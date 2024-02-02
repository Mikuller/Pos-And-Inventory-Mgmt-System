<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        return view('inventory.report.reportRequest');
    }
    public function downloadReport()
    {
        //dd($data);
        $pdf = Pdf::loadView('inventory.report.reportTable', ['data' => session('data', []), 'startDate' => session('startDate', ''), 'endDate' => session('endDate', '')]);
        return $pdf->download('REPORT :' . date('F j, Y, g:i a') . '.pdf');
        // return back()->with('success', 'Invoice Downloaded Successfully!');
    }
}
