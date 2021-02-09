<?php
class Users_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
        $this->load->library('session');
        $this->load->library('encryption');
        $this->load->helper('security');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function set_users($values)
    {
        $firstname      =   html_escape($values['firstname']);
        $lastname       =   html_escape($values['lastname']);
        $midname        =   html_escape($values['midname']);
        $extname        =   html_escape($values['extname']);
        $bdate          =   html_escape($values['bdate']);
        $age            =   html_escape($values['age']);
        $gender         =   html_escape($values['gender']);
        $emailadd       =   html_escape($values['emailadd']);
        $mobilenumber   =   html_escape($values['mobilenumber']);
        $username       =   html_escape($values['username']);
        $password       =   html_escape($values['password']);
        $conpassword    =   html_escape($values['conpassword']);

        $data = array(
            'lastname'          =>  $lastname,
            'firstname'         =>  $firstname,
            'middlename'        =>  $midname,
            'extensionname'     =>  $extname,
            'bdate'             =>  $bdate,
            'age'               =>  $age,
            'gender'            =>  $gender
        );
        $user = $this->db->insert('zusers', $data);
        if($user === TRUE)
        {
            $userid = $this->db->insert_id();

            $datas = array(
                'user_id'      =>  $userid,
                'username'     =>  $username,
                'password'     =>  do_hash($password),
                'email'        =>  $emailadd,
                'cpnumber'     =>  $mobilenumber
            );
            $account = $this->db->insert('zaccount', $datas);
            if($account === TRUE)
            {
                $avatar = array(
                    'user_id'    =>  $userid,
                    'avatar'     =>  "",
                    'status'     =>  "1"
                );
                $avatarinsert = $this->db->insert('zavatar', $avatar);
                if($avatarinsert === TRUE)
                {
                    $banner = array(
                        'user_id'    =>  $userid,
                        'banner'     =>  "",
                        'status'     =>  "1"
                    );
                    $bannerinsert = $this->db->insert('zbanner', $banner);
                    if($bannerinsert === TRUE)
                    {
                        $this->session->set_userdata(array("username" => $username, "userid" => $userid));
                        return 1;
                    }
                }
            }
        }
    }

    public function get_users($username = FALSE)
    {  
        if ($username === FALSE)
        {
            $query = $this->db->get('zusers');
            return $query->result_array();
        }
            
        $query = $this->db->query("SELECT * FROM zaccount a, zusers b, zavatar c, zbanner d WHERE username = '$username' AND b.id=a.user_id AND b.id=c.user_id AND c.status=1 AND b.id=d.user_id AND d.status=1");
        return $query->row_array();
    }

    public function checkusername($values)
    {
        $username   =   $values['username'];

		$account = $this->db->query("SELECT * FROM zaccount WHERE username = '$username'");
		if($account -> num_rows() > 0 )
		{
			return 1;//username already inused
		}
		else
		{
			return 0;//username not inuse
		}
    }

    public function set_avatar($avatarimg)
    {
        $userid = $this->session->userdata("userid");
        $avatarData = array(
            'status' 	=> "0"
        );
        $this->db->where('user_id', $userid);
        $this->db->where('status', 1);
        $updated_avatar = $this->db->update('zavatar', $avatarData);

        if($updated_avatar)
        {
            $avatar = array(
                'user_id'    =>  $userid,
                'avatar'     =>  $avatarimg,
                'status'     =>  "1"
            );
            $avatarinsert = $this->db->insert('zavatar', $avatar);
            if($avatarinsert === TRUE)
            {
                $move_upload 	= 	rename('./uploads/temp_img/'.$avatarimg, './uploads/avatar/'.$avatarimg);
                if($move_upload)
                {
                    return TRUE;
                }
                else 
                {
                    echo $move_upload;
                }
            }
        }
    }

    public function set_banner($bannerimg)
    {
        $userid = $this->session->userdata("userid");
        $bannerData = array(
            'status' 	=> "0"
        );
        $this->db->where('user_id', $userid);
        $this->db->where('status', 1);
        $updated_banner = $this->db->update('zbanner', $bannerData);

        if($updated_banner)
        {
            $banner = array(
                'user_id'    =>  $userid,
                'banner'     =>  $bannerimg,
                'status'     =>  "1"
            );
            $bannerinsert = $this->db->insert('zbanner', $banner);
            if($bannerinsert === TRUE)
            {
                $move_upload 	= 	rename('./uploads/temp_img/'.$bannerimg, './uploads/banner/'.$bannerimg);
                if($move_upload)
                {
                    return TRUE;
                }
                else 
                {
                    echo $move_upload;
                }
            }
        }
    }

    public function search_users($searchuser)
    {
        return $searchuser;
    }

}