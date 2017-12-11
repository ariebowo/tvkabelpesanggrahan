
$(document).ready(function(){
	
	
	$(document).on('submit', '#fr_CrPl', function(e){
		
		if( $('#pelanggan option:selected').val() == '-')
		{
			alert('Pilih salah satu pelanggan');
			
			return false;
		}else{
			
			e.preventDefault();
			e.stopImmediatePropagation();
		
			var urL = $(this).attr('action');
			$.ajax({
					type:'POST',
					data: '&pelanggan='+ $('#pelanggan option:selected').val(),
					url:urL,  
					beforeSend: function( xhr ) {
						
					},
					success:function(rdr){
						
						window.location.href = rdr;
						
					}
				}).done(function( data ) {
					
				});
			
			return false;
	
		}
	});
	
	$(document).on('submit', '#fr_Hitung', function(){
		
		
		if( $('#pelanggan option:selected').val() == '-')
		{
			$('#pelanggan').next().next().show();
			
			return false;
		}else{
			$('#pelanggan').next().next().hide();
	
		}
		if( $('#jml_bayar').val() == '0')
		{
			$('#jml_bayar').next().show();
			
			return false;
		}else{
			$('#jml_bayar').next().hide();
			
		}
		
		var urL = $(this).attr('action');
		$.ajax({
				type:'POST',
				data: $('#fr_Hitung').serialize(),
				url:urL,  
				beforeSend: function( xhr ) {
					//xhr.overrideMimeType( "text/plain; charset=x-user-defined" );
					$("input[type=button]").attr("disabled", true);
					$('#loader').show();
				},
				success:function(rawData){
					
					
					$("#tbHasil tbody tr").remove();
					var list = rawData.content;
					$('#tbHasil').append(list);
					$('#txt-jml-bayar').val(rawData.bayar);
					$('#txt-sisa-bayar').val(rawData.sisa);
					
					$('#btn-simpan').attr('disabled', false);
				}
			}).done(function( data ) {
				$("input[type=button]").attr("disabled", false);
				$('#loader').hide();
			});
		
		return false;
		
	});
	
	$(document).on('submit', '#form_Simpan', function(e){
		
		e.preventDefault();
		e.stopImmediatePropagation();
		
		var urL = $(this).attr('action');
		$.ajax({
			type:'POST',
			data: $('#form_Simpan').serialize(),
			url:urL,  
			beforeSend: function( xhr ) {
				//xhr.overrideMimeType( "text/plain; charset=x-user-defined" );
				$("input[type=button]").attr("disabled", true);
				$('#loader').show();
			},
			success:function(rawData){
				$('#txt-jml-bayar').val('0');
				$('#txt-sisa-bayar').val('0');
				$('#modalNotif').modal('show');
				$("#pelanggan").select2("val", "");
			}
		}).done(function( data ) {
			//$("input[type=button]").attr("disabled", false);
			$('#loader').hide();
			$("#tbHasil tbody tr").remove();
			$('#fr_Hitung')[0].reset();
			$('#btn-simpan').attr('disabled', true);
		});
		
		return false;
		
	});
	
	$(document).on('change', '#pelanggan', function(){
	
		$('#pelanggan-id').val( $('#pelanggan option:selected').val() );
	});
	
	$(document).on('change', '#jml_bayar', function(){
	
		$('#jml-pembayaran').val( $('#jml_bayar').val() );
	});
	
	/*$(document).on('change', '#pelanggan', function(){
		//$('#pelanggan-id').val( $('#pelanggan option:selected').val() );
	}
	
	$(document).on('change', '#jml_bayar', function(){
		//$('#jml-pembayaran').val( $('#jml_bayar').val() );
	}*/
});
