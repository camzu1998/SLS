<?php
	session_start();
    unset($_SESSION['zalogowany']);
	session_unset();
	@header('Location: index.php');
?>
