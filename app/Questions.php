<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
	protected $table = 'questions';
    public $timestamps = false;
    
    static public function GetQuestions($tid, $ball, $ball_count)
    {
        $query = Questions::select(
            'questions.id',
            'questions.ball'
        )
        ->where('questions.ball', $ball)
        ->where('questions.test_id', $tid)
        ->inRandomOrder()->limit($ball_count)->get();
        return $query;
    }
}
