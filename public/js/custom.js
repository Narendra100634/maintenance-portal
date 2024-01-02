let baseurl = 'https://maintenance.karamportals.com/';
// let baseurl = 'http://localhost:8000/';

/* bootstrap datatable */
$(function () {
    $("#example1").DataTable({
        scrollX: true,
    });
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "scrollX": true,
        "scrollY": 200
    });
});

   /***************get email address************************/
   var urls= baseurl;
   $("#email").blur(function (){
      var email = $(this).val();
      var re = /[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}/igm;
        if (re.test(email)) {          
            $("#email").css("border-color:red");         
            let token = $('meta[name="csrf-token"]').attr('content');
            let _url = urls+'resolver/usersList/'+email;
            $.ajax({
               type: 'GET',
               url: _url,
               data: {_token: token},
                success: function (resp) {
                   console.log(resp);
                    $("#resName").val(resp['employee_name']);
                    $("#resLocation").val(resp['region']);                        
                    $("#resMobile").val(resp['phone']);
                    if(resp['status'] == 200){
                        $('#submit').removeAttr('disabled');
                        $("#check-user").text('');
                    }else{
                        $("#check-user").text('Employee does not exist.');
                        $('#submit').attr('disabled','disabled');
                        $('.invalid-feedback').css("display", "none");
                    }
                }
            });
        } else {
            $("#email").css("border-color", "red");              
        }
    });
   
    /* assign to functionlity other resolver */
    function changeResolver($id){
        var reqId = $id;
        $('#changeresolver-model').modal('toggle');
        var userData =  $('#resolver-name:checked').val();      
        $.ajax({
            type: "GET",
            dataType: "json",
            url: urls+'resolver/assignto',
            data: {'resv_id': userData, 'id': reqId},
            success: function(data){
                window.location.href = baseurl+"dashboard";
                
                
            }
        });
    }

    /* chnage status according input filed swaping  */

    $('#status').on('change', function() {
        var statusVal =  this.value;
        console.log(statusVal);
        if(statusVal == 'Feedback Awaiting'){
            $('#tdod').hide(); 
            $('#handoverDt').show(); 
            console.log(123);
        }else if(statusVal == 'Closed'){
            $('.red').show();
            $('#rating-row').show(); 
            $('#feedback-row').show(); 
            $('#closerDt').show();      
            $("#closer_date").attr("required", "true");      
            $('#comment-row').hide(); 
            $('#tdod').hide(); 
            $('#handoverDt').hide(); 
        }else if(statusVal == 'Comment'){
            $('#comment-row').show(); 
            $("#editor").attr("required", "true");
            $('#rating-row').hide(); 
            $('#feedback-row').hide(); 
            $('#closerDt').hide();
            $('#tdod').hide(); 
            $('#handoverDt').hide(); 

        }else if(statusVal != 'Comment'){
            $('#comment-row').show(); 
            $("#editor").attr("required", "true");
            $('#rating-row').hide(); 
            $('#feedback-row').hide(); 
            $('#closerDt').hide();
            $('#tdod').show(); 
            $('#handoverDt').hide(); 

        }
        else if(statusVal == 'Feedback Awaiting'){
            $('#handoverDt').show(); 
            $('#tdod').hide(); 
            console.log(1234);
        }
    });

    /* star rating input filed */

    
    var $star_rating = $('.star-rating .fa');

    var SetRatingStar = function() {
    return $star_rating.each(function() {
        if (parseInt($star_rating.siblings('input.rating-value').val()) >= parseInt($(this).data('rating'))) {
        return $(this).removeClass('fa-star-o').addClass('fa-star');
        } else {
        return $(this).removeClass('fa-star').addClass('fa-star-o');
        }
    });
    };

    $star_rating.on('click', function() {
        $star_rating.siblings('input.rating-value').val($(this).data('rating'));
        return SetRatingStar();
    });
    SetRatingStar();
    $(document).ready(function() {

    });
     /* check jquery version */
    //console.log( 'You are running jQuery version: ' + $.fn.jquery );

     /* daterange functionlity */

    $(function() {
        $( "#td_date" ).datepicker({ startDate: new Date()});
        $( "#handover_date" ).datepicker({ startDate: new Date()});
        $( "#closer_date" ).datepicker({ startDate: new Date()});
    });

   /* ck editor js functionlity */

    ClassicEditor
    .create( document.querySelector('#editor'),
    {
    })
    .catch( error => {
    });
    ClassicEditor
    .create( document.querySelector('#feedback_text'),
    {
    })
    .catch( error => {
    });


    $(function() {
        $('#date').datepicker({
          dateFormat: 'dd-M-yy',
          minDate: 1
        });
        
        $('.date-icon').on('click', function() {
          $('#date').focus();
        })
      });
      