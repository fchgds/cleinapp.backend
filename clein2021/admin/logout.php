<?php
require $_SERVER['DOCUMENT_ROOT'] . "/clein2021/php/session.php";

logout();
header("Location:index.php");
