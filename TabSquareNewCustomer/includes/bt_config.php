<?php 
require_once('includes/braintree-php-3.12.0/lib/Braintree.php');
Braintree_Configuration::environment('sandbox');
Braintree_Configuration::merchantId(<your merchantID>);
Braintree_Configuration::publicKey(<your publicKey>);
Braintree_Configuration::privateKey(<your privateKey>);
?>