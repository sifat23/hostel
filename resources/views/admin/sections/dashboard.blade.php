@extends('admin.layouts.main')
@section('content')
    <div class="container mt-3">
        <div class="card mb-3">
            <div class="card-header">
                <h5>Booked Room List</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">User</th>
                        <th scope="col">Hostel</th>
                        <th scope="col">Room</th>
                        <th scope="col">Occupants</th>
                        <th scope="col">Date Range</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($reservations))
                        @foreach($reservations as $k => $reservation)
                            <tr>
                                <th scope="row">{{ $k + $reservations->firstItem() }}</th>
                                <td>{{ $reservation->user->username }}</td>
                                <td>{{ $reservation->hostel->name }}</td>
                                <td>{{ $reservation->room->name }}</td>
                                <td>{{ $reservation->occupants }}</td>
                                <td>{{ $reservation->check_in }} to {{ $reservation->check_out }}</td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
                <div>
                    {{ isset($reservations) ? $reservations->onEachSide(5)->links() : '' }}
                </div>
            </div>
        </div>
    </div>
@endsection
