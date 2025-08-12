<?php
// This is a debug file to check what's in the session
session_start();
echo "<pre>";
print_r($_SESSION);
echo "</pre>";
echo "If you can see user information above, make note of the variable name that contains the user ID";
?>
