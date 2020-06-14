<?php
require_once('vendor/autoload.php');

$stripe = [
  "secret_key"      => "sk_test_51GtITBEVknbIAaMe9NnRPZ9SjqYt7UgYxxzek13FbunV3NCrZ9EmISiipC2uGYz9ro76oWTw7GbZxhyRLAs2pspl00LGScJBsv",
  "publishable_key" => "pk_test_51GtITBEVknbIAaMeICnSwuICcc9To1UhHDeFUVLtEJwDaL2uRsh0M4vAKPmFDPnzy8EQ9R08p2LnzrZVz6kIeLlo00RSoOB4Vq",
];

\Stripe\Stripe::setApiKey($stripe['secret_key']);
?>