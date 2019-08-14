@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2 mx-auto">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    
                        <div class="card-subtitle mb-3 text-info">
                            <h6>{{ Auth::user()->name }}はログイン中です。</h6>
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                        </div>
                    <ul class="navbar-nav">    
                    <li class="nav-item nav__title">{!! link_to_route('pdf.get', '領収書', [], ['class' => 'nav-link']) !!}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
