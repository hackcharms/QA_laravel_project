@if ($model instanceof App\Answer)
    @php
        $modelName='answer';
    @endphp
@elseif($model instanceof App\Question)
    @php
        $modelName='question';
    @endphp
@endif

<a title="This {{ucfirst($modelName)}} is useful." class="vote-up {{Auth::guest()?'off':''}} {{$model->upVoted($model->id)?' text-info ':''}}"
    onclick="event.preventDefault();document.getElementById('up-vote-{{$modelName.'-'.$model->id}}').submit()">
    {{-- <i class="fab fa-instagram text-warning"></i> --}}
    <i class="fas fa-caret-up fa-3x"></i>
</a>
<form id='up-vote-{{$modelName.'-'.$model->id}}' action="{{route($modelName.'.vote',$model->id)}}" method="post">
    <input type="number" name="vote" value="1" hidden>
    @csrf
</form>
<span class="votes-count">{{$model->votes_count}}</span>
<a title="This {{ucfirst($modelName)}} is not useful" class="vote-down {{Auth::guest()?'off':''}} {{$model->downVoted()?' text-info ':' '}}"
    onclick="event.preventDefault();document.getElementById('down-vote-{{$modelName.'-'.$model->id}}').submit()">
    <i class="fas fa-caret-down fa-3x"></i>
</a>
<form id='down-vote-{{$modelName.'-'.$model->id}}' action="{{route($modelName.'.vote',$model->id)}}" method="post">
    <input type="number" name="vote" value="-1" hidden>
    @csrf
</form>
@if ($model instanceof App\Answer)
@can('acceptBestAnswer', $model)
<a title="Mark this Answer As best Answer" class="{{$model->status}} mt-2"
    onclick="event.preventDefault();document.getElementById('accept-answer-{{$model->id}}').submit();">
    <i class="fas fa-check fa-2x"></i>
</a>
<form id='accept-answer-{{$model->id}}' action="{{route('answer.accept',$model->id)}}" method="POST">
    @csrf
</form>
@elseif($model instanceof App\Question)
@if ($model->is_best)
<a title="Question Owner has mark this As best Answer" class="{{$model->status}} mt-2">
    <i class="fas fa-check fa-2x"></i>
</a>
@endif
@endcan
@else
<a title="Click to mark Favorite(double Click to unmark)"
    class="favorite mt-2 {{Auth::guest() ? 'off':($question->is_favorited ?' favorited':'NOT FAVO')}}"
    onclick="event.preventDefault();document.getElementById('favorite-question-{{$model->id}}').submit()">
    <i class="fas fa-star fa-2x"></i>
    <span class="favorites-count">{{$model->favorites_count}}</span>
</a>

<form id='favorite-question-{{$model->id}}' action="{{route('question.favorites',$model->id)}}" method="post">
    @if (!$model->is_favorited)
    @method('post')
    @else
    @method('Delete')
    @endif
    @csrf
</form>

@endif
