@extends('layouts.app')

@section('title', 'Payment - suite.in')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Payment</h1>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4">Booking Summary</h2>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Hotel</span>
                        <span class="font-medium">{{ $booking->hotel->name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Check In</span>
                        <span class="font-medium">{{ $booking->check_in->format('M d, Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Check Out</span>
                        <span class="font-medium">{{ $booking->check_out->format('M d, Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Nights</span>
                        <span class="font-medium">{{ $booking->nights }} night(s)</span>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-semibold mb-4">Payment Method</h2>
                <form action="{{ route('payments.process', $booking->id) }}" method="POST">
                    @csrf
                    <div class="space-y-3">
                        <label class="flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-blue-500">
                            <input type="radio" name="method" value="dummy" checked class="mr-3">
                            <div>
                                <p class="font-medium">Dummy Payment (For Testing)</p>
                                <p class="text-sm text-gray-600">This is a test payment method</p>
                            </div>
                        </label>
                        <label class="flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-blue-500">
                            <input type="radio" name="method" value="credit_card" class="mr-3">
                            <div>
                                <p class="font-medium">Credit Card</p>
                                <p class="text-sm text-gray-600">Visa, Mastercard, etc.</p>
                            </div>
                        </label>
                        <label class="flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-blue-500">
                            <input type="radio" name="method" value="bank_transfer" class="mr-3">
                            <div>
                                <p class="font-medium">Bank Transfer</p>
                                <p class="text-sm text-gray-600">Transfer via bank</p>
                            </div>
                        </label>
                        <label class="flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-blue-500">
                            <input type="radio" name="method" value="e_wallet" class="mr-3">
                            <div>
                                <p class="font-medium">E-Wallet</p>
                                <p class="text-sm text-gray-600">GoPay, OVO, DANA, etc.</p>
                            </div>
                        </label>
                    </div>
                    <button type="submit" class="w-full mt-6 bg-blue-600 text-white px-4 py-3 rounded-lg font-medium hover:bg-blue-700 transition-colors">
                        Pay Now
                    </button>
                </form>
            </div>
        </div>

        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-md p-6 sticky top-20">
                <h2 class="text-xl font-semibold mb-4">Price Summary</h2>
                <div class="space-y-2 mb-6">
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
        </div>
    </div>
</div>
@endsection

