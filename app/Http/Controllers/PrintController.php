<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use PDF;

class PrintController extends Controller
{
    public function lich_card(Request $request)
    {
        return view('ReportPages.Report_LichKarta');
        /*$pdf = PDF::loadView(
            'ReportPages.Report_LichKarta',
            [
                'test_name'         => $test_name,
                'countAllQuestion'  => $countAllQuestion,
                'maxBall'           => $maxBall,
                'countAnswer'       => $countAnswer,
                'countTrueAnswer'   => $countTrueAnswer,
                'countFalseAnswer'  => $countFalseAnswer,
                'correctBall'       => $correctBall,
                'fio'               => $fio,
                'minid'             => $minid,
                'facult'            => $facult,
                'spec'              => $spec,
                'fo'                => $fo,
                'stlevel'           => $stlevel,
                'test_type'         => $test->typeTestName
            ]
        );
        return $pdf->stream();*/
    }

    public function opis(Request $request)
    {
        return view('ReportPages.Report_Raspiska');
    }

    public function statement(Request $request)
    {
        return view('ReportPages.Report_Zajav');
    }

    public function examSheet(Request $request)
    {
         
    }
}
