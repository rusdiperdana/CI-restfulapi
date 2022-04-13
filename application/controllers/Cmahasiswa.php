<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cmahasiswa extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Client_model','client');
        $this->load->library('form_validation');
    }
    
    public function index()
    {

        $data['judul'] = 'Daftar Mahasiswa';
        $data['mahasiswa'] = $this->client->getAllMahasiswa();
        if($this->input->post('keyword'))
        {
            $data['mahasiswa'] = $this->client->cariDataMahasiswa();
        }
        $this->load->view('templates/header', $data);
        $this->load->view('mahasiswa/index', $data);
        $this->load->view('templates/footer');
    }

    public function detail($id)
    {
        $data['judul'] = 'Detail Data Mahasiswa';
        $data['mahasiswa'] = $this->client-> getMahasiswaBayId($id);
        $this->load->view('templates/header', $data);
        $this->load->view('mahasiswa/detail', $data);
        $this->load->view('templates/footer');
    }

    public function hapus($id)
    {
        $this->client->hapusDataMahasiswa($id);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('Cmahasiswa');
    }

    public function tambah()
    {
        $data['judul'] = 'Form Tambah Data Mahasiswa';

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('nrp', 'NRP', 'required|numeric');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('mahasiswa/tambah');
            $this->load->view('templates/footer');
        } else {
            $this->client->tambahDataMahasiswa();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('Cmahasiswa');
        }
    }

    public function ubah($id)
    {
        $data['judul'] = 'Form Ubah Data Mahasiswa';
        $data['mahasiswa'] = $this->client->getMahasiswaBayId($id);
        $data['jurusan'] = ['Teknik Informatika', 'Teknik Mesin', 'Teknik Planologi', 'Teknik Pangan', 'Teknik Lingkungan'];

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('nrp', 'NRP', 'required|numeric');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('mahasiswa/ubah', $data);
            $this->load->view('templates/footer');
        } else {
            $this->client->ubahDataMahasiswa();
            $this->session->set_flashdata('flash', 'Diubah');
            redirect('Cmahasiswa');
        }
    }

}

/* End of file Controllername.php */
