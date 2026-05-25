<form action="{{ url('/task/register')}}" method="POST">
  {{ csrf_field() }}
  <input type="text" name="task" maxlength="30" placeholder="タスクを入力してください">
  <input type="submit" value="追加">
</form>