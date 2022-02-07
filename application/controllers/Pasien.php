<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasien extends CI_Controller{

    public function __construct()
    {
        parent :: __construct();
        $this->load->library('form_validation');
        if($this->session->userdata('status') != "login"){
            redirect(base_url("Auth"));
        }        
        $this->load->library('form_validation');
        $this->load->model('pasien_crud');
        $this->load->dbutil();
        $this->load->helper(array('form', 'url', 'file', 'date'));
    }

    public function index(){
        $data = array(          
            'title'     => 'Pasien',
            'profile' => $this->pasien_crud->get_data($this->session->userdata("email")),
            );                
        $this->load->view('pasien/pasien_v', $data);        
    }

    public function dokter(){
        $data = array(          
            'title'     => 'Daftar Dokter',         
            'profile' => $this->pasien_crud->get_data($this->session->userdata("email")),
            'list' => $this->pasien_crud->get_dokter(),            
            );        
        $this->load->view('pasien/dokter_v', $data);        
    }
    
    public function profile(){
        $data = array(          
            'title'     => 'Daftar Pasien',         
            'profile' => $this->pasien_crud->get_data($this->session->userdata("email")),              
            );        
        $this->load->view('pasien/profile_v', $data);        
    }
    
    public function riwayat(){        
        $no = $this->uri->segment(3);
        $data = array(          
            'title'     => 'Riwayat Pasien',         
            'profile' => $this->pasien_crud->get_data($this->session->userdata("email")),            
            'list' => $this->pasien_crud->pick_riwayat($no),
            );        
        $this->load->view('pasien/riwayat_v', $data);
               
    }

    public function tambah_riwayat(){
        $no = $this->uri->segment(3);
        $data = array(          
            'title'     => 'Tambah Data Obat',         
            'profile' => $this->pasien_crud->get_data($this->session->userdata("email")),                        
            'get' => $this->pasien_crud->pick_pasien($no),
            'dokter' => $this->pasien_crud->get_dokter(),
            'obat' => $this->pasien_crud->get_obat(),
            'penyakit' => $this->pasien_crud->get_penyakit(),

            );        
        $this->load->view('pasien/Pasien/tambah_riwayat', $data);        
    }

    public function simpan_riwayat(){                       
        $data = array(
            'nama_pasien' => $this->input->post("pasien"),           
            'id_pasien' => $this->input->post("id"),
            'nama_dokter' => $this->input->post("dokter"),            
            'nama_penyakit' => $this->input->post("penyakit"),
            'nama_obat' => $this->input->post("obat"),            
            'jumlah_obat' => $this->input->post("jumlah"),
            'tgl_pengobatan' => $this->input->post("tanggal")           
        );
        $this->pasien_crud->simpan_riwayat($data);
        $this->session->set_flashdata('notif', '<div class=" alert alert-success alert-dismissble"> Success! Data berhasil disimpan di Database. </div>');
        redirect(base_url("pasien/riwayat_pasien".$this->input->post("id")));
    }

    public function update_riwayat(){  
        $id = $this->input->post("id");        
        $data1 = array(            
            '0' => $this->input->post("nama"),
            '1' => $this->input->post("tipe"),
            '2' => $this->input->post("gejala"),
            '3' => $this->input->post("stok"),
        );         
            $data2 = array(            
            '0' => "nama_obat",
            '1' => "tipe_obat",
            '2' => "tingkat_gejala", 
            '3' => "stok",           
        );
        for ($i=0; $i < 4 ; $i++) {
            $a = $data1[$i];
            $b = $data2[$i]; 
            $this->pasien_crud->update_riwayat($a,$b,$id);
        }        
        $this->session->set_flashdata('notif', '<div class=" alert alert-success alert-dismissble"> Success! Data berhasil disimpan di Database. </div>');
        redirect(base_url("pasien/riwayat_pasien"));
    }

    public function hapus_riwayat($no){
        $no['no']= $this->uri->segment(3);                
        $this->pasien_crud->hapus_riwayat($no);               
        redirect('pasien/riwayat_pasien');
    }

    public function obat(){
        $data = array(          
            'title'     => 'Daftar obat',         
            'profile' => $this->pasien_crud->get_data($this->session->userdata("email")),            
            'list' => $this->pasien_crud->get_obat(),
            );        
        $this->load->view('pasien/Obat/obat_v', $data);        
    }
    
    public function tambah_obat(){
        $data = array(          
            'title'     => 'Tambah Data Obat',         
            'profile' => $this->pasien_crud->get_data($this->session->userdata("email")),            
            );        
        $this->load->view('pasien/Obat/tambah_obat', $data);        
    }

    public function edit_obat($no){
        $no = $this->uri->segment(3);
        $data = array(          
            'title'     => 'Ubah Data Obat',         
            'profile' => $this->pasien_crud->get_data($this->session->userdata("email")),
            'get' => $this->pasien_crud->pick_obat($no),          
            );        
        $this->load->view('pasien/Obat/edit_obat', $data);        
    }

    public function simpan_obat(){                       
        $data = array(            
            'nama_obat' => $this->input->post("nama"),            
            'tipe_obat' => $this->input->post("tipe"),
            'tingkat_gejala' => $this->input->post("gejala"),            
            'stok' => $this->input->post("stok"),            
        );
        $this->pasien_crud->simpan_obat($data);
        $this->session->set_flashdata('notif', '<div class=" alert alert-success alert-dismissble"> Success! Data berhasil disimpan di Database. </div>');
        redirect(base_url("pasien/obat"));
    }

    public function update_obat(){  
        $id = $this->input->post("id");        
        $data1 = array(            
            '0' => $this->input->post("nama"),
            '1' => $this->input->post("tipe"),
            '2' => $this->input->post("gejala"),
            '3' => $this->input->post("stok"),
        );         
            $data2 = array(            
            '0' => "nama_obat",
            '1' => "tipe_obat",
            '2' => "tingkat_gejala", 
            '3' => "stok",           
        );
        for ($i=0; $i < 4 ; $i++) {
            $a = $data1[$i];
            $b = $data2[$i]; 
            $this->pasien_crud->update_obat($a,$b,$id);
        }        
        $this->session->set_flashdata('notif', '<div class=" alert alert-success alert-dismissble"> Success! Data berhasil disimpan di Database. </div>');
        redirect(base_url("pasien/obat"));
    }

    public function hapus_obat($id_obat){
        $no['id_obat']= $this->uri->segment(3);                
        $this->pasien_crud->hapus_obat($no);               
        redirect('pasien/obat');
    }

    public function penyakit(){
        $data = array(          
            'title'     => 'Daftar penyakit',         
            'profile' => $this->pasien_crud->get_data($this->session->userdata("email")),
            'list' => $this->pasien_crud->get_penyakit(),
            );        
        $this->load->view('pasien/Penyakit/penyakit_v', $data);        
    } 

    public function tambah_penyakit(){
        $data = array(          
            'title'     => 'Tambah Data Penyakit',         
            'profile' => $this->pasien_crud->get_data($this->session->userdata("email")),            
            );        
        $this->load->view('pasien/Penyakit/tambah_penyakit', $data);        
    }

    public function edit_penyakit($no){
        $no = $this->uri->segment(3);
        $data = array(          
            'title'     => 'Ubah Data Penyakit',         
            'profile' => $this->pasien_crud->get_data($this->session->userdata("email")),
            'get' => $this->pasien_crud->pick_penyakit($no),          
            );        
        $this->load->view('pasien/Penyakit/edit_penyakit', $data);        
    }

    public function simpan_penyakit(){                       
        $data = array(            
            'nama_penyakit' => $this->input->post("nama"),            
            'daerah_penyakit' => $this->input->post("tipe"),
            'gejala' => $this->input->post("gejala"),            
        );
        $this->pasien_crud->simpan_penyakit($data);
        $this->session->set_flashdata('notif', '<div class=" alert alert-success alert-dismissble"> Success! Data berhasil disimpan di Database. </div>');
        redirect(base_url("pasien/penyakit"));
    }

    public function update_penyakit(){  
        $id = $this->input->post("id");        
        $data1 = array(            
            '0' => $this->input->post("nama"),
            '1' => $this->input->post("tipe"),
            '2' => $this->input->post("gejala"),
        );         
            $data2 = array(            
            '0' => "nama_penyakit",
            '1' => "daerah_penyakit",
            '2' => "gejala",            
        );
        for ($i=0; $i < 3 ; $i++) {
            $a = $data1[$i];
            $b = $data2[$i]; 
            $this->pasien_crud->update_penyakit($a,$b,$id);
        }        
        $this->session->set_flashdata('notif', '<div class=" alert alert-success alert-dismissble"> Success! Data berhasil disimpan di Database. </div>');
        redirect(base_url("pasien/penyakit"));
    }

    public function hapus_penyakit($id_penyakit){
        $no['id_penyakit']= $this->uri->segment(3);                
        $this->pasien_crud->hapus_penyakit($no);               
        redirect('pasien/penyakit');
    }

    public function beli(){
        $data = array(          
            'title'     => 'Pembelian Obat',         
            'profile' => $this->pasien_crud->get_data($this->session->userdata("email")),
            'list' => $this->pasien_crud->get_pembelian(),
            );        
        $this->load->view('pasien/Pembelian/pembelian_v', $data);        
    }

    public function tambah_pembelian(){
        $data = array(          
            'title'     => 'Tambah Nota Pembelian',         
            'profile' => $this->pasien_crud->get_data($this->session->userdata("email")),            
            );        
        $this->load->view('pasien/Pembelian/tambah_pembelian', $data);        
    }

    public function edit_pembelian($no){
        $no = $this->uri->segment(3);
        $data = array(          
            'title'     => 'Ubah Nota Pembelian',         
            'profile' => $this->pasien_crud->get_data($this->session->userdata("email")),
            'get' => $this->pasien_crud->pick_pembelian($no),          
            );        
        $this->load->view('pasien/Pembelian/edit_pembelian', $data);        
    }

    public function simpan_pembelian(){                       
        $data = array(            
            'nama_obat' => $this->input->post("nama"),            
            'harga_beli' => $this->input->post("harga"),
            'jumlah_beli' => $this->input->post("jumlah"),
            'total_beli' => $this->input->post("total"),
            'tgl_beli' => $this->input->post("tanggal"),
        );
        $this->pasien_crud->simpan_pembelian($data);
        $this->session->set_flashdata('notif', '<div class=" alert alert-success alert-dismissble"> Success! Data berhasil disimpan di Database. </div>');
        redirect(base_url("pasien/beli"));
    }

    public function update_pembelian(){  
        $id = $this->input->post("id");        
        $data1 = array(            
            '0' => $this->input->post("nama"),
            '1' => $this->input->post("harga"),
            '2' => $this->input->post("jumlah"),
            '3' => $this->input->post("total"),
            '4' => $this->input->post("tanggal"),
        );         
            $data2 = array(            
            '0' => "nama_obat",
            '1' => "harga_beli",
            '2' => "jumlah_beli",
            '3' => "total_beli",
            '4' => "tgl_beli",
        );
        for ($i=0; $i < 5 ; $i++) {
            $a = $data1[$i];
            $b = $data2[$i]; 
            $this->pasien_crud->update_pembelian($a,$b,$id);
        }        
        $this->session->set_flashdata('notif', '<div class=" alert alert-success alert-dismissble"> Success! Data berhasil disimpan di Database. </div>');
        redirect(base_url("pasien/beli"));
    }

    public function hapus_pembelian($NO){
        $no['NO']= $this->uri->segment(3);                
        $this->pasien_crud->hapus_pembelian($no);               
        redirect('pasien/beli');
    }

    public function jual(){
        $data = array(          
            'title'     => 'Penjualan Obat',         
            'profile' => $this->pasien_crud->get_data($this->session->userdata("email")),
            'list' => $this->pasien_crud->get_penjualan(),
            );        
        $this->load->view('pasien/Penjualan/penjualan_v', $data);        
    }

    public function tambah_penjualan(){
        $data = array(          
            'title'     => 'Tambah Nota Penjualan',         
            'profile' => $this->pasien_crud->get_data($this->session->userdata("email")),            
            );        
        $this->load->view('pasien/Penjualan/tambah_penjualan', $data);        
    }

    public function edit_penjualan($no){
        $no = $this->uri->segment(3);
        $data = array(          
            'title'     => 'Ubah Nota Penjualan',         
            'profile' => $this->pasien_crud->get_data($this->session->userdata("email")),
            'get' => $this->pasien_crud->pick_penjualan($no),          
            );        
        $this->load->view('pasien/Penjualan/edit_penjualan', $data);        
    }

    public function simpan_penjualan(){                       
        $data = array(            
            'nama_pasien' => $this->input->post("nama"),            
            'nama_obat' => $this->input->post("obat"),
            'harga_jual' => $this->input->post("harga"),
            'jumlah_jual' => $this->input->post("jumlah"),
            'total_jual' => $this->input->post("total"),
            'tgl_jual' => $this->input->post("tanggal"),
        );
        $this->pasien_crud->simpan_penjualan($data);
        $this->session->set_flashdata('notif', '<div class=" alert alert-success alert-dismissble"> Success! Data berhasil disimpan di Database. </div>');
        redirect(base_url("pasien/jual"));
    }

    public function update_penjualan(){  
        $id = $this->input->post("id");        
        $data1 = array(            
            '0' => $this->input->post("nama"),
            '1' => $this->input->post("obat"),
            '2' => $this->input->post("harga"),
            '3' => $this->input->post("jumlah"),
            '4' => $this->input->post("total"),
            '5' => $this->input->post("tanggal"),
        );         
            $data2 = array(            
            '0' => "nama_pasien",
            '1' => "nama_obat",
            '2' => "harga_jual",
            '3' => "jumlah_jual",
            '4' => "total_jual",
            '5' => "tgl_jual",
        );
        for ($i=0; $i < 6 ; $i++) {
            $a = $data1[$i];
            $b = $data2[$i]; 
            $this->pasien_crud->update_penjualan($a,$b,$id);
        }        
        $this->session->set_flashdata('notif', '<div class=" alert alert-success alert-dismissble"> Success! Data berhasil disimpan di Database. </div>');
        redirect(base_url("pasien/jual"));
    }

    public function hapus_penjualan($NO){
        $no['NO']= $this->uri->segment(3);                
        $this->pasien_crud->hapus_penjualan($no);
        redirect('pasien/jual');
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect(base_url('Auth'));
    }

}