<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Image extends CI_Controller {

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
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index($image_id = FALSE)
	{
        if ($image_id === FALSE) {
            show_404();
            die();
        }

        settype($image_id, 'integer');
        $path = 'images/' . $image_id . '.png';

        if (!file_exists($path)) {
            show_404();
            die();
        }

        header("Content-Type: image/png;");
        readfile($path);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
