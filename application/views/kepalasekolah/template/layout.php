<?php
$data = [
  'title' => $title,
  'index' => $index
];
$this->load->view('kepalasekolah/template/header', $data);
$this->load->view('kepalasekolah/template/navbar');
$this->load->view('kepalasekolah/template/sidebar', $data);
$this->load->view($content);
$this->load->view('kepalasekolah/template/footer');
