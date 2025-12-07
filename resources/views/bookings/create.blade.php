@extends('layouts.app')

@section('title', 'Complete Booking - suite.in')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Complete Your Booking</h1>

    <form action="{{ route('bookings.store') }}" method="POST" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        @csrf
        <input type="hidden" name="hotel_id" value="{{ $hotel->id }}">
        <input type="hidden" name="room_id" value="{{ $room->id }}">
        <input type="hidden" name="check_in" value="{{ $checkIn->format('Y-m-d') }}">
        <input type="hidden" name="check_out" value="{{ $checkOut->format('Y-m-d') }}">
        <input type="hidden" name="guests" value="{{ $guests }}">

        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-semibold mb-4">Guest Information</h2>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                        <input type="text" name="guest_name" required 
                               value="{{ auth()->user()->name }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" name="guest_email" required 
                               value="{{ auth()->user()->email }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                        <input type="tel" name="guest_phone" required 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Special Requests (Optional)</label>
                        <textarea name="special_requests" rows="4" 
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-semibold mb-4">Booking Details</h2>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Hotel</span>
                        <span class="font-medium">{{ $hotel->name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Room</span>
                        <span class="font-medium">{{ $room->roomType->name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Check In</span>
                        <span class="font-medium">{{ $checkIn->format('M d, Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Check Out</span>
                        <span class="font-medium">{{ $checkOut->format('M d, Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Nights</span>
                        <span class="font-medium">{{ $nights }} night(s)</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Guests</span>
                        <span class="font-medium">{{ $guests }} guest(s)</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-md p-6 sticky top-20">
                <h2 class="text-xl font-semibold mb-4">Price Summary</h2>
                <div class="space-y-3 mb-6">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Room Price ({{ $nights }} nights)</span>
                        <span class="font-medium">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Tax (10%)</span>
                        <span class="font-medium">Rp {{ number_format($tax, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Service Charge (5%)</span>
                        <span class="font-medium">Rp {{ number_format($serviceCharge, 0, ',', '.') }}</span>
                    </div>
                    <div class="border-t pt-3 flex justify-between text-lg font-bold">
                        <span>Total</span>
                        <span class="text-blue-600">Rp {{ number_format($totalAmount, 0, ',', '.') }}</span>
                    </div>
                </div>
                <button type="submit" class="w-full bg-blue-600 text-white px-4 py-3 rounded-lg font-medium hover:bg-blue-700 transition-colors">
                    Continue to Payment
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

