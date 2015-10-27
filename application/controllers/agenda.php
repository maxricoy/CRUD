<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Agenda extends CI_Controller{	

	public function insertar(){

		$persona = array(
			'nombre' => $this->input->post('nombre'),
			'edad' => $this->input->post('edad'),
			'email' => $this->input->post('email'),
			'pais' => $this->input->post('pais'),
			'telefono' => $this->input->post('telefono')
			);

		$this->load->model('agenda_model');
		if ( $this->agenda_model->insertar_persona($persona) )
			redirect('agenda');	 
	}

	public function actualizar(){
		$persona = array(
			'nombre' => $this->input->post('nombre'),
			'edad' => $this->input->post('edad'),
			'email' => $this->input->post('email'),
			'pais' => $this->input->post('pais'),
			'telefono' => $this->input->post('telefono')
			);
		$id = $this->input->post('id');

		$this->load->model('agenda_model');
		if( $this->agenda_model->actualiza_persona($id, $persona) )
			redirect('agenda');		
	}

	public function eliminar(){
		$id = $this->uri->segment(3);
		$this->load->model('agenda_model');
		if( $this->agenda_model->eliminar_persona($id) )
			redirect('agenda');
	}

	public function index(){		
		$data['title'] = 'Inicio';
		$data['main_content'] = 'inicio';

		$this->load->model('agenda_model');
		$data['personas'] = $this->agenda_model->leer_persona();		

		if( $this->uri->segment(3) != '' ){
			$id = $this->uri->segment(3);			
			$data['persona_actualizar']	= $this->agenda_model->traer_persona($id);
		}

		$this->load->view('main_template',$data);
	}		

}