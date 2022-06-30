<?php
$data = [
  'title' => $title,
  'index' => $index
];
$this->load->view('operator/template/header', $data);
$this->load->view('operator/template/navbar');
$this->load->view('operator/template/sidebar', $data);
$this->load->view($content);
$this->load->view('operator/template/footer');
