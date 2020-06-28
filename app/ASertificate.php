<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ASertificate extends Model
{
  	protected $table = 'abit_sertificate';
  	public $timestamps = false;

	public static function GetPersSertificate($id_person)
	{
		$query = ASertificate::
				select (
                    'abit_sertificate.*',
                    'ap.name as pred_name'
				)
                ->join('abit_predmets as ap', 'ap.id', 'abit_sertificate.predmet_id')
                ->where('abit_sertificate.person_id', $id_person)
				->get();
		return $query;
	}
}
