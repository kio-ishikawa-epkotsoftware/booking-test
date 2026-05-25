{{-- resources/views/admin/users/edit.blade.php --}}
@extends('layouts.logins')

@section('content')
<div class="p-4">
  <h1>アカウント編集: {{ $user->employee_number }} – {{ $user->name }}</h1>

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

  <form method="POST"
        action="{{ route('admin.users.update', $user->employee_number) }}">
    @csrf
    @method('PUT')

    {{-- 名前 --}}
    <div class="mb-3">
      <label class="form-label">名前</label>
      <input type="text" name="name"
             value="{{ old('name', $user->name) }}"
             class="form-control" required>
    </div>

    {{-- 管理者フラグ --}}
    <div class="mb-3">
      <label class="form-label">管理者権限</label>
      <select name="is_admin" class="form-select" required>
        <option value="0" {{ old('is_admin', $user->is_admin) == 0 ? 'selected' : '' }}>一般</option>
        <option value="1" {{ old('is_admin', $user->is_admin) == 1 ? 'selected' : '' }}>管理者</option>
      </select>
    </div>


    <hr>

    {{-- パスワード変更 --}}
    <div class="mb-3">
      <label class="form-label">新パスワード（空欄なら変更しない）</label>
      <input type="password" name="password" class="form-control">
    </div>
    <div class="mb-3">
      <label class="form-label">新パスワード（確認用）</label>
      <input type="password" name="password_confirmation" class="form-control">
    </div>

    <div class="d-flex gap-2">
      <button type="submit" class="btn btn-primary">更新する</button>
      <a href="{{ route('admin.users.index') }}" class="btn btn-link">一覧へ戻る</a>
    </div>
  </form>
</div>
@endsection