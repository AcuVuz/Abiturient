<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AGrafikExam extends Model
{
	protected $table = 'abit_grafikExam';
	public $timestamps = false;

    static public function getGrafik($st_id)
    {
        $query = AGrafikExam::select('abit_grafikExam.*', 'ap.name')
                ->rightjoin('abit_predmets as ap', 'ap.id', 'abit_grafikExam.predmet_id')
                ->where('ap.stlevel_id', $st_id)
                ->orderby('ap.name', 'asc')
                ->get();
        return $query;
    }

}
