<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\Parcela;

class PDFController extends Controller
{
    public function index()
    {
        $pdf = PDF::loadView('pdf');
        return $pdf->download('pdf.pdf');
    }
}
