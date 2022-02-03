<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OlaMundo extends CI_Controller {

	public function olaMundo()
	{
		$dados['mensagem'] = 'Ola Mundo';
		$this->load->view('olamundo', $dados);
	}

	public function teste()
	{
		$dados['mensagem'] = 'Ola teste';
		$this->load->view('olamundo', $dados);
	}

	public function testeDb()
	{
		$dados = $this->db->get('postagens')->result();
		echo "<pre>";
		print_r($dados);
	}
}
