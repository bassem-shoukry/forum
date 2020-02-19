<div class="card">
    <div class="card-header">
        <h5>
            {{$reply->owner->name}} said {{$reply->created_at->diffForHumans()}}
        </h5>
        <form action="{{url("replies/{$reply->id}/favorites")}}" method="post">
            {{csrf_field()}}
            <button type="submit" class="btn btn-primary" {{$reply->is_favorited() ? 'disabled' : ''}}> {{ $reply->favorites()->count() }} {{Str::plural('Favorite',$reply->favorites()->count())}}</button>
        </form>
    </div>
    <div class="card-body">
        {{$reply->body}}
    </div>
</div>
