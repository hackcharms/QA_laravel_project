<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    public function getUrlAttribute()
    {
        return '#';
    }
    public function answers()
    {
        $this->HasMany(Answer::class);
    }
    public function getAvatarAttribute()
    {
        $email = $this->email;
        // $default = "https://www.somewhere.com/homestar.jpg";
        $size = 32;
        return "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?s=" . $size;
    }
    public function favorites()
    {
        return $this->belongsToMany(Question::class,'favorite_questions')->withTimestamps();
    }
    public function voteQuestions()
    {
        return $this->morphedByMany(Question::class,'votable');
    }
    public function voteAnswers()
    {
        return $this->morphedByMany(Answer::class,'votable');
    }
    public function voteQuestion(Question $question,$vote)
    {

        $voteQuestions=$this->voteQuestions();
        $this->_voteModel($voteQuestions,$question,$vote);
        // if($voteQuestions->where('votable_id',$question->id)->exists())
        // {
        //     $voteQuestions->updateExistingPivot($question,['vote'=>$vote]);

        // }
        // else{
        //     $voteQuestions->attach($question,['vote'=>$vote]);
        // }
        // $question->load('votes');
        // // $downVotes=(int) $vote()->wherePivot('vote',-1)->sum('vote');
        // // $upVotes=(int) $voteQuestions->wherePivot('vote',1)->sum('vote');
        // $downVotes=(int) $question->downVotes()->sum('vote');
        // $upVotes=(int) $question->upVotes()->sum('vote');

        // // $question->load('votes');
        // $question->votes_count=$downVotes+$upVotes;
        // // $question->votes_count=$votes;
        // $question->save();
        // // return back();
    }
    public function voteAnswer(Answer $answer,$vote)
    {

        $voteAnswers=$this->voteAnswers();
       $this->_voteModel($voteAnswers,$answer,$vote);
        // if($voteAnswers->where('votable_id',$answer->id)->exists())
        // {
        //     $voteAnswers->updateExistingPivot($answer,['vote'=>$vote]);

        // }
        // else{
        //     $voteAnswers->attach($answer,['vote'=>$vote]);
        // }
        // $answer->load('votes');
        // // $downVotes=(int) $vote()->wherePivot('vote',-1)->sum('vote');
        // // $upVotes=(int) $voteQuestions->wherePivot('vote',1)->sum('vote');
        // $downVotes=(int) $answer->downVotes()->sum('vote');
        // $upVotes=(int) $answer->upVotes()->sum('vote');
        // $answer->votes_count=$downVotes+$upVotes;
        // $answer->save();
    }
    private function _voteModel($relationship,$model,$vote)
    {
        if($relationship->where('votable_id',$model->id)->exists())
        {
            $relationship->updateExistingPivot($model,['vote'=>$vote]);

        }
        else{
            $relationship->attach($model,['vote'=>$vote]);
        }
        $model->load('votes');
        // $downVotes=(int) $vote()->wherePivot('vote',-1)->sum('vote');
        // $upVotes=(int) $voteQuestions->wherePivot('vote',1)->sum('vote');
        $downVotes=(int) $model->downVotes()->sum('vote');
        $upVotes=(int) $model->upVotes()->sum('vote');
        $model->votes_count=$downVotes+$upVotes;
        $model->save();
    }

}
