<?php
session_start();
unset($_SESSION['kpl']);

echo "<script>window.location='../login.php';</script>";
?> 