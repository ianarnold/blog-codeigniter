<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Publicacao extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();

		if(!$this->session->userdata('logado')) {
			redirect(base_url('admin/login'));
		}
		
		$this->load->model('publicacoes_model', 'modelpublicacao');
		$this->load->model('categorias_model', 'modelcategorias');
		$this->categorias = $this->modelcategorias->listar_categorias();


	}

	public function index($next = null, $posts_per_page = null)
	{
		$this->load->library('table');
		$this->load->library('pagination');

		$config['base_url'] = base_url('admin/publicacao');
		$config['total_rows'] = $this->modelpublicacao->countPosts();
		$posts_per_page = 5;
		$config['per_page'] = $posts_per_page;

		$this->pagination->initialize($config);
		$dados['links_pagination'] = $this->pagination->create_links();


		$dados['categorias'] = $this->categorias;
		$dados['publicacoes'] = $this->modelpublicacao->listar_publicacao($next, $posts_per_page);
		// Dados a serem enviado para o cabeçalho
		$dados['titulo'] = 'Painel de controle';
		$dados['subtitulo'] = 'Publicação';

		$this->load->view('backend/template/html-header', $dados);
		$this->load->view('backend/template/template');
		$this->load->view('backend/publicacao');
		$this->load->view('backend/template/html-footer');
	}

	public function inserir()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txt-titulo', 'Título',
			'required|min_length[3]');
		$this->form_validation->set_rules('txt-subtitulo', 'Subtítulo',
			'required|min_length[3]');
		$this->form_validation->set_rules('txt-conteudo', 'Conteúdo',
			'required|min_length[20]');
		if($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			$titulo = $this->input->post('txt-titulo');
			$subtitulo = $this->input->post('txt-subtitulo');
			$conteudo = $this->input->post('txt-conteudo');
			$datapub = $this->input->post('txt-data');
			$categoria = $this->input->post('select-categoria');
			$userpub = $this->input->post('txt-usuario');
			if($this->modelpublicacao->adicionar($titulo, $subtitulo, $conteudo, $datapub, $categoria, $userpub)) {
				redirect(base_url('admin/publicacao'));
			} else {
				echo "Houve um erro no sistema!";
			}
		}
	}

	public function excluir($id)
	{
		if($this->modelpublicacao->excluir($id)) {
			redirect(base_url('admin/publicacao'));
		} else {
			echo "Houve um erro no sistema!";
		}
	}

	public function alterar($id)
	{
		$this->load->library('table');

		$dados['categorias'] = $this->modelcategorias->listar_categorias();
		$dados['publicacoes'] = $this->modelpublicacao->listar_publicacoes($id);
		// Dados a serem enviado para o cabeçalho
		$dados['titulo'] = 'Painel de controle';
		$dados['subtitulo'] = 'Alterar Publicação';

		$this->load->view('backend/template/html-header', $dados);
		$this->load->view('backend/template/template');
		$this->load->view('backend/alterar-publicacao');
		$this->load->view('backend/template/html-footer');
	}

	public function salvar_alteracoes($criptId)
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txt-titulo', 'Título',
			'required|min_length[3]');
		$this->form_validation->set_rules('txt-subtitulo', 'Subtítulo',
			'required|min_length[3]');
		$this->form_validation->set_rules('txt-conteudo', 'Conteúdo',
			'required|min_length[20]');
		if($this->form_validation->run() == FALSE) {
			$this->alterar($criptId);
		} else {
			$titulo = $this->input->post('txt-titulo');
			$subtitulo = $this->input->post('txt-subtitulo');
			$conteudo = $this->input->post('txt-conteudo');
			$datapub = $this->input->post('txt-data');
			$categoria = $this->input->post('select-categoria');
			$id = $this->input->post('txt-id');
			if($this->modelpublicacao->alterar($titulo, $subtitulo, $conteudo, $datapub, $categoria, $id)) {
				redirect(base_url('admin/publicacao'));
			} else {
				echo "Houve um erro no sistema!";
			}
			
		}
	}

	public function nova_foto()
	{
		if(!$this->session->userdata('logado')) {
			redirect(base_url('admin/login'));
		}

		$id = $this->input->post('id');
		$config['upload_path'] = './assets/frontend/img/publicacao';
		$config['allowed_types'] = 'jpg';
		$config['file_name'] = $id.".jpg";
		$config['overwrite'] = TRUE;
		$this->load->library('upload', $config);

		if(!$this->upload->do_upload()) {
			echo $this->upload->display_errors();
		} else {
			$config2['source_image'] = './assets/frontend/img/publicacao/'.$id.'.jpg';
			$config2['create_thumb'] = FALSE;
			$config2['width'] = 900;
			$config2['height'] = 300;
			$this->load->library('image_lib', $config2);
			if($this->image_lib->resize()) {
				if($this->modelpublicacao->alterar_img($id)) {
					redirect (base_url('admin/publicacao/alterar/'.$id));
				} else {
					echo "Houve um erro no sistema!";
				}
			} else {
				echo $this->image_lib->display_errors();
			}
		}
	}

}
