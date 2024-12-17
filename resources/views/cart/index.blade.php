@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Your Cart</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(count($cart) > 0)
        <form action="{{ route('cart.update') }}" method="POST">
            @csrf
            @method('PATCH')
            <table class="table">
                <thead>
                    <tr>
                        <th>Kebaya</th>
                        <th>Price per Day</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kebayas as $kebaya)
                        <tr>
                            <td>{{ $kebaya->NAMA_KEBAYA }}</td>
                            <td>Rp {{ number_format($kebaya->HARGA_SEWA, 0, ',', '.') }}</td>
                            <td>
                                <input type="number" name="quantity[{{ $kebaya->ID_KEBAYA }}]" value="{{ $cart[$kebaya->ID_KEBAYA]['quantity'] }}" min="1" class="form-control" style="width: 60px;">
                            </td>
                            <td>Rp {{ number_format($kebaya->HARGA_SEWA * $cart[$kebaya->ID_KEBAYA]['quantity'], 0, ',', '.') }}</td>
                            <td>
                                <form action="{{ route('cart.remove', $kebaya) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Update Cart</button>
        </form>
        <form action="{{ route('cart.clear') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-warning">Clear Cart</button>
        </form>
        <a href="{{ route('rentals.create') }}" class="btn btn-success">Proceed to Rent</a>
    @else
        <p>Your cart is empty.</p>
    @endif
    <a href="{{ route('kebayas.index') }}" class="btn btn-secondary mt-3">Continue Shopping</a>
</div>
@endsection

