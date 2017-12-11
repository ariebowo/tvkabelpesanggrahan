
$(document).ready(function(){
		
	
	var DtSource = $('#tbList').attr('data-source');
	var filter = "?rt="+$('#rt option:selected').val()+'&rw='+$('#rw option:selected').val();
	//datatables
    InitDataTable( DtSource + filter);
	
	$(document).on('submit', '#fr_filter', function(){
		
		filter = "?rt="+$('#rt option:selected').val()+'&rw='+$('#rw option:selected').val();
		InitDataTable( DtSource + filter );
		
		return false;
		
	});
	
	$(document).on('submit', '#fr_Save', function(){
		
		var Id = ['nama', 'alamat'];
		for( i= 0; i < Id.length ; i++)
		{
			if( $('#pelanggan_'+Id[i]).val().trim() == '' )
			{
				$('#pelanggan_'+Id[i]).next().show();
				$('#pelanggan_'+Id[i]).focus();
				return false;
			}else{
				$('#pelanggan_'+Id[i]).next().hide();
			}
		}
		
	});
	
	function InitDataTable( DtSource )
	{
		table = $('#tbList').DataTable({ 
 
			"processing": true, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			"order": [], //Initial no order.
			"autoWidth": false,
			"lengthChange": false,
			"responsive" : true,
			"bDestroy": true,
			// Load data for the table's content from an Ajax source
			"ajax": {
				"url": DtSource,
				"type": "POST"
			},
			"columns": [
							{"data": "pelanggan_id"},
							{"data": "pelanggan_nama"},
							{"data": "pelanggan_alamat"},
							{"data": "pelanggan_rt"},
							{"data": "pelanggan_rw"},
							{"data": "action"},
						],
			
	 
		});
	}

});
