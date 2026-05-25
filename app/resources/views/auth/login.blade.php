{{-- resources/views/login.blade.php --}}
@extends('layouts.logins')

@section('content')
<div class="row justify-content-center">
  <div class="col-md-6">
    <div class="card">
      <div class="card-header">ログイン</div>
      <div class="card-body">
        <form method="POST" action="{{ route('login') }}">
          @csrf
          <div class="mb-3">
            <label for="employee_number" class="form-label">ユーザーID</label>
            <input
              id="employee_number"
              type="text"
              name="employee_number"
              class="form-control @error('employee_number') is-invalid @enderror"
              value="{{ old('employee_number') }}"
              required
              autofocus
            >
            @error('employee_number')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">パスワード</label>
            <input
              id="password"
              type="password"
              name="password"
              class="form-control @error('password') is-invalid @enderror"
              required
            >
            @error('password')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <button type="submit" class="btn btn-primary w-100">ログイン</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection