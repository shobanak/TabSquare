<?php 
require_once 'includes/braintree-php-3.12.0/lib/Braintree.php';
require_once 'includes/bt_config.php';

?><pre>
<?//var_dump($_POST); ?>

</pre><?


$reqArry = array(
    'amount' => $_POST["order"]["amount"],
    'orderId' => $_POST["order"]["orderId"],
    'paymentMethodNonce' => $_POST["payment_method_nonce"],
    'customer' => array(
        'id' => $_POST["order"]["phoneId"],
        'firstName' => $_POST["customer"]["firstName"],
        'lastName' => $_POST["customer"]['lastName'],        
        'phone' =>  $_POST["order"]["phoneId"],       
        'email' => $_POST["customer"]['email']
    ),
    'options' => array(
        'submitForSettlement' => $_POST["order"]["settle"],
        'storeInVaultOnSuccess' => true
    ),
 
);

try{
$result = Braintree_Transaction::sale($reqArry);}

catch(Exception $e){ echo 'Caught exception: ',  var_dump($e), "\n";}

print "<pre>";
print_r($result);
print "</pre>";


?> 