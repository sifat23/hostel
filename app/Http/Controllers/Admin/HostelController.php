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

class HostelController extends Controller
{
    public function index(): View
    {
        $hostels = Hostel::latest()->paginate(5);

        return view('admin.sections.hostel.list',
            compact('hostels'));
    }

    public function create(): View
    {
        return view('admin.sections.hostel.form');
    }

    public function store(Request $request): RedirectResponse
    {
        $hostel = new Hostel();
        $hostel->name = $request->name;
        $hostel->location = $request->location;
        $hostel->status = $request->status;
        $hostel->save();
        $hostel->refresh();

        return to_route('admin.hostel.index')
            ->with('success', 'Hostel Created!');
    }

    public function show(Hostel $hostel): View
    {

        return view('admin.sections.hostel.view',
            compact('hostel'));
    }

    public function edit(Hostel $hostel): View
    {
        return view('admin.sections.hostel.form',
            compact('hostel'));
    }

    public function update(Request $request, Hostel $hostel): RedirectResponse
    {
        $hostel->name = $request->name;
        $hostel->location = $request->location;
        $hostel->status = $request->status;
        $hostel->update();
        $hostel->refresh();

        return to_route('admin.hostel.index')
            ->with('success', 'Hostel Updated!');
    }

    public function destroy(Hostel $hostel): RedirectResponse
    {
        $bookings = Reservation::where('hostel_id', $hostel->id)
            ->first();

        if (!empty($bookings)) {
            return to_route('admin.hostel.index')
                ->with('error', 'Hostel is in use!');
        }

        $getRooms = Room::where('hostel_id', $hostel->id)
            ->get();

        foreach ($getRooms as $room) {
            $room->delete();
        }

        $hostel->delete();

        return to_route('admin.hostel.index')
            ->with('success', 'Hostel Deleted!');
    }

}
