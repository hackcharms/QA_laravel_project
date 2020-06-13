@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                <div class="d-flex align-items-center">
                    <h2>{{$question->title}}</h2><sub>
                        @if ($question->updated_date!=$question->created_date)
                            (Last editted : {{$question->updated_date}})
                        @endif
                    </sub>
                    <div class="ml-auto">
                        <a href="{{route('Question.index')}}" class="btn btn-outline-secondary">Back to All Questions</a>
                    </div>
                </div>
                </div>

                <div class="card-body p-5">
                    {!!htmlspecialchars($question->body)!!}
                    <br>
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
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-tittle">
                    <h2>{{$question->answers_count. "  ".Str::plural('Answer',$question->answers_count)}}</h2>
                    </div>
                    <hr>
                    @foreach ($question->answers as $answer)
                        <div class="media">
                            <div class="media-body">
                                {!!$answer->body!!}
                                <div class="float-right">
                                    <span class="text-muted">Answered {{$answer->created_date}}</span>
                                    <div class="media mt-2">
                                    <a href="{{$answer->user->url}}" class="pr-2">
                                    <img src="{{$answer->user->avatar}}" alt="profile Pic">
                                    </a>
                                    <div class="media-body mt-1">
                                    <a href="{{$answer->user->url}}"> {{$answer->user->name}}</a>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
