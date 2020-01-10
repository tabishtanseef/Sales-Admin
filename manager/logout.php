<?php
ob_start();
session_start();
if(isset($_SESSION['manager_id'])) {
	session_destroy();
	unset($_SESSION['manager_id']);
	unset($_SESSION['manager_id']);
	header("Location: index.php");
} else {
	header("Location: index.php");
}
?>