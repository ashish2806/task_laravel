
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});



$('#movie').submit(function() {
     event.preventDefault();
    $.ajax({ 
        data:  new FormData(this), 
        method : "POST",
        type: $(this).attr('method'),
        url: $(this).attr('action'),
        dataType:"JSON",
        contentType:false,
        cache:false,
        processData:false,
        success: function(response) {
            if(response.status == 'success'){
                get_movie_list();
                $('#uploaded_image').removeClass('d-block');
                $('#uploaded_image').addClass('d-none');
                document.getElementById("movie").reset();
            }

            if(response.from == 'validation'){
                $('#alert').html(response.message.join('<br>'));
            }else{
                $('#alert').html(response.message);
            }
            $('#alert').attr('class','');
            $('#alert').addClass(response.class);
        }
    });
    return false; 
});
function readURL(input) {

    if (input.files && input.files[0]) {
      var reader = new FileReader();
  
      reader.onload = function(e) {
        $('#uploaded_image').attr('src', e.target.result)
           .width(90)
           .height(90)
           .addClass('d-block');
      }
  
      reader.readAsDataURL(input.files[0]);
    }
  }
  
  $("#image").change(function() {
    readURL(this);
  });

function edit(rec){
   
    $.ajax({ 
        type: 'get',
        url: '/edit/'+rec,
      //  data:{"rec":rec},
        dataType:"JSON",
        
        success: function(response) {
            if(response.status == 'success'){
                var  img = response.data.image;
                response.data.image='';
                if(img != null){
                    $('#uploaded_image').attr('src', 'uploads/'+img)
                        .width(90)
                        .height(90)
                        .addClass('d-block');
                    }
                
                populate('#movie', JSON.parse(JSON.stringify(response.data)));
            }
       }

    });
}


function delete_rec(rec){
   
    $.ajax({ 
        type: 'get',
        url: '/delete/'+rec,
      //  data:{"rec":rec},
        dataType:"JSON",
        
        success: function(response) {
            if(response.status == 'success'){
                get_movie_list();
            }
            $('#alert').html(response.message);
            $('#alert').attr('class','');
            $('#alert').addClass(response.class);
            
       }

    });
}

function populate(frm, data) {
    // alert();
     $.each(data, function(key, value){
         // /alert(key);
       $('[name='+key+']', frm).val(value);
     });
   }