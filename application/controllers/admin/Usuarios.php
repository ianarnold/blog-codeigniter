<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();
	}

	public function index()
	{

		if(!$this->session->userdata('logado')) {
			redirect(base_url('admin/login'));
		}

		$this->load->library('table');
		$this->load->model('usuarios_model', 'modelusuarios');
		$dados['usuarios'] = $this->modelusuarios->listar_autores();


		// Dados a serem enviado para o cabeçalho
		$dados['titulo'] = 'Painel de controle';
		$dados['subtitulo'] = 'Usuários';

		$this->load->view('backend/template/html-header', $dados);
		$this->load->view('backend/template/template');
		$this->load->view('backend/usuarios');
		$this->load->view('backend/template/html-footer');
	}

	public function inserir()
	{
		if(!$this->session->userdata('logado')) {
			redirect(base_url('admin/login'));
		}

		$this->load->model('usuarios_model', 'modelusuarios');


		$this->load->library('form_validation');
		$this->form_validation->set_rules('txt-nome', 'Nome do Usuário',
			'required|min_length[3]');
		$this->form_validation->set_rules('txt-email', 'Email',
			'required|valid_email|is_unique[usuario.email]');
		$this->form_validation->set_rules('txt-historico', 'Histórico',
			'required|min_length[20]');
		$this->form_validation->set_rules('txt-user', 'User',
			'required|min_length[3]|is_unique[usuario.user]');
		$this->form_validation->set_rules('txt-senha', 'Senha',
			'required|min_length[3]');
		$this->form_validation->set_rules('txt-confir-senha', 'Confirmação de senha',
			'required|matches[txt-senha]');

		if($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			$nome = $this->input->post('txt-nome');
			$email = $this->input->post('txt-email');
			$historico = $this->input->post('txt-historico');
			$user = $this->input->post('txt-user');
			$senha = $this->input->post('txt-senha');
			if($this->modelusuarios->adicionar($nome, $email, $historico, $user, $senha)) {
				redirect(base_url('admin/usuarios'));
			} else {
				echo "Houve um erro no sistema!";
			}
		}
	}

	public function excluir($id)
	{
		if(!$this->session->userdata('logado')) {
			redirect(base_url('admin/login'));
		}

		$this->load->model('usuarios_model', 'modelusuarios');

		if($this->modelusuarios->excluir($id)) {
			redirect(base_url('admin/usuarios'));
		} else {
			echo "Houve um erro no sistema!";
		}
	}

	public function alterar($id)
	{
		if(!$this->session->userdata('logado')) {
			redirect(base_url('admin/login'));
		}
		$this->load->model('usuarios_model', 'modelusuarios');

		$dados['usuarios'] = $this->modelusuarios->listar_usuario($id);
		// Dados a serem enviado para o cabeçalho
		$dados['titulo'] = 'Painel de controle';
		$dados['subtitulo'] = 'Usuários';

		$this->load->view('backend/template/html-header', $dados);
		$this->load->view('backend/template/template');
		$this->load->view('backend/alterar-usuario');
		$this->load->view('backend/template/html-footer');
	}

	public function salvar_alteracoes()
	{
		if(!$this->session->userdata('logado')) {
			redirect(base_url('admin/login'));
		}

		$this->load->model('usuarios_model', 'modelusuarios');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txt-nome', 'Nome do Usuário',
			'required|min_length[3]');
		$this->form_validation->set_rules('txt-email', 'Email',
			'required|valid_email|is_unique[usuario.email]');
		$this->form_validation->set_rules('txt-historico', 'Histórico',
			'required|min_length[20]');
		$this->form_validation->set_rules('txt-user', 'User',
			'required|min_length[3]|is_unique[usuario.user]');
		$this->form_validation->set_rules('txt-senha', 'Senha',
			'required|min_length[3]');
		$this->form_validation->set_rules('txt-confir-senha', 'Confirmação de senha',
			'required|matches[txt-senha]');

		if($this->form_validation->run() == FALSE) {
			$this->alterar();
		} else {
			$nome = $this->input->post('txt-nome');
			$email = $this->input->post('txt-email');
			$historico = $this->input->post('txt-historico');
			$user = $this->input->post('txt-user');
			$senha = $this->input->post('txt-senha');
			$id = $this->input->post('txt-id');
			if($this->modelusuarios->alterar($nome, $email, $historico, $user, $senha, $id)) {
				redirect(base_url('admin/usuarios'));
			} else {
				echo "Houve um erro no sistema!";
			}
		}
	}

	public function page_login()
	{
		// Dados a serem enviado para o cabeçalho
		$dados['titulo'] = 'Painel de controle';
		$dados['subtitulo'] = 'Entrar no sistema';

		$this->load->view('backend/template/html-header', $dados);
		$this->load->view('backend/login');
		$this->load->view('backend/template/html-footer');
	}

	public function login()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txt-user', 'Usuário',
			'required|min_length[3]');
		$this->form_validation->set_rules('txt-senha', 'Senha',
			'required|min_length[3]');
		if($this->form_validation->run() == FALSE) {
			$this->page_login();
		} else {
			$usuario= $this->input->post('txt-user');
			$senha= $this->input->post('txt-senha');
			$this->db->where('user', $usuario);
			$this->db->where('senha', md5($senha));
			$userLogado = $this->db->get('usuario')->result();
			if (count($userLogado) == 1) {
				$dadosSessao['userLogado'] = $userLogado[0];
				$dadosSessao['logado'] = TRUE;
				$this->session->set_userdata($dadosSessao);
				redirect(base_url('admin'));
			} else {
				$dadosSessao['userLogado'] = NULL;
				$dadosSessao['logado'] = FALSE;
				$this->session->set_userdata($dadosSessao);
				redirect(base_url('admin/login'));
			}
		}
	}

	public function logout()
	{
		$dadosSessao['userLogado'] = NULL;
		$dadosSessao['logado'] = FALSE;
		$this->session->set_userdata($dadosSessao);
		redirect(base_url('admin/login'));	
	}


}
