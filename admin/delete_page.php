<?php
session_start();
require_once('../config/db.php');
   
if(!isset($_SESSION['loggedIn'])){
  header("location: login.php");
}

if(isset($_GET['id']) && $_GET['id'] !== ''){
	$id = $_GET['id'];
	$query = "SELECT * FROM pages WHERE id = $id";
	$page = db::getInstance()->getResult($query);

	if(strtolower($page['title']) === 'home'){
		header("location:pages.php");
	}

  if($page && $page['id'] !== ''){
		$id = $page['id'];
		$msg = '';
		$delQuery = "DELETE FROM pages WHERE id = '$id'";
		if(db::getInstance()->dbquery($delQuery)){
			$msg = "Page deleted successfully";
			$status = "success";
		}else{
			$status = "error";
		}
		header("location:pages.php?status=$status&msg=$msg");

	}else{
  		header("location:pages.php");
	}

}else{
	header("location:pages.php");
}
