@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <div class="d-flex align-items-center">
                            <h2>{{$question->title}}</h2><sub>
                                @if ($question->updated_date!=$question->created_date)
                                    (Last Activity : {{$question->updated_date}})
                                @endif
                            </sub>

                            <div class="ml-auto">
                                <a href="{{route('question.index')}}" class="btn btn-outline-secondary">Back to All Questions</a>
                            </div>
                        </div>
                        </div>
                        <hr>
                        <div class="media">
                            <div class="d-flex flex-column vote-controls">
                                <a title="This question is useful" class="vote-up {{Auth::guest()?'off':''}}"
                                onclick="event.preventDefault();document.getElementById('up-vote-question-{{$question->id}}').submit()">
                                    {{-- <i class="fab fa-instagram text-warning"></i> --}}
                                <i class="fas fa-caret-up fa-3x "></i>
                                </a>
                                <form id='up-vote-question-{{$question->id}}' action="{{route('question.vote',$question->id)}}" method="post">
                                    <input type="number" name="vote" value="1" hidden>
                                    @csrf
                                </form>
                            <span class="votes-count">{{$question->votes_count}}</span>
                                <a title="this question is not useful" class="vote-down {{Auth::guest()?'off':''}}"
                                onclick="event.preventDefault();document.getElementById('down-vote-question-{{$question->id}}').submit()">
                                    <i class="fas fa-caret-down fa-3x"></i>
                                </a>
                                <form id='down-vote-question-{{$question->id}}' action="{{route('question.vote',$question->id)}}" method="post">
                                    <input type="number" name="vote" value="-1" hidden>
                                    @csrf
                                </form>
                                <a title="Click to mark Favorite(double Click to unmark)"  class="favorite mt-2 {{Auth::guest() ? 'off':($question->is_favorited ?' favorited':'NOT FAVO')}}"
                                    onclick="event.preventDefault();document.getElementById('favorite-question-{{$question->id}}').submit()">
                                    <i class="fas fa-star fa-2x"></i>
                                <span class="favorites-count">{{$question->favorites_count}}</span>
                                </a>

                                <form id='favorite-question-{{$question->id}}' action="{{route('question.favorites',$question->id)}}" method="post">
                                    @if (!$question->is_favorited)
                                    @method('post')
                                    @else
                                    @method('Delete')
                                    @endif
                                    @csrf
                                </form>
                            </div>
                            <div class="media-body">
                                {!!htmlspecialchars($question->body)!!}
                                <br>
                            </div>
                            <div class="float-right">
                                    <span class="text-muted">Asked {{$question->created_date}}</span>
                                    <div class="media mt-2">
                                        <a href="{{$question->user->url}}" class="pr-2">
                                            <img src="{{$question->user->avatar}}" alt="profile Pic">
                                        </a>
                                        <div class="media-body mt-1">
                                            <a href="{{$question->user->url}}"> {{$question->user->name}}</a>
                                        </div>
                                    </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('answers._index',[
        'answersCount'=>$question->answers_count,
        'answers'=>$question->answers
        ])
    @include('answers._create')
</div>
@endsection
