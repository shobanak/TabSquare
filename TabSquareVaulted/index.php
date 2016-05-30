<?php
require_once 'includes/braintree-php-3.12.0/lib/Braintree.php';
require_once 'includes/bt_config.php';

// Generate Client NONCE 
//$clientToken = Braintree_ClientToken::generate();
$clientToken = Braintree_ClientToken::generate([
    "customerId" => "6598277432"
]);
?>
<html>
<head>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://js.braintreegateway.com/v2/braintree.js"></script>
</head>
<body>
<form id="checkout" method="post" action="get.php">
  <div id="config">
  <h1> Dropin UI Configuration Options </h1> 
    <p>Client Token has been generated by the server side BT PHP SDK which is: <pre><?echo $clientToken?></pre></p>
	
	<!-- Order Setup--> 
	<h4>Order Details</h4>
   
      <label >Order Amount:</label>
       <input type="text" name="order[amount]" value='150.00' readonly/>
   
   <label>Order ID: </label>
   <input type="text" name="order[orderId]" value='132123' readonly/> 

   <label>Phone ID: </label>
   <input type="text" name="order[phoneId]" value='6598277432' readonly/>
   
   <label>Submit for settlement</label>
      <select type="dropdown" name="order[settle]">
      <option value="true">True</option>
	  <option value="false">False</option>
   </select>   
  </div>
  <br/>
<br/>
  <div id="dropin"></div>
  <input type="submit" value="Pay">
</form>
<script>
braintree.setup("<?echo $clientToken?>",
  'dropin', {
    container: 'dropin',
	onPaymentMethodReceived: function (obj) {
        console.log(obj);
		var $msg = 'On Payment Method Received Fired Nonce:  ' +  obj.nonce + " Payment Type: " + obj.type;
		//alert($msg);
        $('<input />').attr('type', 'hidden')
            .attr('name', 'payment_method_nonce')
            .attr('value', obj.nonce)
            .appendTo('#checkout');

        $.ajax({
            type: 'post',
            url: 'get.php',
            data: $('form').serialize(),
            success: function (result) {
                console.log(result);
                var div = document.getElementById('transaction_response');
                div.innerHTML = div.innerHTML + result;
            }
        });
	}
  });</script> 
  
<div id="transaction_response"></div>

</body>
</html>