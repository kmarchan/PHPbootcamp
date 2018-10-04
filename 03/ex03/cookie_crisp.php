<?php
    $name = $_GET['name'];
    $value = $_GET['value'];
    $action = $_GET['action'];

    if ($name && $action)
    {
        if ($action == "set" && $value)
        {
            setcookie($name, $value, time() + 86400);
        }
        if ($action == "get")
        {
            echo $_COOKIE[$_GET['name']]."\n";
        }
        if ($action == "del")
        {
            setcookie($name, $value, time() - 86400);
        }
    }
?>