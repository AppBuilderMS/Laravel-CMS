@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card card-default">

        <div class="card-header">{{isset($tag) ? 'Edit Tag' : 'Create Tag'}}</div>

        <div class="card-body">

            <form action="{{isset($tag) ? route('tags.update', $tag->id) : route('tags.store')}}" method="POST">
                @csrf
                @if(isset($tag))
                    @method('PATCH')
                @endif
                <div class="form-group">
                    <label for="name">Tag Name</label>
                    <input class="form-control" type="text" id="name" name="name" value="{{isset($tag) ? $tag->name : ''}}">
                    @if($errors->first('name'))
                        <div class='alert alert-danger py-1 mt-1'>{{$errors->first('name')}}</div>
                    @endif
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">
                        {{isset($tag) ? 'Update Tag' : 'Add Tag'}}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
