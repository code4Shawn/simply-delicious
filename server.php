<?php 

include ("connection.php");
session_start();

#REGISTER CODE...

if (isset($_POST['register'])) {
	$passwd= $_POST['pass'];
	$confirm= $_POST['conpass'];

	if ($passwd == $confirm) {
		$sql= "INSERT INTO  customer (Name, Email, Password, Type, username) VALUES ('".$_POST['name']."','".$_POST['email']."','".$passwd."','".$_POST['user']."','".$_POST['sname']."')";

		if ($conn->query($sql) == TRUE) {
			$_SESSION['register_con'] = "Successful!";
			header("location: login.php");
			echo "register_fail";
			die();
		}
	}
	else{
		$_SESSION['register_fail'] = "Passwords don't match!";
		header("location: register.php");
		die();
	}
	$conn->close();
}

#LOGIN CODE...

if (isset($_POST['login'])) {
	$sql="SELECT * FROM customer WHERE username ='".$_POST['sname']."'";
	$grab = $conn->query($sql);
	if ($grab != TRUE) {
			$_SESSION['sign_in'] = "Invalid credentials!";
			header("location: home.php");
			die();
	}

	$data=$grab->fetch_assoc();
	$user=$data['type'];
	$pass=$data['pass'];
	if (isset($_POST['pass']) && $_POST['pass'] == $pass) {
		if ($user == "Admin") {
			$_SESSION['uid'] = $data['id'];
			$_SESSION['user'] = $data['sname'];
			$_SESSION['type'] = $user;
			header("location: home.php");
			die();
		}
		else{
			$_SESSION['user'] = $data['sname'];
			$_SESSION['type'] = $user;
			$_SESSION['uid'] = $data['id'];
			header("location: home.php");
			die();
		}
	}else{
		$_SESSION['sign_in'] = "Invalid credentials!";
		header("location: home.php");
	}
	$conn->close();
	
}

#LOGOUT CODE...

if (isset($_GET['out'])) {
	unset($_SESSION['user']);
	unset($_SESSION['type']);
	header("location: login.php");
}

# ADD ITEM CODE...

if (isset($_POST['order'])) {
	$sql = "INSERT INTO orders (item,pic,price) VALUES ('".$_POST['item']."','".$_POST['pic']."','".$_POST['price']."')";
	if ($conn->query($sql) == TRUE) {
		$_SESSION['update_con'] = "Item added successfully";
    	header("location: menu.php");
		die();
	}
	else{
		$_SESSION['update_con'] = "Couldn't add Item!";
    	header("location: menu.php");
		die();
	}
	$conn-> close();
}
