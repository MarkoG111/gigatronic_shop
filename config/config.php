<?php
define("BASE_URL", "http://localhost/Gigatronic_Shop/");

define("ABSOLUTE_PATH", $_SERVER["DOCUMENT_ROOT"] . "/Gigatronic_Shop/");

define("ERRORS_FILE", ABSOLUTE_PATH . "data/errors.txt");
define("LOGIN_FILE", ABSOLUTE_PATH . "data/login.txt");
define("LOG_ACESS_FILE", ABSOLUTE_PATH . "data/log_access.txt");

define("ENV_FILE", ABSOLUTE_PATH . "config/.env");

define("DBNAME", env("DBNAME"));
define("SERVER", env("SERVER"));
define("USERNAME", env("USERNAME"));
define("PASSWORD", env("PASSWORD"));


function env($param) {
  $open = fopen(ENV_FILE, "r");

  $data = file(ENV_FILE);

  $string = "";
  foreach ($data as $key => $value) {
    $config = explode("=", $value);
    if ($config[0] == $param) {
      $string = trim($config[1]);
    }
  }

  fclose($open);

  return $string;
}