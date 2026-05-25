$(function(){
  $('.delete_btn').on('click', function(){
    var Id = $(this).data('id');
    /*console.log(Id);*/
    if(confirm("タスクを完了してよいでしょうか？")){
      /* ==========AJAX通信================= */
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        type:'POST',
        url: '/task/delete',
        data: {
          id: Id
        }
      }).done(function(){
         /*console.log('成功');*/
         location.reload();
      }).fail(function(XMLHttpRequest, textStatus, errorThrown){
         console.log(XMLHttpRequest.status);
         console.log(textStatus);
         console.log(errorThrown);
      });
      /* ==========/AJAX通信================= */
    }
  });
});