<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();

		$this->load->model('categorias_model', 'modelcategorias');
		$this->categorias = $this->modelcategorias->listar_categorias();
	}

	public function index($id, $nome ,$next = null, $posts_per_page = null)
	{

		$this->load->model('publicacoes_model', 'modelpublicacoes');
		$this->load->library('pagination');
		$config['base_url'] = base_url('categoria/'.$id.'/'.$nome);
		$config['total_rows'] = $this->modelpublicacoes->countPostsCat($id);
		$posts_per_page = 2;
		$config['per_page'] = $posts_per_page;
		$this->pagination->initialize($config);
		$dados['links_pagination'] = $this->pagination->create_links();


		$dados['categorias'] = $this->categorias;
		// Carregando a model de publicacoes

		$dados['postagem'] = $this->modelpublicacoes->categoria_pub($id, $next, $posts_per_page);
		//////////////////////////////////////////////////////////////////

		// Dados a serem enviado para o cabeçalho
		$dados['titulo'] = 'Categorias';
		$dados['subtitulo'] = '';
		$dados['subtitulodb'] = $this->modelcategorias->listar_titulo($id);
		///////////////////////////////////////////

		$this->load->view('frontend/template/html-header', $dados);
		$this->load->view('frontend/template/header');
		$this->load->view('frontend/categoria');
		$this->load->view('frontend/template/aside');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');
	}

}
