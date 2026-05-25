{{-- resources/views/admin/users/create.blade.php --}}
@extends('layouts.logins')

@section('content')
<div class="p-4">
  <h1>アカウント作成</h1>

  @if(session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
  @endif

  @if($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form method="POST" action="{{ route('admin.users.store') }}">
    @csrf

    {{-- 社員番号 --}}
    <div class="mb-3">
      <label class="form-label">社員番号</label>
      <input type="text" name="employee_number"
             value="{{ old('employee_number') }}"
             class="form-control" required>
    </div>

    {{-- パスワード --}}
    <div class="mb-3">
      <label class="form-label">パスワード</label>
      <input type="text" name="password"
             value="{{ old('password') }}"
             class="form-control" required>
    </div>

    {{-- 名前 --}}
    <div class="mb-3">
      <label class="form-label">名前</label>
      <input type="text" name="name"
             value="{{ old('name') }}"
             class="form-control" required>
    </div>

    {{-- 管理者フラグ --}}
    <div class="mb-3">
      <label class="form-label">管理者権限</label>
      <select name="is_admin" class="form-select" required>
        <option value="0" {{ old('is_admin')=='0' ? 'selected':'' }}>一般</option>
        <option value="1" {{ old('is_admin')=='1' ? 'selected':'' }}>管理者</option>
      </select>
    </div>

    <div class="d-flex gap-2">
      <button type="submit" class="btn btn-primary">作成する</button>
      <a href="{{ route('admin.users.index') }}" class="btn btn-link">一覧へ戻る</a>
    </div>
  </form>
</div>
@endsection