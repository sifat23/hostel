<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class DashboardController extends Controller
{
    public function index(): View
    {
        $reservations = Reservation::latest()->paginate(5);

        return view('admin.sections.dashboard',
            compact('reservations'));
    }


}
