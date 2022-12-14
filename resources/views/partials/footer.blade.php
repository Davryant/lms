@stack('scripts')

<script src="{{asset('public/js/jquery.min.js')}}"></script>
<script src="{{asset('public/lib/jquery/jquery.js')}}"></script>
<script src="{{asset('public/lib/popper.js/popper.js')}}"></script>
<script src="{{asset('public/lib/bootstrap/bootstrap.js')}}"></script>



<script type="text/javascript">
  $('div.alert').not('.alert-important').delay(3000).fadeOut(3000);
</script>

<script>
  
   $(".cargos_1").click(function(){
    if($(this).is(":clicked")){
      var amount = $('#wharfage_'+$(this).val()).html();
      var subtotal = $('#subtotal_1').html();
      
    } 
    else if($(this).is(":not(:checked)")){
      var amount = $('#wharfage_'+$(this).val()).html();
      var subtotal = $('#subtotal_1').html();

    }
  });



  function likeFunction(){
          // var book_id = id;
          
          var book_id = $('#book_id').val();
          var user_id = $('#user_id').val();

          console.log(book_id);
          // alert(book_id);

          $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
        

            if(book_id !=""){

                $.ajax({
                    url: "{{URL::asset('/books/like-book')}}/"+book_id,
                    type: 'post',
                    data: {
                      book_id: book_id,
                      user_id: user_id
                    },
    
                    success: function(response){
                      console.log(response);
                        window.location.reload();
                    },
                    error: function(response) {
                      console.log('error');
                      window.location.reload();
    
                  }
    
                });
            }
         }


      function favoriteFunction(id){
          var book_id = id;
        
          console.log(book_id);
          // alert(book_id);

          $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
        

            if(book_id !=""){

                $.ajax({
                    url: "{{URL::asset('/books/favorite-book')}}/"+book_id,
                    type: 'post',
                    data: {
                      book_id: book_id,
                    },
    
                    success: function(response){
                      console.log(response);
                        window.location.reload();
                    },
                    error: function(response) {
                      console.log('error');
                      window.location.reload();
    
                  }
    
                });
            }
         }
</script>