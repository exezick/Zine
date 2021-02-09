<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('videos_model');
        $this->load->helper('url_helper');
	}
	
	public function index($page="home")
	{
		$this->home($page);
	}

	public function home($page)
	{
        $this->load->helper('url');

        if ( ! file_exists(APPPATH.'views/'.$page.'.php'))
        {
            show_404();
        }

        $data['video_default'] = $this->videos_model->show_latest_video();
        $data['video_list'] = $this->videos_model->get_videos();
        $data['video_category'] = $this->videos_model->check_category("");

        $data['title'] = "Zine";

        // if(!empty($data['video_default']))
        // {
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
            $this->load->view($page, $data);
            $this->load->view('templates/footer', $data);
        //}
	}
    
}