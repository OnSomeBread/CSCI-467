<?php
function sendPurchaseOrder($quoteID, $assocID, $custid, $priceTotal) {
    $url = 'http://blitz.cs.niu.edu/PurchaseOrder/';
    
    $data = array(
        'order' => $quoteID,
        'associate' => $assocID,
        'custid' => $custid,
        'amount' => $priceTotal
    );

    $options = array(
        'http' => array(
            'header' => array('Content-type: application/json', 'Accept: application/json'),
            'method'  => 'POST',
            'content' => json_encode($data)
        )
    );

   	$context  = stream_context_create($options);
	$result = file_get_contents($url, false, $context);
	echo($result);
}
<?php
