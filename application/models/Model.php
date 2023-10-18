<?php class Model extends CI_Model{
    function add_new_registration()
    {
        $data = array(
            'email'         =>  $this->input->post('email'),
            'username'      =>  $this->input->post('username'),
            'password'      =>  md5($this->input->post('password')),
            'department'    =>  $this->input->post('department'),
    	);
    	$result = $this->db->insert('tbl_users',$data);
    	return $this->db->insert_id();
    }

    function get_email_count($email){
        return $this->db->where('email',$email)->get('tbl_users')->num_rows();
    }

    public function login($email, $password){
        $query = $this->db->select('*')->from('tbl_users')
           ->where('email',$email)
           ->where('password',md5($password))->get();
        if($query->num_rows() == 1){                  
            return $query->result();
        }
        else{
            return false;
        }
    }

    public function getUserInfo($email){       
        return  $this->db->select('*')->from('tbl_users')->where('email', $email)->get()->row();       
    }

    public function getUserInfoById($userInd){       
        return  $this->db->select('*')->from('tbl_users')->where('id', $userInd)->get()->row();       
    }

    public function updateUserPassword($password,$id){
        $data = array(  
            'password'      => md5($password),
            'updated_at'    => date('Y-m-d H:i'),
        );
        return $this->db->where('id',$id)->update('tbl_users',$data);
    }  
    function get_all_results($table)
    {
        return $this->db->select('*')->from($table)->order_by('id','desc')->get()->result();
    }

    function get_table_results($table,$id)
    {
        return $this->db->select('*')->from($table)->where('id',$id)->get()->row();
    }  
    function get_table_num_rows($table,$field,$id)
    {
        return $this->db->select('*')->from($table)->where($field,$id)->get()->num_rows();
    }
    function get_table_rows($table,$field,$id)
    {
        return $this->db->select('*')->from($table)->where($field,$id)->get()->row();
    }
    function get_projects($user_id){
        $result =  $this->db->select('*')->from('tbl_projects')->where('user_id',$user_id)->order_by('id','desc')->get()->result();
        foreach($result as &$data){
            $taskInfo = $this->get_table_num_rows('tbl_tasks','p_id',$data->id);
            $data->no_of_task= $taskInfo?$taskInfo:0;
        }
        return $result;
    }
    function get_active_projects($user_id)
    {
        return $this->db->select('*')->from('tbl_projects')->where('user_id',$user_id)->where('status=',1)->get()->result();
    }
    function get_project_wise_tasks($id,$user_id)
    {
        return $this->db->select('tt.*,tp.name as project')
        ->from('tbl_tasks as tt')
        ->join('tbl_projects as tp','tt.p_id = tp.id')
        ->where('tt.p_id',$id)
        ->where('tp.user_id',$user_id)
        ->order_by('id','desc')
        ->get()->result();

    }
    function insertRow($table,$data){  
        $result         = $this->db->insert($table,$data);
        return $this->db->insert_id();
    }
    
    function updateRow($table,$id,$data){  
        $this->db->where('id',$id);
        return $this->db->update($table,$data);
    }

    function deleteRow($table,$id){  
        $this->db->where('id',$id);
        return $this->db->delete($table);
    }
    function get_tasks($user_id){
        return $this->db->select('tt.*,tp.name as project')
        ->from('tbl_tasks as tt')
        ->join('tbl_projects as tp','tt.p_id = tp.id')
        ->where('tp.user_id',$user_id)
        ->order_by('id','desc')
        ->get()->result();
    }
    function createTask($data){
        if($data['title']){
            $taskDetails = $data['title'];
            $taskDueDate = $data['due_date'];
            $taskStatus = $data['status'];
            foreach($taskDetails as $key=>$row){
                $arrTask = array(   'p_id'=>$data['p_id'],
                                    'title'=>$row,
                                    'due_date'=>$taskDueDate[$key],
                                    'status'=>$taskStatus[$key]
                            );
                $result =   $this->db->insert('tbl_tasks',$arrTask);
            }
        }    
        return $result;
    }
}