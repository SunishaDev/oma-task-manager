<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function __construct()
	{
        parent::__construct();
	    error_reporting(E_ALL & ~E_NOTICE);
	    $this->config->item('base_url'); 
		$this->load->helper('form');
		$this->load->helper('security');
		$this->load->helper(array('form', 'url'));
		$this->load->library('session');
		$this->load->database();
		$this->load->model('Model','Model');
	}
	public function index()
	{
		if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true){ //checks if the user is logged in or not
			$userId 			= $_SESSION['user_id'];
			$data['userInfo']	= $this->Model->getUserInfoById($userId);
			$this->load->view('header',$data);
			$this->load->view('dashboard',$data);
			$this->load->view('footer',$data);
		}else{
			$this->load->view('login');
		}
	}
	public function login()
    {
        if($this->input->post()){
            $email   = $this->input->post("email");
            $password    = $this->input->post("password");
            if($this->Model->login($email,$password))
            {
                $user  = $this->Model->getUserInfo($email);
                $this->session->set_userdata(array('user' => $user->username,'user_id' => $user->id,'isLoggedIn' => true));
                redirect(base_url(), 'refresh');
            }
            else
            {
                $data = NULL;
                $this->session->set_flashdata('error', 'Wrong username or password.');
                redirect(base_url(), 'refresh');
            }

        } 
       
        $this->load->view('admin/login');
    }
	public function logout()
    {
        error_reporting(0);  
        $this->session->sess_destroy();
        session_destroy();
        redirect(base_url(), 'refresh');
    }
	public function sign_up()
	{
		if($this->input->post()){
			$result = $this->Model->add_new_registration(); //we can add more fields required here
			if($result > 0){
				$this->session->set_userdata(array('user' => $this->input->post('user_name'),'user_id' => $result,'isLoggedIn' => true));
				redirect(base_url(), 'refresh');
			}
		}
		$this->load->view('register');
	}
	public function my_profile()
    {
		if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true){
			$userId 			= $_SESSION['user_id'];
			$data['userInfo']	= $this->Model->getUserInfoById($userId);
			$this->load->view('header',$data);
			$this->load->view('profile',$data);
			$this->load->view('footer',$data);
		}else{
			$this->load->view('login');
		}	
	}

	public function validate_email() 
    {
		if($this->input->post()){
			$email 		= $this->input->post('email');
			$userExist  = $this->Model->getUserInfo($email);
			if($userExist){
				redirect('reset-password/'.$userExist->id);
			}else{
				$this->session->set_flashdata('error', 'Account not found.');
			}
		}
		$this->load->view('verify_email');
	}
	
	public function resetPassword($id)
    {
		$data['userId'] = $id;
		if($this->input->post()){
			$password 			= $this->input->post('password');
			$updatePassword  	= $this->Model->updateUserPassword($password,$id);
			if($updatePassword){
				$this->session->set_flashdata('success', 'Password updated successfully.');
				redirect(base_url(), 'refresh');
			}else{
				$this->session->set_flashdata('error', 'Failed. Please try again.');
				redirect('reset-password/'.$userExist->id);
			}
		}
		$this->load->view('reset_password',$data);
	}
	public function projects()
	{
        if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true)
        {
            $user_id                    = $this->session->userdata('user_id');
            $data['user_id']           	= $user_id;
            $data['projects']           =  $this->Model->get_projects($user_id);
            $this->load->view('header',$data);
            $this->load->view('projects',$data);
            $this->load->view('footer',$data);
        }
        else{
		    $this->load->view('login');
        }
	}
	public function add_project()
	{
		if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true)
		{
			$user_id                    = $this->session->userdata('user_id');
            $data['user_id']           	= $user_id;
            if(!empty($this->input->post())){
                $time = time();
                $data = $this->input->post();
                unset($data['csrf_token']);
                $result =  $this->Model->insertRow('tbl_projects',$data);
                if($result > 0){
                      $this->session->set_flashdata('success', "<strong><center>Project added successfully</center></strong>");
                    redirect('projects');
                }else{
                      $this->session->set_flashdata('error', "<strong><center>Failed</center></strong>");
                     redirect('create-project');
                }
             }
            $this->load->view('header',$data);
            $this->load->view('add_project',$data);
            $this->load->view('footer',$data);
        }
        else{
		    $this->load->view('login');
        }
	}
	public function view_project($id)
	{
		if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true)
        {
            $user_id                    = $this->session->userdata('user_id');
            $data['user_id']           	= $user_id;
            $data['projectInfo']       = $this->Model->get_table_results('tbl_projects',$id);
            $this->load->view('header',$data);
            $this->load->view('view_project',$data);
            $this->load->view('footer',$data);
        }
        else{
		    $this->load->view('login');
        }
	}
    public function edit_project($id)
	{
        if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true)
        {
            $user_id                    = $this->session->userdata('user_id');
            $data['user_id']           	= $user_id;
            $data['projectInfo']       = $this->Model->get_table_results('tbl_projects',$id);
            if(!empty($this->input->post())){
                $time = time();
                $data = $this->input->post();
                if(!isset($data['status'])){
                    $data['status'] = 0;
                }
                unset($data['csrf_token']);
                $result =  $this->Model->updateRow('tbl_projects',$id,$data);
                if($result > 0){
                      $this->session->set_flashdata('success', "<strong><center>Project updated successfully</center></strong>");
                    redirect('view-project/'.$id);
                }else{
                      $this->session->set_flashdata('error', "<strong><center>Failed</center></strong>");
                      redirect('edit-project/'.$id);
                }
             }
            $this->load->view('header',$data);
            $this->load->view('edit_project',$data);
            $this->load->view('footer',$data);
        }
        else{
		    $this->load->view('admin/login');
        }
	}
    public function deleteProject($id){
		if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true)
        {
            $count          = $this->Model->get_table_num_rows('tbl_tasks','p_id',$id);
            if($count == 0){
                 $result         = $this->Model->deleteRow('tbl_projects',$id);
                if($result){
                    $this->session->set_flashdata('success', '<strong> Project Deleted Successfully.</strong>');
                    redirect('projects');
                }else{
                    $this->session->set_flashdata('error', '<strong> Project Deletion failed.</strong>');
                    redirect('view-project/'.$id);
                }
            }else{
                $this->session->set_flashdata('error', '<strong>Failed! Tasks exists in this project.</strong>');
                redirect('view-project/'.$id);
            }
            
        }
        else
        {
            redirect('cms_admin');
        }
    }
	public function tasks()
	{
        if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true)
        {
            $user_id                    = $this->session->userdata('user_id');
            $data['user_id']           	= $user_id;
			$data['projects']          	=  $this->Model->get_active_projects($user_id);
			if(!empty($this->input->post())){
				$p_id 				= 	$this->input->post('p_id');
				$data['p_id']		=	$p_id;
				$data['tasks']      =  	$this->Model->get_project_wise_tasks($p_id,$user_id);
			}else{
				$data['tasks']      =  	$this->Model->get_tasks($user_id);
				$data['p_id']		=	'';	
			}
            $this->load->view('header',$data);
            $this->load->view('tasks',$data);
            $this->load->view('footer',$data);
        }
        else{
		    $this->load->view('login');
        }
	}
	public function project_tasks($name,$id)
	{
        if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true)
        {
            $user_id                    = $this->session->userdata('user_id');
            $data['user_id']           	= $user_id;
			$data['project']        	= $this->Model->get_table_results('tbl_projects',$id);
            $data['tasks']           	=  $this->Model->get_project_wise_tasks($id,$user_id);
            $this->load->view('header',$data);
            $this->load->view('project_tasks',$data);
            $this->load->view('footer',$data);
        }
        else{
		    $this->load->view('login');
        }
	}
	public function add_task()
	{
		if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true)
		{
			$user_id                    = $this->session->userdata('user_id');
            $data['user_id']           	= $user_id;
			$data['projects']          	=  $this->Model->get_active_projects($user_id);
            if(!empty($this->input->post())){
                $time = time();
                $data = $this->input->post();
                $result =  $this->Model->createTask($data);
                if($result > 0){
                      $this->session->set_flashdata('success', "<strong><center>Task added successfully</center></strong>");
                    redirect('projects');
                }else{
                      $this->session->set_flashdata('error', "<strong><center>Failed</center></strong>");
                     redirect('create-project');
                }
             }
            $this->load->view('header',$data);
            $this->load->view('add_task',$data);
            $this->load->view('footer',$data);
        }
        else{
		    $this->load->view('login');
        }
	}
	
    public function edit_task($id)
	{
        if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true)
        {
            $user_id                    = $this->session->userdata('user_id');
            $data['user_id']           	= $user_id;
            $data['taskInfo']       = $this->Model->get_table_results('tbl_tasks',$id);
			$data['projects']          	=  $this->Model->get_active_projects($user_id);

            if(!empty($this->input->post())){
                $time = time();
                $data = $this->input->post();
                if(!isset($data['status'])){
                    $data['status'] = 0;
                }
                $result =  $this->Model->updateRow('tbl_tasks',$id,$data);
                if($result > 0){
                      $this->session->set_flashdata('success', "<strong><center>Task updated successfully</center></strong>");
                }else{
                      $this->session->set_flashdata('error', "<strong><center>Failed</center></strong>");
                }
				redirect('tasks');
             }
            $this->load->view('header',$data);
            $this->load->view('edit_task',$data);
            $this->load->view('footer',$data);
        }
        else{
		    $this->load->view('admin/login');
        }
	}
    public function deleteTask(){
		$id = $this->input->post('id');
                 $result         = $this->Model->deleteRow('tbl_tasks',$id);
                if($result){
                    $this->session->set_flashdata('success', '<strong> Task Deleted Successfully.</strong>');
                   
                }else{
                    $this->session->set_flashdata('error', '<strong> Task Deletion failed.</strong>');
                }
				redirect('tasks');
           
        }
        
	
}
