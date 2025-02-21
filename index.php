<?php 

require __DIR__ . "/backend/vendor/autoload.php";

$url = filter_input(INPUT_GET, "url");

echo $url;