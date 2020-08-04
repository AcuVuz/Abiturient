<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tests extends Model
{
	protected $table = 'tests';
	public $timestamps = false;

	static public function GetTestHead($tid)
	{
        $query = Tests::select('tests.*', 'ta.name as target_name', 'tp.name as type_name')
                    ->leftjoin('target_audience as ta', 'ta.id', 'tests.targetAudience_id')
                    ->leftjoin('type_test as tp', 'tp.id', 'tests.type_id')
                    ->where('tests.id', $tid)->first();
		
		return $query;
	}
}
