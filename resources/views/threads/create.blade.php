@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card">
                <div class="card-header">Forum Thread</div>
                <div class="card-body">
                    <form action="{{route('threads.store')}}" method="Post">
                        @csrf
                        <div class="form-group">
                            <label for="title"></label>
                            <input type="text" id="title" name="title" title="title" class="form-control" placeholder="title" value="{{old('title')}}" />
                        </div>

                        <div class="form-group">
                            <label for="Body"></label>
                            <textarea name="body" title="body" class="form-control" placeholder="Body">{{old('body')}}</textarea>
                        </div>

                        <div class="form-group">
                            <select name="channel_id" title="channel" class="form-control">
                                <option value="">Select Channel</option>
                                @foreach($channels as $channel)
                                    <option value="{{$channel->id}}" {{$channel->id == old('channel_id') ? 'selected' : ''}}>{{$channel->name}}</option>
                                @endforeach
                            </select>
                        </div>



                        <div class="btn-group">
                            <button type="submit" class="btn btn-info">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
