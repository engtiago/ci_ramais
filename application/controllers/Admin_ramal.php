<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_ramal extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('Auth_helper');
        Autentica($this);
        $this->load->model('Ramal_model');
        // $this->output->enable_profiler(TRUE);
    }

    /*Area interna view
    ########################################## */
    public function novoRamal()
    {
        $data['title']    =    "Ramais | Novo Ramal";
        $data['description']    =    "Novo Ramal";
        $setor = $this->Ramal_model->buscaSetores();
        $dados = array(
            'ramal' => null,
            'setor' => $setor,
            'formsubmit' => 'Admin_ramal/function_novoRamal'
        );
        $this->load->templateAdmin('ramal/formRamal', $data, $dados);
    }

    public function verEditRamal($id_ramal)
    {
        $data['title']    =    "Ramal | Editar";
        $data['description']    =    "Edital Ramal";
        $setor = $this->Ramal_model->buscaSetores();
        $ramal = $this->Ramal_model->buscaRamalId($id_ramal);
        $dados = array(
            'ramal' => $ramal,
            'setor' => $setor,
            'formsubmit' => 'Admin_ramal/function_editRamal'
        );
        $this->load->templateAdmin('ramal/formRamal', $data, $dados);
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
            "base_url" => base_url("Admin_ramal/listaRamais/$order_by/$pesquisa"),
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
        $this->load->templateAdmin('ramal/listaRamal', $data, $dados);
    }



    /*Area interna functions 
    ########################################## */
    private function rulesRamal()
    {
        return  array(
            array(
                'field'    =>    'nome_ramal',
                'label'    =>    'Nome',
                'rules'    =>    'trim|required|min_length[3]|max_length[255]'
            ),
            array(
                'field'    =>    'numero_ramal',
                'label'    =>    'Numero',
                'rules'    =>    'trim|max_length[255]'
            ),
            array(
                'field'    =>    'email_ramal',
                'label'    =>    'Emal',
                'rules'    =>    'trim|valid_email|max_length[255]'
            ),
            array(
                'field'    =>    'setor_id_setor',
                'label'    =>    'Setor',
                'rules'    =>    'trim|required'
            )
        );
    }

    public function function_novoRamal()
    {
        $post = $this->input->post();
        $rules = $this->rulesRamal();
        $this->form_validation->set_rules($rules);
        $validacaoForm = $this->form_validation->run();
        if ($validacaoForm) {
            $ramal = array(
                "nome_ramal" => $post["nome_ramal"],
                "numero_ramal" => $post["numero_ramal"],
                "email_ramal" => $post["email_ramal"],
                "setor_id_setor" => $post["setor_id_setor"],
            );
            $this->Ramal_model->salvaRamal($ramal);
            $this->session->set_flashdata('alert', array(
                'tipo' => 'success',
                'strongMsg' => '<i class="fas fa-check"></i> Sucesso',
                'msg' => 'Novo Ramal salvo'
            ));
        } else {
            $this->session->set_flashdata('alert', array(
                'tipo' => 'danger',
                'strongMsg' => '<i class="fas fa-times"></i> Erro',
                'msg' => validation_errors()
            ));
        }
        redirect(base_url('Admin_ramal/novoRamal'));
    }

    public function function_editRamal()
    {
        $post = $this->input->post();
        $rules  = $this->rulesRamal();
        $rules[] =
            array(
                'field'    =>    'id_ramal',
                'label'    =>    'id_ramal',
                'rules'    =>    'trim|required'
            );

        $this->form_validation->set_rules($rules);
        $validacaoForm = $this->form_validation->run();
        if ($validacaoForm) {
            $ramal = array(
                "id_ramal" => $post["id_ramal"],
                "nome_ramal" => $post["nome_ramal"],
                "numero_ramal" => $post["numero_ramal"],
                "email_ramal" => $post["email_ramal"],
                "setor_id_setor" => $post["setor_id_setor"]
            );
            $this->Ramal_model->editarRamal($ramal);
            $this->session->set_flashdata('alert', array(
                'tipo' => 'success',
                'strongMsg' => '<i class="fas fa-check"></i> Sucesso',
                'msg' => 'Ramal editado'
            ));
        } else {
            $this->session->set_flashdata('alert', array(
                'tipo' => 'danger',
                'strongMsg' => '<i class="fas fa-times"></i> Erro',
                'msg' => validation_errors()
            ));
        }
        redirect(base_url("Admin_Ramal/verEditRamal/{$post["id_ramal"]}"));
    }

    public function function_deletarRamal($id_ramal)
    {
        if ($this->Ramal_model->deleteRamal($id_ramal)) {
            $this->session->set_flashdata('alert', array(
                'tipo' => 'success',
                'strongMsg' => '<i class="fas fa-check"></i> Sucesso',
                'msg' => 'Ramal deletado'
            ));
        } else {
            $this->session->set_flashdata('alert', array(
                'tipo' => 'danger',
                'strongMsg' => '<i class="fas fa-times"></i> Erro',
                'msg' => 'Erro ao excluir Ramal'
            ));
        }
        redirect(base_url('Admin_ramal/listaRamal'));
    }

    /*Area interna  categorias_receitas
    ########################################## */

    public function novoSetor()
    {
        $data['title']    =    "Setor | Cadastro ";
        $data['description']    =    "Novo Setor";
        $dados = array(
            'categoriaReceita' => null,
            'formsubmit' => 'Admin_ramal/function_novoSetor'
        );
        $this->load->templateAdmin('ramal/formSetor', $data, $dados);
    }

    public function verEditSetor($id_setor)
    {
        $data['title']    =    "Setor | Edição ";
        $data['description']    =    "Editar Setor";
        $categoriaReceita = $this->Ramal_model->buscaSetorId($id_setor);
        $dados = array(
            'categoriaReceita' => $categoriaReceita,
            'formsubmit' => 'Admin_ramal/function_editSetor'

        );
        $this->load->templateAdmin('receitas/formCategoriaReceita', $data, $dados);
    }

    public function listaSetor()
    {
        $data['title']    =    "Marizafoods | Lista de categoria de Receitas";
        $data['description']    =    "Sabor é Assim";
        $categoriaReceita = $this->Receita_model->buscaCategorias();
        $dados = array(
            'categoriaReceita' => $categoriaReceita
        );
        $this->load->templateAdmin('receitas/listaCategoriaReceita', $data, $dados);
    }

    /*Area interna functions  categoria receitas
    ########################################## */
    private function rulesSetor()
    {
        return  [
            array(
                'field' => 'noem_setor',
                'label' => 'Nome',
                'rules' =>  'trim|required|min_length[3]|max_length[255]'
            ),
            array(
                'field' => 'ramal_setor',
                'label' => 'Ramal',
                'rules' => 'trim|max_length[255]'
            )
        ];
    }

    public function function_novoSetor()
    {
        $post = $this->input->post();
        $rules = $this->rulesSetor();
        $this->form_validation->set_rules($rules);
        $validacaoForm = $this->form_validation->run();
        if ($validacaoForm) {
            $setor = array(
                "nome_setor" => $post['nome_setor'],
                "ramal_setor" => $post['ramal_setor']
            );
            $this->Receita_model->salvaSetor($setor);
            $this->session->set_flashdata('alert', array(
                'tipo' => 'success',
                'strongMsg' => '<i class="fas fa-check"></i> Sucesso',
                'msg' => 'Novo setor salvo'
            ));
        } else {
            $this->session->set_flashdata('alert', array(
                'tipo' => 'danger',
                'strongMsg' => '<i class="fas fa-times"></i> Erro',
                'msg' => validation_errors()
            ));
        }
        redirect(base_url('Admin_ramal/novoSetor'));
    }

    public function function_editSetor()
    {
        $post = $this->input->post();
        $rules = $this->rulesSetor();
        $rules[] =
            array(
                'field' => 'id_setor',
                'label' => 'id_setor',
                'rules' => 'trim|required'
            );

        $this->form_validation->set_rules($rules);
        $validacaoForm = $this->form_validation->run();
        if ($validacaoForm) {
            $setor = array(
                "id_setor" => $post['id_setor'],
                "nome_setor" => $post['nome_setor'],
                "ramal_setor" => $post['ramal_setor']
            );
            $this->Ramal_model->editarSetor($setor);
            $this->session->set_flashdata('alert', array(
                'tipo' => 'success',
                'strongMsg' => '<i class="fas fa-check"></i> Sucesso',
                'msg' => 'Setor editado'
            ));
        } else {
            $this->session->set_flashdata('alert', array(
                'tipo' => 'danger',
                'strongMsg' => '<i class="fas fa-times"></i> Erro',
                'msg' => validation_errors()
            ));
        }
        redirect(base_url('Admin_ramal/listacategoriareceitas'));
    }

    public function function_deletCategoriaReceita($id_categoria_receita)
    {
        if ($this->Receita_model->deleteCategoria($id_categoria_receita)) {
            $this->session->set_flashdata('alert', array(
                'tipo' => 'success',
                'strongMsg' => '<i class="fas fa-check"></i> Sucesso',
                'msg' => 'Categoria deletada'
            ));
        } else {
            $this->session->set_flashdata('alert', array(
                'tipo' => 'danger',
                'strongMsg' => '<i class="fas fa-times"></i> Erro',
                'msg' => 'Erro ao excluir Categoria'
            ));
        }
        redirect(base_url() . 'Admin_receitas/listacategoriareceitas');
    }

    private function UploadFile($inputFileName)
    {
        $config = array(
            "upload_path" => "upload/receita",
            "allowed_types" => "jpg|jpeg|png|bmp|gif",
            "max_size" => "2048",
            "max_filename" => "255",
            "file_name" => url_title('foto-receita')
        );
        $this->load->library('upload', $config);
        return $this->upload->do_upload($inputFileName);
    }
}
