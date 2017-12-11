
$(document).ready(function(){
	
	var DtSource = $('#tbList').attr('data-source');
	var filter = '?rt='+ $('#rt option:selected').val();
		filter += '&rw='+ $('#rw option:selected').val();
		filter += '&pelanggan='+ $('#pelanggan option:selected').val();
		filter += '&tahun='+ $('#tahun option:selected').val();
	//datatables
    InitDataTable( DtSource + filter );
	
	$(document).on('submit', '#fr_filter', function() {
		
		var filter = '?rt=' + $('#rt option:selected').val();
			filter += '&rw=' + $('#rw option:selected').val();
			filter += '&pelanggan=' + $('#pelanggan option:selected').val();
			filter += '&tahun='+ $('#tahun option:selected').val();
		
		InitDataTable( DtSource + filter );
		
		return false;
	});	
		
	$(document).on('click', '.btn-direct-print', function(){
		
		var urL = $(this).attr('href');
		$.ajax({
				type:'GET',
				url:urL,  
				beforeSend: function( xhr ) {
				},
				success:function(rawData){
					alert('Success Printing');
				}
			}).done(function( data ) {
			});
		
		return false;
	});
	
	$(document).on('click', '#btn-cetak-bayar', function(){
		
		
		var urL = $(this).attr('data-url');
			urL += $('#pelanggan_id').val()+'?tahun='+$('#tahun_cetak option:selected').val();
		
		window.open(urL);  
		
	});
	
	$('#tbHarga').DataTable({
		"paging": true,
		"lengthChange": false,
		"searching": false,
		"ordering": true,
		"info": true,
		"autoWidth": false,
		"aaSorting" : [[0, 'desc']],
		"columns": [
			{ "orderable": true },
			{ "orderable": false },
			{ "orderable": false },
			{ "orderable": false },
			{ "orderable": false },
		  ],
    });
	
	$(document).on('submit', '#filter_bayar', function(){
		
		var urL = $(this).attr('action');
		$.ajax({
			type:'POST',
			url:urL,  
			data: $(this).serialize(),
			beforeSend: function( xhr ) {
			},
			success:function(rawData){
				
				//$('#tbHasil').DataTable().destroy();
				$('#tbHasil').empty();
				$('#tbHasil').replaceWith(rawData.view);
				
				$('#tbHasil').DataTable({
					"bDestroy": true,
					"processing": true,
					"lengthChange": false,
					"bPaginate":false,
					"searching" :false,
					"bInfo": false,
					"responsive" : true,
				});
				
			}
		}).done(function( data ) {
			$('body').removeClass('modal-open');
			$('.modal-backdrop').remove();
			
		});
		
		return false;
		
	});
	
	$(document).on('submit', '.modalBayar', function(){
		
		var urL = $(this).attr('action');
		$.ajax({
			type:'POST',
			url:urL,  
			data: $(this).serialize(),
			beforeSend: function( xhr ) {
			},
			success:function(rawData){
				
				$('.modal-detail').modal('hide');
			
			}
		}).done(function( data ) {
			$('#filter_bayar').submit();
		});
		
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
			"type": "POST"
		},
		"columns": [
						{"data": "pelanggan_nama"},
						{"data": "pelanggan_rt_rw"},
						//{"data": "pelanggan_hutang"},
						{"data": "pelanggan_tvkabel_januari"},
						{"data": "pelanggan_sampah_januari"},
						{"data": "pelanggan_tvkabel_februari"},
						{"data": "pelanggan_sampah_februari"},
						{"data": "pelanggan_tvkabel_maret"},
						{"data": "pelanggan_sampah_maret"},
						{"data": "pelanggan_tvkabel_april"},
						{"data": "pelanggan_sampah_april"},
						{"data": "pelanggan_tvkabel_mei"},
						{"data": "pelanggan_sampah_mei"},
						{"data": "pelanggan_tvkabel_juni"},
						{"data": "pelanggan_sampah_juni"},
						{"data": "pelanggan_tvkabel_juli"},
						{"data": "pelanggan_sampah_juli"},
						{"data": "pelanggan_tvkabel_agustus"},
						{"data": "pelanggan_sampah_agustus"},
						{"data": "pelanggan_tvkabel_september"},
						{"data": "pelanggan_sampah_september"},
						{"data": "pelanggan_tvkabel_oktober"},
						{"data": "pelanggan_sampah_oktober"},
						{"data": "pelanggan_tvkabel_november"},
						{"data": "pelanggan_sampah_november"},
						{"data": "pelanggan_tvkabel_desember"},
						{"data": "pelanggan_sampah_desember"},
						
					],
		"drawCallback": function( oSettings, json ) {
			
			var dt = oSettings.jqXHR.responseJSON;
			var dtBayar = dt.pembayaran;
			
			$('#tot-tvkabel-januari').text(dtBayar.iuran_tvkabel.januari);
			$('#tot-sampah-januari').text(dtBayar.iuran_sampah.januari);
			$('#tot-tvkabel-februari').text(dtBayar.iuran_tvkabel.februari);
			$('#tot-sampah-februari').text(dtBayar.iuran_sampah.februari);
			$('#tot-tvkabel-maret').text(dtBayar.iuran_tvkabel.maret);
			$('#tot-sampah-maret').text(dtBayar.iuran_sampah.maret);
			$('#tot-tvkabel-april').text(dtBayar.iuran_tvkabel.april);
			$('#tot-sampah-april').text(dtBayar.iuran_sampah.april);
			$('#tot-tvkabel-mei').text(dtBayar.iuran_tvkabel.mei);
			$('#tot-sampah-mei').text(dtBayar.iuran_sampah.mei);
			$('#tot-tvkabel-juni').text(dtBayar.iuran_tvkabel.juni);
			$('#tot-sampah-juni').text(dtBayar.iuran_sampah.juni);
			$('#tot-tvkabel-juni').text(dtBayar.iuran_tvkabel.juni);
			$('#tot-sampah-juni').text(dtBayar.iuran_sampah.juni);
			$('#tot-tvkabel-juli').text(dtBayar.iuran_tvkabel.juli);
			$('#tot-sampah-juli').text(dtBayar.iuran_sampah.juli);
			$('#tot-tvkabel-agustus').text(dtBayar.iuran_tvkabel.agustus);
			$('#tot-sampah-agustus').text(dtBayar.iuran_sampah.agustus);
			$('#tot-tvkabel-september').text(dtBayar.iuran_tvkabel.september);
			$('#tot-sampah-september').text(dtBayar.iuran_sampah.september);
			$('#tot-tvkabel-oktober').text(dtBayar.iuran_tvkabel.oktober);
			$('#tot-sampah-oktober').text(dtBayar.iuran_sampah.oktober);
			$('#tot-tvkabel-november').text(dtBayar.iuran_tvkabel.november);
			$('#tot-sampah-november').text(dtBayar.iuran_sampah.november);
			$('#tot-tvkabel-desember').text(dtBayar.iuran_tvkabel.desember);
			$('#tot-sampah-desember').text(dtBayar.iuran_sampah.desember);
			
			
		}
 
	});
}