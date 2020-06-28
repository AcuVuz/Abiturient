<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use PDF;
use App\Persons;
use App\AStatments;
use App\ADocument;
use App\ASertificate;

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
        $statement = AStatments::GetStatement($request->asid);
        $person = Persons::GetPerson($statement->person_id);
        $docObr = Persons::GetDocumentObr($statement->person_id);
        $docPers = ADocument::GetPersonDocument($statement->person_id);
        return view('ReportPages.Report_Raspiska', 
            [ 
                'statement' => $statement,
                'person'    => $person,
                'docObr'    => $docObr,
                'docPers'   => $docPers
            ]
        );
    }

    public function statement(Request $request)
    {
        $statement = AStatments::GetStatement($request->asid);
        $person = Persons::GetPerson($statement->person_id);
        $docObr = Persons::GetDocumentObr($statement->person_id);
        $sertificate = ASertificate::GetPersSertificate($statement->person_id);
        return view('ReportPages.Report_Zajav',
            [
                'statement' => $statement,
                'person'    => $person,
                'docObr'    => $docObr,
                'sertificate' => $sertificate
            ]
        );
    }

    public function examSheet(Request $request)
    {
         
    }
}
