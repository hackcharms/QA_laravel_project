@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                <div class="d-flex align-items-center">
                    <h2>Ask Questions</h2>
                    <div class="ml-auto">
                        <a href="{{route('question.index')}}" class="btn btn-outline-secondary">Back to All Questions</a>
                    </div>
                </div>
                </div>

                <div class="card-body">
                    <h2>Question Form</h2>
                <form action="{{route('question.store')}}" method="post">
                    @method('post')
                    @include('layouts._form',['buttonText'=>'Ask Question'])
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
