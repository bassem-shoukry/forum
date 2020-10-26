<div class="card">
    <div class="card-header">
        <h5>
            <a href="{{route('profiles.show',$reply->owner->name)}}">{{$reply->owner->name}}</a> said {{$reply->created_at->diffForHumans()}}
        </h5>
        <form action="{{url("replies/{$reply->id}/favorites")}}" method="post">
            {{csrf_field()}}
            <button type="submit" class="btn btn-primary" {{$reply->is_favorited() ? 'disabled' : ''}}> {{ $reply->favorites_count }} {{Str::plural('Favorite',$reply->favorites_count)}}</button>
        </form>
    </div>
    <div class="card-body">
        {{$reply->body}}
    </div>
</div>
