<?php
class Videos_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
        $this->load->helper('url_helper');
    }

    public function show_latest_video()
    {
        $vid = $this->db->query('SELECT * FROM videos a, category b WHERE a.cat_id=b.cat_id AND a.cat_id=1 ORDER BY a.vid_id ASC LIMIT 1');
        if($vid->num_rows() > 0)
        {
            return $vid->result_array();
        }
    }

    public function get_videos()
    {  
        $query = $this->db->query('SELECT * FROM videos a, category b WHERE a.cat_id=b.cat_id ORDER BY a.title ASC');
        return $query->result_array();
    }

    public function get_selected_video($vid_id)
    {  
        $query = $this->db->query("SELECT * FROM videos a, category b WHERE a.cat_id=b.cat_id AND a.vid_id=$vid_id");
        return $query->result_array();
    }

    public function check_category($vid_id)
    {
        $vidq = " ";

        if(!empty($vid_id))
        {
            $vidq = ' AND a.vid_id='.$vid_id;
            $vid = $this->db->query("SELECT * FROM videos a, category b WHERE a.cat_id=b.cat_id $vidq ORDER BY a.title ASC limit 1");
            if($vid->num_rows() > 0)
            {
                $vidz = $vid->row();
                return $vidz->cat_id;
            }
        }
        else
        {
            return 1;
        }
    }

    public function insert_videos()
    {
        $delmov = $this->delete_videos();
        if( $delmov)
        {
            $mov    = $this->insert_movie();
            $anim   = $this->insert_anime();
            $toon   = $this->insert_cartoon();
            $oth   = $this->insert_other();

            if($mov && $anim && $toon && $oth)
            {
                return true;
            }
        }
    }

    public function delete_videos()
    {
        $deleted = $this->db->query("DELETE FROM videos");
		if($deleted)
		{
            return true;
        }
    }

    public function insert_movie()
    {
        $dir        = 'uploads/movies';
        $scan       = scandir($dir);
        $counter    = count($scan);
        $x = 1;
        
        for ($i = 0; $i < $counter; $i++) 
        {
            if ($scan[$i] != '.' && $scan[$i] != '..' && $scan[$i] != 'index.html') 
            {
                $vidata = array(
                    'cat_id'    =>  1,
                    'title'     =>  $scan[$i]
                );
                $this->db->insert('videos', $vidata);
            } 
            $x++;
        }
        return true;
    }

    public function insert_anime()
    {
        $dir        = 'uploads/anime';
        $scan       = scandir($dir);
        $counter    = count($scan);
        $x = 1;
        
        for ($i = 0; $i < $counter; $i++) 
        {
            if ($scan[$i] != '.' && $scan[$i] != '..' && $scan[$i] != 'index.html') 
            {
                $vidata = array(
                    'cat_id'    =>  2,
                    'title'     =>  $scan[$i]
                );
                $this->db->insert('videos', $vidata);
            } 
            $x++;
        }
        return true;
    }

    public function insert_cartoon()
    {
        $dir        = 'uploads/cartoons';
        $scan       = scandir($dir);
        $counter    = count($scan);
        $x = 1;
        
        for ($i = 0; $i < $counter; $i++) 
        {
            if ($scan[$i] != '.' && $scan[$i] != '..' && $scan[$i] != 'index.html') 
            {
                $vidata = array(
                    'cat_id'    =>  3,
                    'title'     =>  $scan[$i]
                );
                $this->db->insert('videos', $vidata);
            } 
            $x++;
        }
        return true;
    }

    public function insert_other()
    {
        $dir        = 'uploads/others';
        $scan       = scandir($dir);
        $counter    = count($scan);
        $x = 1;
        
        for ($i = 0; $i < $counter; $i++) 
        {
            if ($scan[$i] != '.' && $scan[$i] != '..' && $scan[$i] != 'index.html') 
            {
                $vidata = array(
                    'cat_id'    =>  4,
                    'title'     =>  $scan[$i]
                );
                $this->db->insert('videos', $vidata);
            } 
            $x++;
        }
        return true;
    }

}