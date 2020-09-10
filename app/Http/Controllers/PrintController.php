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
use App\AExamsCard;
use App\AStatementLgot;
use App\AVedomost;
use App\Tests;
use App\TestScatter;
use App\Questions;
use App\QuestionDetails;

class PrintController extends Controller
{
	static public function numberToRussian ($sourceNumber){ 
		//Целое значение $sourceNumber вывести прописью по-русски
		//Максимальное значение для аругмента-числа PHP_INT_MAX
		//Максимальное значение для аругмента-строки минус/плюс 999999999999999999999999999999999999
		$smallNumbers=array( //Числа 0..999
			array('ноль'),
			array('','один','два','три','четыре','пять','шесть','семь','восемь','девять'),
			array('десять','одиннадцать','двенадцать','тринадцать','четырнадцать',
				'пятнадцать','шестнадцать','семнадцать','восемнадцать','девятнадцать'),
			array('','','двадцать','тридцать','сорок','пятьдесят','шестьдесят','семьдесят','восемьдесят','девяносто'),
			array('','сто','двести','триста','четыреста','пятьсот','шестьсот','семьсот','восемьсот','девятьсот'),
			array('','одна','две')
		);
		$degrees=array(
			array('дофигальон','','а','ов'), //обозначение для степеней больше, чем в списке
			array('тысяч','а','и',''), //10^3
			array('миллион','','а','ов'), //10^6
			array('миллиард','','а','ов'), //10^9
			array('триллион','','а','ов'), //10^12
			array('квадриллион','','а','ов'), //10^15
			array('квинтиллион','','а','ов'), //10^18
			array('секстиллион','','а','ов'), //10^21
			array('септиллион','','а','ов'), //10^24
			array('октиллион','','а','ов'), //10^27
			array('нониллион','','а','ов'), //10^30
			array('дециллион','','а','ов') //10^33
			//досюда написано в Вики по нашей короткой шкале: https://ru.wikipedia.org/wiki/Именные_названия_степеней_тысячи
		);
		
		if ($sourceNumber==0) return $smallNumbers[0][0]; //Вернуть ноль
		$sign = '';
		if ($sourceNumber<0) {
			$sign = 'минус '; //Запомнить знак, если минус
			$sourceNumber = substr ($sourceNumber,1);
		}
		$result=array(); //Массив с результатом
	   
		//Разложение строки на тройки цифр
		$digitGroups = array_reverse(str_split(str_pad($sourceNumber,ceil(strlen($sourceNumber)/3)*3,'0',STR_PAD_LEFT),3));
		foreach($digitGroups as $key=>$value){
		 	$result[$key]=array();
		 	//Преобразование трёхзначного числа прописью по-русски
		 	foreach ($digit=str_split($value) as $key3=>$value3) {
		  		if (!$value3) continue;
		  		else {
					switch ($key3) {
						case 0: 
							$result[$key][] = $smallNumbers[4][$value3]; 
							break;
						case 1: 
							if ($value3==1) {
								$result[$key][]=$smallNumbers[2][$digit[2]];
								break 2;
							}
							else $result[$key][]=$smallNumbers[3][$value3];
							break;
						case 2:
							if (($key==1)&&($value3<=2)) $result[$key][]=$smallNumbers[5][$value3];
							else $result[$key][]=$smallNumbers[1][$value3];
							break;
					}
				}
			}
		 	$value*=1;
		 	if (!$degrees[$key]) $degrees[$key]=reset($degrees);
		 
		 	//Учесть окончание слов для русского языка
			if ($value && $key) {
				$index = 3;
				if (preg_match("/^[1]$|^\\d*[0,2-9][1]$/",$value)) $index = 1; //*1, но не *11
				else if (preg_match("/^[2-4]$|\\d*[0,2-9][2-4]$/",$value)) $index = 2; //*2-*4, но не *12-*14
				$result[$key][]=$degrees[$key][0].$degrees[$key][$index];
			}
		 	$result[$key]=implode(' ',$result[$key]);
		}
		return $sign.implode(' ',array_reverse($result));
	}

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
		$statement = AStatments::GetStatement($request->asid);
		$person = Persons::GetPerson($statement->person_id);
		$docObr = Persons::GetDocumentObr($statement->person_id);
		$examCard = AExamsCard::GetExamCard($statement->id);
		return view('ReportPages.Report_Ekzcart',
			[
				'statement'     => $statement,
				'person'        => $person,
				'docObr'        => $docObr,
				'examCard'      => $examCard
			]
		);
	}

	public function vedomost(Request $request)
	{ 
		$vedomost = AVedomost::GetPersVedomost($request->ved_id);   
		$ved_info = AVedomost::GetInfo($request->ved_id);
		$text_ball = [];

		foreach ($vedomost as $ved) {
			$text_ball += [
				$ved->id => isset($ved->ball) ? PrintController::numberToRussian($ved->ball) : ''
			];
		}
		
		return view('ReportPages.Report_vedomost', 
			[
				'vedomost' 	=> $vedomost,
				'text_ball'	=> $text_ball,
				'ved_info'	=> $ved_info
			]
		);
	}

	public function printtest_show(Request $request)
	{
		$role = session('role_id');
		$users = session('user_name');
		$predmet = DB::table('abit_predmets as ap')
					->leftjoin('abit_stlevel as ast', 'ast.id', 'ap.stlevel_id')
					->where('ap.is_vuz', 'T')
					->whereNotNull('ap.test_id')
					->whereNotIn('ap.test_id', [198, 199])
					->select('ap.*', 'ast.name as StName')
					->orderby('ap.name', 'asc')
					->get();
		return view('DashboardPage.Print_test_show', 
			[
				'title'     => 'Печать тестов',
				'role'      => $role,
				'username'  => $users,
				'predmet'	=> $predmet
			]
		); 
	}

	public function search_predmet(Request $request)
    {
        $predmet = DB::table('abit_predmets as ap')
                        ->leftjoin('abit_stlevel as ast', 'ast.id', 'ap.stlevel_id')
                        ->where('ap.is_vuz', 'T')
						->where('ap.name', 'LIKE', '%'.$request->text.'%')
						->whereNotNull('ap.test_id')
						->whereNotIn('ap.test_id', [198, 199])
                        ->select('ap.*', 'ast.name as StName')
                        ->orderby('ap.name', 'asc')->get();
        $data = '';
        foreach ($predmet as $p) {
            $data .= '<tr onclick="toggle_tr('.$p->test_id.');"><td class="text-left">'.$p->name.'</td><td class="text-left">'.$p->StName.'</td></tr>';
        }
        return $data;
	}
	
	public function test(Request $request)
	{ 
		$test_head = Tests::GetTestHead($request->tid); 
		$test_scatter = TestScatter::GetTestScatter($test_head->id);  
		$test_body = [];
		foreach ($test_scatter as $sc) {
			$question = Questions::GetQuestions($test_head->id, $sc->ball, $sc->ball_count);
			foreach($question as $q)
			{
				$test_body += [
					$q->id => [
						'question' 		=> QuestionDetails::GetQuestionsDetails($q->id),
						'question_text'	=> QuestionDetails::GetQuestionText($q->id),
						'ball'			=> $q->ball
					]
				];
			}
		}
		shuffle($test_body);
		return view('ReportPages.Print_test', 
			[
				'test_head' => $test_head,
				'test_body'	=> $test_body
			]
		);
	}

	public function abitformon() {
		$abits = AStatments::select(
						"abit_statements.id",
						"p.famil", 
						"p.name", 
						"p.otch", 
						"p.gender", 
						"p.birthday", 
						"p.country",
						"p.adr_obl",
						"p.adr_rajon",
						"p.adr_city",
						"p.adr_street",
						"p.adr_house",
						"p.adr_flatroom",
						'ag.name as spec',
						'ag.minid',
						'fo.name as fo_name',
						'ag.st_id',
						'ap.is_budg'
					)
					->leftjoin('persons as p', 'p.id', 'abit_statements.person_id')
					->leftjoin('abit_prikaz as ap', 'ap.id', 'abit_statements.prikaz_zach_id')
					->leftjoin('abit_group as ag', 'ag.id', 'abit_statements.group_id')
					->leftjoin('abit_formObuch as fo', 'fo.id', 'ag.fo_id')
					->whereNotNull('abit_statements.prikaz_zach_id')
					->get();
		$lgot = [];
		foreach ($abits as $abit) {
			$lgot += [
				$abit->id => AStatementLgot::where('state_id', '=', $abit->id)->count()
			];
		}
		return view('ReportPages.Report_AbitMon', ["abits" => $abits, "lgot" => $lgot]);
	}
}
