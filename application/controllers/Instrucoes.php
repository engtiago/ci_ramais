<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Instrucoes  extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('Auth_helper');
		Autentica($this , true);
        $this->load->model('Blog_model');
        // $this->output->enable_profiler(TRUE);
    }

    /*Area externa
    ########################################## */
    public function ver($pesquisa ='all')
    {
        if($this->input->post()){
            $pesquisa = $this->input->post('titulo_post_blog');
         }
         $pesquisa = urldecode($pesquisa);
       
        $this->load->library('pagination');
        $data['title']    =    "Instruções";
        $data['description']    =    "Instruções";

        $config = array(
            "base_url" => base_url() . "blog/ver/$pesquisa/",
            "total_rows" => intval($this->Blog_model->buscaTudoPost(100000, 0,'id_post_blog', $pesquisa)->num_rows()),
            "per_page" => 3,
            "uri_segment" => 4
        );
        $config = array_merge($config, $this->load->configPagination());
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $post_blog = $this->Blog_model->buscaTudoPost($config["per_page"], $page,'id_post_blog', $pesquisa);
        $dados = array(
            'post_blog' => $post_blog->result_array(),
            'links' => $this->pagination->create_links()
        );
        $this->load->templateAdmin('blog/blog', $data, $dados);
    }

}
