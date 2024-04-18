@extends('user.layouts.main')
@section('content')
    @if(!empty($hostel))
        <div class="container pt-3">
            <div class="card">
                <div class="card-header">
                    <h1>{{ $hostel->name }}</h1>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <img class="img-30vh" src="{{ asset('assets/img/hostel.jpg') }}">
                            <div>
                                <h4>{{ $hostel->location }}</h4>
                            </div>
                        </div>
                        <div class="col">
                            <ul class="no-bullets pt-3">
                                @if($hostel->rooms->isNotEmpty())
                                    @foreach($hostel->rooms as $room)
                                        <li class="mb-3">

                                            <div class="d-flex gap-3">
                                                <div>
                                                    <img class="img-15vh"
                                                         src="{{ asset('assets/img/demo.jpeg') }}" alt="hostel-demo">
                                                </div>
                                                <div class="align-content-center">
                                                    <h3>{{ $room->name }}</h3>
                                                    <span class="round-marks">{{ \App\Enums\RoomType::from($room->type)->name }}</span>
                                                    <div class="pt-3">
                                                        <a href="{{ route('user.hostel.room.show', [$hostel, $room]) }}" class="btn btn-info btn-sm">Book Now!</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection
