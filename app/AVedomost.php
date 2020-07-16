<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AVedomost extends Model
{
	protected $table = 'abit_vedomost';
	public $timestamps = false;

	static public function GetVedomost($ex_id, $st_id, $fo_id, $predmet_id, $typeExam_id)
	{
		
		if (isset($ex_id)) {
			$query = AVedomost::select('abit_vedomost.*', 'te.name')
						->leftjoin('abit_typeExam as te', 'te.id', 'abit_vedomost.type_exam_id')
						->where('abit_vedomost.examenGroup_id', $ex_id)
						->get();
		} else {
			$query = AVedomost::select('abit_vedomost.*', 'te.name')
						->leftjoin('abit_typeExam as te', 'te.id', 'abit_vedomost.type_exam_id')
						->where('abit_vedomost.st_id', $st_id)
						->where('abit_vedomost.fo_id', $fo_id)
						->where('abit_vedomost.predmet_id', $predmet_id)
						->where('abit_vedomost.type_exam_id', $typeExam_id)
						->get();
		}
		return $query;
	}
	
	static public function CountPers($ved_id)
	{
		$query = AExamsCard::select('abit_examCard.*')
					->where('abit_examCard.ved_id', $ved_id)
					->count();

		return $query;
	}

	static public function Create($examenGroup_id, $st_id, $fo_id, $predmet_id, $typeExam_id, $date_vedom)
	{
		$query = new AVedomost;
		$query->examenGroup_id = $examenGroup_id;
		$query->st_id = $st_id;
		$query->fo_id = $fo_id;
		$query->predmet_id = $predmet_id;
		$query->type_exam_id = $typeExam_id;
		$query->date_vedom = $date_vedom;
		$query->save();

		return $query;
	}

	static public function FillVedomost($ved_id, $limit, $actual, $examenGroup_id, $date_exam)
	{
		$lim = $limit - $actual;
		$examCard = AExamsCard::select('id')->whereNull('ved_id')->where('exam_id', $examenGroup_id)->limit($lim)->get();
		
		foreach ($examCard as $ec) {
			$ec->ved_id = $ved_id;
			$ec->date_exam = $date_exam;
			$ec->save();
		}
		
	}

	static public function GetPersVedomost($ved_id)
	{
		$query = AExamsCard::
						select(
							'st.shifr_statement',
							'pers.famil',
							'pers.name',
							'pers.otch',
							'abit_examCard.ball'
						)
						->leftjoin('abit_statements as st', 'st.id', 'abit_examCard.state_id')
						->leftjoin('persons as pers', 'pers.id', 'st.person_id')
						->where('ved_id', $ved_id)
						->get();
		return $query;
	}
}
