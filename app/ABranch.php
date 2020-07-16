<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ABranch extends Model
{
	protected $table = 'abit_branch';
	public $timestamps = false;

	public static function GetBranch() {
        $query = ABranch::select('*')->get();
        return $query;
	}

}
