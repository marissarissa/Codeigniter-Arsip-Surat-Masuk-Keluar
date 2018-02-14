<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat_model extends CI_Model {
	public function __construct(){
		parent::__construct();
	//Do your magic here
	}
	
	public function get_surat_masuk(){
		return $this->db->get('surat_masuk')
		->result();
	}

	public function get_data_dashboard(){
		$surat_masuk = $this->db->select('count(*) as total_masuk')
								->get('surat_masuk')
								->row();

		$surat_keluar = $this->db->select('count(*) as total_keluar')
								->get('surat_keluar')
								->row();

		return array(
					'surat_masuk' => $surat_masuk->total_masuk,
					'surat_keluar' => $surat_keluar->total_keluar
					);
	}

	public function get_surat_masuk_by_id($id_surat){
		return $this->db->where('id_surat' ,$id_surat)
		->get('surat_masuk')
		->row();
	}


	public function tambah_surat_masuk($file_surat){
		$data = array(
			'nomor_surat' => $this->input->post('no_surat'),
			'tgl_kirim' => $this->input->post('tgl_kirim'),
			'tgl_terima' => $this->input->post('tgl_terima'),
			'pengirim' => $this->input->post('pengirim'),
			'penerima' => $this->input->post('penerima'),
			'perihal' => $this->input->post('perihal'),
			'file_surat' => $file_surat['file_name']
		);

		$this->db->insert('surat_masuk', $data);
		if($this->db->affected_rows() > 0){
			return TRUE;
		} else {
			return FALSE;
		}
	}

	

	public function ubah_surat_masuk(){
		$data = array(
			'nomor_surat' => $this->input->post('edit_no_surat'),
			'tgl_kirim' => $this->input->post('edit_tgl_kirim'),
			'tgl_terima' => $this->input->post('edit_tgl_terima'),
			'pengirim' => $this->input->post('edit_pengirim'),
			'penerima' => $this->input->post('edit_penerima'),
			'perihal' => $this->input->post('edit_perihal'),

		);
		$this->db->where('id_surat', $this->input->post('edit_id_surat'))
		->update('surat_masuk', $data);

		if($this->db->affected_rows() > 0){
			return TRUE;
		} else{
			return FALSE;
		}
	}

	public function ubah_file_surat_masuk($file_surat){
		$data = array(
			'file_surat' => $file_surat['file_name']
		);

		$this->db->where('id_surat', $this->input->post('edit_file_surat'))
		->update('surat_masuk', $data);

		if($this->db->affected_rows() < 0){
			return TRUE;
		} else{
			return FALSE;
		}
	}

	public function hapus_surat_masuk($id_surat){
		$this->db->where('id_surat', $id_surat)
		->delete('surat_masuk');

		if($this->db->affected_rows() > 0 ){
			return TRUE;
		} else{
			return FALSE;
		}
	}

	// surat keluar
	public function get_surat_keluar(){
		return $this->db->get('surat_keluar')
		->result();
	}

	public function get_surat_keluar_by_id($id_surat){
		return $this->db->where('id_surat' ,$id_surat)
		->get('surat_masuk')
		->row();
	}


	public function tambah_surat_keluar($file_surat){
		$data = array(
			'nomor_surat' => $this->input->post('no_surat'),
			'tgl_kirim' => $this->input->post('tgl_kirim'),
			'pengirim' => $this->input->post('pengirim'),
			'penerima' => $this->input->post('penerima'),
			'perihal' => $this->input->post('perihal'),
			'file_surat' => $file_surat['file_name']
		);

		$this->db->insert('surat_keluar', $data);
		if($this->db->affected_rows() > 0){
			return TRUE;
		} else {
			return FALSE;
		}
	}

	

	public function ubah_surat_keluar(){
		$data = array(
			'nomor_surat' => $this->input->post('edit_no_surat'),
			'tgl_kirim' => $this->input->post('edit_tgl_kirim'),
			'pengirim' => $this->input->post('edit_pengirim'),
			'penerima' => $this->input->post('edit_penerima'),
			'perihal' => $this->input->post('edit_perihal'),

		);
		$this->db->where('id_surat', $this->input->post('edit_id_surat'))
		->update('surat_keluar', $data);

		if($this->db->affected_rows() > 0){
			return TRUE;
		} else{
			return FALSE;
		}
	}

	public function ubah_file_surat_keluar($file_surat){
		$data = array(
			'file_surat' => $file_surat['file_name']
		);

		$this->db->where('id_surat', $this->input->post('edit_file_surat'))
		->update('surat_keluar', $data);

		if($this->db->affected_rows() < 0){
			return TRUE;
		} else{
			return FALSE;
		}
	}

	public function hapus_surat_keluar($id_surat){
		$this->db->where('id_surat', $id_surat)
		->delete('surat_keluar');

		if($this->db->affected_rows() > 0 ){
			return TRUE;
		} else{
			return FALSE;
		}
	}

	// disposisi
	public function get_jabatan(){
		return $this->db->get('jabatan')
		->result();
	}

	public function get_all_disposisi($id_surat){
		return $this->db->join('disposisi', 'disposisi.id_surat = surat_masuk.id_surat')
		->join('jabatan', 'disposisi.id_pegawai_pengirim = jabatan.id_jabatan')
		->join('pegawai', 'pegawai.id_pegawai = disposisi.id_pegawai_penerima')
		->where('disposisi.id_surat' , $id_surat)
		->get('surat_masuk')
		->result();
	}

	public function get_pegawai_by_jabatan($id_jabatan){
		return $this->db->where('id_jabatan', $id_jabatan)
						->get('pegawai')
						->result();

	}

	public function tambah_disposisi($id_surat){
		$data = array(
					'id_surat' => $id_surat,
					'id_pegawai_pengirim' => $this->session->userdata('id_pegawai'),
					'id_pegawai_penerima' => $this->input->post('tujuan_pegawai'),
					'keterangan' => $this->input->post('keterangan')
		);

		$this->db->insert('disposisi', $data);

		if($this->db->affected_rows() > 0){
			return TRUE;
		} else{
			return FALSE;
		}
	}

	public function get_all_disposisi_masuk($id_pegawai_penerima){
		return $this->db->join('disposisi', 'disposisi.id_surat = surat_masuk.id_surat')
						->join('pegawai', 'disposisi.id_pegawai_pengirim = pegawai.id_pegawai')
						->join('jabatan', 'jabatan.id_jabatan = pegawai.id_jabatan')
						->where('id_pegawai_penerima', $id_pegawai_penerima)
						->get('surat_masuk')
						->result();
	}

	public function get_all_disposisi_keluar($id_pegawai_pengirim){
		return $this->db->join('disposisi', 'disposisi.id_surat = surat_masuk.id_surat')
						->join('pegawai', 'disposisi.id_pegawai_penerima = pegawai.id_pegawai')
						->join('jabatan', 'jabatan.id_jabatan = pegawai.id_jabatan')
						->where('disposisi.id_pegawai_pengirim', $this->session->userdata('id_pegawai'))
						->where('disposisi.id_surat', $this->uri->segment(3))
						->get('surat_masuk')
						->result();
	}

	public function hapus_disposisi($id_disposisi){
		$this->db->where('id_disposisi', $id_disposisi)
				->delete('disposisi');
			if($this->db->affected_rows() > 0){
				return TRUE;
			} else{
				return FALSE;
			}
	}


}

/* End of file surat_model.php */
/* Location: ./application/models/surat_model.php */