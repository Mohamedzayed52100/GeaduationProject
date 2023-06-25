<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\PDF;

class ReportPDFController extends Controller
{
    public function index()
    {
        $emps = [];
        for ($i = 0; $i < 15; $i++) {
            $emp = [];
            $emp['name'] = "Emp_" . $i;
            $emp['gender'] = "M";
            $emp['salary'] = rand(300, 1000);
            $emp['withholding_tax'] = rand(1, 30);
            $emp['netpay'] = rand(300, 1000);
            $emps[] = $emp;
        }
        $data = [
            'title' => 'Welcome to cambotutorial.com',
            'date' => date('M-Y'),
            'data' => $emps,
        ];

        // export pdf generate with setting A4 and Landscape
        $pdf = PDF::loadView('reportpdf', $data)->setPaper('a4', 'landscape');
        return $pdf->download('report.pdf');

    }
}