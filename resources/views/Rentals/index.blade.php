@extends('layouts.main')

@section('content')
<div class="container">
    <h1>My Rentals</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>Kebaya</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rentals as $rental)
                <tr>
                    <td>{{ $rental->kebaya->NAMA_KEBAYA }}</td>
                    <td>{{ $rental->TANGGAL_MULAI->format('Y-m-d') }}</td>
                    <td>{{ $rental->TANGGAL_SELESAI->format('Y-m-d') }}</td>
                    <td>Rp {{ number_format($rental->TOTAL_HARGA, 0, ',', '.') }}</td>
                    <td>{{ ucfirst($rental->STATUS) }}</td>
                    <td>
                        <a href="{{ route('rentals.show', $rental) }}" class="btn btn-sm btn-info">View</a>
                        @if($rental->STATUS === 'pending')
                            <a href="{{ route('rentals.edit', $rental) }}" class="btn btn-sm btn-secondary">Edit</a>
                            <form action="{{ route('rentals.destroy', $rental) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to cancel this rental?')">Cancel</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

