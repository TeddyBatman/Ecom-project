<?php
class LoginController extends Controller{
	public function index(){
		//display the login form and process user input
		if(isset($_POST['action'])){
			$theUser = $this->model('User')->findUser($_POST['username']);
			if($theUser !=null && password_verify($_POST['password'], $theUser->password_hash)){
				$_SESSION['user_id'] = $theUser->user_id;
				$_SESSION['role'] = $theUser->role;
				header('location:/product/index');
			}else{
				$this->view('login/index','Incorrect username/password.');
			}
		}else
			$this->view('login/index');
	}

	public function register(){
		//display the register form and process new registration
		if(isset($_POST['action'])){
			$newUser = $this->model('User');
			$theUser = $newUser->findUser($_POST['username']);
			if($theUser == null && $_POST['password'] == $_POST['password_confirm']){
				$newUser->username = $_POST['username'];
				$newUser->password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
				$newUser->create();
				header('location:/login/index');
			}
			$this->view('login/register','Username already in use or password does not match');
		}else
			$this->view('login/register');
	}

	public function logout(){
		//process logout requests
		session_destroy();
		header('location:/login/index');
	}
}
?>