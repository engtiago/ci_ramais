<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_instrucoes extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('Auth_helper');
        Autentica($this);
        $this->load->model('Blog_model');
    }

    /*Area interna view
    ########################################## */
    public function novopost()
    {
        $data['title']    =    "Admin Instruções";
        $data['description']    =    "Instruções";
        $dados = array(
            'post_blog' => null,
            'formsubmit' => 'Admin_instrucoes/function_novoPost'
        );
        $this->load->templateAdmin('blog/formBlog', $data, $dados);
    }

    public function verEditPost($id_post_blog)
    {
        $data['title']    =    "Admin Instruções";
        $data['description']    =    "Instruções";;

        $post_blog = $this->Blog_model->buscaPostId($id_post_blog);
        $dados = array(
            'post_blog' => $post_blog,
            'formsubmit' => 'Admin_instrucoes/function_editPost'
        );
        $this->load->templateAdmin('blog/formBlog', $data, $dados);
    }

    public function listaPostsBlog($order_by = 'id_post_blog', $pesquisa = 'all')
    {
        if ($this->input->post()) {
            $pesquisa = $this->input->post('titulo_post_blog');
        }

        $this->load->library('pagination');
        $data['title']    =    "Marizafoods | Lista de posts do blog";
        $data['description']    =    "Lista de posts do blog";
        $page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
        $config = array(
            "base_url" => base_url() . "Admin_instrucoes/listablog/$order_by/$pesquisa",
            "total_rows" => $this->Blog_model->buscaTudoPost(100000000, 0, $order_by, $pesquisa)->num_rows(),
            "per_page" => 15,
            "uri_segment" => 5
        );
        $config = array_merge($config, $this->load->configPagination());
        $this->pagination->initialize($config);
        $post_blog = $this->Blog_model->buscaTudoPost($config["per_page"], $page, $order_by, $pesquisa, 'ASC')->result_array();
        $dados = array(
            'post_blog' => $post_blog,
            'links' => $this->pagination->create_links(),
            'pesquisa' => $pesquisa
        );
        $this->load->templateAdmin('blog/listaBlog', $data, $dados);
    }

    /*Area interna functions receitas
    ########################################## */
    public function function_novoPost()
    {
        $post_postblog = $this->input->post();
        $rules    =    array(
            array(
                'field'    =>    'titulo_post_blog',
                'label'    =>    'Titulo',
                'rules'    =>    'trim|is_unique[post_blog.titulo_post_blog]|required|min_length[3]|max_length[1000]'
            ),
            array(
                'field'    =>    'categoria_post_blog',
                'label'    =>    'Categoria',
                'rules'    =>    'trim|required|min_length[3]|max_length[255]'
            ),
            array(
                'field'    =>    'texto_post_blog',
                'label'    =>    'Texto do Blog',
                'rules'    =>    'trim|required|min_length[3]|max_length[10000]'
            )
        );
        $this->form_validation->set_rules($rules);
        $validacaoForm = $this->form_validation->run();
        if ($validacaoForm) {
            if ($this->UploadFile('img_post_blog')) {
                $post_blog = array(
                    "titulo_post_blog" => $post_postblog["titulo_post_blog"],
                    "categoria_post_blog" => $post_postblog["categoria_post_blog"],
                    "texto_post_blog" => $post_postblog["texto_post_blog"],
                    "pessoa_id_pessoa" => $this->session->userdata("usuario_logado")['id_pessoa'],
                    "data_post_blog" => date("Y-m-d", time()),
                    'img_post_blog' => $this->upload->file_name
                );
                $this->Blog_model->salvaPost($post_blog);
                $this->session->set_flashdata('alert', array(
                    'tipo' => 'success',
                    'strongMsg' => '<i class="fas fa-check"></i> Sucesso',
                    'msg' => 'Novo Post inserido'
                ));
            } else {
                $post_blog = array(
                    "titulo_post_blog" => $post_postblog["titulo_post_blog"],
                    "categoria_post_blog" => $post_postblog["categoria_post_blog"],
                    "texto_post_blog" => $post_postblog["texto_post_blog"],
                    "pessoa_id_pessoa" => $this->session->userdata("usuario_logado")['id_pessoa'],
                    "data_post_blog" => date("Y-m-d", time()),
                    'img_post_blog' => null,
                );
                $this->Blog_model->salvaPost($post_blog);
                $this->session->set_flashdata('alert', array(
                    'tipo' => 'warning',
                    'strongMsg' => '<i class="fas fa-check"></i> Salvo com Sucesso',
                    'msg' => $this->upload->display_errors()
                ));
            }
           redirect(base_url() . 'Admin_instrucoes/listaPostsBlog');
        } else {

            $this->session->set_flashdata('alert', array(
                'tipo' => 'danger',
                'strongMsg' => '<i class="fas fa-times"></i> Erro',
                'msg' => validation_errors()
            ));
            redirect(base_url() . 'Admin_instrucoes/novopost');
        }
    }


    public function function_editPost()
    {
        $post_postblog = $this->input->post();

        $rules    =    array(
            array(
                'field'    =>    'id_post_blog',
                'label'    =>    'ID Post',
                'rules'    =>    'trim|required|integer'
            ),
            array(
                'field'    =>    'titulo_post_blog',
                'label'    =>    'Titulo',
                'rules'    =>    "trim|required|min_length[3]|max_length[1000]"
            ),
            array(
                'field'    =>    'categoria_post_blog',
                'label'    =>    'Categoria',
                'rules'    =>    'trim|required|min_length[3]|max_length[255]'
            ),
            array(
                'field'    =>    'texto_post_blog',
                'label'    =>    'Texto do Blog',
                'rules'    =>    'trim|required|min_length[3]|max_length[10000]'
            )
        );
        $this->form_validation->set_rules($rules);
        $validacaoForm = $this->form_validation->run();
        if ($validacaoForm) {
            if ($this->UploadFile('img_post_blog')) {
                $post_blog = array(
                    "id_post_blog" => $post_postblog["id_post_blog"],
                    "titulo_post_blog" => $post_postblog["titulo_post_blog"],
                    "categoria_post_blog" => $post_postblog["categoria_post_blog"],
                    "texto_post_blog" => $post_postblog["texto_post_blog"],
                    "pessoa_id_pessoa" => $this->session->userdata("usuario_logado")['id_pessoa'],
                    "data_post_blog" => date("Y-m-d", time()),
                    'img_post_blog' => $this->upload->file_name
                );
                $this->Blog_model->editarPost($post_blog);
                $this->session->set_flashdata('alert', array(
                    'tipo' => 'success',
                    'strongMsg' => '<i class="fas fa-check"></i> Sucesso',
                    'msg' => 'Receita editada'
                ));
            } else {
                $post_blog = array(
                    "id_post_blog" => $post_postblog["id_post_blog"],
                    "titulo_post_blog" => $post_postblog["titulo_post_blog"],
                    "categoria_post_blog" => $post_postblog["categoria_post_blog"],
                    "texto_post_blog" => $post_postblog["texto_post_blog"],
                    "pessoa_id_pessoa" => $this->session->userdata("usuario_logado")['id_pessoa'],
                    "data_post_blog" => date("Y-m-d", time()),
                    'img_post_blog' => $post_postblog["img_post_blog"],
                );
                $this->Blog_model->editarPost($post_blog);
                $this->session->set_flashdata('alert', array(
                    'tipo' => 'warning',
                    'strongMsg' => '<i class="fas fa-check"></i> Editado com Sucesso',
                    'msg' => $this->upload->display_errors()
                ));
            }
            redirect(base_url() . 'Admin_instrucoes/listaPostsBlog');
        } else {
            $this->session->set_flashdata('alert', array(
                'tipo' => 'danger',
                'strongMsg' => '<i class="fas fa-times"></i> Erro',
                'msg' => validation_errors()
            ));
            redirect(base_url() . 'Admin_instrucoes/verEditPost/' . $post_postblog["id_post_blog"]);
        }
    }

    public function function_deletarPost($id_post_blog)
    {
        $post = $this->Blog_model->buscaPostId($id_post_blog);
        if ($this->Blog_model->deletePost($id_post_blog)) {
            unlink("./upload/blog/{$post['img_post_blog']}");
            $this->session->set_flashdata('alert', array(
                'tipo' => 'success',
                'strongMsg' => '<i class="fas fa-check"></i> Sucesso',
                'msg' => 'Receita deletada'
            ));
        } else {
            $this->session->set_flashdata('alert', array(
                'tipo' => 'danger',
                'strongMsg' => '<i class="fas fa-times"></i> Erro',
                'msg' => 'Erro ao excluir Receita'
            ));
        }
        redirect(base_url() . 'Admin_instrucoes/listaPostsBlog');
    }

    private function UploadFile($inputFileName)
    {
        $config = array(
            "upload_path" =>  'upload/blog',
            "allowed_types" => "jpg|jpeg|png|bmp|gif",
            "max_size" => "2048",
            "max_filename" => "255",
            "file_name" => md5(microtime() . url_title('foto-post-blog'))
        );
        $this->load->library('upload', $config);
        return $this->upload->do_upload($inputFileName);
    }
}
