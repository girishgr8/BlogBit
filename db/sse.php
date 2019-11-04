<?php
    header('Content-Type: text/event-stream');
    header('Cache-Control: no-cache');
    $x=rand(0,1000);
    echo "data:{$x}\n\n";
    flush();
?>