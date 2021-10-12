
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class berita extends CI_Controller
{
    public function olahraga()
    {

        $data['akunku'] = $this->db->get_where('akunku', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('berita/olahraga', $data);
        $this->load->view('templates/footer');
    }

    public function bisnis()
    {

        $data['akunku'] = $this->db->get_where('akunku', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('berita/bisnis', $data);
        $this->load->view('templates/footer');
    }

    public function kesehatan()
    {

        $data['akunku'] = $this->db->get_where('akunku', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('berita/kesehatan', $data);
        $this->load->view('templates/footer');
    }
}
