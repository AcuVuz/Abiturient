<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AStatementDovuz extends Model
{
	protected $table = 'abit_statementDovuz';
	public $timestamps = false;

	static public function GetStatDovuz($id_statement)
	{
		$Dovuz = AStatementDovuz::
					select (
                        'p.id as predmet_id',
                        'p.name',
                        'abit_statementDovuz.ball'
					)
					->leftjoin('abit_predmets as p', 'p.id', 'abit_statementDovuz.predmet_id')
					->where('abit_statementDovuz.state_id', $id_statement)
					->get();
		return $Dovuz;
    }
    
    static public function delete_record($id)
    {
        $query = AStatementDovuz::select('*')->where('id', $id)->first();
        $query->delete();
    }
    
    static public function delete_all($state_id)
    {
        AStatementDovuz::select('*')->where('state_id', $state_id)->delete();
    }

    static public function new_record($state_id, $predmet_id, $ball)
    {
        $query = new AStatementDovuz;
        $query->state_id = $state_id;
        $query->predmet_id = $predmet_id;
        $query->ball = $ball;
        $query->save();
    }
}
