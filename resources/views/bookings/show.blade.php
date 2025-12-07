@extends('layouts.app')

@section('title', 'Booking Details - suite.in')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-xl shadow-md p-8">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Booking Details</h1>
            <span class="px-4 py-2 rounded-full text-sm font-medium
                @if($booking->status == 'confirmed') bg-green-100 text-green-800
                @elseif($booking->status == 'pending') bg-yellow-100 text-yellow-800
                @elseif($booking->status == 'cancelled') bg-red-100 text-red-800
                @else bg-gray-100 text-gray-800
                @endif">
                {{ ucfirst($booking->status) }}
            </span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <div>
                <h2 class="text-lg font-semibold mb-4">Hotel Information</h2>
                <p class="text-gray-900 font-medium mb-1">{{ $booking->hotel->name }}</p>
                <p class="text-gray-600 text-sm">{{ $booking->hotel->address }}</p>
                <p class="text-gray-600 text-sm">{{ $booking->hotel->city }}, {{ $booking->hotel->province }}</p>
            </div>
            <div>
                <h2 class="text-lg font-semibold mb-4">Guest Information</h2>
                <p class="text-gray-900 font-medium mb-1">{{ $booking->guest_name }}</p>
                <p class="text-gray-600 text-sm">{{ $booking->guest_email }}</p>
                <p class="text-gray-600 text-sm">{{ $booking->guest_phone }}</p>
            </div>
        </div>

        <div class="border-t pt-6 mb-6">
            <h2 class="text-lg font-semibold mb-4">Booking Information</h2>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-600">Booking Number</p>
                    <p class="font-medium">{{ $booking->booking_number }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Check In</p>
                    <p class="font-medium">{{ $booking->check_in->format('M d, Y') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Check Out</p>
                    <p class="font-medium">{{ $booking->check_out->format('M d, Y') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Duration</p>
                    <p class="font-medium">{{ $booking->nights }} night(s)</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Guests</p>
                    <p class="font-medium">{{ $booking->guests }} guest(s)</p>
                </div>
            </div>
        </div>

        <div class="border-t pt-6 mb-6">
            <h2 class="text-lg font-semibold mb-4">Rooms</h2>
            @foreach($booking->rooms as $bookingRoom)
                <div class="mb-4">
                    <p class="font-medium">{{ $bookingRoom->room->roomType->name }}</p>
                    <p class="text-sm text-gray-600">Rp {{ number_format($bookingRoom->price_per_night, 0, ',', '.') }} per night × {{ $booking->nights }} nights</p>
                </div>
            @endforeach
        </div>

        <div class="border-t pt-6 mb-6">
            <h2 class="text-lg font-semibold mb-4">Payment Summary</h2>
            <div class="space-y-2">
                <div class="flex justify-between">
                    <span class="text-gray-600">Subtotal</span>
                    <span class="font-medium">Rp {{ number_format($booking->subtotal, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Tax (10%)</span>
                    <span class="font-medium">Rp {{ number_format($booking->tax, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Service Charge (5%)</span>
                    <span class="font-medium">Rp {{ number_format($booking->service_charge, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-lg font-bold border-t pt-2">
                    <span>Total</span>
                    <span class="text-blue-600">Rp {{ number_format($booking->total_amount, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        @if($booking->payment)
            <div class="border-t pt-6">
                <h2 class="text-lg font-semibold mb-4">Payment Information</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-600">Payment Number</p>
                        <p class="font-medium">{{ $booking->payment->payment_number }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Payment Method</p>
                        <p class="font-medium">{{ ucfirst(str_replace('_', ' ', $booking->payment->method)) }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Status</p>
                        <p class="font-medium">{{ ucfirst($booking->payment->status) }}</p>
                    </div>
                    @if($booking->payment->paid_at)
                        <div>
                            <p class="text-sm text-gray-600">Paid At</p>
                            <p class="font-medium">{{ $booking->payment->paid_at->format('M d, Y H:i') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        @endif

        @if($booking->status == 'pending' && !$booking->payment)
            <div class="border-t pt-6 mt-6">
                <a href="{{ route('bookings.payment', $booking->id) }}" 
                   class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-700 transition-colors">
                    Proceed to Payment
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

