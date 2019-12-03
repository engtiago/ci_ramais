<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Receitas extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        //$this->output->enable_profiler(TRUE);
        $this->load->model('Receita_model');
    }

    /*Area externa
    ########################################## */
    public function ver($pesquisa ='all')
    {
        if($this->input->post()){
            $pesquisa = $this->input->post('nome_receita');
            if($pesquisa == '' ){
                $pesquisa = 'all';
            }
         }
         $pesquisa = urldecode($pesquisa);
         
        $this->load->library('pagination');
        $data['title']    =    "Marizafoods | Receitas";
        $data['description']    =    "Receitas da Mariza";

        $config = array(
            "base_url" => base_url("receitas/ver/$pesquisa/"),
            "total_rows" => intval($this->Receita_model->buscaReceitalimit(100000, 0, $pesquisa)->num_rows()),
            "per_page" => 8,
            "uri_segment" => 4
        );
        $config = array_merge($config, $this->load->configPagination());
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $receitas = $this->Receita_model->buscaReceitalimit($config["per_page"], $page, $pesquisa);
        $dados = array(
            'receitas' => $receitas->result_array(),
            'links' => $this->pagination->create_links()
        );
        $this->load->template('receitas/receitas', $data, $dados);
    }

    public function receitasView($id_receita)
    {
        $data['title']    =    "Marizafoods | Receitas";
        $data['description']    =    "Receitas da Mariza";
        $receita = $this->Receita_model->buscaReceitaId($id_receita);
        $dados = array(
            'receita' => $receita
        );
        $this->load->template('receitas/receitasView', $data, $dados);
    }
}
