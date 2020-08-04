<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestScatter extends Model
{
	protected $table = 'test_scatter';
    public $timestamps = false;
    
    static public function GetTestScatter($tid)
    {
        return TestScatter::where('test_id', '=', $tid)->get();
    }
}
