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
use App\APersPriv;

class PrintController extends Controller
{
    public function lich_card(Request $request)
    {
        $statement = AStatments::GetStatement($request->asid);
        $person = Persons::GetPerson($statement->person_id);
        $documentObr = Persons::GetDocumentObr($statement->person_id);
        $lgots  = Persons::GetLgots($statement->person_id);
        $lgot = '';

        foreach ($lgots as $l) $lgot .= $l->name.', ';

        return view('ReportPages.Report_LichKarta', 
            [
                'person' => $person,
                'statement' => $statement,
                'documentObr' => $documentObr,
                'lgots' => $lgot
            ]
        );
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
        $allPrivilege = APersPriv::GetPersAllPrivilege($statement->person_id);
        return view('ReportPages.Report_Zajav',
            [
                'statement'     => $statement,
                'person'        => $person,
                'docObr'        => $docObr,
                'sertificate'   => $sertificate,
                'allPrivilege'  => $allPrivilege
            ]
        );
    }

    public function examSheet(Request $request)
    {
         
    }
}
