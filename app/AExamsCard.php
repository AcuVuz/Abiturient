<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AExamsCard extends Model
{
	protected $table = 'abit_examCard';
	public $timestamps = false;

	static public function GetExamCard($state_id)
	{
		$query = AExamsCard::select
					(
						'p.name as pred_name',
						'abit_examCard.*'
					)
					->leftjoin('abit_examenGroup as eg', 'eg.id', 'abit_examCard.exam_id')
					->leftjoin('abit_predmets as p', 'p.id', 'eg.predmet_id')
					->where('abit_examCard.state_id', $state_id)
					->get();

		return $query;
	}

	static public function GetAllExamCard($examen_id, $exType = 0, $predmet_id)
	{
		if (isset($examen_id)) {
			if ($exType == 3)
			{
				$query = AExamsCard::select('abit_examCard.*')
							->leftjoin('abit_statements as st', 'st.id', 'abit_examCard.state_id')
							->whereNull('st.date_return')
							->whereNull('ved_id')
							->whereNotNull('ball')
							->where('exam_id', $examen_id)
							->get();
			}
			else
			{
				$query = AExamsCard::select('abit_examCard.*')
				->leftjoin('abit_statements as st', 'st.id', 'abit_examCard.state_id')
				->whereNull('st.date_return')
				->whereNull('ved_id')
				->where('exam_id', $examen_id)
				->get();
			}
		} else {
			if ($exType == 3)
			{
				$query = AExamsCard::select('abit_examCard.*')
							->leftjoin('abit_statements as st', 'st.id', 'abit_examCard.state_id')
							->leftjoin('abit_examenGroup as eg', 'eg.id', 'abit_examCard.exam_id')
							->whereNull('st.date_return')
							->whereNull('ved_id')
							->whereNotNull('ball')
							->where('eg.predmet_id', $predmet_id)
							->get();
			}
			else
			{
				$query = AExamsCard::select('abit_examCard.*')
							->leftjoin('abit_statements as st', 'st.id', 'abit_examCard.state_id')
							->leftjoin('abit_examenGroup as eg', 'eg.id', 'abit_examCard.exam_id')
							->whereNull('st.date_return')
							->whereNull('ved_id')
							->where('eg.predmet_id', $predmet_id)
							->get();
			}
		}
		return $query;
	}
	static public function GetReitMag($gid){
			$query = DB::select('CALL abit_reit_mag(?)',[$gid]);
			$k = [];
			$i = 0;

			foreach ($query as $key) {

				$k +=[$i =>[ $key->number,
							$key->famil,
							$key->Pname,
							$key->otch,
							$key->srbal,
							$key->count_exam,
							$key->name_exam,
							$key->exam_ball,
							$key->sum_all_ball
						]];
				$i++;
			}

			$arr=array
			(
				"data" => $k
			);

			return $arr;
	}

}
