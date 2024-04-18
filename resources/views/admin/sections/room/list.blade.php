@extends('admin.layouts.main')
@section('content')
    <div class="container mt-3 pt-3">
        @include('admin.partials.notify')
        <div class="card mb-3">
            <div class="card-header d-flex">
                <h5>All Hostel List</h5>
                <a class="btn btn-outline-primary ms-auto"
                    href="{{ route('admin.hostel.create') }}">Add Hostel</a>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Location</th>
                        <th scope="col">Rooms</th>
                        <th scope="col">Status</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($hostels))
                        @foreach($hostels as $k => $hostel)
                            <tr>
                                <th scope="row">{{ $k + $hostels->firstItem() }}</th>
                                <td>{{ $hostel->name }}</td>
                                <td>{{ $hostel->location }}</td>
                                <td>{{ $hostel->rooms->count() }}</td>
                                <td>
                                    @if(\App\Enums\GeneralStatus::from($hostel->status)->value == \App\Enums\GeneralStatus::Active->value)
                                        <span class="active-round-marks">{{ \App\Enums\GeneralStatus::Active->name }}</span>
                                    @else
                                        <span class="disabled-round-marks">{{ \App\Enums\GeneralStatus::Disabled->name }}</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-boston btn-sm"
                                       href="{{ route('admin.hostel.edit', [$hostel]) }}">
                                        edit
                                    </a>
                                    <button class="btnDelete btn btn-danger btn-sm ms-1"
                                            data-name="{{ $hostel->name }}"
                                            data-id="{{ $hostel->id }}">
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
    @include('admin.partials.delete-modals')
@endsection
@section('script')
    <script>
            $('.btnDelete').on('click', function () {
                let id = $(this).data('id');
                let itemName = $(this).data('name');
                let postURL = '{{ route('admin.hostel.destroy', [':hostel']) }}';
                let link = postURL.replace(':hostel', id);

                $('#delete-form').attr('action', link);
                $('#deleteModal').modal('show');
                $('#deletable-item-name').html(itemName);
            })
    </script>
@endsection
