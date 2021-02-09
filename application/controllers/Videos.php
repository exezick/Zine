<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Videos extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->helper('url_helper');
        $this->load->model('videos_model');
        $this->load->library('ftp');
    }

    public function index()
    {
        
    }

    public function view($vid_id)
    {
        $this->load->helper('url');

        $data['video_default'] = $this->videos_model->get_selected_video($vid_id);
        $data['video_list'] = $this->videos_model->get_videos();
        $data['video_category'] = $this->videos_model->check_category($vid_id);

        $data['title'] = "Zine";
        
        if(!empty($data['video_default']))
        {
            $data['headercontents'] = array(
                '<link rel="stylesheet" href="'.base_url().'assets/css/bootstrap.css">',
                '<link rel="stylesheet" href="'.base_url().'assets/css/animate.css">',
                '<link rel="stylesheet" href="'.base_url().'assets/css/font-awesome.css">',
                '<link rel="stylesheet" href="'.base_url().'assets/css/custom.css">',
                '<script type="text/javascript">var URL = "'.base_url().'";</script>'
            );
            $data['defaultfootercontents'] = array(
                '<script src="'.base_url().'assets/js/jquery.js"></script>',
                '<script src="'.base_url().'assets/js/bootstrap.js"></script>',
                '<script src="'.base_url().'assets/js/custom.js"></script>'
            );
            $data['somefootercontents'] = array(
            
            );
            
            $this->load->view('templates/header', $data);
            $this->load->view('videos/movie', $data);
            $this->load->view('templates/footer', $data);
        }
        else
        {
            show_404();
        }
    }

    public function scan_videos()
    {
        $scaned = $this->videos_model->insert_videos();
        if($scaned)
        {
            echo 1;
        }
    }
    
}