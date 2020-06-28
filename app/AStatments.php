<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AStatments extends Model
{
  	protected $table = 'abit_statements';
  	public $timestamps = false;

	public static function GetStatement($id_statement)
	{
		$query = AStatments::
				select (
					'abit_statements.*',
					'g.name as group_name',
					'b.short_name as branch_name',
					'fo.name as fo_name',
					'f.name as fk_name',
					'st.name as st_name',
					'g.minid'
				)
				->join('abit_group as g', 'g.id', 'abit_statements.group_id')
				->join('abit_formObuch as fo', 'fo.id', 'g.fo_id')
				->join('abit_stlevel as st', 'st.id', 'g.st_id')
				->join('abit_facultet as f', 'f.id', 'g.fk_id')
				->join('abit_branch as b', 'b.id', 'f.branch_id')
				->where('abit_statements.id', $id_statement)
				->first();
		return $query;
	}
}
