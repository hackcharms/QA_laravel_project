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
                            <a href="{{route('question.create')}}" class="btn btn-outline-secondary">Ask Questions</a>
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
                                <strong>{{$question->answers_count}}</strong> {{Str::plural('answer',$question->answers_count)}}
                                </div>

                                <div class="views">
                                    {{$question->views." ".Str::plural('view',$question->views)}}
                                </div>
                            </div>
                            <div class="media-body">
                                <div class="d-flex align-items-center">
                                <h3 class="mt-0"><a href="{{$question->url}}">{{$question->title}}  </a></h3><sub>
                                    @if ($question->updated_date!=$question->created_date)
                                        (Last editted : {{$question->updated_date}})
                                    @endif
                                </sub>
                                    {{-- @if (Gate::allows(['update-question','delete-question'],$question)) --}}
                                        <div class="ml-auto">
                                    @if(Auth::user() && Auth::user()->can('update-question',$question))
                                        <a href="{{route('question.edit',$question->id)}}" class="btn btn-sm btn-outline-info">Edit</a>
                                        @endif
                                    {{-- @if (Gate::allows(['update-question','delete-question'],$question)) --}}
                                    @if(Auth::user() && Auth::user()->can('delete-question',$question))
                                        <form class="form-delete" method="POST" action="{{route('question.destroy',$question->id)}}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger" onclick="confirm('Cofirm Question Deletion?')"> Delete</button>
                                        </form>
                                        @endif
                                    </div>


                                </div>

                                <p class="lead">
                                    Asked By <a href="{{$question->user->url}}">{{$question->user->name}}</a>
                                    <small class="text-muted">{{$question->created_date}}</small>
                                </p>
                                {{Str::limit($question->body,250)}}
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
