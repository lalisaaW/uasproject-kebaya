@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8 text-center">Explore Our Beautiful Kebayas</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($kebayas as $kebaya)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                @if($kebaya->FOTO_URL)
                    <img src="{{ asset('storage/'.$kebaya->FOTO_URL) }}" alt="{{ $kebaya->NAMA_KEBAYA }}" class="w-full h-64 object-cover">
                @else
                    <div class="w-full h-64 bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-500">No image available</span>
                    </div>
                @endif
                <div class="p-6">
                    <h2 class="text-xl font-semibold mb-2">{{ $kebaya->NAMA_KEBAYA }}</h2>
                    <p class="text-gray-600 mb-4">{{ Str::limit($kebaya->DESKRIPSI, 100) }}</p>
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-sm text-gray-500">Size: {{ $kebaya->UKURAN }}</span>
                        <span class="text-sm text-gray-500">Color: {{ $kebaya->WARNA }}</span>
                    </div>
                    <p class="text-lg font-bold mb-4">Rp {{ number_format($kebaya->HARGA_SEWA, 0, ',', '.') }} / day</p>
                    
                    @if(Auth::check() && Auth::user()->canRentKebaya())
                        <form action="{{ route('kebayas.rent', $kebaya) }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label for="TANGGAL_MULAI" class="block text-sm font-medium text-gray-700">Start Date</label>
                                <input type="date" name="TANGGAL_MULAI" id="TANGGAL_MULAI" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                            <div>
                                <label for="TANGGAL_SELESAI" class="block text-sm font-medium text-gray-700">End Date</label>
                                <input type="date" name="TANGGAL_SELESAI" id="TANGGAL_SELESAI" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                                Rent Now
                            </button>
                        </form>
                    @elseif(!Auth::check())
                        <a href="{{ route('login') }}" class="block text-center w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                            Login to Rent
                        </a>
                    @else
                        <p class="text-center text-gray-500">You are not authorized to rent kebayas.</p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

