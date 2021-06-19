<?php
require $_SERVER['DOCUMENT_ROOT'] . "/php/session.php";

logout();
header("Location:index.php");
