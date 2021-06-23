<?php

/* //Generate a random string.
$token = openssl_random_pseudo_bytes(16);

//Convert the binary data into hexadecimal representation.
$token = bin2hex($token);

//Print it out for example purposes.
echo $token;
 */

$fname = "HICHAM";
$lname = "ELKAMOUNI";

$arr1 = str_split($fname);
$arr2 = str_split($fname, 2);
$arr3 = str_split($lname, 2);

print_r($arr2);
print_r($arr3);

echo $arr2[0] . $arr3[0];
