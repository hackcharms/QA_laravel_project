<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-tittle">
                    <h2>{{$answersCount. "  ".Str::plural('Answer',$answersCount)}}</h2>
                </div>
                <hr>
                @include('layouts._message')
                @foreach ($answers as $answer)
                <div class="media">
                    <div class="d-flex flex-column vote-controls">
                        @include('shared._vote',['model'=>$answer])
                    </div>
                    <div class="media-body">
                        {!!$answer->body!!}
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="ml-auto">
                                    @can('update', $answer)
                                    <a class="btn btn-sm btn-outline-primary"
                                        href="{{route('question.answers.edit',[$question->id, $answer->id])}}">Edit</a>
                                    @endcan
                                    @can('delete', $answer)
                                    <form class="form-delete" method="POST"
                                        action="{{route('question.answers.destroy',[$question->id, $answer->id])}}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger"
                                            onclick="confirm('Cofirm Question Deletion?')"> Delete</button>
                                    </form>
                                    @endcan
                                </div>
                            </div>
                            <div class="col-3"></div>
                            <div class="col-2"></div>
                            <div class="col-3">
                                @include('shared._author',['label'=>'Answered','model'=>$answer])
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
