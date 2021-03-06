<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Persons extends Model
{
	protected $table = 'persons';
	public $timestamps = false;

	//=============== ТАБЛИЦА АБИТУРИЕНТОВ ================================//
	public static function DashboardTable($stxt){
		//$tkt = APersPriv::select('id as ctt')->whereRaw('abit_persPrivilege.pers_id', 'persons.id')->count();
		session('role_id') != 1 ? $pers_test = '1079' : $pers_test = '';
		if($stxt == ''){
			$item_abit = Persons::
			selectRaw(
				'distinct(persons.id) as id_Abit, persons.famil as FirstName,
				persons.name as Name, persons.otch as LastName,
				persons.email, persons.phone_one as PhoneOne, persons.phone_two as PhoneTwo,
				(select count(ap.id) from abit_persPrivilege ap
					where ap.pers_id = persons.id) as countPriv, persons.is_checked as Checked'
			)
			->join('abit_statements', 'abit_statements.person_id', '=', 'persons.id')
			->join('abit_group', 'abit_group.id', '=', 'abit_statements.group_id')
			->join('abit_facultet', 'abit_facultet.id', '=', 'abit_group.fk_id')
			->join('user_roles', 'user_roles.abit_branch_id', '=', 'abit_facultet.branch_id')
			->where('persons.pers_type', 'a')
			->where('persons.famil','<>', '')
			->where('persons.id','<>', $pers_test)
			->where('user_roles.user_id', session('user_id'))
			//->whereNull('abit_statements.date_return')
			->orderBy('FirstName', 'ASC')
			->get();
		}else{
			$item_abit = Persons::selectRaw(
				'distinct(persons.id) as id_Abit, persons.famil as FirstName,
				persons.name as Name, persons.otch as LastName,
				persons.email, persons.phone_one as PhoneOne, persons.phone_two as PhoneTwo,
				persons.is_checked as Checked'
			)
			->where('persons.famil', 'like', '%'.$stxt.'%')
			->where('persons.pers_type', 'a')
			->where('persons.famil','<>', '')
			->where('persons.id','<>', $pers_test)
			->get();
		}


		$k = [];
		$i = 0;
		foreach ($item_abit as $key) {
			if($key->countPriv != 0) $privilage = '&#10003;';
			else   $privilage = '';
			if($key->Checked === 'T' ) $Checked = '&#10003;';
			else $Checked = '';
			$k +=[$i =>[$key->id_Abit,
						$Checked,
						$key->FirstName.' '.$key->Name.' '.$key->LastName, //FIO
						$privilage,
						$key->PhoneOne,
						$key->PhoneTwo,
						$key->email,'']];
			$i++;
		}

		$arr=array
		(
			"data" => $k
		);

		return $arr;
	}

	//=============== БОКОВАЯ ПАНЕЛЬ ================================//
	public static function DashboardSidebar($id_person){
		$query = Persons::
			select
			(
				'persons.famil as FirstName',
				'persons.name as Name',
				'persons.otch as LastName',
				'persons.photo_url as Avatar',
				'persons.birthday as Birthday'
			)
		->where('id',$id_person)
			->first();

		$arr = [
		"FirstName" => $query->FirstName,
		"Name" => $query->Name,
		"LastName" => $query->LastName,
		"Avatar" => $query->Avatar,
		"Birthday" => date("d.m.Y", strtotime($query->Birthday))
		];

		return $arr;
	}

	//=============== ТАБЛИЦА ЭКЗАМЕНОВ АБИТУРИЕНТА ================================//
	public static function DashboardPersonsExams($id_person){
		$query = AExamsCard::
			select
			(
			'abit_predmets.name as Predmet',
			'abit_examCard.date_exam as DateExam',
			'abit_examCard.ball as Ball'
			)
			->leftjoin('abit_examenGroup', 'abit_examenGroup.id', '=', 'abit_examCard.exam_id')
			->leftjoin('abit_predmets', 'abit_predmets.id', '=', 'abit_examenGroup.predmet_id')
			->leftjoin('abit_statements', 'abit_statements.id', '=', 'abit_examCard.state_id')
			->where('abit_statements.person_id', $id_person)
			->distinct()
			->get();

			$k = [];
			$i = 0;

			foreach ($query as $key) {

				$k +=[$i =>[$key->Predmet,
				$key->DateExam != null ? date("d.m.Y", strtotime($key->DateExam)) : '',
							$key->Ball,
							]];
				$i++;
			}

			$arr=array
			(
				"data" => $k
			);

			return $arr;
	}


	//=============== ТАБЛИЦА ПОДАННЫХ АБИТУРИЕНТОМ ЗАЯВЛЕНИЙ ================================//
	public static function DashboardPersonsStatment($id_person){
		$query = AStatments::
			select
			(
				'abit_statements.shifr_statement as shifr',
				'abit_group.name as SpecName',
				'abit_statements.date_return as DateReturn'
			)
			->leftJoin('abit_group', 'abit_group.id', '=', 'abit_statements.group_id')
			->where('abit_statements.person_id',$id_person)
			->get();

			$k = [];
			$i = 0;

			foreach ($query as $key) {

				$k +=[$i =>[$key->shifr,
							$key->SpecName,
							$key->DateReturn != null ? date("d.m.Y", strtotime($key->DateReturn)) : '']];
				$i++;
			}

			$arr=array
			(
				"data" => $k
			);

			return $arr;
	}

	public static function GetPerson($id_person)
	{
		$query = Persons::
			select
			(
				'persons.*'
			)
		->where('id',$id_person)
		->first();
		return $query;
	}

	public static function GetStatement($id_person, $is_return){
		if ($is_return)
		{
			$query = AStatments::
				select
				(
					'abit_statements.shifr_statement as shifr',
					'abit_group.name as SpecName',
					'abit_statements.date_return as DateReturn'
				)
				->leftJoin('abit_group', 'abit_group.id', '=', 'abit_statements.group_id')
				->where('abit_statements.person_id',$id_person)
				->get();
		}
		else
		{
			$query = AStatments::
				select
				(
					'abit_statements.shifr_statement as shifr',
					'abit_group.name as SpecName',
					'abit_statements.date_return as DateReturn'
				)
				->leftJoin('abit_group', 'abit_group.id', '=', 'abit_statements.group_id')
				->where('abit_statements.person_id',$id_person)
				->whereNull('abit_statements.date_return')
				->get();
		}
		return $query;
	}

	public static function GetDocumentObr($id_person)
	{
		$query = ADocument::
			select
			(
				'abit_typeDoc.name',
				'abit_typeEducation.name as educ_name',
				'abit_document.*'
			)
			->leftjoin('abit_typeDoc', 'abit_typeDoc.id', 'abit_document.doc_id')
			->leftjoin('abit_typeEducation', 'abit_typeEducation.id', 'abit_document.educ_id')
			->whereIn('abit_document.doc_id', [1, 7])
			->where('abit_document.pers_id', $id_person)
			->first();
		return $query;
	}

	public static function GetLgots($id_person)
	{
		$query = APersPriv::
				select
				(
					'abit_typePrivilege.name'
				)
				->leftjoin('abit_typePrivilege', 'abit_typePrivilege.id', 'abit_persPrivilege.priv_id')
				->where('abit_persPrivilege.pers_id', $id_person)
				->where('abit_typePrivilege.type', '1')
				->get();
		return $query;
	}

	public static function AddDiscComment($comment, $pers_id){
		$query = Persons::where('id', $pers_id)->first();
		$query->Comment = $comment;
		$query->save();
		return 1;
	}

	public static function StaticTable(){
		$query = DB::select('CALL abit_statistic()');
		/*->whereNotIn('abit_group.id', [20, 29, 31, 37, 41, 46, 56, 57, 58, 59, 61, 63, 66, 68, 72, 73, 75, 76, 77, 99, 101, 107,
														111, 124, 126, 129, 131, 135, 136, 138, 139, 140, 169, 170, 171, 178, 181, 183, 187, 188, 190, 193, 191,
														192, 205, 206, 217, 218, 219, 220, 221, 240, 245, 246, 247, 251, 254, 256, 260, 261, 263,  264, 265, 266,
														278, 279, 281, 288, 312, 313, 315, 319, 325, 328, 329, 332, 335, 341, 352, 376]);*/
		$k = [];
		$i = 0;
		foreach ($query as $key) {

			$k +=[$i =>[
						'',
						$key->id,
						$key->name,
						$key->grname,
						$key->count_ochka,
						$key->count_zaochka,
						$key->return_ochka,
						$key->return_zaochka,
						$key->count_statments,
						$key->count_return_statments,
						$key->fakname,
						$key->ochka_id,
						$key->zaochka_id]];
			$i++;
		}

		$arr=array
		(
			"data" => $k
		);

		return $arr;
	}
  public static function PerStatTable($gip_o, $gip_z){
			$query = DB::select('CALL abit_persons_statistic(?,?)',[$gip_o,$gip_z]);

												$k = [];
												$i = 0;
												foreach ($query as $key) {

													$k +=[$i =>[ $key->famil,
																										$key->Pname,
																										$key->otch,
																										$key->srbal,
																										$key->medal,
																										$key->lgot,
																										$key->nagradi,
																										$key->dovuz,
																										$key->marafon,
																										$key->count_exam,
																										$key->name_exam,
																										$key->exam_ball,
																										$key->sum_ex_ball,
																										$key->original,
																										$key->foid
																											]];
													$i++;
												}

												$arr=array
												(
													"data" => $k
												);
			return $arr;
		}
}
