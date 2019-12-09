<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->helper('Auth_helper');
		Autentica($this);
		 //$this->output->enable_profiler(TRUE);		
	}

	public function index()
	{
		$this->load->model('Ramal_model');
		$data['title']    =    "Ramal";
        $data['description']    =    "Todos os Ramais";
        $ramal = $this->Ramal_model->buscaTudoRamal(1000000, 0,null,'all')->result_array();
        $setor = $this->Ramal_model->buscaSetores();
        $dados = array(
            'ramal' => $ramal,
            'setor' => $setor
        );
        $this->load->templateAdmin('ramal/ramal', $data, $dados);
	}
	


}
