<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ATypPriv extends Model
{
	protected $table = 'abit_typePrivilege';
	public $timestamps = false;

	static public function GetLgot()
	{
		$lgot = ATypPriv::
					select (
						'id',
                        'name'
					)
					->where('abit_typePrivilege.type', '1')
					->get();
		return $lgot;
	}

	static public function GetNagrad()
	{
		$Nagrad = ATypPriv::
					select (
						'id',
                        'name'
					)
                    ->where('type', '2')
                    ->whereNotIn('id', [20, 26])
					->get();
		return $Nagrad;
	}
}
