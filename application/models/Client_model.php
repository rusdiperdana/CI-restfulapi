<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use GuzzleHttp\Client;

class Client_model extends CI_Model {


    private $_client;
    public function __construct()
    {
        parent::__construct();

        $this->_client = new Client([
            'base_uri' => 'http://localhost/ci_rest_server/',
            'auth' =>  ['didi', '1234'],
        ]);
        
    }
    
    public function getAllMahasiswa()
    {
       
        $response = $this->_client->request('GET','mahasiswa',
        [
            'query' => [
                'X-API-KEY' => 'rahasia'
            ]
        ]);
        $result = json_decode($response->getBody()->getContents(), true);

        return $result['data'];
    }

    public function getMahasiswaBayId($id)
    {
        $response = $this->_client->request('GET','mahasiswa',
        [
            'query' => [
                'X-API-KEY' => 'rahasia',
                'id' => $id
            ]
        ]);

        $result = json_decode($response->getBody()->getContents(), true);

        return $result['data'][0];
    }

    public function hapusDataMahasiswa($id)
    {
        $response = $this->_client->request('DELETE','mahasiswa',
        [
            'form_params' => [
                'id' => $id,
                'X-API-KEY' => 'rahasia'
            ]
        ]);

        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function tambahDataMahasiswa()
    {
        $data = [
            "nama" => $this->input->post('nama', true),
            "nrp" => $this->input->post('nrp', true),
            "email" => $this->input->post('email', true),
            "jurusan" => $this->input->post('jurusan', true),
            'X-API-KEY' => 'rahasia'
        ];

        $response = $this->_client->request('POST','mahasiswa',
        [
            'form_params' => $data
        ]);

        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function ubahDataMahasiswa()
    {
        $data = [
            "nama" => $this->input->post('nama', true),
            "nrp" => $this->input->post('nrp', true),
            "email" => $this->input->post('email', true),
            "jurusan" => $this->input->post('jurusan', true),
            "id" => $this->input->post('id', true),
            'X-API-KEY' => 'rahasia'
        ];

        $response = $this->_client->request('PUT','mahasiswa',
        [
            'form_params' => $data
        ]);

        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
       
    }

    public function cariDataMahasiswa()
    {
        $keyword = $this->input->post('keyword', true);
        $this->db->like('nama', $keyword);
        $this->db->or_like('jurusan', $keyword);
        $this->db->or_like('nrp', $keyword);
        $this->db->or_like('email', $keyword);
        return $this->db->get('mahasiswa')->result_array();
    }

}

/* End of file ModelName.php */
