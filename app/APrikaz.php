<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class APrikaz extends Model
{
	protected $table = 'abit_prikaz';
	public $timestamps = false;

    static public function getAll() {
        $query = APrikaz::select('abit_prikaz.*', 'fo.name as fo_name')
                    ->leftjoin('abit_formObuch as fo', 'fo.id', 'abit_prikaz.fo_id')
                    ->get();
        return $query;
    }

	static public function inserPrikaz($name, $date_prikaz, $fo_id, $is_budg) {
        $prikaz = new APrikaz;
        $prikaz->name = $name;
        $prikaz->date_prikaz = $date_prikaz;
        $prikaz->is_budg = $is_budg;
        $prikaz->fo_id = $fo_id;
        $prikaz->save();
        return $prikaz;
    }

    static public function updateById($prikaz_id, $name, $date_prikaz, $fo_id, $is_budg) {
        $prikaz = APrikaz::find($prikaz_id);
        $prikaz->name = $name;
        $prikaz->date_prikaz = $date_prikaz;
        $prikaz->is_budg = $is_budg;
        $prikaz->fo_id = $fo_id;
        $prikaz->save();
        return $prikaz;
    }
}
