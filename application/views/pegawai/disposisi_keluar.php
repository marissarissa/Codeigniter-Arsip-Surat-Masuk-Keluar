<div id="page-wrapper">
	<div class="graphs">
		<h3 class="blank1">Disposisi Keluar Surat</h3>
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
				<a href="#" class="btn btn-info btn-sm" target="_blank" data-toggle="modal" data-target="#modal_add">Tambah Disposisi Keluar</a>
				<thead>
					<tr>
						<th>No</th>
						<th>Tujuan Unit</th>
						<th>Tujuan Pegawai</th>
						<th>Tanggal Disposisi</th>
						<th>Keterangan</th>
						<th></th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 0;
					foreach ($data_disposisi as $disposisi) {
						echo '
						<tr>
						<td>'.++$no.'</td>
						<td>'.$disposisi->nama_jabatan.'</td>
						<td>'.$disposisi->nama.'</td>
						<td>'.$disposisi->tgl_disposisi.'</td>
						<td>'.$disposisi->keterangan.'</td>
				
						';
						if($disposisi->id_pegawai_pengirim == $this->session->userdata('id_pegawai')){
							echo '<td><label class="label label-info">Disposisi Keluar</label></td>';

						}
						echo '
						<td>
							<a href="'.base_url('uploads/'.$disposisi->file_surat).'" class="btn btn-info btn-sm btn-block" target="_blank"> Lihat </a>
							<a href="'.base_url('index.php/surat/hapus_disposisi_keluar/'.$disposisi->id_disposisi.'/'.$disposisi->id_surat).'" class="btn btn-primary btn-sm btn-block">Hapus</a>
							</td>
						</tr>
							';
						}
					?>


				</tbody>
			</table>
		</div>

	</div><!-- /.table-responsive -->
</div>
</div>

<div class="modal fade" id="modal_add" tabindex="-1" role="dialog" aria-labelledby="modal_addLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">

			<form action="<?php echo base_url('index.php/surat/tambah_disposisi/'.$this->uri->segment(3)) ?>" method="post">
				<div class="modal-header">
					<h4 class="modal-title" id="modal_addLabel">
						Tambah Disposisi Surat
					</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>Tujuan Unit</label>
						<select class="form-control" name="tujuan_unit" onchange="get_pegawai_by_jabatan(this.value)">
							<option value=""> -- Pilih Tujuan Unit -- </option>
							<?php
								foreach ($drop_down_jabatan as $jabatan) {
									if($jabatan->id_jabatan != $this->session->userdata('id_jabatan') && $jabatan->id_jabatan > $this->session->userdata('id_jabatan')){
										echo '
											<option value="'.$jabatan->id_jabatan.'">'.$jabatan->nama_jabatan.'</option>
										';
									}
								}
							?>
							
						</select>
					</div>
					<div class="form-group">
						<label>Tujuan Pegawai</label>
						<select class="form-control" name="tujuan_pegawai" id="tujuan_pegawai">
							<option value=""> -- Pilih Nama Pegawai -- </option>
						</select>
					</div>
					<div class="form-group">
						<label>Keterangan</label>
						<textarea class="form-control" name="keterangan" rows="10"></textarea> 
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

<script type="text/javascript">
	function get_pegawai_by_jabatan(id_jabatan)
	{
		$('#tujuan_pegawai').empty();

		$.getJSON('<?php echo base_url(); ?>index.php/surat/get_pegawai_by_jabatan/'+id_jabatan, function(data){
			$.each(data, function(index,value){
				$('#tujuan_pegawai').append('<option value="'+value.id_pegawai+'">'+value.nama+'</option>');
			})
		});
	}
</script> 