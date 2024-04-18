<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hostel;
use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class RoomController extends Controller
{
    public function create(Hostel $hostel): View
    {
        return view('admin.sections.room.form',
            compact('hostel'));
    }

    public function store(Request $request, Hostel $hostel): RedirectResponse
    {
        $room = new Room();
        $room->hostel_id = $hostel->id;
        $room->name = $request->name;
        $room->type = $request->type;
        $room->status = $request->status;
        $room->save();
        $room->refresh();

        return to_route('admin.hostel.show', [$hostel])
            ->with('success', 'Room Created!');
    }

    public function edit(Hostel $hostel, Room $room): View
    {
        return view('admin.sections.room.form',
            compact('hostel', 'room'));
    }

    public function update(Request $request, Hostel $hostel, Room $room): RedirectResponse
    {
        $room->name = $request->name;
        $room->hostel_id = $hostel->id;
        $room->type = $request->type;
        $room->status = $request->status;
        $room->update();
        $room->refresh();

        return to_route('admin.hostel.show', [$hostel])
            ->with('success', 'Room Updated!');
    }

    public function destroy(Hostel $hostel, Room $room): RedirectResponse
    {
        $bookings = Reservation::where('room_id', $room->id)
            ->first();

        if (!empty($bookings)) {
            return to_route('admin.hostel.show', [$hostel])
                ->with('error', 'Room is in use!');
        }

        $room->delete();

        return to_route('admin.hostel.show', [$hostel])
            ->with('success', 'Room Deleted!');
    }

}
