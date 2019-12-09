<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ramal extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('Auth_helper');
        Autentica($this, true);
        $this->load->model('Ramal_model');
        //$this->output->enable_profiler(TRUE);
    }

    /*Area externa
    ########################################## */
    public function index()
    {
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


    public function listaRamais($order_by = 'id_ramal', $pesquisa = 'all')
    {
        if ($this->input->post()) {
            $pesquisa = $this->input->post('pesquisa');
        }
        $pesquisa = urldecode($pesquisa);
        $this->load->library('pagination');
        $data['title']    =    "Ramais | Lista de Ramais";
        $data['description']    =    "Lista de Ramais";
        $page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
        $config = array(
            "base_url" => base_url("Ramal/listaRamais/$order_by/$pesquisa"),
            "total_rows" => $this->Ramal_model->buscaTudoRamal(100000000, 0, $order_by, $pesquisa)->num_rows(),
            "per_page" => 15,
            "uri_segment" => 5
        );
        $config = array_merge($config, $this->load->configPagination());
        $this->pagination->initialize($config);
        $ramal = $this->Ramal_model->buscaTudoRamal($config["per_page"], $page, $order_by, $pesquisa)->result_array();
        $dados = array(
            'links' => $this->pagination->create_links(),
            'pesquisa' => $pesquisa,
            'ramal' => $ramal
        );
        $this->load->templateAdmin('ramal/listaRamalEX', $data, $dados);
    }
}
