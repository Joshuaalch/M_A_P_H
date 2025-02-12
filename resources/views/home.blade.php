@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <!-- Card header displaying 'Dashboard' -->
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <!-- Check if a session status is present -->
                    @if (session('status'))
                        <!-- Display the success alert if session status exists -->
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Display a message confirming the user is logged in -->
                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
