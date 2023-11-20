<?php
require('stripe-php-master/init.php');

$publishableKey="pk_test_51OET5zSFsEoeji9NvMtdZ2WdHsWIBUogHKEy8PTANTuRMC6RVX9pKXLvfSiLLRHMTR9C3JxqH7ruaqwizNJAL48T00oA4pGmlP";

$secretKey="sk_test_51OET5zSFsEoeji9NS9JG37jNzU5UtJLM4RRSVTSGFArxDZVxZxdmi3fF6UUdajBydGRZfafQfdwqkvtzJ5hNWb7600EPZzKWDT";

\Stripe\Stripe::setApiKey($secretKey);
?>