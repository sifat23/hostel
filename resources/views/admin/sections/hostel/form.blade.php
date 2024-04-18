@extends('admin.layouts.main')
@section('content')
    <div class="container mt-3 pt-3">

        @php
            if (isset($hostel)) {
                $action =  route('admin.hostel.update', [$hostel]);
                $method = 'PATCH';
            } else {
                $action =  route('admin.hostel.store');
                $method = 'POST';
            }
        @endphp

        <form action="{{ $action }}" method="POST">
            @csrf
            @method($method)

            <div class="card mb-3">
                <div class="card-header">
                    <h5>@if(isset($hostel))
                            Edit
                        @else
                            Add
                        @endisset Hostel</h5>
                </div>
                @include('admin.sections.hostel._fields')
                <div class="card-footer d-flex">
                    <a class="btn btn-outline-danger"
                       href="{{ route('admin.hostel.index') }}">Back</a>
                    <button class="ms-auto btn btn-success">Submit</button>
                </div>
            </div>
        </form>
    </div>
@endsection
