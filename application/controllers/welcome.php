<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
	public function index()
	{
        $this->load->helper('url');

        $data = array('result' => '', 'error_message' => '');

		$this->load->view('welcome_message', $data);
	}

    public function access($game_token)
    {
        $this->load->helper('url');
        $this->load->model('game_model');
        $this->load->model('user_model');
        $this->load->model('analytics_model');

        $game = $this->game_model->get_by_token($game_token);

        if ($game->steam_title == FALSE) {
            $this->game_model->scrape($game->id);
        }

        $pie_json = $this->analytics_model->get_pie_data($game->id);
        $line_json = $this->analytics_model->get_line_data($game->id);

        $data = array(
            'game' => $game,
            'pie_data_json' => json_encode($pie_json),
            'line_data_json' => json_encode($line_json)
        );

        $this->load->view('deploy_instructions', $data);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
