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
}
