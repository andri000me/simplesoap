<?php 

session_start();

$action = $_GET['action'] ?? '';

require_once 'lib/nusoap.php';

$objPetugas =  new nusoap_client('http://localhost/simplesoap/server/serverPetugas.php');

switch ($action) 
{
	case 'create':
		
		require_once 'app/html/view.create.php';

		break;

	case 'store':
		
		$getData = [
			'name'		=> $_POST['_name'],
			'address'	=> $_POST['_address'],
			'age'		=> $_POST['_age'],
			'phone'		=> $_POST['_phone'],
		];

		$response = $objPetugas->call('store',$getData);

		if ($response !== FALSE) 
		{
			echo "Data baru sudah disimpan <a href=?page=petugas> >>Lihat </a>";
		}

		break;

	case 'edit':
		
		$getId = isset($_GET['id']) ? $_GET['id'] : null;

		$param = [
			'id'	=> $getId
		];

		$response = $objPetugas->call('find',$param);

		require_once 'app/html/view.edit.php';

		break;	

	case 'update':

		$getData = [
			'id'		=> $_POST['_id'],
			'name'		=> $_POST['_name'],
			'address'	=> $_POST['_address'],
			'age'		=> $_POST['_age'],
			'phone'		=> $_POST['_phone'],
		];

		$response = $objPetugas->call('update',$getData);

		if ($response !== FALSE) 
		{
			echo "Data sudah diubah <a href=?page=petugas> >>Lihat </a>";
		}

		break;	
	case 'delete':
		
		$getId = isset($_GET['id']) ? $_GET['id'] : null;

		$param = [
			'id'	=> $getId
		];

		$response = $objPetugas->call('delete',$param);

		if ($response !== FALSE) 
		{
			echo "Data sudah hapus <a href=?page=petugas> >>Lihat </a>";
		}

		break;		
	
	default:
		
		$param = null;

		$response = $objPetugas->call('all',['param' => $param]);

		require_once 'app/html/view.show.php';

		break;
}