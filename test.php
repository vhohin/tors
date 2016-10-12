<?php
session_start();
echo "<pre>\nSESSION:\n";
print_r($_SESSION);
print_r($_SERVER);
echo "</pre>\n\n";