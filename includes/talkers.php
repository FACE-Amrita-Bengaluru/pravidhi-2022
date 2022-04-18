<?php
    function consoleBug($data)
    {
        return;
        $output = $data;
        
        if (is_array($output))
            $output = implode(",", $output);
        
        echo "<script>console.log(\"" . "$output" . "\");</script>";
    }

    function throwAlert($message) {
        echo "<script>alert('$message')</script>";
    }

    function redirect($url) {
        echo "<script>window.location.href='$url';</script>";
    }
?>