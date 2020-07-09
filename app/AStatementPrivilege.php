<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AStatementPrivilege extends Model
{
	protected $table = 'abit_statementPrivilege';
	public $timestamps = false;

	static public function GetStatPriv($id_statement)
	{
		$Priv = AStatementPrivilege::
					select (
                        'tp.id as nag_id',
                        'tp.name',
                        'abit_statementPrivilege.ball'
					)
					->join('abit_typePrivilege as tp', 'tp.id', 'abit_statementPrivilege.priv_id')
                    ->where('abit_statementPrivilege.state_id', $id_statement)
                    ->whereNotIn('tp.id', [20, 26])
					->first();
		return $Priv;
	}

	static public function GetStatMarafon($id_statement)
	{
		$Marafon = AStatementPrivilege::
					select (
                        'tp.name',
                        'abit_statementPrivilege.ball'
					)
					->join('abit_typePrivilege as tp', 'tp.id', 'abit_statementPrivilege.priv_id')
                    ->where('abit_statementPrivilege.state_id', $id_statement)
                    ->where('tp.id', '26')
					->first();
		return $Marafon;
    }
    
    static public function delete_record($id)
    {
        $query = AStatementPrivilege::select('*')->where('id', $id)->first();
        $query->delete();
    }
    
    static public function delete_all($state_id)
    {
        AStatementPrivilege::select('*')->where('state_id', $state_id)->delete();
    }

    static public function new_record($state_id, $priv_id, $ball)
    {
        $query = new AStatementPrivilege;
        $query->state_id = $state_id;
        $query->priv_id = $priv_id;
        $query->ball = $ball;
        $query->save();
    }
}
