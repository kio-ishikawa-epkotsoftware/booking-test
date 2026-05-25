<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Carbon\Carbon;

class BookingController extends Controller
{
    /**
     * 予約一覧
     */
    public function index()
    {
        $bookings = Booking::where('user_id', auth()->id())
            ->orderBy('booking_date')
            ->orderBy('booking_time')
            ->get();

        return view('booking.index', compact('bookings'));
    }

    /**
     * 登録画面
     */
    public function create()
    {
        return view('booking.register');
    }

    /**
     * 登録処理
     */
    public function store(Request $request)
    {
        $request->validate([
            'booking_date' => 'required|date|after_or_equal:today',
            'booking_time' => 'required',
        ]);

        // 日付＋時間を結合
        $bookingDateTime = Carbon::parse(
            $request->booking_date . ' ' . $request->booking_time
        );

        // 過去日時チェック
        if ($bookingDateTime->isPast()) {

            return back()
                ->withInput()
                ->withErrors([
                    'booking_time' => '過去の日時は指定できません。'
                ]);
        }

        // 重複チェック
        $exists = Booking::where('booking_date', $request->booking_date)
            ->where('booking_time', $request->booking_time)
            ->exists();

        if ($exists) {

            return back()
                ->withInput()
                ->withErrors([
                    'booking_time' => 'その時間は予約済みです。'
                ]);
        }

        // 登録
        Booking::create([
            'user_id'       => auth()->id(),
            'booking_date'  => $request->booking_date,
            'booking_time'  => $request->booking_time,
        ]);

        return redirect()
            ->route('booking.index')
            ->with('success', '予約を登録しました。');
    }

    /**
     * キャンセル
     */
    public function destroy(Booking $booking)
    {
        // 自分の予約だけ削除可能
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        $booking->delete();

        return redirect()
            ->route('booking.index')
            ->with('success', '予約をキャンセルしました。');
    }
}