<?php
/**
 * Created by PhpStorm.
 * User: btafoya
 * Date: 8/10/17
 * Time: 7:04 PM
 */

include ("vendor/autoload.php");

$test = new \Mika56\SPFCheck\DNSRecordGetterDirect("8.8.8.8");

print_r($test->dns_get_record("google.com", "MX"));

print_r(dns_get_record("google.com", DNS_MX));