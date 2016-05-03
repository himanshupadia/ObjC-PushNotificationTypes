<?php

// Put your device token here (without spaces):
$deviceToken = '8a7ff173db2018cff7dbb3eaa14e0451ed324cc3103580d9cf34b6d1cf1c5aab';

// Put your private key's passphrase here:
$passphrase = '';

// Put your alert message here:
$message = $argv[1]; 
$url = $argv[2];

if (!$message || !$url)
    exit('Example Usage: $php newspush.php \'Breaking News!\' \'https://raywenderlich.com\'' . "\n");

////////////////////////////////////////////////////////////////////////////////

$ctx = stream_context_create();
stream_context_set_option($ctx, 'ssl', 'local_cert', 'DemoPush.pem');
stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

// Open a connection to the APNS server
$fp = stream_socket_client(
  'ssl://gateway.sandbox.push.apple.com:2195', $err,
  $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

if (!$fp)
  exit("Failed to connect: $err $errstr" . PHP_EOL);

echo 'Connected to APNS' . PHP_EOL;

// Create the payload body
$body['aps'] = array(
  'alert' => $message,
  'sound' => 'default',
  'link_url' => $url,
  'category' => "ACCEPT_ACTION",
  );

// Encode the payload as JSON
$payload = json_encode($body);

// Build the binary notification
$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

// Send it to the server
$result = fwrite($fp, $msg, strlen($msg));

if (!$result)
  echo 'Message not delivered' . PHP_EOL;
else
  echo 'Message successfully delivered' . PHP_EOL;

// Close the connection to the server
fclose($fp);
