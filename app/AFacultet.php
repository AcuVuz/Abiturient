<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AFacultet extends Model
{
	protected $table = 'abit_facultet';
	public $timestamps = false;

	static public function GetFacultet($branch_id)
	{
		$query = AFacultet::select('*')
                        ->where('branch_id', $branch_id)
                        ->orderBy('name', 'asc')
                        ->get();
		return $query;
	}
}
