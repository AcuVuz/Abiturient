<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ATypExam extends Model
{
	protected $table = 'abit_typeExam';
	public $timestamps = false;

	static public function GetTypExam()
	{
		$query = ATypExam::select('*')->get();

		return $query;
	}
}
