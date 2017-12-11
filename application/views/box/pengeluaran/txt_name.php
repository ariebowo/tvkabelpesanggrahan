<span><?= date('d-m-Y', strtotime($tanggal)); ?></span>
<!-- Modal Edit -->
<div class="modal fade" id="modalEdit-<?= $id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h4 class="modal-title" id="myModalLabel">+ Update Pengeluaran</h4>
	  </div>
	  <div class="modal-body">
		<form action="<?= base_url('pengeluaran/save')?>" method="POST">
		<div class="modal-body">
		
			<div class="form-group">
				<label>Tanggal:</label><br/>
				
				<input type="text" name="tanggal" class="form-control datepicker" value="<?= date('m/d/Y', strtotime($tanggal)) ?>" readonly />
				<input type="hidden" name="id" value="<?= $id ?>">
			</div>
			
			<div class="form-group">
				<label>Keterangan:</label><br/>
				<input type="text" class="form-control" name="keterangan" value="<?= $keterangan?>" />
				
			</div>
			
			<div class="form-group">
				<label>Nominal:</label><br/>
				<?php 
					$total = str_replace(array("Rp."," ","."), array("","",""), $total);
				?>
				<input type="text" class="form-control tNumb" name="total" value="<?= number_format($total,0,".",",") ?>" />
				
			</div>
			
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>
			<button type="submit" class="btn btn-primary btn-flat" ><i class="fa fa-save"></i> Simpan</button>
		</div>
		</form>
	  </div>
	</div>
  </div>
</div>