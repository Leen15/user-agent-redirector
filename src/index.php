<?php
require_once('Mobile_Detect.php');
$detect = new Detection\Mobile_Detect;

header("Content-Type: text/plain");

// normalize path requested
$current_path = $_SERVER['REQUEST_URI'];
$current_path = str_replace("/", "", $current_path);
$current_path = str_replace("-", "_", $current_path);
$current_path = strtoupper($current_path) . "_";

// find envs to use with the current path
$envs = array_filter($_ENV, function($k) {
  global $current_path;
  if ($current_path == "_" && 
    ($k == "IOS_URL" || 
    $k == "ANDROID_URL" || 
    $k == "HUAWEI_URL" || 
    $k == "FALLBACK_URL" )) {
    return true;
  }
  return substr($k, 0, strlen($current_path)) === $current_path;
}, ARRAY_FILTER_USE_KEY);


if (count($envs) == 0) {
  die("sorry, path not supported (" . $current_path . ")");
}

$key = "";
if ( $detect->is('iOS') ) {
  $key = "IOS_URL";
}
else if ( $detect->match('HMSCore')) {
  $key = "ANDROID_URL";
}
else if ( $detect->is('AndroidOS') ) {
  $key = "HUAWEI_URL";
}
else {
  $key = "FALLBACK_URL";
}

$redirect_url = $envs[$current_path . $key];

if (getenv("DEBUG") && getenv("DEBUG") == 'true') {
  echo "PATH: " . $current_path . PHP_EOL;
  echo "ENVS: ";
  var_dump($envs);
  echo "KEY FOUND: " . $key . PHP_EOL;
  echo "REDIRECT TO: " . $redirect_url . PHP_EOL;
}
else {
  header("Location: $redirect_url", true, 302);
}

