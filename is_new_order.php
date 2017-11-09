<?php
    $file = fopen("isnew.txt", "r+");
    clearstatcache();
    echo fread($file, filesize("isnew.txt"));
    fclose($file);
    
    $file = fopen("isnew.txt", "w+");
    fwrite($file, "FALSE");
    fclose($file);
    exit();
?>