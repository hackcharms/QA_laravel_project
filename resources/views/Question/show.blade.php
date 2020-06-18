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
                                @include('shared._vote',['model'=>$question])
                            </div>
                            <div class="media-body">
                                {!!htmlspecialchars($question->body)!!}
                                {{-- <br> --}}
                                {{-- <div class="float-right">
                                </div> --}}
                                <div class="row">
                                    <div class="col-3"></div>
                                    <div class="col-3"></div>
                                    <div class="col-3"></div>
                                    <div class="col-3">
                                        @include('shared._author',['label'=>'Asked','model'=>$question])
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
