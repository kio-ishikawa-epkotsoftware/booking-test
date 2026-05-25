{{-- resources/views/booking/register.blade.php --}}
@extends('layouts.logins')

@section('content')
<div class="container">

    <h1>予約登録</h1>

    <form method="POST" action="{{ route('booking.store') }}">
        @csrf

        <div class="mb-3">

            <label class="form-label">
                予約日
            </label>

            <input type="date"
                   name="booking_date"
                   class="form-control @error('booking_date') is-invalid @enderror"
                   value="{{ old('booking_date') }}">

            @error('booking_date')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

        </div>

        <div class="mb-3">

            <label class="form-label">
                予約時間
            </label>

            <input type="time"
                   name="booking_time"
                   class="form-control @error('booking_time') is-invalid @enderror"
                   value="{{ old('booking_time') }}">

            @error('booking_time')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

        </div>

        <button type="submit"
                class="btn btn-primary">
            登録
        </button>

    </form>

</div>
@endsection