<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Middleware\User;
use App\Mail\ReservationMail;
use App\Models\Hostel;
use App\Models\Reservation;
use App\Models\Room;
use App\Services\SerializeDates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class RoomController extends Controller
{
    public function show(Hostel $hostel, Room $room): View
    {
        $bookedDates = Reservation::where('room_id', $room->id)
            ->get()->pluck('check_out', 'check_in')->toArray();


        $serializeDates = new SerializeDates();
        $unavailableDates  = $serializeDates->getAllDatesDuringBookingPeriod($bookedDates);

        return view('user.sections.room.index',
        compact('room', 'unavailableDates'));
    }


    public function reservation(Request $request, Room $room)
    {
        $request->validate([
            'check_in_date' => ['required', 'date'],
            'check_out_date' => ['required', 'date', 'after_or_equal:check_in_date'],
            'email' => ['required', 'email:filter'],
            'occupants' => ['required'],
        ]);

        $reservation = Reservation::create([
            'user_id' => auth()->user()->getAuthIdentifier(),
            'room_id' => $room->id,
            'hostel_id' => $room->hostel->id,
            'check_in' => $request->check_in_date,
            'check_out' => $request->check_out_date,
            'email' => $request->email,
            'occupants' => $request->occupants
        ]);

        Mail::to($request->email)
            ->send(new ReservationMail($reservation));

        return to_route('user.hostel.room.show', [$room->hostel, $room])
            ->with('success', 'Room Booked Successfully');
    }



}
