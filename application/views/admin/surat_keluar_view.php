<div id="page-wrapper">
	<div class="graphs">
		<h3 class="blank1">Surat Keluar</h3>
		<div class="xs tabls">
			<div class="bs-example4" data-example-id="contextual-table">

				<div class="col-lg-12">
					<?php 
					$notif = $this->session->flashdata('notif');
					if($notif != NULL){
						echo '
						<div class="alert alert-info">'.$notif.'</div>
						';
					}
					?>
				</div>
			</div>

			<table class="table">
				<a href="#" class="btn btn-info btn-sm" target="_blank" data-toggle="modal" data-target="#modal_add">Tambah Surat</a>
				<thead>
					<tr>
						<th>No</th>
						<th>Nomor Surat</th>
						<th>Pengirim</th>
						<th>Tanggal Kirim</th>
						<th>Penerima</th>
						<th>Perihal</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 0;
					foreach ($data_surat_keluar as $surat_keluar) {
						echo '
						<tr>'.++$no.'</tr>
						<td>'.$surat_keluar->nomor_surat.'</td>
						<td>'.$surat_keluar->pengirim.'</td>
						<td>'.$surat_keluar->tgl_kirim.'</td>
						<td>'.$surat_keluar->penerima.'</td>
						<td>'.$surat_keluar->perihal.'</td>
						<td>
						<a href="'.base_url('uploads/'.$surat_keluar->file_surat).'" class="btn btn-info btn-sm" target="_blank">Lihat</a>
						<a href="'.base_url('index.php/surat/hapus_surat_masuk/'.$surat_keluar->id_surat).'" class="btn btn-danger btn-sm" >Hapus</a>

						</td>
						';
					}
					?>


				</tbody>
			</table>
		</div>

	</div><!-- /.table-responsive -->
</div>
</div>

<!-- tambah surat -->
<div class="modal fade" id="modal_add" tabindex="-1" role="dialog" aria-labelledby="modal_addLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">

			<form action="<?php echo base_url();?>index.php/surat/tambah_surat_keluar" method="post" enctype="multipart/form-data">
				<div class="modal-header">
					<h4 class="modal-title" id="modal_addLabel">
						Tambah Surat Keluar
					</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>Nomor Surat</label>
						<input type="text" name="no_surat" class="form-control">
					</div>
					<div class="form-group">
						<label>Tanggal Kirim</label>
						<input type="date" name="tgl_kirim" class="form-control">
					</div>
					<div class="form-group">
						<label>Pengirim</label>
						<input type="text" name="pengirim" class="form-control">
					</div>
					<div class="form-group">
						<label>Penerima</label>
						<input type="text" name="penerima" class="form-control">
					</div>
					<div class="form-group">
						<label>Perihal</label>
						<input type="text" name="perihal" class="form-control">
					</div>
					<div class="form-group">
						<label>Unggah Surat (*pdf)</label>
						<input type="file" name="file_surat" class="form-control">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
					<input type="submit" name="submit" class="btn btn-primary" value="Submit">
				</div>
			</form>
		</div>
	</div>
</div>