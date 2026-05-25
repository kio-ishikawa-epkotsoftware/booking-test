@foreach($tasks as $task)
  <li>
    <p>{{ $task->task }}</p>
    <button class="delete_btn" data-id="{{ $task->id }}">完了</button>
  </li>
@endforeach