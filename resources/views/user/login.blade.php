@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">


        <div class="col-md-8 mt-5 mb-5">
            <div class="card shadow-lg" id="card" style="margin-top:50px;">
                <div class="card-header">Login</div>
                <form action="{{route('login.post')}}" method="post" id="registrationForm" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                      
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" name="email" class="form-control" required>
                            @if($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" name="password" class="form-control" required>
                            @if($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password')}}</span>
                            @endif
                        </div>
                        <br>
                        <div class="form-group mb-5 mt-3 text-center">
                            <button class="btn btn-dark" id="btnRegister">Login</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection