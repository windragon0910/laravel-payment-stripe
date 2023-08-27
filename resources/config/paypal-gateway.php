<?php

$mode='test'; // test or live
define('PAYPAL_RETURN_URL', 'https://technosmarter.com/paypal/success.php');
define('PAYPAL_CANCEL_URL', 'https://technosmarter.com/paypal/cancel.php');
define('PAYPAL_NOTIFY_URL', 'https://technosmarter.com/paypal/ipn.php');
define('PAYPAL_CURRENCY', 'USD');

if($mode == 'live')
{
    define('PAYPAL_URL', 'https://www.paypal.com/cgi-bin/webscr');
}
else
{
    define('PAYPAL_URL', 'https://www.sandbox.paypal.com/cgi-bin/webscr');
}

?>
