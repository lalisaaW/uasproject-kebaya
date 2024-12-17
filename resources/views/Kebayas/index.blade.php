@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Kebayas</h1>
    @if(Auth::user()->canUploadKebaya())
        <a href="{{ route('kebayas.create') }}" class="btn btn-primary mb-3">Add New Kebaya</a>
    @endif
    <div class="row">
        @foreach($kebayas as $kebaya)
            <div class="col-md-4 mb-4">
                <div class="card">
                    @if($kebaya->FOTO_URL)
                        <img src="{{ asset('storage/'.$kebaya->FOTO_URL) }}" class="card-img-top" alt="{{ $kebaya->NAMA_KEBAYA }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $kebaya->NAMA_KEBAYA }}</h5>
                        <p class="card-text">{{ Str::limit($kebaya->DESKRIPSI, 100) }}</p>
                        <p class="card-text">Size: {{ $kebaya->UKURAN }}</p>
                        <p class="card-text">Color: {{ $kebaya->WARNA }}</p>
                        <p class="card-text">Price: Rp {{ number_format($kebaya->HARGA_SEWA, 0, ',', '.') }} / day</p>
                        @if(Auth::user()->canRentKebaya())
                            <a href="{{ route('rentals.create', $kebaya) }}" class="btn btn-primary">Rent</a>
                        @endif
                        @if(Auth::user()->canUploadKebaya() && $kebaya->ID_USER == Auth::id())
                            <a href="{{ route('kebayas.edit', $kebaya) }}" class="btn btn-secondary">Edit</a>
                            <form action="{{ route('kebayas.destroy', $kebaya) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#createKebayaModal form').on('submit', function(e) {
        e.preventDefault();
        var form = $(this);
        var formData = new FormData(this);

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    alert(response.message);
                    $('#createKebayaModal').modal('hide');
                    location.reload(); // Reload the page to show the new kebaya
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function(xhr) {
                var errors = xhr.responseJSON.errors;
                var errorMessage = '';
                for (var error in errors) {
                    errorMessage += errors[error][0] + '\n';
                }
                alert('Error: ' + errorMessage);
            }
        });
    });
});
</script>

