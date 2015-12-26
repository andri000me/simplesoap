<?php 

$page = $_GET['page'] ?? null;

if ($page == null) 
{
	require_once 'app/Auth.php';	
}
else
{
	$realPage = ucfirst($page);

	require_once 'app/'.$realPage.'.php';


}