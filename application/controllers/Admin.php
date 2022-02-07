<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller{

    public function __construct()
    {
        parent :: __construct();
        $this->load->library('form_validation');
        if($this->session->userdata('status') != "login"){
            redirect(base_url("Auth"));
        }        
        $this->load->library('form_validation');
        $this->load->model('admin_crud');
        $this->load->dbutil();
        $this->load->helper(array('form', 'url', 'file', 'date'));
    }

    public function index(){
        $data = array(          
            'title'     => 'Admin',
            'profile' => $this->admin_crud->get_data($this->session->userdata("email")),
            );                
        $this->load->view('admin/admin_v', $data);        
    }
    
    public function dokter(){
        $data = array(          
            'title'     => 'Daftar Dokter',         
            'profile' => $this->admin_crud->get_data($this->session->userdata("email")),
            'list' => $this->admin_crud->get_dokter(),            
            );        
        $this->load->view('admin/Dokter/dokter_v', $data);        
    }
    
    public function tambah_dokter(){
        $data = array(          
            'title'     => 'Tambah Dokter',         
            'profile' => $this->admin_crud->get_data($this->session->userdata("email")),            
            );        
        $this->load->view('admin/Dokter/tambah_dokter', $data);        
    }

    public function edit_dokter($no){
        $no = $this->uri->segment(3);
        $data = array(          
            'title'     => 'Ubah Dokter',         
            'profile' => $this->admin_crud->get_data($this->session->userdata("email")),
            'get' => $this->admin_crud->pick_dokter($no),          
            );        
        $this->load->view('admin/Dokter/edit_dokter', $data);        
    }

    public function simpan_dokter(){               
        $tanggal = $this->input->post("tanggal");
        $today = date("Y-m-d");
        $usia = date_diff(date_create($tanggal), date_create($today))->format('%y');
            $data = array(            
            'nama_dokter' => $this->input->post("nama"),
            'usia' => $usia,
            'jenis_kelamin' => $this->input->post("kelamin"),
            'spesialis' => $this->input->post("ahli"),
            'alamat' => $this->input->post("alamat"),
            'telp' => $this->input->post("telp"),
        );
        $this->admin_crud->simpan_dokter($data);
        $this->session->set_flashdata('notif', '<div class=" alert alert-success alert-dismissble"> Success! Data berhasil disimpan di Database. </div>');
        redirect(base_url("admin/dokter"));
    }

    public function update_dokter(){  
        $id = $this->input->post("id");        
        $data1 = array(            
            '0' => $this->input->post("nama"),
            '1' => $this->input->post("usia"),
            '2' => $this->input->post("kelamin"),
            '3' => $this->input->post("ahli"),
            '4' => $this->input->post("alamat"),
            '5' => $this->input->post("telp"),
        );         
            $data2 = array(            
            '0' => "nama_dokter",
            '1' => "usia",
            '2' => "jenis_kelamin",
            '3' => "spesialis",
            '4' => "alamat",
            '5' => "telp",            
        );
        for ($i=0; $i < 6 ; $i++) {
            $a = $data1[$i];
            $b = $data2[$i]; 
            $this->admin_crud->update_dokter($a,$b,$id);
        }        
        $this->session->set_flashdata('notif', '<div class=" alert alert-success alert-dismissble"> Success! Data berhasil disimpan di Database. </div>');
        redirect(base_url("admin/dokter"));
    }

    public function hapus_dokter($id_dokter){
        $no['id_dokter']= $this->uri->segment(3);                
        $this->admin_crud->hapus_dokter($no);               
        redirect('admin/dokter');
    }
    
    public function pasien(){
        $data = array(          
            'title'     => 'Daftar Pasien',         
            'profile' => $this->admin_crud->get_data($this->session->userdata("email")),  
            'list' => $this->admin_crud->get_pasien(),          
            );        
        $this->load->view('admin/Pasien/pasien_v', $data);        
    }
    
    public function riwayat_pasien(){
        $no = $this->uri->segment(3);
        $data = array(          
            'title'     => 'Riwayat Pasien',         
            'profile' => $this->admin_crud->get_data($this->session->userdata("email")),
            'get' => $this->admin_crud->pick_pasien($no),
            'list' => $this->admin_crud->pick_riwayat($no),
            );        
        $this->load->view('admin/Pasien/riwayat_pasien', $data);
               
    }

    public function tambah_riwayat(){
        $no = $this->uri->segment(3);
        $data = array(          
            'title'     => 'Tambah Data Obat',         
            'profile' => $this->admin_crud->get_data($this->session->userdata("email")),                        
            'get' => $this->admin_crud->pick_pasien($no),
            'dokter' => $this->admin_crud->get_dokter(),
            'obat' => $this->admin_crud->get_obat(),
            'penyakit' => $this->admin_crud->get_penyakit(),

            );        
        $this->load->view('admin/Pasien/tambah_riwayat', $data);        
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
        $this->admin_crud->simpan_riwayat($data);
        $this->session->set_flashdata('notif', '<div class=" alert alert-success alert-dismissble"> Success! Data berhasil disimpan di Database. </div>');
        redirect(base_url("admin/riwayat_pasien".$this->input->post("id")));
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
            $this->admin_crud->update_riwayat($a,$b,$id);
        }        
        $this->session->set_flashdata('notif', '<div class=" alert alert-success alert-dismissble"> Success! Data berhasil disimpan di Database. </div>');
        redirect(base_url("admin/riwayat_pasien"));
    }

    public function hapus_riwayat($no){
        $no['no']= $this->uri->segment(3);                
        $this->admin_crud->hapus_riwayat($no);               
        redirect('admin/riwayat_pasien');
    }

    public function obat(){
        $data = array(          
            'title'     => 'Daftar obat',         
            'profile' => $this->admin_crud->get_data($this->session->userdata("email")),            
            'list' => $this->admin_crud->get_obat(),
            );        
        $this->load->view('admin/Obat/obat_v', $data);        
    }
    
    public function tambah_obat(){
        $data = array(          
            'title'     => 'Tambah Data Obat',         
            'profile' => $this->admin_crud->get_data($this->session->userdata("email")),            
            );        
        $this->load->view('admin/Obat/tambah_obat', $data);        
    }

    public function edit_obat($no){
        $no = $this->uri->segment(3);
        $data = array(          
            'title'     => 'Ubah Data Obat',         
            'profile' => $this->admin_crud->get_data($this->session->userdata("email")),
            'get' => $this->admin_crud->pick_obat($no),          
            );        
        $this->load->view('admin/Obat/edit_obat', $data);        
    }

    public function simpan_obat(){                       
        $data = array(            
            'nama_obat' => $this->input->post("nama"),            
            'tipe_obat' => $this->input->post("tipe"),
            'tingkat_gejala' => $this->input->post("gejala"),            
            'stok' => $this->input->post("stok"),            
        );
        $this->admin_crud->simpan_obat($data);
        $this->session->set_flashdata('notif', '<div class=" alert alert-success alert-dismissble"> Success! Data berhasil disimpan di Database. </div>');
        redirect(base_url("admin/obat"));
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
            $this->admin_crud->update_obat($a,$b,$id);
        }        
        $this->session->set_flashdata('notif', '<div class=" alert alert-success alert-dismissble"> Success! Data berhasil disimpan di Database. </div>');
        redirect(base_url("admin/obat"));
    }

    public function hapus_obat($id_obat){
        $no['id_obat']= $this->uri->segment(3);                
        $this->admin_crud->hapus_obat($no);               
        redirect('admin/obat');
    }

    public function penyakit(){
        $data = array(          
            'title'     => 'Daftar penyakit',         
            'profile' => $this->admin_crud->get_data($this->session->userdata("email")),
            'list' => $this->admin_crud->get_penyakit(),
            );        
        $this->load->view('admin/Penyakit/penyakit_v', $data);        
    } 

    public function tambah_penyakit(){
        $data = array(          
            'title'     => 'Tambah Data Penyakit',         
            'profile' => $this->admin_crud->get_data($this->session->userdata("email")),            
            );        
        $this->load->view('admin/Penyakit/tambah_penyakit', $data);        
    }

    public function edit_penyakit($no){
        $no = $this->uri->segment(3);
        $data = array(          
            'title'     => 'Ubah Data Penyakit',         
            'profile' => $this->admin_crud->get_data($this->session->userdata("email")),
            'get' => $this->admin_crud->pick_penyakit($no),          
            );        
        $this->load->view('admin/Penyakit/edit_penyakit', $data);        
    }

    public function simpan_penyakit(){                       
        $data = array(            
            'nama_penyakit' => $this->input->post("nama"),            
            'daerah_penyakit' => $this->input->post("tipe"),
            'gejala' => $this->input->post("gejala"),            
        );
        $this->admin_crud->simpan_penyakit($data);
        $this->session->set_flashdata('notif', '<div class=" alert alert-success alert-dismissble"> Success! Data berhasil disimpan di Database. </div>');
        redirect(base_url("admin/penyakit"));
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
            $this->admin_crud->update_penyakit($a,$b,$id);
        }        
        $this->session->set_flashdata('notif', '<div class=" alert alert-success alert-dismissble"> Success! Data berhasil disimpan di Database. </div>');
        redirect(base_url("admin/penyakit"));
    }

    public function hapus_penyakit($id_penyakit){
        $no['id_penyakit']= $this->uri->segment(3);                
        $this->admin_crud->hapus_penyakit($no);               
        redirect('admin/penyakit');
    }

    public function beli(){
        $data = array(          
            'title'     => 'Pembelian Obat',         
            'profile' => $this->admin_crud->get_data($this->session->userdata("email")),
            'list' => $this->admin_crud->get_pembelian(),
            );        
        $this->load->view('admin/Pembelian/pembelian_v', $data);        
    }

    public function tambah_pembelian(){
        $data = array(          
            'title'     => 'Tambah Nota Pembelian',         
            'profile' => $this->admin_crud->get_data($this->session->userdata("email")),            
            );        
        $this->load->view('admin/Pembelian/tambah_pembelian', $data);        
    }

    public function edit_pembelian($no){
        $no = $this->uri->segment(3);
        $data = array(          
            'title'     => 'Ubah Nota Pembelian',         
            'profile' => $this->admin_crud->get_data($this->session->userdata("email")),
            'get' => $this->admin_crud->pick_pembelian($no),          
            );        
        $this->load->view('admin/Pembelian/edit_pembelian', $data);        
    }

    public function simpan_pembelian(){                       
        $data = array(            
            'nama_obat' => $this->input->post("nama"),            
            'harga_beli' => $this->input->post("harga"),
            'jumlah_beli' => $this->input->post("jumlah"),
            'total_beli' => $this->input->post("total"),
            'tgl_beli' => $this->input->post("tanggal"),
        );
        $this->admin_crud->simpan_pembelian($data);
        $this->session->set_flashdata('notif', '<div class=" alert alert-success alert-dismissble"> Success! Data berhasil disimpan di Database. </div>');
        redirect(base_url("admin/beli"));
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
            $this->admin_crud->update_pembelian($a,$b,$id);
        }        
        $this->session->set_flashdata('notif', '<div class=" alert alert-success alert-dismissble"> Success! Data berhasil disimpan di Database. </div>');
        redirect(base_url("admin/beli"));
    }

    public function hapus_pembelian($NO){
        $no['NO']= $this->uri->segment(3);                
        $this->admin_crud->hapus_pembelian($no);               
        redirect('admin/beli');
    }

    public function jual(){
        $data = array(          
            'title'     => 'Penjualan Obat',         
            'profile' => $this->admin_crud->get_data($this->session->userdata("email")),
            'list' => $this->admin_crud->get_penjualan(),
            );        
        $this->load->view('admin/Penjualan/penjualan_v', $data);        
    }

    public function tambah_penjualan(){
        $data = array(          
            'title'     => 'Tambah Nota Penjualan',         
            'profile' => $this->admin_crud->get_data($this->session->userdata("email")),            
            );        
        $this->load->view('admin/Penjualan/tambah_penjualan', $data);        
    }

    public function edit_penjualan($no){
        $no = $this->uri->segment(3);
        $data = array(          
            'title'     => 'Ubah Nota Penjualan',         
            'profile' => $this->admin_crud->get_data($this->session->userdata("email")),
            'get' => $this->admin_crud->pick_penjualan($no),          
            );        
        $this->load->view('admin/Penjualan/edit_penjualan', $data);        
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
        $this->admin_crud->simpan_penjualan($data);
        $this->session->set_flashdata('notif', '<div class=" alert alert-success alert-dismissble"> Success! Data berhasil disimpan di Database. </div>');
        redirect(base_url("admin/jual"));
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
            $this->admin_crud->update_penjualan($a,$b,$id);
        }        
        $this->session->set_flashdata('notif', '<div class=" alert alert-success alert-dismissble"> Success! Data berhasil disimpan di Database. </div>');
        redirect(base_url("admin/jual"));
    }

    public function hapus_penjualan($NO){
        $no['NO']= $this->uri->segment(3);                
        $this->admin_crud->hapus_penjualan($no);
        redirect('admin/jual');
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect(base_url('Auth'));
    }

}