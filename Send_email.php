<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Send_email extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$obj = null;//require obj;
		$this->send($obj);
	}

	public function send($obj){
		
		// Change this thing in sender gmail setting	
		// A: At security tab sign-in section is there, find 2-step verification and disable it.
		// B: In Account permissions section, find  Access for less secure apps and enable it.

		// Please change this line in you ini.php file		
		// Find the line.
		// ;extension=php_openssl.dll
		// // Remove  ";" from this line to enable
		// extension=php_openssl.dll
		// Save and restart all services
		// ssl service  is enable

		// The mail sending protocol.
		$config['protocol'] = 'smtp';
		// SMTP Server Address for Gmail.
		$config['smtp_host'] = "ssl://smtp.googlemail.com";//smtp.googlemail.com
		// SMTP Port - the port that you is required
		$config['smtp_port'] = 465;
		// SMTP Username like. (abc@gmail.com)
		$config['smtp_user'] = $obj->sender_email;
		// SMTP Password like (abc***##)
		$config['smtp_pass'] = $obj->sender_epassword;
		$config['mailtype'] = 'html';
		$config['starttls'] = true;
		$config['newline']  = "\r\n";

		// Load email library and passing configured values to email library
		$this->load->library('email', $config);
		// Sender email address
		$this->email->from("myoothu.jva@gmial.com","Thura");
		// Receiver email address.for single email
		//send multiple email
		$this->email->to($obj->to_email);
		// Subject of email
		$this->email->subject($obj->title);
		// Message in email
		$this->email->message($obj->message);
		// It returns boolean TRUE or FALSE based on success or failure
		$res = $this->email->send(); 
		echo $this->email->print_debugger();
	}
}
