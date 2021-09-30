<?php
// show error reporting
error_reporting(E_ALL);
 
// set your default time-zone
date_default_timezone_set('Asia/Manila');
 
// variables used for jwt
//https://datatracker.ietf.org/doc/html/rfc7519#section-4.1

//used by our JWT library to encode and decode a token
$key = "Tbsmm";
//claim identifies the principal that issued the JWT.
$issued_at = time();
$expiration_time = $issued_at + (60 * 60); // valid for 1 hour
$issuer = "http://localhost:8012/Acodemia/RestApiAuthLevel1/";
?>