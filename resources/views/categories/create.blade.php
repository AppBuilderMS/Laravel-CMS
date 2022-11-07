@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card card-default">

        <div class="card-header">{{isset($category) ? 'Edit Category' : 'Create category'}}</div>

        <div class="card-body">

            <form action="{{isset($category) ? route('categories.update', $category->id) : route('categories.store')}}" method="POST">
                @csrf
                @if(isset($category))
                    @method('PATCH')
                @endif
                <div class="form-group">
                    <label for="name">Category Name</label>
                    <input class="form-control" type="text" id="name" name="name" value="{{isset($category) ? $category->name : ''}}">
                    @if($errors->first('name'))
                        <div class='alert alert-danger py-1 mt-1'>{{$errors->first('name')}}</div>
                    @endif
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">
                        {{isset($category) ? 'Update category' : 'Add Category'}}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
