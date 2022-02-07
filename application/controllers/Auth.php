<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller{

	public function __construct()
	{
		parent :: __construct();
		$this->load->library('form_validation');
		$this->load->model('admin_login');
		$this->load->model('pasien_login');
		$this->load->model('admin_crud');
		$this->load->model('pasien_crud');
		$this->load->helper(array('form', 'url'));
	}

	public function index(){		
		$data['title'] = 'Login';		
		$this->load->view('login_v', $data);		
	}

	public function forgotpass(){
		$data['title'] = 'Recovery password';		
		$this->load->view('forgotpass_v', $data);		
	}

	public function register(){
		$data['title'] = 'Patient Registration';		
		$this->load->view('register_v', $data);		
	}

	public function aksi_login(){
	$user 		= $this->input->post('user');
	$pass 	= md5($this->input->post('pass'));
	$where = array(
		'email' => $user,
		'pass' => $pass,
		);
	$cek = $this->admin_login->cek_login("admin",$where)->num_rows();
	$cek2 = $this->pasien_login->cek_login("pasien",$where)->num_rows();			
		if($cek > 0 && $cek2 == 0){
			$data_session = array(
				'email' => $user,
				'status' => "login"
			); 
			$this->session->set_userdata($data_session); 
			//echo "login as admin";
			redirect(base_url("Admin"));
		}			
		elseif($cek == 0 && $cek2 > 0){
			$data_session = array(
				'email' => $user,
				'status' => "login"
				); 
			$this->session->set_userdata($data_session); 
			//echo "login as peserta";
			redirect(base_url("Pasien"));            
		}		
		else{						
			$this->session->set_flashdata('notif', '<div class=" alert alert-warning alert-dismissble"> Login Gagal. </div>');
			redirect('Auth/index');            
		}        
	}

	public function simpan(){
		$nama = $this->input->post('nama');	
		$kelamin  = $this->input->post("kelamin");		
		$tanggal = $this->input->post("tanggal");
        $today = date("Y-m-d");
        $usia = date_diff(date_create($tanggal), date_create($today))->format('%y');        
		$alamat  = $this->input->post("alamat");
		$telp  = $this->input->post("telp");
		$email = $this->input->post('email');
		$pass1 = $this->input->post('pass');
		$pass2 = $this->input->post('pass2');				
		$data = array(			
			'nama_pasien' => $nama,
            'usia' => $usia,
			'jenis_kelamin' => $kelamin,			
			'alamat' => $alamat,
			'telp' => $telp,
			'email' => $email,
			'pass' => md5($pass1),			
		);			
			$this->pasien_crud->simpan($data);
			$this->session->set_flashdata('notif', '<div class=" alert alert-success alert-dismissble"> Success! Data berhasil disimpan di Database. </div>');
			redirect('Auth/index');
		        
	}

    public function check_reset(){
		$email = $this->input->post('user');		
			$where = array(
			'email' => $email,
			);
			$cek = $this->admin_login->cek_login("admin",$where)->num_rows();			
			if($cek == 0 || $email == null){				
				$this->session->set_flashdata('notif', '<div class=" alert alert-warning alert-dismissble"> Email tidak tersedia. </div>');
					redirect('Auth/forgotpass');                    
			}
			else{				
                $data = array(
                    'title' => 'Create New password',
                    'email' =>  $email,
                );                
                $this->load->view('newpass_v', $data);	
		}			
	}

	public function reset(){
		$email = $this->input->post('user');
        $pass 	= md5($this->input->post('pass'));														
		$this->admin_crud->update_pass($pass,$email);
		$this->session->set_flashdata('notif', '<div class=" alert alert-warning alert-dismissble"> Reset berhasil. Password baru anda adalah <strong>'.$this->input->post('pass').'</strong> </div>');
		redirect('Auth/index');
	}	

	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url('Auth'));
	}
}