<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Hostel;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $hostels = Hostel::where('status', 1)
            ->latest()
            ->paginate(5);

        return view('user.sections.home',
            compact('hostels'));
    }
}
