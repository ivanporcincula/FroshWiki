<?php

$idNumber = "11817054";


$idArray = str_split($idNumber);
$checkId = (int) ($idArray[0])*8 +  (int) ($idArray[1])*7 + (int) ($idArray[2])*6
    + (int) ($idArray[3])*5 +  (int) ($idArray[4])*4 + (int) ($idArray[5])*3
    + (int) ($idArray[6])*2 +  (int) ($idArray[7])*1;

echo $checkId;

?>
