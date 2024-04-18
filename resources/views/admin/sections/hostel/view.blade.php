@extends('admin.layouts.main')
@section('content')
    <div class="container mt-3 pt-3">
        @include('admin.partials.notify')
        @if(!empty($hostel))
            <div class="card mb-3">
                <div class="card-header d-flex">
                    <h5>Hostel Details & Rooms</h5>
                    <a class="ms-auto btn btn-primary"
                       href="{{ route('admin.room.create', [$hostel]) }}">Add Room</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div>
                                <img class="img-20vh" src="{{ asset('assets/img/hostel.jpg') }}" alt="">
                            </div>
                            <div class="pt-3">
                                <a class="btn btn-boston btn-sm"
                                   href="{{ route('admin.hostel.edit', [$hostel]) }}">edit hostel</a>
                                <h5 class="mt-2">Hostel Name: {{ $hostel->name }}</h5>
                                <p><strong>Location: </strong>{{ $hostel->location }}</p>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Bookings</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($hostel->rooms->isNotEmpty())
                                    @foreach($hostel->rooms as $k => $room)
                                        <tr>
                                            <th scope="row">{{ $k + 1 }}</th>
                                            <td>{{ $room->name }}</td>

                                            <td>
                                                @if(\App\Enums\RoomType::from($room->type)->value == \App\Enums\RoomType::Single->value)
                                                    <span
                                                        class="a-round-marks">{{ \App\Enums\RoomType::Single->name }}</span>
                                                @else
                                                    <span
                                                        class="b-round-marks">{{ \App\Enums\RoomType::Double->name }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $room->bookings->count() }}
                                            </td>
                                            <td>
                                                @if(\App\Enums\GeneralStatus::from($room->status)->value == \App\Enums\GeneralStatus::Active->value)
                                                    <span
                                                        class="active-round-marks">{{ \App\Enums\GeneralStatus::Active->name }}</span>
                                                @else
                                                    <span
                                                        class="disabled-round-marks">{{ \App\Enums\GeneralStatus::Disabled->name }}</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a class="btn btn-boston btn-sm"
                                                   href="{{ route('admin.room.edit', [$hostel, $room]) }}">
                                                    edit
                                                </a>
                                                <button class="btnDelete btn btn-danger btn-sm ms-1"
                                                        data-name="{{ $room->name }}"
                                                        data-support="{{ $hostel->id }}"
                                                        data-id="{{ $room->id }}">
                                                    delete
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                            <div>
                                {{ isset($hostels) ? $hostels->onEachSide(5)->links() : '' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    @include('admin.partials.delete-modals')
@endsection
@section('script')
    <script>
        $('.btnDelete').on('click', function () {
            let id = $(this).data('id');
            let itemName = $(this).data('name');
            let support = $(this).data('support');
            let postURL = '{{ route('admin.room.destroy', [':support',':room']) }}';
            let link = postURL.replace(':support', support);
            let url = link.replace(':room', id);

            $('#delete-form').attr('action', url);
            $('#deleteModal').modal('show');
            $('#deletable-item-name').html(itemName);
        })
    </script>
@endsection
