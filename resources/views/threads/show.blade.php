@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
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
                        @foreach($thread->replies as $reply)
                            @include('threads.reply')
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
