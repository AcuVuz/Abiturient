<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ASTLevel extends Model
{
	protected $table = 'abit_stlevel';
        public $timestamps = false;

	static public function GetSTLevel($fk_id)
	{
                $query = AGroup::select('st.id', 'st.name')
                        ->distinct()
                        ->leftjoin('abit_stlevel as st', 'st.id', 'abit_group.st_id')
                        ->where('abit_group.fk_id', $fk_id)
                        ->orderBy('st.id', 'asc')
                        ->get();
                        return $query;
	}
}
