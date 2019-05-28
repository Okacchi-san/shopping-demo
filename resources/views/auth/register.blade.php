@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 mx-auto">
            

            <div class="card">
                <div class="card-header text-white bg-dark text-center">Register</div>

                <div class="card-body">
                {!! Form::open(['route' => 'signup.post']) !!}
                    
                    
                <div class="form-group">
                    {!! Form::label('name', 'Name', ['class' => 'col-form-label-sm']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
                        @if ($errors->has('name'))
                            <span class="help-block">
                                {{ $errors->first('name')  }}
                            </span>
                        @endif
                </div>

                <div class="form-group">
                    {!! Form::label('email', 'Email', ['class' => 'col-form-label-sm']) !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
                        @if ($errors->has('email'))
                            <span class="help-block">
                                {{ $errors->first('email') }}
                            </span>
                        @endif
                </div>

                <div class="form-group">
                    {!! Form::label('password', 'Password', ['class' => 'col-form-label-sm']) !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                        @if ($errors->has('password'))
                            <span class="help-block">
                                {{ $errors->first('password') }}
                            </span>
                        @endif
                </div>        
                <div class="form-group">
                    {!! Form::label('password_confirmation', 'Confirm Password', ['class' => 'col-form-label-sm']) !!}
                    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                </div>
                <div class="mt-4">
                {!! Form::submit('Sign up', ['class' => 'btn btn-primary btn-block']) !!}
                </div>
                {!! Form::close() !!}
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
