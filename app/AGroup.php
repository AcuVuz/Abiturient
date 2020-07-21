<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AGroup extends Model
{
	protected $table = 'abit_group';
	public $timestamps = false;

	static public function GetGroup($fk_id, $st_id, $fo_id)
	{
		$query = AGroup::select('abit_group.*')
					->where('abit_group.fk_id', $fk_id)
					->where('abit_group.st_id', $st_id)
					->where('abit_group.fo_id', $fo_id)
					->whereNotIn('abit_group.id', function ($query2) {
						$query2->select('group_id')
							->from('abit_removeGroup');
					})
					->orderBy('abit_group.name', 'asc')
					->get();
		return $query;
	}
	static public function GetGroupName($id){
			$query = AGroup::where('id',$id)->first();
			return $query;
	}
}
