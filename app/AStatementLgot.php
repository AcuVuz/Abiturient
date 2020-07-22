<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AStatementLgot extends Model
{
	protected $table = 'abit_statementLgot';
	public $timestamps = false;

	static public function GetStatLgot($id_statement)
	{
		$Priv = AStatementLgot::
					select (
                        'tp.id as lgot_id',
                        'tp.name'
					)
					->join('abit_typePrivilege as tp', 'tp.id', 'abit_statementLgot.priv_id')
                    ->where('abit_statementLgot.state_id', $id_statement)
					->first();
		return $Priv;
	}
    
    static public function delete_record($id)
    {
        $query = AStatementLgot::select('*')->where('id', $id)->first();
        $query->delete();
    }
    
    static public function delete_all($state_id)
    {
        AStatementLgot::select('*')->where('state_id', $state_id)->delete();
    }

    static public function new_record($state_id, $priv_id)
    {
        $query = new AStatementLgot;
        $query->state_id = $state_id;
        $query->priv_id = $priv_id;
        $query->save();
    }
}
