<?php
// functions.php
	function check_txnid($tnxid){
	    global $link;
	    return true;
	    $valid_txnid = true;
	    //get result set
	    $sql = mysql_query("SELECT * FROM `payments` WHERE txnid = '$tnxid'", $link);
	    if ($row = mysql_fetch_array($sql)) {
	        $valid_txnid = false;
	    }
	    return $valid_txnid;
	}
	function check_price($price, $id){
	    $valid_price = false;
	    //you could use the below to check whether the correct price has been paid for the product
	    /*
	    $sql = mysql_query("SELECT amount FROM `products` WHERE id = '$id'");
	    if (mysql_num_rows($sql) != 0) {
	        while ($row = mysql_fetch_array($sql)) {
	            $num = (float)$row['amount'];
	            if($num == $price){
	                $valid_price = true;
	            }
	        }
	    }
	    return $valid_price;
	    */
	    return true;
	}
	function updatePayments($data){
	    global $link;
	    if (is_array($data)) {
	        $sql = mysql_query("INSERT INTO `payments` (txnid, payment_amount, payment_status, itemid, createdtime) VALUES (
	                '".$data['txn_id']."' ,
	                '".$data['payment_amount']."' ,
	                '".$data['payment_status']."' ,
	                '".$data['item_number']."' ,
	                '".date("Y-m-d H:i:s")."'
	                )", $link);
	        return mysql_insert_id($link);
	    }
	}
/*
CREATE TABLE IF NOT EXISTS `payments` (
	 `id` int(6) NOT NULL AUTO_INCREMENT,
	 `txnid` varchar(20) NOT NULL,
	 `payment_amount` decimal(7,2) NOT NULL,
	 `payment_status` varchar(25) NOT NULL,
	 `itemid` varchar(25) NOT NULL,
	 `createdtime` datetime NOT NULL,
	 PRIMARY KEY (`id`)
	) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
  */        
        