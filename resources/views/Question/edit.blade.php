@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                <div class="d-flex align-items-center">
                    <h2>Edit Questions</h2>
                    <div class="ml-auto">
                        <a href="{{route('Question.index')}}" class="btn btn-outline-secondary">Back to All Questions</a>
                    </div>
                </div>
                </div>
                <div class="card-body">
                    <h2>Question Form</h2>
                <form action="{{route('Question.update',$question)}}" method="post">
                    @method('put')
                    @include('layouts._form',['buttonText'=>'Update Question'])
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
