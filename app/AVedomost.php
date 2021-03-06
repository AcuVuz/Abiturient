<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AVedomost extends Model
{
	protected $table = 'abit_vedomost';
	public $timestamps = false;

	static public function GetVedomost($ex_id, $st_id, $fo_id, $predmet_id, $typeExam_id, $date_exam)
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
						->where('abit_vedomost.date_vedom', $date_exam)
						->get();
		}
		return $query;
	}

	static public function GetVedomostFromPredmet($st_id, $predmet_id, $typeExam_id, $date_exam)
	{
		$query = AVedomost::select('abit_vedomost.*', 'te.name')
					->leftjoin('abit_typeExam as te', 'te.id', 'abit_vedomost.type_exam_id')
					->where('abit_vedomost.st_id', $st_id)
					->where('abit_vedomost.predmet_id', $predmet_id)
					->where('abit_vedomost.type_exam_id', $typeExam_id)
					->where('abit_vedomost.date_vedom', $date_exam)
					->get();
		
		return $query;
	}
	
	static public function CountPers($ved_id, $typeExam_id)
	{
		if ($typeExam_id == 3) {
			$query = AExamsCard::select('abit_examCard.*')
						->leftjoin('abit_statements as st', 'st.id', 'abit_examCard.state_id')
						->whereNull('st.date_return')
						->whereNotNull('abit_examCard.ball')
						->where('abit_examCard.ved_id', $ved_id)
						->count();
		}
		else
		{
			$query = AExamsCard::select('abit_examCard.*')
					->leftjoin('abit_statements as st', 'st.id', 'abit_examCard.state_id')
					->whereNull('st.date_return')
					->where('abit_examCard.ved_id', $ved_id)
					->count();
		}

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

	static public function FillVedomost($ved_id, $limit, $actual, $examenGroup_id, $date_exam, $typeExam_id, $predmet_id)
	{
		$lim = $limit - $actual;
		if (isset($examenGroup_id)) {
			if ($typeExam_id == 3) {
				$examCard = AExamsCard::select('abit_examCard.id')
							->leftjoin('abit_statements as st', 'st.id', 'abit_examCard.state_id')
							->whereNull('st.date_return')
							->whereNull('ved_id')
							->whereNotNull('abit_examCard.ball')
							->where('exam_id', $examenGroup_id)
							->limit($lim)
							->get();
				
				foreach ($examCard as $ec) {
					$ec->ved_id = $ved_id;
					$ec->date_exam = $date_exam;
					$ec->save();
				}
			}
			else
			{
				$examCard = AExamsCard::select('abit_examCard.id')
							->leftjoin('abit_statements as st', 'st.id', 'abit_examCard.state_id')
							->whereNull('st.date_return')
							->whereNull('ved_id')
							->where('exam_id', $examenGroup_id)
							->limit($lim)
							->get();
				
				foreach ($examCard as $ec) {
					$ec->ved_id = $ved_id;
					$ec->date_exam = $date_exam;
					$ec->save();
				}
			}
		} else {
			if ($typeExam_id == 3) {
				$examCard = AExamsCard::select('abit_examCard.id')
							->leftjoin('abit_statements as st', 'st.id', 'abit_examCard.state_id')
							->leftjoin('abit_examenGroup as eg', 'eg.id', 'abit_examCard.exam_id')
							->whereNull('st.date_return')
							->whereNull('ved_id')
							->whereNotNull('abit_examCard.ball')
							->where('eg.predmet_id', $predmet_id)
							->limit($lim)
							->get();
				
				foreach ($examCard as $ec) {
					$ec->ved_id = $ved_id;
					$ec->date_exam = $date_exam;
					$ec->save();
				}
			}
			else
			{
				$examCard = AExamsCard::select('abit_examCard.id')
							->leftjoin('abit_statements as st', 'st.id', 'abit_examCard.state_id')
							->leftjoin('abit_examenGroup as eg', 'eg.id', 'abit_examCard.exam_id')
							->whereNull('st.date_return')
							->whereNull('ved_id')
							->where('eg.predmet_id', $predmet_id)
							->limit($lim)
							->get();
				
				foreach ($examCard as $ec) {
					$ec->ved_id = $ved_id;
					$ec->date_exam = $date_exam;
					$ec->save();
				}
			}
		}
	}

	static public function GetPersVedomost($ved_id)
	{
		$query = AExamsCard::
						select(
							'st.id',
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

	static public function GetAll()
	{
		$query = AVedomost::select(
						'abit_vedomost.id',
						'fo.name as fo_name',
						'st.name as st_name',
						'te.name as te_name',
						'p.name as predmet_name',
						'abit_vedomost.date_vedom',
						'g.name as group_name',
						'g.minid',
						'st.id as st_id'
					)
					->leftjoin('abit_examenGroup as eg', 'eg.id', 'abit_vedomost.examenGroup_id')
					->leftjoin('abit_group as g', 'g.id', 'eg.group_id')
					->leftjoin('abit_formObuch as fo', 'fo.id', 'g.fo_id')
					->leftjoin('abit_stlevel as st', 'st.id', 'abit_vedomost.st_id')
					->leftjoin('abit_typeExam as te', 'te.id', 'abit_vedomost.type_exam_id')
					->leftjoin('abit_predmets as p', 'p.id', 'abit_vedomost.predmet_id')
					->orderby('abit_vedomost.id')
					->get();
		return $query;
	}

	static public function GetInfo($ved_id)
	{
		$query = AVedomost::select(
						'abit_vedomost.id',
						'fo.name as fo_name',
						'st.name as st_name',
						'te.name as te_name',
						'p.name as predmet_name',
						'abit_vedomost.date_vedom',
						'g.name as group_name',
						'g.minid',
						'st.id as st_id'
					)
					->leftjoin('abit_examenGroup as eg', 'eg.id', 'abit_vedomost.examenGroup_id')
					->leftjoin('abit_group as g', 'g.id', 'eg.group_id')
					->leftjoin('abit_formObuch as fo', 'fo.id', 'g.fo_id')
					->leftjoin('abit_stlevel as st', 'st.id', 'abit_vedomost.st_id')
					->leftjoin('abit_typeExam as te', 'te.id', 'abit_vedomost.type_exam_id')
					->leftjoin('abit_predmets as p', 'p.id', 'abit_vedomost.predmet_id')
					->where('abit_vedomost.id', $ved_id)
					->first();
		return $query;
	}

	static public function remove($ved_id)
	{
		$query = AVedomost::select('*')->where('id', $ved_id)->first();
        $query->delete();
	}

	static public function GetPersFromVedom($ved_id)
	{
		$query = AExamsCard::select('abit_examCard.*', 'p.famil', 'p.name', 'p.otch', 'p.id as pid', 'pr.test_id as tid')
					->leftjoin('abit_statements as ast', 'ast.id', 'abit_examCard.state_id')
					->leftjoin('abit_examenGroup as eg', 'eg.id', 'abit_examCard.exam_id')
					->leftjoin('abit_predmets as pr', 'pr.id', 'eg.predmet_id')
					->leftjoin('persons as p', 'p.id', 'ast.person_id')
					->where('ved_id', '=', $ved_id)->orderBy('p.famil')->get();
		return $query;
	}
}
