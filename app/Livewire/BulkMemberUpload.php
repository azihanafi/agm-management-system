<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class BulkMemberUpload extends Component
{
    use WithFileUploads;

    public $csvFile    = null;
    public $previewRows = [];
    public $totalRows  = 0;
    public $delimiter  = ',';
    public $result     = null;
    public $logs       = [];

    // ─── Template download ────────────────────────────────────────────────────

    public function downloadTemplate()
    {
        return response()->streamDownload(function () {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['Name', 'Staff ID', 'Workplace']);
            fputcsv($out, ['JOHN DOE',   '1234567', 'HQ - Block A']);
            fputcsv($out, ['JANE SMITH', '7654321', 'Branch Office']);
            fclose($out);
        }, 'member_template.csv', ['Content-Type' => 'text/csv']);
    }

    // ─── File lifecycle ───────────────────────────────────────────────────────

    public function updatedCsvFile()
    {
        $this->reset(['previewRows', 'totalRows', 'result', 'logs']);
        $this->resetErrorBag();

        if (!$this->csvFile) return;

        $ext = strtolower($this->csvFile->getClientOriginalExtension());
        if (in_array($ext, ['xlsx', 'xls'])) {
            $this->addError('csvFile', 'Excel files are not supported. Please save your file as CSV and try again.');
            $this->csvFile = null;
            return;
        }

        try {
            $this->validate([
                'csvFile' => 'required|mimetypes:text/csv,text/plain,application/csv,application/vnd.ms-excel,application/octet-stream|max:2048',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->csvFile = null;
            throw $e;
        }

        $this->parsePreview();
    }

    public function clearFile()
    {
        $this->reset(['csvFile', 'previewRows', 'totalRows', 'result', 'logs', 'delimiter']);
        $this->resetErrorBag();
    }

    public function resetAll()
    {
        $this->clearFile();
    }

    // ─── CSV parsing ──────────────────────────────────────────────────────────

    private function readLines(): array
    {
        $content = file_get_contents($this->csvFile->getRealPath());
        $content = str_replace("\xEF\xBB\xBF", '', $content);          // strip UTF-8 BOM
        $content = str_replace(["\r\n", "\r"], "\n", $content);
        return array_values(array_filter(
            explode("\n", $content),
            fn($l) => trim($l) !== ''
        ));
    }

    private function detectDelimiter(string $headerLine): string
    {
        foreach ([';', "\t", '|'] as $d) {
            if (str_contains($headerLine, $d)) return $d;
        }
        return ',';
    }

    private function parsePreview(): void
    {
        $lines = $this->readLines();

        if (count($lines) < 2) {
            $this->addError('csvFile', 'The file is empty or contains no data rows.');
            $this->csvFile = null;
            return;
        }

        $this->delimiter  = $this->detectDelimiter($lines[0]);
        $this->previewRows = [];
        $count = 0;

        foreach (array_slice($lines, 1) as $line) {
            $row = str_getcsv($line, $this->delimiter);
            if (count($row) < 3 || empty(trim($row[0]))) continue;

            if ($count < 5) {
                $this->previewRows[] = [
                    'name'      => trim($row[0]),
                    'staff_id'  => trim($row[1]),
                    'workplace' => trim($row[2]),
                ];
            }
            $count++;
        }

        $this->totalRows = $count;

        if ($count === 0) {
            $this->addError('csvFile', 'No valid rows found. Make sure columns are in order: Name, Staff ID, Workplace.');
            $this->csvFile = null;
        }
    }

    // ─── Import ───────────────────────────────────────────────────────────────

    public function import()
    {
        if (!$this->csvFile) return;

        $this->result = null;
        $this->logs   = [];

        try {
            $lines = $this->readLines();

            if (count($lines) < 2) {
                throw new \Exception('File appears to be empty.');
            }

            $added      = 0;
            $duplicates = 0;
            $failed     = 0;

            foreach (array_slice($lines, 1) as $index => $line) {
                $rowNum = $index + 2;
                $row    = str_getcsv($line, $this->delimiter);

                if (count($row) < 3 || empty(trim($row[0]))) {
                    $this->logs[] = ['type' => 'error', 'msg' => "Row {$rowNum}: Skipped — invalid format or missing columns."];
                    $failed++;
                    continue;
                }

                $name      = strtoupper(trim($row[0]));
                $staffId   = trim($row[1]);
                $workplace = trim($row[2]);

                if (empty($staffId)) {
                    $this->logs[] = ['type' => 'error', 'msg' => "Row {$rowNum}: Skipped — Staff ID is empty."];
                    $failed++;
                    continue;
                }

                try {
                    if (User::where('staff_id', $staffId)->exists()) {
                        $this->logs[] = ['type' => 'duplicate', 'msg' => "Row {$rowNum}: {$name} ({$staffId}) — already exists, skipped."];
                        $duplicates++;
                        continue;
                    }

                    User::create([
                        'name'          => $name,
                        'staff_id'      => $staffId,
                        'workplace'     => $workplace,
                        'password'      => Hash::make($staffId),
                        'role'          => 'member',
                        'is_new_member' => false,
                    ]);

                    $this->logs[] = ['type' => 'ok', 'msg' => "Row {$rowNum}: {$name} ({$staffId}) — added successfully."];
                    $added++;

                } catch (\Throwable $e) {
                    $this->logs[] = ['type' => 'error', 'msg' => "Row {$rowNum}: {$name} — " . $e->getMessage()];
                    $failed++;
                }
            }

            $this->result = compact('added', 'duplicates', 'failed');
            $this->dispatch('members-updated');
            $this->reset(['csvFile', 'previewRows', 'totalRows', 'delimiter']);

        } catch (\Throwable $e) {
            $this->result = ['added' => 0, 'duplicates' => 0, 'failed' => 0, 'error' => $e->getMessage()];
            $this->logs[] = ['type' => 'error', 'msg' => 'Fatal error: ' . $e->getMessage()];
        }
    }

    // ─── Render ───────────────────────────────────────────────────────────────

    public function render()
    {
        return view('livewire.bulk-member-upload');
    }
}
