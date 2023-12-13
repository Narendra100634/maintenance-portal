/* bootstrap datatable */
$(function () {
    $("#example1").DataTable({
        scrollX: true,
        // scrollY: 200
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
   var urls= 'http://localhost:8000/';
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
                location.reload();
                console.log(data);
            }
        });
    }

    /* chnage status according input filed swaping  */

    $('#status').on('change', function() {
        var statusVal =  this.value;
        if(statusVal == 'Feedback Awaiting'){
            $('#tdod').hide(); 
            $('#handoverDt').show(); 
            console.log(123);
        }else if(statusVal == 'Closed'){
            $('#rating-row').show(); 
            $('#feedback-row').show(); 
            
            $('#comment-row').hide(); 
            $('#tdod').hide(); 
            $('#handoverDt').hide(); 
        }else if(statusVal != 'Feedback Awaiting'){
            // $('#handoverDt').hide(); 
            // $('#tdod').show(); 
            $('#handoverDt').hide(); 
            $('#tdod').show(); 
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
    });
    
    /*sweetalert functionlity */

    $(function() {
        
        $('.toggle-class').change(function() {
            var status = $(this).prop('checked') == true ? 1 : 0; 
            var user_id = $(this).data('id'); 	
        	if(user_id !=""){		
                swal.fire({	
                    title: 'Are you sure you want to update Status?',	
                    icon: 'warning',	
                    showCancelButton: true,	
                    confirmButtonColor: '#343a40',	
                    cancelButtonColor: '#d33',	
                    confirmButtonText: 'Yes, update it!',
                    timer: 30000	
                }).then(function (e) {	
                
                    if (e.value === true) {	
                        let _url = urls+'resolver/changeStatus';	
                        $.ajax({	
                            type: 'GET',
                            url: _url,	
                            data: {'status': status, 'id': user_id},
                            success: function (data) {	                        
                                if (data.success) {	                           
                                    swal.fire("Done!", data.message, "success");	
                                    location.reload();	
                                } else {	
                                    swal.fire("Error!", 'Sumething went wrong.', "error");	
                                }	
                            },	
                            error: function (data) {	
                                swal.fire("Error!", 'Sumething went wrong.', "error");	
                            }	
                        });	
                    } else {	
                        e.dismiss;	
                    }	
                }, function (dismiss) {	
                    return false;	
                })	
            }else{	
                alert('Please fill all the field !');	
            }	
        })
   })

   /* ck editor js functionlity */

    ClassicEditor
    .create( document.querySelector('#editor'),
    {
    })
    .catch( error => {
    });