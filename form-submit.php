<?php
define("DB_HOST", "something.com");
define("DB_NAME", "databaseName");
define("DB_USER", "username");
define("DB_PASSWORD", "password");
$token = $_POST['token_field'];
$url = 'https://presto-staging.prestoapi.com/api/plugin/connect';
$data = json_encode(array('server' => DB_HOST, 'dbName' => DB_NAME, 'username' => DB_USER, 'password' => DB_PASSWORD));
$options = array(
    'http' => array(
        'method' => 'POST',
        'header' => array(
            "Content-type: application/json",
            "Authorization: $token"
        ),
        'content' => $data
    )
);
$context = stream_context_create($options);
$result = @file_get_contents($url, false, $context);
if ($result === FALSE)
    echo 'Failed';
else
    echo 'Success';
