    let baseurl = 'https://maintenance.karamportals.com/';
    //let baseurl = 'http://localhost:8000/';

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
        if(statusVal == 'Feedback Awaiting'){
            console.log(333);
            $('#tdod').hide(); 
            $('#td_date').removeAttr('required');
            $('#handoverDt').show(); 
            $("#handover_date").attr("required",true); 
            console.log(123);
        }else if(statusVal == 'Closed'){
            console.log(222);
            $('.red').show();
            $('#rating-row').show(); 
            $('#feedback-row').show(); 
            //$("#feedback_text").attr("required" ,true);
            $('#closerDt').show();      
            $("#closer_date").attr("required" ,true);      
            $('#comment-row').hide();
            $('#editor').removeAttr('required'); 
            $('#tdod').hide(); 
            $('#td_date').removeAttr('required');
            $('#handoverDt').hide(); 
            $('#handover_date').removeAttr('required'); 
        }else if(statusVal == 'Comment'){
            console.log(111);
            $('#comment-row').show(); 
            // $("#editor").attr("required" ,true);
            $('#rating-row').hide(); 
            $('#feedback-row').hide(); 
            $('#closerDt').hide();
            $('#closer_date').removeAttr('required');
            $('#tdod').hide(); 
            $('#td_date').removeAttr('required');
            $('#handoverDt').hide(); 
            $('#handover_date').removeAttr('required'); 

        }else if(statusVal == 'WIP'){
            console.log(111);
            $('#comment-row').show(); 
            // $("#editor").attr("required" ,true);
            $('#rating-row').hide(); 
            $('#feedback-row').hide(); 
            $('#closerDt').hide();
            $('#closer_date').removeAttr('required');
            $('#tdod').show(); 
            $('#td_date').removeAttr('required');
            $('#handoverDt').hide(); 
            $('#handover_date').removeAttr('required'); 

        }
        else if(statusVal == 'On Hold'){
            console.log(111);
            $('#comment-row').show(); 
            // $("#editor").attr("required" ,true);
            $('#rating-row').hide(); 
            $('#feedback-row').hide(); 
            $('#closerDt').hide();
            $('#closer_date').removeAttr('required');
            $('#tdod').show(); 
            $('#td_date').removeAttr('required');
            $('#handoverDt').hide(); 
            $('#handover_date').removeAttr('required'); 

        }
        else if(statusVal == 'Information Awaiting'){
            console.log(111);
            $('#comment-row').show(); 
            // $("#editor").attr("required" ,true);
            $('#rating-row').hide(); 
            $('#feedback-row').hide(); 
            $('#closerDt').hide();
            $('#closer_date').removeAttr('required');
            $('#tdod').show(); 
            $('#td_date').removeAttr('required');
            $('#handoverDt').hide(); 
            $('#handover_date').removeAttr('required'); 

        }
        // else if(statusVal != 'Comment'){
        //     // $('#comment-row').show(); 
        //     // $("#editor").attr("required" ,true);
        //     $('#rating-row').hide(); 
        //     $('#feedback-row').hide(); 
        //     $('#closerDt').hide();
        //     $('#closer_date').removeAttr('required');
        //     $('#tdod').show();
        //     $("#td_date").attr("required",true); 
        //     $('#handoverDt').hide(); 
        //     $('#handover_date').removeAttr('required');
        // }
        else if(statusVal == 'Feedback Awaiting'){
            $('#handoverDt').show(); 
            $("#handover_date").attr("required" ,true);
            $('#tdod').hide(); 
            $('#td_date').removeAttr('required');
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
     /* daterange functionlity */

    $(function() {
        $( "#td_date" ).datepicker({ startDate: new Date()});
        $( "#handover_date" ).datepicker({ startDate: new Date()});
        $( "#closer_date" ).datepicker({ startDate: new Date()});
    });

   /* ck editor js functionlity */

   var allEditors = document.querySelector('#feedback_text');

        ClassicEditor.create(allEditors);
        $("#ckeditorForm").submit(function(e) {

            var content = $('#feedback_text').val();
            html = $(content).text();
            if ($.trim(html) == '') {
                alert("Please enter message");
                e.preventDefault();
            } else {
                alert("Success");
            }          
        });

        