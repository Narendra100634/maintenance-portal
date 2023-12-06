<footer class="main-footer">
    <div class="pull-right hidden-xs"><b>Version</b> 1.2.0</div>
    <span>© Copyrights KARAM Safety Pvt. Ltd. 2023. All rights reserved.</span>
</footer>
</div>
    <!-- jQuery 2.1.4 -->
    <script src="{{asset('/js/jQuery-2.1.4.min.js')}}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('/js/bootstrap.min.js')}}"></script>
    <!-- DataTables -->
    <script src="{{asset('/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/js/dataTables.bootstrap.min.js')}}"></script>
    <!-- SlimScroll -->
    <script src="{{asset('/js/jquery.slimscroll.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('/js/fastclick.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('/js/app.min.js')}}"></script>
    
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <!-- page script -->
    <script>
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
    </script>
</body>
</html>
<script>
   
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

                   // $("#reporting_manager_email").val(resp[0].reporting_to);
                   // $("#is_rm").val(resp[0].is_rm);
                   
                   
                   // if (resp.success) {
                   //     swal.fire("Done!", resp.message, "success");
                   //     location.reload();
                   // } else {
                   //     swal.fire("Error!", 'Sumething went wrong.', "error");
                   // }
               }
               ,
               error: function (resp) {
                   // swal.fire("Error!", 'Sumething went wrong.', "error");
                   $("#email").css("border-color", "red");
               }
           });

       } else {
           // $('.msg').hide();
           // $('.error').show();
           $("#email").css("border-color", "red");
           // console.log(email);
       }

   });

   
  $(function() {
    $('.toggle-class').change(function() {
        var status = $(this).prop('checked') == true ? 1 : 0; 
        var user_id = $(this).data('id'); 
         
        $.ajax({
            type: "GET",
            dataType: "json",
            url: urls+'resolver/changeStatus',
            data: {'status': status, 'id': user_id},
            success: function(data){
              console.log(data)
            }
        });
    })
  })

</script>