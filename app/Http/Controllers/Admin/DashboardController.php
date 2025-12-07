<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->isAdmin()) {
            // Admin sees all hotels and bookings
            $hotels = Hotel::count();
            $bookings = Booking::count();
            $revenue = Booking::where('status', 'confirmed')->sum('total_amount');
            $recentBookings = Booking::with(['hotel', 'user'])->latest()->take(10)->get();
        } else {
            // Hotel owner sees only their hotels
            $hotels = Hotel::where('owner_id', $user->id)->count();
            $bookings = Booking::whereHas('hotel', function($q) use ($user) {
                $q->where('owner_id', $user->id);
            })->count();
            $revenue = Booking::whereHas('hotel', function($q) use ($user) {
                $q->where('owner_id', $user->id);
            })->where('status', 'confirmed')->sum('total_amount');
            $recentBookings = Booking::whereHas('hotel', function($q) use ($user) {
                $q->where('owner_id', $user->id);
            })->with(['hotel', 'user'])->latest()->take(10)->get();
        }

        return view('admin.dashboard', compact('hotels', 'bookings', 'revenue', 'recentBookings'));
    }
}
