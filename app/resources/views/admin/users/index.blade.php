{{-- resources/views/admin/users/index.blade.php --}}
@extends('layouts.logins')

@section('content')
<div class="p-4">
  <h1>アカウント一覧</h1>

  {{-- 成功メッセージ --}}
  @if(session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
  @endif
  {{-- エラーメッセージ --}}
  @if($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  {{-- 検索フォーム --}}
  <form method="GET" action="{{ route('admin.users.index') }}"
        class="row gx-2 gy-2 align-items-center mb-4" style="max-width: 500px;">
    <div class="col">
      <input type="text" name="q"
             class="form-control"
             placeholder="社員番号で検索"
             value="{{ old('q', $q) }}">
    </div>
    <div class="col-auto">
      <button type="submit" class="btn btn-primary">検索</button>
    </div>
    @if(! empty($q))
      <div class="col-auto">
        <a href="{{ route('admin.users.index') }}" class="btn btn-link">リセット</a>
      </div>
    @endif
  </form>

  {{-- 新規作成ボタン --}}
  <div class="mb-3 text-end">
    <a href="{{ route('admin.users.create') }}" class="btn btn-success">
      新規アカウント作成
    </a>
  </div>

  {{-- アカウント一覧テーブル --}}
  <div class="table-responsive">
    <table class="table table-bordered align-middle text-center">
      <thead class="table-light">
        <tr>
          <th>社員番号</th>
          <th>名前</th>
          <th>管理者</th>
          <th>操作</th>
        </tr>
      </thead>
      <tbody>
        @forelse($users as $u)
          <tr>
            <td class="text-nowrap">{{ $u->employee_number }}</td>
            <td class="text-nowrap">{{ $u->name }}</td>
            <td class="text-nowrap">{{ $u->is_admin ? '○' : '×' }}</td>
            <td class="text-nowrap">
              {{-- 編集ボタン（パスワード変更もこの画面で行える） --}}
              <a href="{{ route('admin.users.edit', $u->employee_number) }}"
                 class="btn btn-sm btn-outline-secondary me-1">
                編集
              </a>

              {{-- 削除フォーム --}}
              @if(auth()->id() !== $u->employee_number)
                <form method="POST"
                      action="{{ route('admin.users.destroy', $u->employee_number) }}"
                      class="d-inline-block"
                      onsubmit="return confirm('本当にこのアカウントを削除しますか？');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-outline-danger">
                    削除
                  </button>
                </form>
              @endif
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5" class="text-center text-muted">該当するアカウントが見つかりません。</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection