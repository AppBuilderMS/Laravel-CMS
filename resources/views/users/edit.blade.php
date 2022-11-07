@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">My Profile</div>

                <div class="card-body">
                    <form action="{{route('users.update-profile')}}" method="Post">
                        @csrf
                        @method('put')

                        <div class="form-group">
                            <label for="name" >Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}">
                            @if($errors->first('name'))
                                <div class='alert alert-danger py-1 mt-1'>{{$errors->first('name')}}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="about" >About</label>
                            <textarea class="form-control" name="about" id="about" cols="5" rows="5">{{$user->about}}</textarea>
                            @if($errors->first('about'))
                                <div class='alert alert-danger py-1 mt-1'>{{$errors->first('about')}}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Update Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
