<?php
$password = "lahore123"; // Replace this with the actual password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
echo "Hashed Password: " . $hashed_password;
?>