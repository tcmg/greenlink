<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Process extends CI_Controller {

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
	public function submit()
	{
        $this->load->model('game_model');
        $this->load->model('user_model');

        $url = $this->input->get_post('steam_url', TRUE);
        $email = $this->input->get_post('email', TRUE);

        $view_data = array('error_message' => '', 'result' => '');

        if ($url === '' || $email === '') {
            $view_data['error_message'] = 'Missing URL or email.';
            $this->load->view('welcome_message', $view_data);
            return; 
        }

        $this->load->helper('url');

        $user = $this->user_model->get_by_email($email);

        if ($user == false) {
            // User doesn't exist
            $user = $this->user_model->create($email);
        }

        try {
            log_message('info', 'about to parse');
            $steam_id = $this->game_model->parse_steam_url($url);
            log_message('info', 'parsed');
            $game = $this->game_model->get_by_steam($email, $steam_id);
            log_message('info', 'get');
        } catch(Exception $e) {
            $view_data['error_message'] = 'Malformed URL.';
            $this->load->view('welcome_message', $view_data);
            return; 
        }

        if ($game == false) {
            // Game isn't already submitted
            $this->game_model->create($user->id, $steam_id);
        }

        log_message('info', 'game existed');
        $this->game_model->send_access($email, $steam_id);
        $view_data['result'] = 'Sent access email. Check your email inbox.';

        $this->load->view('welcome_message', $view_data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
