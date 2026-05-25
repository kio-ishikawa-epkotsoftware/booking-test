{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.logins')

@section('content')
<div class="p-4">
  <h1>ダッシュボード</h1>
  <p>{{ auth()->user()->name }} さん、こんにちは。</p>

  <div class="row mt-4 gx-3">
    {{-- 左側：全ユーザー向けメニュー --}}
    <div class="col-12 col-md-6">
      <div class="d-grid gap-3">
        <a href="{{ route('booking.register') }}"
           class="btn btn-primary btn-lg">
          予約登録
        </a>
        <a href="{{ route('booking.index') }}"
           class="btn btn-primary btn-lg">
          予約一覧
        </a>
      </div>
    </div>

    {{-- 右側：管理者専用メニュー --}}
    @if(auth()->user()->is_admin)
    <div class="col-12 col-md-6">
      <div class="d-grid gap-3 text-md-end">
        <a href="{{ route('admin.dashboard') }}"class="btn btn-dark btn-lg">
          [管理者用]管理メニュー
        </a>
      </div>
    </div>
    @endif
  </div>
</div>
@endsection