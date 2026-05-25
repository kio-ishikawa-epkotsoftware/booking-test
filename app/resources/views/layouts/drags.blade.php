@foreach($sortables as $sortable)

<div class="drag" data-num="{{ $sortable->id }} "style="left:{{ $sortable->left_x }}px; top:{{ $sortable->top_y }}px;">
  <p><span class="name">{{ $sortable->id }} {{ $sortable->name }}</span></p>
</div>

@endforeach