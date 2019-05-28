@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2 mx-auto">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    
                        <div class="card-subtitle mb-3 text-info">
                            <h6>{{ Auth::user()->name }} is logged in!</h6>
                        
                           
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
