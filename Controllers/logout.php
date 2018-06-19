<?php

require "check_auth.php";

session_destroy();

header("Location: ../Views/login.php");


?>