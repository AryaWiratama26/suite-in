@extends('layouts.app')

@section('title', 'My Bookings - suite.in')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">My Bookings</h1>

    @if($bookings->count() > 0)
        <div class="space-y-6">
            @foreach($bookings as $booking)
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div class="mb-4 md:mb-0">
                            <div class="flex items-center gap-4 mb-2">
                                <h2 class="text-xl font-semibold text-gray-900">{{ $booking->hotel->name }}</h2>
                                <span class="px-3 py-1 rounded-full text-sm font-medium
                                    @if($booking->status == 'confirmed') bg-green-100 text-green-800
                                    @elseif($booking->status == 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($booking->status == 'cancelled') bg-red-100 text-red-800
                                    @else bg-gray-100 text-gray-800
                                    @endif">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </div>
                            <p class="text-gray-600 mb-1">Booking Number: <span class="font-medium">{{ $booking->booking_number }}</span></p>
                            <p class="text-gray-600 mb-1">{{ $booking->check_in->format('M d, Y') }} - {{ $booking->check_out->format('M d, Y') }}</p>
                            <p class="text-gray-600">{{ $booking->nights }} night(s) • {{ $booking->guests }} guest(s)</p>
                        </div>
                        <div class="text-right">
                            <p class="text-2xl font-bold text-blue-600 mb-2">Rp {{ number_format($booking->total_amount, 0, ',', '.') }}</p>
                            <a href="{{ route('bookings.show', $booking->id) }}" 
                               class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $bookings->links() }}
        </div>
    @else
        <div class="bg-white rounded-xl shadow-md p-12 text-center">
            <p class="text-gray-600 text-lg mb-4">You don't have any bookings yet.</p>
            <a href="{{ route('home') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-700 transition-colors">
                Browse Hotels
            </a>
        </div>
    @endif
</div>
@endsection

