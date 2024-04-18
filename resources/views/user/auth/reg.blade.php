@extends('user.layouts.main')
@section('content')
    <div class="container d-flex align-items-center justify-content-center h-100-p">
        <div class="col-4">
            @include('user.partials.notify')
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">User Registration</h5>
                    <form action="{{ route('user.register') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control"
                                   name="username" id="username">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control"
                                   id="password" name="password">
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control"
                                   id="password_confirmation" name="password_confirmation">
                        </div>

                        <div class="text-center mb-3">
                            <button type="submit" class="btn btn-primary">Complete Registration</button>
                        </div>
                        <div class="text-center">
                            <a href="{{ route('user.login') }}" class="ml-auto btn btn-outline-primary">Go To Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
