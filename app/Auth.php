<?php 

require_once 'lib/nusoap.php';

$action = $_GET['action'] ?? null;

switch ($action) 
{
	case 'validate':

		$userName 	= $_POST['_user'] ?? null;
		$passWord 	= $_POST['_pass'] ?? null;

		$getData = [
			'username'	=> $userName,
			'password'	=> $passWord
		];

		$objClient = new nusoap_client('http://localhost/simplesoap/server/serverAuth.php');

		$response = $objClient->call('Validate',$getData);

		if ($response !== 'Fails') 
		{
			session_start();

			$_SESSION['username'] = $response['user_name'];
			$_SESSION['useralias'] = $response['user_alias'];
			$_SESSION['userlevel'] = $response['user_level'];

			header('location:?page=petugas');
		}
				
	break;
	
	default:
		
		require_once 'app/html/form-login.php';

	break;
}



