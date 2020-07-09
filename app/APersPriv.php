<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class APersPriv extends Model
{
	protected $table = 'abit_persPrivilege';
	public $timestamps = false;

	static public function GetPersLgot($id_person)
	{
		$lgot = APersPriv::
					select (
						'tp.name'
					)
					->join('abit_typePrivilege as tp', 'tp.id', 'abit_persPrivilege.priv_id')
					->where('abit_persPrivilege.pers_id', $id_person)
					->where('tp.type', '1')
					->get();
		return $lgot;
	}

	static public function GetPersNagrad($id_person)
	{
		$lgot = APersPriv::
					select (
						'tp.name'
					)
					->join('abit_typePrivilege as tp', 'tp.id', 'abit_persPrivilege.priv_id')
					->where('abit_persPrivilege.pers_id', $id_person)
					->where('tp.type', '2')
					->get();
		return $lgot;
	}

	static public function GetPersAllPrivilege($id_person)
	{
		$AllPrivilege = APersPriv::
					select (
						'tp.name',
						'db.ball'
					)
					->leftjoin('abit_dopBall as db', 'db.persPrivilege_id', 'abit_persPrivilege.id')
					->join('abit_typePrivilege as tp', 'tp.id', 'abit_persPrivilege.priv_id')
					->where('abit_persPrivilege.pers_id', $id_person)
					->get();
		return $AllPrivilege;
	}

	    
    static public function delete_record($id)
    {
        $query = APersPriv::select('*')->where('id', $id)->first();
        $query->delete();
    }
    
    static public function delete_all($person_id)
    {
        APersPriv::select('*')->where('person_id', $person_id)->delete();
    }

    static public function new_record($person_id, $priv_id)
    {
        $query = new APersPriv;
        $query->person_id = $person_id;
        $query->priv_id = $priv_id;
        $query->save();
    }
}
