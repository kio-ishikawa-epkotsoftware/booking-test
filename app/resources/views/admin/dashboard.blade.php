{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.logins')

@section('content')
<div class="p-4">
  <h1>管理ダッシュボード</h1>
  <p>{{ auth()->user()->name }} さん、管理者メニューへようこそ。</p>

  <div class="d-grid gap-3 mt-4" style="max-width:400px;">
    {{-- アカウント管理 --}}
    <a href="{{ route('admin.users.index') }}" class="btn btn-dark btn-lg">
      アカウント管理
    </a>
  </div>
</div>
@endsection