<?php
/**
 * Votable Trait will help to vote Answers and Questions
 */
namespace App;
trait VotableTrait
{
    public function votes()
    {
        return $this->morphToMany(User::class,'votable');
    }
    public function upVotes()
    {
        return $this->votes()->wherePivot('vote',1);
    }
    public function downVotes()
    {
        return $this->votes()->wherePivot('vote',-1);
    }
    public function downVoted()
    {
        return $this->downVotes()->where('user_id',auth()->id())->exists();
        return ;//$this->downVotes()->where('user_id',auth()->id())->exists();
        //  $vote=$this->downVotes()->where('user_id',auth()->id());
        // return $this->downVotes()->where('user_id',1);
        // return $this->downVotes()->find(1);
    }
    public function upVoted()
    {
        return $this->upVotes()->where('user_id',auth()->id())->exists();
        return ;//$this->upVotes()->where('user_id',auth()->id())->exists();
    }
}
