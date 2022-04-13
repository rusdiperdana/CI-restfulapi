
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa_model extends CI_Model {

  
    public function getMahasiswa($id = null)
    {
        if($id === null)
        {
              //get all
               //resutl array array assosiatif
                return $this->db->get('mahasiswa')->result_array();
        }else{
            //get id brati pake where
            return $this->db->get_where('mahasiswa',['id'=>$id])->result_array();
        }
    }

    // public function getById($id)
    // {
    //     return $this->db->get_where('mahasiswa',['id'=>$id])->result_array();
    // }

    public function deleteMahasiswa($id)
    {
        $this->db->delete('mahasiswa',['id' => $id]);
        return $this->db->affected_rows();
    }

    public function createMahasiswa($data)
    {
        //dh berurutan sesuai field table
        $this->db->insert('mahasiswa',$data);
        //kembaliin lagi
        return $this->db->affected_rows();
    }

    public function updateMahasiswa($data,$id)
    {
        $this->db->update('mahasiswa' ,$data, ['id'=> $id]);
        return $this->db->affected_rows();
    }

    //klo crud biasa
    // public function tambahDataMahasiswa()
    // {
    //     $data = [
    //         "nama" => $this->input->post('nama', true),
    //         "nrp" => $this->input->post('nrp', true),
    //         "email" => $this->input->post('email', true),
    //         "jurusan" => $this->input->post('jurusan', true)
    //     ];

    //     $this->db->insert('mahasiswa', $data);
    // }

    // public function hapusDataMahasiswa($id)
    // {
    //     // $this->db->where('id', $id);
    //     $this->db->delete('mahasiswa', ['id' => $id]);
    // }

    // public function getMahasiswaById($id)
    // {
    //     return $this->db->get_where('mahasiswa', ['id' => $id])->row_array();
    // }

    // public function ubahDataMahasiswa()
    // {
    //     $data = [
    //         "nama" => $this->input->post('nama', true),
    //         "nrp" => $this->input->post('nrp', true),
    //         "email" => $this->input->post('email', true),
    //         "jurusan" => $this->input->post('jurusan', true)
    //     ];

    //     $this->db->where('id', $this->input->post('id'));
    //     $this->db->update('mahasiswa', $data);
    // }

    // public function cariDataMahasiswa()
    // {
    //     $keyword = $this->input->post('keyword', true);
    //     $this->db->like('nama', $keyword);
    //     $this->db->or_like('jurusan', $keyword);
    //     $this->db->or_like('nrp', $keyword);
    //     $this->db->or_like('email', $keyword);
    //     return $this->db->get('mahasiswa')->result_array();
    // }

    //ini controllernya yg atas modelnya
    // public function __construct()
    // {
    //     parent::__construct();
    //     $this->load->model('Mahasiswa_model');
    //     $this->load->library('form_validation');
    // }

    // public function index()
    // {
    //     $data['judul'] = 'Daftar Mahasiswa';
    //     $data['mahasiswa'] = $this->Mahasiswa_model->getAllMahasiswa();
    //     if( $this->input->post('keyword') ) {
    //         $data['mahasiswa'] = $this->Mahasiswa_model->cariDataMahasiswa();
    //     }
    //     $this->load->view('templates/header', $data);
    //     $this->load->view('mahasiswa/index', $data);
    //     $this->load->view('templates/footer');
    // }

    // public function tambah()
    // {
    //     $data['judul'] = 'Form Tambah Data Mahasiswa';

    //     $this->form_validation->set_rules('nama', 'Nama', 'required');
    //     $this->form_validation->set_rules('nrp', 'NRP', 'required|numeric');
    //     $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

    //     if ($this->form_validation->run() == false) {
    //         $this->load->view('templates/header', $data);
    //         $this->load->view('mahasiswa/tambah');
    //         $this->load->view('templates/footer');
    //     } else {
    //         $this->Mahasiswa_model->tambahDataMahasiswa();
    //         $this->session->set_flashdata('flash', 'Ditambahkan');
    //         redirect('mahasiswa');
    //     }
    // }

    // public function hapus($id)
    // {
    //     $this->Mahasiswa_model->hapusDataMahasiswa($id);
    //     $this->session->set_flashdata('flash', 'Dihapus');
    //     redirect('mahasiswa');
    // }

    // public function detail($id)
    // {
    //     $data['judul'] = 'Detail Data Mahasiswa';
    //     $data['mahasiswa'] = $this->Mahasiswa_model->getMahasiswaById($id);
    //     $this->load->view('templates/header', $data);
    //     $this->load->view('mahasiswa/detail', $data);
    //     $this->load->view('templates/footer');
    // }

    // public function ubah($id)
    // {
    //     $data['judul'] = 'Form Ubah Data Mahasiswa';
    //     $data['mahasiswa'] = $this->Mahasiswa_model->getMahasiswaById($id);
    //     $data['jurusan'] = ['Teknik Informatika', 'Teknik Mesin', 'Teknik Planologi', 'Teknik Pangan', 'Teknik Lingkungan'];

    //     $this->form_validation->set_rules('nama', 'Nama', 'required');
    //     $this->form_validation->set_rules('nrp', 'NRP', 'required|numeric');
    //     $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

    //     if ($this->form_validation->run() == false) {
    //         $this->load->view('templates/header', $data);
    //         $this->load->view('mahasiswa/ubah', $data);
    //         $this->load->view('templates/footer');
    //     } else {
    //         $this->Mahasiswa_model->ubahDataMahasiswa();
    //         $this->session->set_flashdata('flash', 'Diubah');
    //         redirect('mahasiswa');
    //     }
    // }
}

/* End of file Mahasiswa_model.php */
