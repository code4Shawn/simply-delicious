<?php
	<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class users_model extends CI_Model{
//Register new client to the system
public function register($enc_password){
$data = array(
'fname' => $this->input->post('fname'),
'sname' => $this->input->post('sname'),
'phonenumber' => $this->input->post('phonenumber'),
'email' => $this->input->post('email'),
'username' => $this->input->post('username'),
'password' => $enc_password,
'password2' => $enc_password
);

//insert data to the database
return $this->db->insert('clients', $data);
}
/*
//login user
public function login($username,$password){
//validate the login
$this->db->where('username', $username);
$this->db->where('password', $password);

$result = $this->db->get('clients');

if ($result->num_rows() == 1) {
return $result->row(0)->id;
}else{
return false;
}
}*/

function can_login($uername, $password){
$this->db->where('username', $username);
$this->db->where('password', $password);
$query = $this->db->get('clients');

if ($query->num_rows() > 0) {
return true;
} else {
return false;
}

}

//Check if the username exists
public function check_username_exists($username){
$query = $this->db->get_where('clients', array('username' =>$username));
if (empty($query->row_array())) {
return true;
}else{
return false;
}
}

//Check if the email exists
public function check_email_exists($email){
$query = $this->db->get_where('clients', array('email' =>$email));
if (empty($query->row_array())) {
return true;
}else{
return false;
}
}
}
?>
?>