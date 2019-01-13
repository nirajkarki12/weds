<?php
session_start();
require_once('../config/db.php');

if(!isset($_SESSION['loggedIn'])){
	header("location: login.php");
}

if(isset($_GET['id']) && $_GET['id'] !== ''){
	$id = $_GET['id'];
	$query = "SELECT * FROM banner WHERE id = $id";
	$banner = db::getInstance()->getResult($query);

	if($banner && $banner['id'] !== ''){
		$id = $banner['id'];
		$msg = '';
		$imageName = $banner['image'];
		$delQuery = "DELETE FROM banner WHERE id = '$id'";
		if(db::getInstance()->dbquery($delQuery)){
      	unlink("../banner/" . $imageName);
			$msg = "Banner deleted successfully";
			$status = "success";
		}else{
			$status = "error";
		}
		header("location:banner.php?status=$status&msg=$msg");

	}else{
			header("location:banner.php");
	}

}else{
	header("location:banner.php");
}
