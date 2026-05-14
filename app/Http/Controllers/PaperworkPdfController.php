<?php

namespace App\Http\Controllers;

use App\Models\Paperwork;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PaperworkPdfController extends Controller
{
    public function download($id)
    {
        $paperwork = Paperwork::with(['budgetItems', 'itineraryItems'])->findOrFail($id);
        
        $pdf = Pdf::loadView('pdf.paperwork', compact('paperwork'));
        
        $filename = 'Paperwork_' . str_replace(' ', '_', $paperwork->program_title) . '.pdf';
        
        return $pdf->download($filename);
    }

    public function stream($id)
    {
        $paperwork = Paperwork::with(['budgetItems', 'itineraryItems'])->findOrFail($id);
        
        $pdf = Pdf::loadView('pdf.paperwork', compact('paperwork'));
        
        return $pdf->stream();
    }
}
