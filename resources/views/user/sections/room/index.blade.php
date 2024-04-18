@extends('user.layouts.main')
@section('style')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
@endsection
@section('content')
    @if(!empty($room))
        <div class="container pt-3">
            @include('user.partials.notify')
            <div class="card">
                <div class="card-header">
                    <h1>{{ $room->hostel->name }}</h1>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <h3>{{ $room->name }}</h3>
                            <img class="img-30vh" src="{{ asset('assets/img/demo.jpeg') }}">
                            <div class="mt-3">
                                Room Type : <span
                                    class="round-marks">{{ \App\Enums\RoomType::from($room->type)->name }}</span>
                                <br>
                                Hostel Location : {{ $room->hostel->location }}
                            </div>
                        </div>
                        <div class="col-4 align-content-center">
                            <form action="{{ route('user.hostel.reserve.room', [$room]) }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="check-in-date" class="form-label">Check-in Date</label>
                                    <input type="text" class=" form-control"
                                           autocomplete="off"
                                           name="check_in_date_visible"
                                           value="{{ old('check_in_date_visible') }}"
                                           id="check-in-date">
                                    <input type="hidden"
                                           value="{{ old('check_in_date') }}"
                                           name="check_in_date" id="altFieldIn">
                                </div>
                                <div class="mb-3">
                                    <label for="check-out-date" class="form-label">Check-out Date</label>
                                    <input type="text" class="bookingDatePicker form-control"
                                           name="check_out_date_visible"
                                           value="{{ old('check_out_date_visible') }}"
                                           autocomplete="off"
                                           id="check-out-date">
                                    <input type="hidden"
                                           value="{{ old('check_out_date') }}"
                                           name="check_out_date" id="altFieldOut">
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Enter Your Mail</label>
                                    <input type="email" class="form-control"
                                           value="{{ old('email') }}"
                                           id="email" name="email">
                                </div>

                                <div class="mb-3">
                                    <label for="occupants" class="form-label">Enter Your Occupants</label>
                                    <input type="number"
                                           min="0"
                                           class="form-control"
                                           value="{{ old('occupants') }}"
                                           id="occupants" name="occupants">
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Book Now!</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection
@section('script')
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>

        var unavailableDates = [<?php
                                if (!empty($unavailableDates)) {
                                    foreach ($unavailableDates as $date) {
                                        echo '"'. date("j-n-Y", strtotime($date)) .'", ';
                                    }
                                }
                                ?>];

        //

        var unavailableDatesp = ["25-4-2024", "6-11-2024", "7-4-2024"];

        console.log(unavailableDates, unavailableDatesp)

        function unavailable(date) {
            dmy = date.getDate() + "-" + (date.getMonth() + 1) + "-" + date.getFullYear();
            if ($.inArray(dmy, unavailableDates) == -1) {
                return [true, ""];
            } else {
                return [false, "", "Unavailable"];
            }
        }

        $(function () {
            $("#check-in-date").datepicker({
                minDate: 1,
                dateFormat: "mm/dd/yy",
                altFormat: "yy-mm-dd",
                altField: "#altFieldIn",
                beforeShowDay: unavailable
            });

            $("#check-out-date").datepicker({
                minDate: 1,
                dateFormat: "mm/dd/yy",
                altFormat: "yy-mm-dd",
                altField: "#altFieldOut",
                beforeShowDay: unavailable
            });
        });
    </script>
    <script>


        console.log('var: ', unavailableDates)
    </script>
@endsection
