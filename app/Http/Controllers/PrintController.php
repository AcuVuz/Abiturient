<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use PDF;
use App\Persons;

class PrintController extends Controller
{
    public function lich_card(Request $request)
    {
        $person = Persons::GetPerson($request->pid);
        $statements = Persons::GetStatement($request->pid, false);
        $documentObr = Persons::GetDocumentObr($request->pid);
        $lgots  = Persons::GetLgots($request->pid);
        $lgot = '';
        $shifr = '';
        $spec = '';
        foreach ($statements as $state) 
        {
            $shifr .= $state->shifr.', ';
            $spec .= $state->SpecName.', ';
        }

        foreach ($lgots as $l) $lgot .= $l->name.', ';

        return view('ReportPages.Report_LichKarta', 
            [
                'person' => $person,
                'shifr' => $shifr,
                'spec'  => $spec,
                'documentObr' => $documentObr,
                'lgots' => $lgot
            ]
        );
        /*$pdf = PDF::loadView(
            'ReportPages.Report_LichKarta'
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
