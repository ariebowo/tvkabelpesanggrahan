
  $(function () {
	  
    //Date picker
	$('.datepicker').datepicker({
      autoclose: true
    });
	
	$(".select2").select2();
	
	//Data Table
	$("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
	
	$(document).on('click', '.btn-del', function(){
		var baseUrl = $('#base_url').attr('data-url');
		var Url = $(this).attr('data-url');
		
		$('#myModal').modal('show');
		$('.modal-text').text('Anda Yakin Menghapus Data ini ?');
		$('#btn-Del').attr('href', Url);
		
	});
	
	$('.tNumber').keypress(function(e){
		
		if ( e.which !=8 && e.which !=0 && e.which !=46 && (e.which < 48 || e.which > 57)) {
			return false;
		}
	});
	
	$(document).on('keyup', '.tNumb', function(e){
		
        //if ( e.which!='37' && e.which!='38' && e.which!='39' && e.which!='40' && e.which!='8' )//nav and backspace
        if ( e.which!='37' && e.which!='38' && e.which!='39' && e.which!='40'  )//nav and backspace
        {        
            $(this).val( number_format($(this).val()) );
        }        
    });
	
	
  });
  