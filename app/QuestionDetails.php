<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionDetails extends Model
{
	protected $table = 'question_details';
    public $timestamps = false;
    
    static public function GetQuestionsDetails($qid)
    {
        $query = QuestionDetails::where('quest_id', $qid)->where('type', '<>', 'que')->inRandomOrder()->get();
        return $query;
    }
    
    static public function GetQuestionText($qid)
    {
        $query = QuestionDetails::where('quest_id', $qid)->where('type', '=', 'que')->first();
        return $query;
    }
}
