<?php
session_start();
if(!isset($_SESSION['idadmin']))
{
    header("Location:index.php");
}
