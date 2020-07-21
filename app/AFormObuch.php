<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AFormObuch extends Model
{
	protected $table = 'abit_formObuch';
	public $timestamps = false;

	static public function GetFormObuch($fk_id, $st_id)
	{
		$query = AGroup::select('abit_group.*')
					->distinct()
					->leftjoin('abit_formObuch as fo', 'fo.id', 'abit_group.fo_id')
					->where('abit_group.fk_id', $fk_id)
					->where('abit_group.st_id', $st_id)
					->select('fo.id', 'fo.name')
					->orderBy('fo.id', 'asc')
					->get();
		return $query;
	}
		static public function GetFormObuchName($id){
			 $query = AFormObuch::where('id', $id)->first();
				return $query;
		}
}
