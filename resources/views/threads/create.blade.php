@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Forum Thread</div>

                <div class="card-body">
                    <form action="{{route('threads.store')}}" method="Post">
                        @csrf
                        <div class="form-group">
                            <label for="title"></label>
                            <input type="text" id="title" name="title" title="title" class="form-control" placeholder="title" />
                        </div>

                        <div class="form-group">
                            <label for="Body"></label>
                            <textarea name="body" title="body" class="form-control" placeholder="Body"></textarea>
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
