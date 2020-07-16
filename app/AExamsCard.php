<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
