@extends('admin.layouts.main')
@section('content')
    <div class="container d-flex align-items-center justify-content-center h-100-p">
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Admin Login</h5>
                    <form action="{{ route('admin.login') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control"
                                   name="email" id="email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control"
                                   id="password" name="password">
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
