
$(document).ready(function(){
		
	
	var DtSource = $('#tbList').attr('data-source');
	//datatables
    InitDataTable( DtSource );
	
	
	$(document).on('submit', '#fr_Harga', function(){
		
		var Id = ['tvkabel', 'iuran_sampah'];
		for( i= 0; i < Id.length ; i++)
		{
			
			if( $('#harga_'+Id[i]).val() == '0' )
			{
				
				$('#harga_'+Id[i]).next().show();
				$('#harga_'+Id[i]).focus();
				return false;
			}else{
				$('#harga_'+Id[i]).next().hide();
			}
		}
		
		
	});
	
	function InitDataTable( DtSource )
	{
		table = $('#tbList').DataTable({ 
 
			"processing": true, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			//"order": [], //Initial no order.
			"aaSorting" : [[0, 'desc']],
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
							{"data": "harga_id"},
							{"data": "harga_tvkabel"},
							{"data": "harga_iuran_sampah"},
							{"data": "harga_tgl_berlaku"},
							{"data": "harga_tgl_berakhir"},
						],
			
	 
		});
	}

});
