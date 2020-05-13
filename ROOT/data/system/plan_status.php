<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET');

echo "{
  \"0\": \"Waiting\",
  \"1\": \"Opened\",
  \"2\": \"Closed\",
  \"3\": \"Canceled\"
}";

?>