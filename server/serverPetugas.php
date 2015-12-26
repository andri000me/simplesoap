<?php 

require_once '../lib/nusoap.php';

$targetNamespace = 'http://localhost/simplesoap/server/';

$serverPetugas = new soap_server();

$serverPetugas->configureWSDL('find',$targetNamespace);
$serverPetugas->configureWSDL('all',$targetNamespace);
$serverPetugas->configureWSDL('store',$targetNamespace);
$serverPetugas->configureWSDL('update',$targetNamespace);
$serverPetugas->configureWSDL('delete',$targetNamespace);

$serverPetugas->wsdl->schemaTargetNamespace = $targetNamespace;

$serverPetugas->register(
	'find',
	[
		'id'		=> 'xsd:string'
	],
	[
		'return'	=> 'xsd:Array'
	]
);

$serverPetugas->register(
	'all',
	[
		'param'		=> 'xsd:string'
	],
	[
		'return'	=> 'xsd:Array'
	]
);

$serverPetugas->register(
	'update',
	[	
		'id'		=> 'xsd:string',
		'name'		=> 'xsd:string',
		'address'	=> 'xsd:string',
		'age'		=> 'xsd:string',
		'phone'		=> 'xsd:string'
	],
	[
		'return'	=> 'xsd:string'
	],
	$targetNamespace
);

$serverPetugas->register(
	'store',
	[
		'name'		=> 'xsd:string',
		'address'	=> 'xsd:string',
		'age'		=> 'xsd:string',
		'phone'		=> 'xsd:string'
	],
	[
		'return'	=> 'xsd:string'
	],
	$targetNamespace
);

$serverPetugas->register(
	'delete',
	[
		'id'		=> 'xsd:string'
	],
	[
		'return'	=> 'xsd:string'
	]
);


function find($id)
{
	$con = mysqli_connect('localhost','root','marwek','trying');

	$query = "SELECT * FROM human WHERE id = '{$id}'";

	$result = mysqli_query($con,$query);

	$row = mysqli_fetch_assoc($result);

	return $row;
}


function all($param)
{
	$con = mysqli_connect('localhost','root','marwek','trying');

	$query = "SELECT * FROM human WHERE name LIKE '%$param%'";

	$result = mysqli_query($con,$query);

	$data = [];

	while ($all = mysqli_fetch_assoc($result)) 
	{
		$data[] = $all;
	}

	return $data;	
}

function store($name,$address,$age,$phone)
{
	$con = mysqli_connect('localhost','root','marwek','trying');

	$query = "INSERT INTO human (name,address,age,phone) VALUES ('{$name}','{$address}','{$age}','{$phone}')";

	$result = mysqli_query($con,$query);

	if ($result) 
	{
		return TRUE;
	}
	else
	{
		return FALSE;
	}	
}

function update($id,$name,$address,$age,$phone)
{
	$con = mysqli_connect('localhost','root','marwek','trying');

	$query = "UPDATE 
				human 
			  SET 
			  	name 	= '{$name}',
			  	address = '{$address}',
			  	age 	= '{$age}',
			  	phone	= '{$phone}'
			  WHERE 
			  	id 		= '{$id}'";

	$result = mysqli_query($con,$query);

	if ($result) 
	{
		return TRUE;
	}
	else
	{
		return FALSE;
	}	
}

function delete($id)
{
	$con = mysqli_connect('localhost','root','marwek','trying');

	$query = "DELETE FROM human WHERE id = '{$id}'";

	$result = mysqli_query($con,$query);

	if ($result) 
	{
		return TRUE;
	}
	else
	{
		return FALSE;
	}	
}

$rawPostData = file_get_contents('php://input');

$serverPetugas->service($rawPostData);