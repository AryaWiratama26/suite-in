<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function show($bookingId)
    {
        $booking = Booking::where('user_id', Auth::id())
            ->with(['hotel', 'rooms.room.roomType', 'payment'])
            ->findOrFail($bookingId);

        if ($booking->status !== 'pending') {
            return redirect()->route('bookings.show', $booking->id);
        }

        return view('payments.show', compact('booking'));
    }

    public function process(Request $request, $bookingId)
    {
        $booking = Booking::where('user_id', Auth::id())
            ->findOrFail($bookingId);

        if ($booking->status !== 'pending') {
            return back()->withErrors(['booking' => 'Booking is already processed.']);
        }

        $request->validate([
            'method' => 'required|in:credit_card,debit_card,bank_transfer,e_wallet,dummy',
        ]);

        // Create payment record
        $payment = Payment::create([
            'booking_id' => $booking->id,
            'payment_number' => 'PAY' . strtoupper(Str::random(10)),
            'amount' => $booking->total_amount,
            'method' => $request->method,
            'status' => 'processing',
            'transaction_id' => 'TXN' . strtoupper(Str::random(12)),
        ]);

        // Simulate payment processing (dummy)
        // In real implementation, this would call Midtrans API
        sleep(2); // Simulate processing time

        $payment->update([
            'status' => 'completed',
            'paid_at' => now(),
        ]);

        $booking->update([
            'status' => 'confirmed',
        ]);

        return redirect()->route('bookings.show', $booking->id)
            ->with('success', 'Payment successful! Your booking has been confirmed.');
    }
}
