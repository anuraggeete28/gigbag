<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Kolkata");
class User extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$this->loadview('home','','Home');
	}
	public function about()
	{
		$this->loadview('about','','About');
	}
	public function loadview($view, $data = '', $page)
	{
		$headerData['page'] = $page;
		$this->load->view('layout/header', $headerData);
		$this->load->view($view, $data);
		$this->load->view('layout/footer',$headerData);
	}
}