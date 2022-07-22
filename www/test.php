<?php
    // echo phpversion();

    echo isPhone("06 90.90.90.90");

    function isPhone($phone){
        return preg_match("/^(?:(?:\+|00)33[\s.-]{0,3}(?:\(0\)[\s.-]{0,3})?|0)[1-9](?:(?:[\s.-]?\d{2}){4}|\d{2}(?:[\s.-]?\d{3}){2})$/", $phone);
    }
?>