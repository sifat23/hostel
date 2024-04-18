@extends('admin.layouts.main')
@section('content')
    <div class="container mt-3 pt-3">

        @php
            if (isset($hostel) && isset($room)) {
                $action =  route('admin.room.update', [$hostel, $room]);
                $method = 'PATCH';
            } else {
                $action =  route('admin.room.store', [$hostel]);
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
                        @endisset Room</h5>
                </div>
                @include('admin.sections.room._fields')
                <div class="card-footer d-flex">
                    <a class="btn btn-outline-danger"
                       href="{{ route('admin.hostel.show', [$hostel]) }}">Back</a>
                    <button class="ms-auto btn btn-success">Submit</button>
                </div>
            </div>
        </form>
    </div>
@endsection
