<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable=['body','user_id','question_id'];
    use VotableTrait;
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }
    public function getUpdatedDateAttribute()
    {
        return $this->updated_at->diffForHumans();
    }
    public function getStatusAttribute()
    {
        return $this->is_best?'vote-accepted':'';
    }
    public function getIsBestAttribute()
    {
        return $this->id==$this->question->best_answer_id;
    }


    public static function boot()
    {
        parent::boot();
        static::created(function($answer){
            $answer->question()->increment('answers_count');
        });
    //     static::saved(function($answer)
    // {
    //     echo "Answer saved\n";
    // });
    static::deleted(function($answer){
        $question=$answer->question;
        $question->decrement('answers_count');
        if($question->best_answer_id==$answer->id)
        {
            $question->best_answer_id=NULL;
            $question->save();
        }
    });
    }
}
