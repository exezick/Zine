<?php
class Post_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('ftp');
    }

    public function set_post($values)
    {
        $postfield  =   html_escape($values['postfield']);
        $postimg    =   html_escape($values['hiddenpostimg']);

        $data = array(
            'title'     =>  '',
            'content'   =>  $postfield,
            'user_id'   =>  $this->session->userdata("userid")
        );
        $post = $this->db->insert('zpost', $data);

        if($post === TRUE)
        {
            if(!empty($postimg))
            {
                $dataimg = array(
                    'post_id'   =>  $this->db->insert_id(),
                    'image'     =>  $postimg
                );
                $imgpost = $this->db->insert('zpostimage', $dataimg);

                $move_upload 	= 	rename('./uploads/temp_img/'.$postimg, './uploads/post/'.$postimg);
                if($move_upload)
                {
                    return TRUE;
                }
                else 
                {
                    echo $move_upload;
                }
            }
            else 
            {
                return TRUE;
            }
        }
    }

    public function get_post($postid)
    {
        $splt = explode("_",$postid);

        if ($splt[0]=="post")
        {
            $query = $this->db->query("SELECT * FROM zpost a, zaccount b, zusers c, zavatar d where a.postid=$splt[1] AND b.user_id=a.user_id AND c.id=a.user_id AND d.user_id=a.user_id AND d.status=1 LIMIT 1");
            if($query)
            {
                return $query->result_array();
            }
        }
        else if ($splt[0]=="user")
        {
            $query = $this->db->query("SELECT * FROM zpost a, zaccount b, zusers c, zavatar d where a.user_id=$splt[1] AND a.user_id=b.user_id AND b.user_id=c.id AND d.user_id=a.user_id AND d.status=1 ORDER BY datesentposted DESC");
            if($query)
            {
                return $query->result_array();
            }
        }
        
    }

    public function del_post($postid)
    {
        //delete the post with dependencies and file image
        $file = $this->del_fileimg_upload($postid);
        
        if($file == "notexist")
        {
            $post = $this->del_mypost($postid);
            if($post)
            {
                return TRUE;
            }
        }
        else if($file == "filedeleted" || $file == "error")
        {
            $image = $this->del_postimage($postid);
            if($image)
            {
                $post = $this->del_mypost($postid);
                if($post)
                {
                    return TRUE;
                }
            }
        }
        
    }

    public function del_mypost($postid)
    {
        $deleted = $this->db->query("DELETE FROM zpost WHERE postid='$postid'");
		if($deleted)
		{
            return TRUE;
        }
    }

    public function del_postimage($postid)
    {
        $imgdel = $this->db->query("DELETE FROM zpostimage WHERE post_id='$postid'");
        if($imgdel)
        {
            return TRUE;
        }
    }

    public function del_fileimg_upload($postid)
    {
        $query = $this->db->query("SELECT * FROM zpostimage where post_id=$postid");
        $rowimg = $query->row();
        if(!empty($rowimg->post_id))
        {
            $dfile = 'uploads/post/'.$rowimg->image;
            if(file_exists($dfile))
            {
                $delmg = unlink($dfile);
                if($delmg)
                {
                    return "filedeleted";
                }
            }
            else 
            {
                return "error"; //file dont exist in the directory
            }
        }
        else 
        {
            return "notexist"; //not exist in db
        }
    }

}