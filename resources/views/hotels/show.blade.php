@extends('layouts.app')

@section('title', $hotel->name . ' - suite.in')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
        <div class="h-96 bg-gray-200 relative">
            @if($hotel->image)
                <img src="{{ asset('storage/' . $hotel->image) }}" alt="{{ $hotel->name }}" class="w-full h-full object-cover">
            @endif
        </div>
        <div class="p-8">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $hotel->name }}</h1>
                    <p class="text-gray-600">{{ $hotel->address }}, {{ $hotel->city }}, {{ $hotel->province }}</p>
                </div>
                <div class="text-right">
                    <div class="flex items-center mb-2">
                        <span class="text-yellow-500 text-2xl">★</span>
                        <span class="text-2xl font-bold ml-2">{{ number_format($hotel->rating, 1) }}</span>
                    </div>
                    <p class="text-sm text-gray-500">{{ $hotel->total_reviews }} reviews</p>
                </div>
            </div>
            <p class="text-gray-700 mb-6">{{ $hotel->description }}</p>
            
            @if($hotel->amenities->count() > 0)
                <div class="border-t pt-6">
                    <h3 class="text-lg font-semibold mb-4">Amenities</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach($hotel->amenities as $amenity)
                            <div class="flex items-center">
                                <span class="text-gray-700">{{ $amenity->name }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Available Rooms</h2>
            
            @if($rooms->count() > 0)
                @foreach($rooms as $roomTypeId => $roomGroup)
                    @php $roomType = $roomGroup->first()->roomType; @endphp
                    <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                        <div class="flex flex-col md:flex-row gap-6">
                            <div class="md:w-1/3">
                                @if($roomGroup->first()->image)
                                    <img src="{{ asset('storage/' . $roomGroup->first()->image) }}" alt="{{ $roomType->name }}" class="w-full h-48 object-cover rounded-lg">
                                @else
                                    <div class="w-full h-48 bg-gray-200 rounded-lg flex items-center justify-center">
                                        <span class="text-gray-400">No image</span>
                                    </div>
                                @endif
                            </div>
                            <div class="md:w-2/3">
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $roomType->name }}</h3>
                                <p class="text-gray-600 mb-4">{{ $roomType->description }}</p>
                                <div class="grid grid-cols-2 gap-4 mb-4 text-sm">
                                    <div>
                                        <span class="text-gray-500">Max Occupancy:</span>
                                        <span class="font-medium">{{ $roomType->max_occupancy }} guests</span>
                                    </div>
                                    <div>
                                        <span class="text-gray-500">Bed Type:</span>
                                        <span class="font-medium">{{ $roomType->bed_type }}</span>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-2xl font-bold text-blue-600">Rp {{ number_format($roomGroup->first()->price_per_night, 0, ',', '.') }}</p>
                                        <p class="text-sm text-gray-500">per night</p>
                                    </div>
                                    @auth
                                        <a href="{{ route('bookings.create', ['hotel_id' => $hotel->id, 'room_id' => $roomGroup->first()->id, 'check_in' => $checkIn, 'check_out' => $checkOut, 'guests' => request('guests', 2)]) }}" 
                                           class="bg-blue-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-blue-700 transition-colors">
                                            Book Now
                                        </a>
                                    @else
                                        <a href="{{ route('login') }}" 
                                           class="bg-blue-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-blue-700 transition-colors">
                                            Login to Book
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="bg-white rounded-xl shadow-md p-8 text-center">
                    <p class="text-gray-600">No rooms available for the selected dates.</p>
                </div>
            @endif
        </div>

        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-md p-6 sticky top-20">
                <h3 class="text-lg font-semibold mb-4">Booking Summary</h3>
                <form action="{{ route('hotels.show', $hotel->id) }}" method="GET" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Check In</label>
                        <input type="date" name="check_in" value="{{ $checkIn }}" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Check Out</label>
                        <input type="date" name="check_out" value="{{ $checkOut }}" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Guests</label>
                        <input type="number" name="guests" value="{{ $guests }}" min="1" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>
                    <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-700 transition-colors">
                        Update Search
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

