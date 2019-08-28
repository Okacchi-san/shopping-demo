@extends('layouts.app_admin')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 mx-auto">
            <div class="card">
                <div class="card-header text-white bg-dark text-center">Login</div>
                <div class="card-body">
                    {!! Form::open(['route' => 'admin_login_post']) !!}
                <div class="form-group">
                    {!! Form::label('email', 'Email', ['class' => 'col-form-label-sm']) !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('password', 'Password' ,['class' => 'col-form-label-sm']) !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>
                <div class="row mt-4">
                <div class="col-5">
                {!! Form::submit('Log in', ['class' => 'btn btn-primary btn-block']) !!}
                </div>
                <div class="col-7 text-left ">
                <a class="btn btn-link btn-sm" href="{{ route('password.request') }}">Forgot Password?</a>
                </div></div>
                {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection