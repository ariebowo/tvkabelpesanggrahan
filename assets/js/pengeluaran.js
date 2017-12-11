
$(document).ready(function(){
	
	$('#date-range').daterangepicker();
	
	var DtSource = $('#tbList').attr('data-source');
	//var filter = '?rt='+ $('#rt option:selected').val();
	//	filter += '&rw='+ $('#rw option:selected').val();
	//	filter += '&pelanggan='+ $('#pelanggan option:selected').val();
	//	filter += '&tahun='+ $('#tahun option:selected').val();
	//datatables
    InitDataTable( DtSource );
	
	$(document).on('change', '#date-range', function(){
		
		var DtSource = $('#tbList').attr('data-source');
		//var filter = '?dateRange='+ $('#date-range').val();
		
		InitDataTable( DtSource );
		
	});
	
	
	$(document).on('submit', '#fr_filter', function() {
		
		/*var filter = '?rt=' + $('#rt option:selected').val();
			filter += '&rw=' + $('#rw option:selected').val();
			filter += '&pelanggan=' + $('#pelanggan option:selected').val();
			filter += '&tahun='+ $('#tahun option:selected').val();
		)*/
		InitDataTable( DtSource );
		
		return false;
	});	
	
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
			"type": "POST",
			"data" : {'dateRange' : $("#date-range").val() },
		},
		"columns": [
						{"data": "id"},
						{"data": "tanggal"},
						{"data": "keterangan"},
						{"data": "total"},
						{"data": "action"},
						
					],
		"drawCallback": function( oSettings, json ) {
			
			var dt = oSettings.jqXHR.responseJSON;
			
			$(".datepicker").datepicker("destroy");
			$('.datepicker').datepicker({
			  autoclose: true
			});
		}
		
 
	});
}