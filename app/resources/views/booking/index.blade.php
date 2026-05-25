{{-- resources/views/booking.blade.php --}}
@extends('layouts.logins')

@section('content')
<div class="container">

    <h1>予約一覧</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-3">
        <a href="{{ route('booking.register') }}"
           class="btn btn-primary">
            新規予約
        </a>
    </div>

    <table class="table table-bordered">

        <thead>
            <tr>
                <th>予約日</th>
                <th>予約時間</th>
                <th>操作</th>
            </tr>
        </thead>

        <tbody>

        @forelse($bookings as $booking)

            <tr>
                <td>{{ $booking->booking_date }}</td>
                <td>{{ $booking->booking_time }}</td>

                <td>

                    <form method="POST"
                          action="{{ route('booking.destroy', $booking->id) }}">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('キャンセルしますか？')">

                            キャンセル

                        </button>

                    </form>

                </td>
            </tr>

        @empty

            <tr>
                <td colspan="3">
                    予約はありません
                </td>
            </tr>

        @endforelse

        </tbody>

    </table>

</div>
@endsection