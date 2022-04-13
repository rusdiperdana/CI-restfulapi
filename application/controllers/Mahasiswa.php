<?php

defined('BASEPATH') OR exit('No direct script access allowed');

    require(APPPATH . 'libraries/RestController.php');

    require APPPATH . 'libraries/Format.php';
    
    use chriskacerguis\RestServer\RestController;

    class Mahasiswa extends RestController {
//klo restfull tu endpoint ttp sama yg beda tipe datanya aja get post delete dll urlnya ttp sama
        function __construct() {

            parent::__construct();
                $this->load->model('Mahasiswa_model','mahasiswa');
                //per key jd 1 key konek ke metod yg mana dalam 1 jam 
                $this->methods['index_get']['limit'] = 1000;
                
            }

        public function index_get(){
              //skrng bisa kirim param key dan value d postmen
              $id = $this->get('id');
              if ($id === null)
              {
                   //nampilin smua data mahasiswa klo get
                    $mahasiswa = $this->mahasiswa->getMahasiswa();
              }
              else{
                $mahasiswa = $this->mahasiswa->getMahasiswa($id);
              }

            if($mahasiswa)
            {
                $this->response([
                    //status true karna nampilin smua mahasiswa
                       'status' => true,
                       'data' => $mahasiswa
                       //htttp ok kembalian status code 200
                        ], RESTController::HTTP_OK);
            }else{
                $this->response([
                    //status true karna nampilin smua mahasiswa
                       'status' => false,
                       'message' => 'id not found'
                       //htttp ok kembalian status code 200
                        ], RESTController::HTTP_NOT_FOUND);
            }
        }

        //delete kirimnya d body di xxxx
        public function index_delete()
        {
            //ambil idnya dlu
            $id = $this->delete('id');
            if($id === null)
            {
                $this->response([
                       'status' => false,
                       'message' => 'no provide an id!'
                        ], RESTController::HTTP_BAD_REQUEST);
            }else{
                //dptin idnya dr atas itu
                // > 0 tu brati ada datanya
                if($this->mahasiswa->deleteMahasiswa($id) > 0)
                {
                    //ok
                    $this->response([
                           'status' => true,
                           'id' => $id,
                           'message' => 'deleted.'
                            ], RESTController::HTTP_OK);
                }else{
                    //id not found
                    $this->response([
                        'status' => false,
                        'message' => 'gada id cuy'
                         ], RESTController::HTTP_BAD_REQUEST);
                }
            }
        }

        public function index_post()
        {
            //array get post klo mau insert
            $data = [
                'nrp' => $this->post('nrp'),
                'nama' => $this->post('nama'),
                'email' => $this->post('email'),
                'jurusan' => $this->post('jurusan'),
            ];

            if($this->mahasiswa->createMahasiswa($data) > 0)
            {
                $this->response([
                    'status' => true,
                    'message' => 'new mahasiswa has benn created.'
                     ], RESTController::HTTP_CREATED);
            }else
            {
                //gagal 
                $this->response([
                    'status' => false,
                    'message' => 'failed add data.'
                     ], RESTController::HTTP_BAD_REQUEST);
            }
        }
      
        //edit
        public function index_put()
        {
            $id = $this->put('id');
            $data = [
                'nrp' => $this->put('nrp'),
                'nama' => $this->put('nama'),
                'email' => $this->put('email'),
                'jurusan' => $this->put('jurusan'),
            ];

            if($this->mahasiswa->updateMahasiswa($data,$id) > 0)
            {
                $this->response([
                    'status' => true,
                    'message' => 'data mahasiswa has benn updated.'
                     ],  RESTController::HTTP_OK);
            }else
            {
                //gagal 
                $this->response([
                    'status' => false,
                    'message' => 'failed update data!'
                     ], RESTController::HTTP_OK);
            }
        }
    }
/** End of file Controllername.php **/