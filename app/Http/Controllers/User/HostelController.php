<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Hostel;
use Illuminate\View\View;

class HostelController extends Controller
{
    public function show(Hostel $hostel): View
    {
        return view('user.sections.hostel.index',
            compact('hostel'));
    }
}
