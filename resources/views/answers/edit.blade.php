@extends('layouts.app')

@section('content')
<div class="container">
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-tittle">
                <h2>Update Your Answer</h2>
                </div>
                <hr>
            <h4>Question : {{$question->title}}</h4>
                {{-- <hr> --}}
                <form action="{{route('question.answers.update',[$question,$answer])}}" method="post">
                    @method('patch')
                    @csrf
                    <div class="form-group">
                    <textarea name="body" id="" cols="30" rows="7" class="form-control {{$errors->has('body')?'
                    invalid':''}}">{{old('body',$answer->body)}}</textarea>
                    @if ($errors->has('body'))
                        <div class="invalid-feedback">
                            <strong>{{$errors->first('body')}}</strong>
                        </div>
                    @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-outline-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
