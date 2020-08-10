<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class APredmets extends Model
{
	protected $table = 'abit_predmets';
	public $timestamps = false;

	static public function GetPredmetZNO()
	{
		$predmet = APredmets::
					select (
						'id',
						'name'
					)
                    ->where('is_zno', 'T')
                    ->orderby('name', 'asc')
					->get();
		return $predmet;
	}

	static public function GetPredmetDovuz()
	{
		$predmet = APredmets::
					select (
						'id',
						'name'
					)
                    ->where('is_dovuz', 'T')
                    ->orderby('name', 'asc')
					->get();
		return $predmet;
	}

	static public function GetPredmetLNU()
	{
		$predmet = APredmets::
					select (
						'id',
						'name'
					)
                    ->where('is_vuz', 'T')
                    ->orderby('name', 'asc')
					->get();
		return $predmet;
	}

	static public function GetGroupPredmet($group_id)
	{
		$predmet = APredmets::
					select (
						'abit_predmets.id',
						'eg.id as exid',
						'abit_predmets.name'
					)
					->leftjoin('abit_examenGroup as eg', 'eg.predmet_id', 'abit_predmets.id')
					->where('eg.group_id', $group_id)
                    ->where('abit_predmets.is_vuz', 'T')
                    ->orderby('abit_predmets.name', 'asc')
					->get();
		return $predmet;
	}

	static public function GetGroupByPredmet($predmet_id)
	{
		$predmet = AExamenGroup::where('predmet_id', $predmet_id)->get();
		return $predmet;
	}

	static public function GetStlevelPredmet($st_id)
	{
		$predmet = APredmets::
					select (
						'id',
						'name'
					)
					->where('stlevel_id', $st_id)
                    ->where('abit_predmets.is_vuz', 'T')
					->orderby('abit_predmets.name', 'asc')
					->distinct()
					->get();
		return $predmet;
	}
}
