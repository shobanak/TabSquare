<?php 
require_once 'includes/braintree-php-3.12.0/lib/Braintree.php';
require_once 'includes/bt_config.php';

?><pre>
<?//var_dump($_POST); ?>

</pre><?

$reqArry = array(
    'amount' => $_POST["order"]["amount"],
    'orderId' => $_POST["orderId"],
    'paymentMethodNonce' => $_POST["payment_method_nonce"],    
    'options' => array(
        'submitForSettlement' => $_POST["order"]["settle"],
        'storeInVaultOnSuccess' => true
    ),
    
);

/*
$reqArry = array(
    'amount' => $_POST["order"]["amount"],
    'orderId' => $_POST["orderId"],
    'paymentMethodNonce' => $_POST["payment_method_nonce"],
    'customer' => array(
        'firstName' => $_POST["customer"]["firstName"],
        'lastName' => $_POST["customer"]['lastName'],        
        'phone' => $_POST["customer"]['phone'],       
        'email' => $_POST["customer"]['email']
    ),
    'options' => array(
        'submitForSettlement' => $_POST["order"]["settle"],
        'storeInVaultOnSuccess' => true
    ),
    'channel' => 'MyShoppingCartProvider'
);
*/

if($_POST["order"]["mid"] != '') {
    $reqArry['merchantAccountId'] = $_POST["order"]["mid"];
}

try{
$result = Braintree_Transaction::sale($reqArry);}

catch(Exception $e){ echo 'Caught exception: ',  var_dump($e), "\n";}

print "<pre>";
print_r($result);
print "</pre>";


?> 