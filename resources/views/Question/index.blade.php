@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                <div class="d-flex align-items-center">
                    <h2>All Questions</h2>
                    <div class="ml-auto">
                        <a href="{{route('Question.create')}}" class="btn btn-outline-secondary">Ask Questions</a>
                    </div>
                </div>
                </div>

                <div class="card-body">
                    @include('layouts._message')
                    @foreach ($questions as $question)
                        <div class="media">
                            <div class="d-flex flex-column counters">
                                <div class="votes">
                                <strong>{{$question->votes}}</strong> {{Str::plural('vote',$question->vote)}}
                            </div>
                        <div class="status {{$question->status}}">
                                <strong>{{$question->answers}}</strong> {{Str::plural('answer',$question->answers)}}
                                </div>

                                <div class="views">
                                    {{$question->views." ".Str::plural('view',$question->views)}}
                                </div>
                            </div>
                            <div class="media-body">
                                <h3 class="mt-0"><a href="{{$question->url}}">{{$question->title}}</a></h3>
                                <p class="lead">
                                    Asked By <a href="{{$question->user->url}}">{{$question->user->name}}</a>
                                    <small class="text-muted">{{$question->created_date}}</small>
                                </p>
                                {{Str::limit($question->body,250)}}
                            </div>
                        </div>
                        <hr>
                    @endforeach
                    {{-- <div class="pagination justify-content-center"> --}}
                        {{$questions->links()}}
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
