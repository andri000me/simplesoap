<?php 

require_once '../lib/nusoap.php';

$targetNamespace = 'http://localhost/simplesoap/server/';

$serverAuth = new soap_server();

$serverAuth->configureWSDL('Validate',$targetNamespace);

$serverAuth->wsdl->schemaTargetNamespace = $targetNamespace;

$serverAuth->register(
	'Validate',
	
	[
		'username'	=> 'xsd:string',
		'password'	=> 'xsd:string'
	],
	
	[
		'return'	=> 'xsd:Array'
	],

	$targetNamespace
);

	
	function Validate($username,$password)
	{
		$connection = mysqli_connect(
			'localhost',
			'root',
			'marwek',
			'trying'
		);
		
		$query 		= "SELECT user_alias,user_name,user_level FROM users WHERE user_name = '{$username}'";

		$result 	= mysqli_query($connection,$query);

		$numsRow 	= mysqli_num_rows($result);

		if ($numsRow == 1) 
		{			
			$row   		= mysqli_fetch_assoc($result);

			return $row;
		}
		else
		{
			return 'Fails';
		}	

	}

$rawPostData = file_get_contents('php://input');
$serverAuth->service($rawPostData);