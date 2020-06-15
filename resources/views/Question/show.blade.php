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
                                    (Last editted : {{$question->updated_date}})
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
                                <a title="This question is useful" class="vote-up" >
                                    {{-- <i class="fab fa-instagram text-warning"></i> --}}
                                    <i class="fas fa-caret-up fa-3x"></i>
                                </a>
                                <span class="votes-count">1230</span>
                                <a title="this question is not useful" class="vote-down off">
                                    <i class="fas fa-caret-down fa-3x"></i>
                                </a>
                                <a title="Click to mark Favorite(double Click to unmark)"  class="favorite mt-2 favorited">
                                    <i class="fas fa-star fa-2x"></i>
                                <span class="favorites-count">123</span>
                            </a>
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
