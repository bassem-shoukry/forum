@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{$thread->creator->name}} posted :
                        {{$thread->title}}
                    </div>
                    <div class="card-body">
                        {{$thread->body}}
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        @foreach($replies as $reply)
                            @include('threads.reply')
                        @endforeach
                        {{$replies->links()}}
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        @if(Auth::check())
                            <form method="POST" action="{{route('replies.store',$thread)}}">
                                @csrf
                                <div class="form-group">
                                    <textarea name="body" title="body" class="form-control" placeholder="Have something to say?"></textarea>
                                </div>
                                <div class="btn-group">
                                    <button type="submit" class="btn btn-info">Post</button>
                                </div>
                            </form>
                        @else
                            <p>Please <a href="{{url('/login')}}">Sign in</a> to participate in the discussion.</p>
                        @endif
                    </div>
                </div>

            </div>
            <div class="col-md-4">
               <div class="card">
                <div class="card-body">
                    <p>
                        This Thread was published {{ $thread->created_at->diffForHumans()  }} by <a href="#">{{ $thread->creator->name }}</a> and currently has {{$thread->replies_count}} {{Str::plural('comment',$thread->replies_count)}}
                    </p>
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection
