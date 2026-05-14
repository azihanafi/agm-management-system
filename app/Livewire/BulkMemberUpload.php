<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class BulkMemberUpload extends Component
{
    use WithFileUploads;

    public $csvFile;
    public $logs = [];
    public $isProcessing = false;
    public $previewData = [];
    public $totalRows = 0;
    public $importSummary = null;

    public function downloadTemplate()
    {
        $headers = ['Name', 'Staff ID', 'Workplace'];
        $callback = function() use ($headers) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $headers);
            fputcsv($file, ['JOHN DOE', '1234567', 'FJB - T1, T2, T3']);
            fputcsv($file, ['JANE SMITH', '7654321', 'FGVGT']);
            fclose($file);
        };

        return response()->streamDownload($callback, 'member_template.csv', [
            'Content-Type' => 'text/csv',
        ]);
    }

    public function updatedCsvFile()
    {
        $extension = strtolower($this->csvFile->getClientOriginalExtension());
        if (in_array($extension, ['xlsx', 'xls'])) {
            $this->addError('csvFile', 'Excel files (.xlsx) are not supported. Please save your file as a CSV (Comma Separated Values) and try again.');
            $this->reset(['csvFile', 'previewData', 'totalRows']);
            return;
        }

        try {
            $this->validate([
                'csvFile' => 'required|mimetypes:text/csv,text/plain,application/csv,application/vnd.ms-excel,application/octet-stream|max:2048',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->reset(['previewData', 'totalRows']);
            throw $e;
        }

        $this->logs = [];
        $this->previewData = [];
        
        $content = file_get_contents($this->csvFile->getRealPath());
        $content = str_replace("\xEF\xBB\xBF", '', $content);
        $content = str_replace(["\r\n", "\r"], "\n", $content);
        $lines = explode("\n", $content);

        $headerLine = $lines[0] ?? '';
        $delimiter = ",";
        if (str_contains($headerLine, ';')) $delimiter = ";";
        elseif (str_contains($headerLine, "\t")) $delimiter = "\t";
        elseif (str_contains($headerLine, "|")) $delimiter = "|";

        $rowCount = 0;
        foreach (array_slice($lines, 1) as $line) {
            $line = trim($line);
            if (empty($line)) continue;
            $row = str_getcsv($line, $delimiter);
            if (count($row) >= 3 && !empty($row[0])) {
                if ($rowCount < 6) {
                    $this->previewData[] = $row;
                }
                $rowCount++;
            }
        }

        $this->totalRows = $rowCount;
        
        if ($this->totalRows <= 0 && $this->csvFile) {
            $this->addError('csvFile', 'No valid data found in this CSV. Please check the column order (Name, Staff ID, Workplace).');
            $this->reset(['previewData', 'totalRows']);
        }
    }

    public function clearFile()
    {
        $this->reset(['csvFile', 'previewData', 'totalRows']);
    }

    public function upload()
    {
        $this->resetErrorBag();
        
        if (!$this->csvFile) {
            $this->addError('csvFile', 'Please select a file first.');
            return;
        }

        $this->isProcessing = true;
        $this->logs = [];
        $this->importSummary = null;
        
        try {
            // Read content into memory to avoid file system issues
            $content = file_get_contents($this->csvFile->getRealPath());
            $content = str_replace("\xEF\xBB\xBF", '', $content); // Remove BOM
            
            // Normalize line endings
            $content = str_replace(["\r\n", "\r"], "\n", $content);
            $lines = explode("\n", $content);

            if (count($lines) < 2) {
                throw new \Exception("The file seems to be empty or has no data rows.");
            }

            // Detect Delimiter from header
            $headerLine = $lines[0];
            $delimiter = ",";
            if (str_contains($headerLine, ';')) $delimiter = ";";
            elseif (str_contains($headerLine, "\t")) $delimiter = "\t";
            elseif (str_contains($headerLine, "|")) $delimiter = "|";

            $count = 0;
            $errors = 0;
            $skipped = 0;

            // Process lines (skipping header)
            for ($i = 1; $i < count($lines); $i++) {
                $line = trim($lines[$i]);
                if (empty($line)) continue;

                try {
                    $row = str_getcsv($line, $delimiter);
                    
                    if (count($row) < 3 || empty($row[0])) {
                        $this->logs[] = "Line " . ($i + 1) . ": Invalid format or missing columns.";
                        $skipped++;
                        continue;
                    }

                    $name = strtoupper(trim($row[0]));
                    $staff_id = trim($row[1]);
                    $workplace = trim($row[2]);

                    if (empty($staff_id)) {
                        $this->logs[] = "Line " . ($i + 1) . ": Missing Staff ID.";
                        $skipped++;
                        continue;
                    }

                    if (User::where('staff_id', $staff_id)->exists()) {
                        $this->logs[] = "Line " . ($i + 1) . ": Duplicate Staff ID {$staff_id} skipped.";
                        $skipped++;
                        continue;
                    }

                    User::updateOrCreate(
                        ['staff_id' => $staff_id],
                        [
                            'name' => $name,
                            'workplace' => $workplace,
                            'password' => Hash::make($staff_id),
                            'role' => 'member',
                            'is_new_member' => false
                        ]
                    );
                    
                    $this->logs[] = "Line " . ($i + 1) . ": {$name} processed successfully.";
                    $count++;
                } catch (\Throwable $rowError) {
                    $this->logs[] = "Line " . ($i + 1) . ": ERROR -> " . $rowError->getMessage();
                    $errors++;
                }
            }

            $this->importSummary = [
                'success' => true,
                'count' => $count,
                'skipped' => $skipped,
                'errors' => $errors,
                'message' => "Process Complete: {$count} members added to database."
            ];
            
            $this->dispatch('members-updated');
            $this->reset(['csvFile', 'previewData', 'totalRows']);
            
        } catch (\Throwable $e) {
            $this->importSummary = [
                'success' => false,
                'message' => "Import Failed: " . $e->getMessage()
            ];
            $this->logs[] = "CRITICAL: " . $e->getMessage();
        } finally {
            $this->isProcessing = false;
        }
    }

    public function render()
    {
        return view('livewire.bulk-member-upload');
    }
}
