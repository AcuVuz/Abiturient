<?php

namespace App\Http\Controllers;

use App\AStatments;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JurnalController extends Controller
{
    public function index (Request $request) {
        $role = session('role_id'); 
        $users = session('user_name');
        if ($request->session()->has('branch_id'))
            $abit_branch = DB::table('abit_branch')->where('id', session('branch_id'))->get();
        else
            $abit_branch = DB::table('abit_branch')->get();
        return response()->view("JurnalPage.main", [
            'title'     => 'Приказы',
            'role' 		=> $role,
            'abit_branch'	=> $abit_branch,
            'username' 	=> $users
        ]);
    }

    public function get_facultet(Request $request)
	{
		$fk = DB::table('abit_facultet')->where('branch_id', $request->bid)->orderBy('name', 'asc')->get();
		$data = "<option>Выберите элемент</option>";
		foreach ($fk as $f) {
			$data .= "<option value='".$f->id."'>".$f->name."</option>";
		}
		return $data;
	}

	public function get_stlevel(Request $request)
	{
		$stlevel = DB::table('abit_group as g')->distinct()->leftjoin('abit_stlevel as st', 'st.id', 'g.st_id')->where('g.fk_id', $request->fkid)->select('st.id', 'st.name')->orderBy('st.id', 'asc')->get();
		$data = "<option>Выберите элемент</option>";
		foreach ($stlevel as $st) {
			$data .= "<option value='".$st->id."'>".$st->name."</option>";
		}
		return $data;
	}

	public function get_form_obuch(Request $request)
	{
		$role = session('role_id');

		$formobuch = DB::table('abit_group as g')
						->distinct()
						->leftjoin('abit_formObuch as fo', 'fo.id', 'g.fo_id')
						->where('g.fk_id', $request->fkid)
						->where('g.st_id', $request->stid)
						->select('fo.id', 'fo.name')
						->orderBy('fo.id', 'asc')
						->get();
		$data = "<option>Выберите элемент</option>";
		foreach ($formobuch as $fo) {
			$data .= "<option value='".$fo->id."'>".$fo->name."</option>";
		}
		return $data;
	}

	public function get_group(Request $request)
	{
		$group = DB::table('abit_group as g')
					->where('g.fk_id', $request->fkid)
					->where('g.st_id', $request->stid)
					->where('g.fo_id', $request->foid)
					->whereNotIn('g.id', function ($query) {
						$query->select(DB::raw('group_id'))
							  ->from('abit_removeGroup');
					})
					->orderBy('g.name', 'asc')->get();
		$data = "<option>Выберите элемент</option>";
		foreach ($group as $g) {
			$data .= "<option value='".$g->id."'>".$g->name."</option>";
		}
		return $data;
	}

	public function print_titul(Request $request) {
		if (isset($request->group_id)) {
			$group = DB::table('abit_group as g')
					->select("g.*", "f.name as fk_name", "ab.name as branch_name", "fo.name as fo_name", "st.name as st_name")
					->leftjoin("abit_facultet as f", "f.id", "g.fk_id")
					->leftjoin("abit_branch as ab", "ab.id", "f.branch_id")
					->leftjoin("abit_formObuch as fo", "fo.id", "g.fo_id")
					->leftjoin("abit_stlevel as st", "st.id", "g.st_id")
					->where("g.id", "=", $request->group_id)
					->orderBy('g.name', 'asc')->get();
		} else {
			$group = DB::table('abit_group as g')
			->select("g.*", "f.name as fk_name", "ab.name as branch_name", "fo.name as fo_name", "st.name as st_name")
			->leftjoin("abit_facultet as f", "f.id", "g.fk_id")
			->leftjoin("abit_branch as ab", "ab.id", "f.branch_id")
			->leftjoin("abit_formObuch as fo", "fo.id", "g.fo_id")
			->leftjoin("abit_stlevel as st", "st.id", "g.st_id")
			->whereNotIn('g.id', function ($query) {
				$query->select(DB::raw('group_id'))
				->from('abit_removeGroup');
			})
			->orderBy('g.name', 'asc')->get();
		}
		return view("ReportPages.Report_Journal_Tit", [ "group" => $group]);
	}

	public function print_jurnal(Request $request) {
		if (isset($request->group_id)) {
			$doc_obr = [];
			$lgot = [];
			$statement = AStatments::select(
					"abit_statements.*", 
					"p.famil", 
					"p.name", 
					"p.otch", 
					"p.gender", 
					"p.birthday", 
					"p.country",
					"p.adr_obl",
					"p.adr_rajon",
					"p.adr_city",
					"p.adr_street",
					"p.adr_house",
					"p.adr_flatroom"
				)
				->leftjoin("persons as p", "p.id", "abit_statements.person_id")
				->where("abit_statements.group_id", "=", $request->group_id)
				->orderby("abit_statements.queue_number", "asc")
				->get();
			foreach ($statement as $state) {
				$doc_obr += [
					$state->id => DB::table('abit_document as doc')->where("doc.pers_id", "=", $state->person_id)->whereIn("doc.doc_id", [1, 7])->first(),
				];
				$lgot += [
					$state->id => DB::table('abit_statementLgot as sl')->where("sl.state_id", "=", $state->id)->count(),
				];
			}
		}
		return view("ReportPages.Report_Journal", [ "statements" => $statement, "doc_obr" => $doc_obr, "lgot" => $lgot ]);
	}
}
