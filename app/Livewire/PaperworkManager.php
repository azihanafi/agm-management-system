<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Paperwork;
use App\Models\PaperworkBudgetItem;
use App\Models\PaperworkItineraryItem;
use Illuminate\Support\Facades\DB;

class PaperworkManager extends Component
{
    public $paperwork_id;
    public $kepada = '';
    public $sk = '';
    public $daripada = '';
    public $tarikh = '';
    public $perkara = '';
    
    public $program_title = '';
    public $program_date = '';
    public $program_day = '';
    public $program_time = '';
    public $program_location = '';
    
    public $syarat_penyertaan = '';
    public $cadangan_syarat = '';
    
    public $budgetItems = [];
    public $itineraryItems = [];
    
    public $status = 'draft';
    public $current_level = 1;
    public $comments = '';

    public $total_budget = 0;

    protected $rules = [
        'kepada' => 'required|string',
        'daripada' => 'required|string',
        'tarikh' => 'required|date',
        'perkara' => 'required|string',
        'program_title' => 'required|string',
        'program_date' => 'required|date',
        'program_day' => 'required|string',
        'program_time' => 'required|string',
        'program_location' => 'required|string',
    ];

    public function mount($paperworkId = null)
    {
        if ($paperworkId) {
            $this->loadPaperwork($paperworkId);
        } else {
            $this->addBudgetItem();
            $this->addItineraryItem();
            $this->tarikh = date('Y-m-d');
            $this->program_date = date('Y-m-d');
        }
    }

    public function loadPaperwork($id)
    {
        $paperwork = Paperwork::with(['budgetItems', 'itineraryItems'])->findOrFail($id);
        $this->paperwork_id = $paperwork->id;
        $this->fill($paperwork->toArray());
        $this->budgetItems = $paperwork->budgetItems->toArray();
        $this->itineraryItems = $paperwork->itineraryItems->toArray();
        $this->calculateTotal();
    }

    public function addBudgetItem()
    {
        $this->budgetItems[] = [
            'description' => '',
            'price' => 0,
            'quantity' => 1,
            'unit' => 'Unit',
            'total_price' => 0
        ];
    }

    public function removeBudgetItem($index)
    {
        unset($this->budgetItems[$index]);
        $this->budgetItems = array_values($this->budgetItems);
        $this->calculateTotal();
    }

    public function addItineraryItem()
    {
        $this->itineraryItems[] = [
            'time' => '',
            'activity' => ''
        ];
    }

    public function removeItineraryItem($index)
    {
        unset($this->itineraryItems[$index]);
        $this->itineraryItems = array_values($this->itineraryItems);
    }

    public function updatedBudgetItems($value, $key)
    {
        $parts = explode('.', $key);
        if (count($parts) >= 2) {
            $index = $parts[0];
            $field = $parts[1];

            if ($field === 'price' || $field === 'quantity') {
                $price = floatval($this->budgetItems[$index]['price']);
                $qty = intval($this->budgetItems[$index]['quantity']);
                $this->budgetItems[$index]['total_price'] = $price * $qty;
            }
        }
        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        $this->total_budget = array_sum(array_column($this->budgetItems, 'total_price'));
    }

    public function save($submit = false)
    {
        $this->validate();

        // Terminal logic validation for Esport MLBB
        if (str_contains(strtolower($this->perkara), 'esport mlbb') || str_contains(strtolower($this->program_title), 'esport mlbb')) {
            $hasTerminalConstraint = false;
            foreach ($this->itineraryItems as $item) {
                if (preg_match('/Terminal [123]|FGT/i', $item['activity'])) {
                    // Logic to check group counts if they were in a specific field
                    // For now, we'll just add a validation message if more than 4 groups are mentioned in text
                    if (preg_match('/([5-9]|\d{2,}) groups/i', $item['activity'])) {
                         $this->addError('itineraryItems', 'Terminal 1, 2, 3 & FGT are limited to 4 groups.');
                         return;
                    }
                } elseif (preg_match('/Terminal [^123]/i', $item['activity'])) {
                    if (preg_match('/([3-9]|\d{2,}) groups/i', $item['activity'])) {
                         $this->addError('itineraryItems', 'Other terminals are limited to 2 groups.');
                         return;
                    }
                }
            }
        }

        DB::transaction(function () use ($submit) {
            $paperwork = Paperwork::updateOrCreate(
                ['id' => $this->paperwork_id],
                [
                    'kepada' => $this->kepada,
                    'sk' => $this->sk,
                    'daripada' => $this->daripada,
                    'tarikh' => $this->tarikh,
                    'perkara' => $this->perkara,
                    'program_title' => $this->program_title,
                    'program_date' => $this->program_date,
                    'program_day' => $this->program_day,
                    'program_time' => $this->program_time,
                    'program_location' => $this->program_location,
                    'syarat_penyertaan' => $this->syarat_penyertaan,
                    'cadangan_syarat' => $this->cadangan_syarat,
                    'status' => $submit ? 'submitted' : $this->status,
                    'current_level' => $submit ? 1 : $this->current_level,
                ]
            );

            $this->paperwork_id = $paperwork->id;

            $paperwork->budgetItems()->delete();
            foreach ($this->budgetItems as $item) {
                $paperwork->budgetItems()->create($item);
            }

            $paperwork->itineraryItems()->delete();
            foreach ($this->itineraryItems as $item) {
                $paperwork->itineraryItems()->create($item);
            }
        });

        session()->flash('message', $submit ? 'Paperwork submitted successfully!' : 'Paperwork saved as draft.');
        return redirect()->route('paperwork.index');
    }

    public function approve($level)
    {
        $paperwork = Paperwork::findOrFail($this->paperwork_id);
        
        if ($level == 2) {
            $paperwork->status = 'level2_approved';
            $paperwork->current_level = 3;
        } elseif ($level == 3) {
            $paperwork->status = 'level3_approved'; // Support
            $paperwork->current_level = 4;
        } elseif ($level == 4) {
            $paperwork->status = 'approved';
        }

        $paperwork->save();
        session()->flash('message', 'Paperwork approved at level ' . $level);
    }

    public function reject($level)
    {
        $paperwork = Paperwork::findOrFail($this->paperwork_id);
        $paperwork->status = 'rejected';
        $paperwork->comments = $this->comments;
        $paperwork->save();
        session()->flash('message', 'Paperwork rejected.');
    }

    public function render()
    {
        return view('livewire.paperwork-manager');
    }
}
