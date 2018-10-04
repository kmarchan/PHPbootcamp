<?php
    $name = $_GET['name'];
    $value = $_GET['value'];
    $action = $_GET['action'];

    if (isset($name) && isset($action))
    {
        if ($action == "set" && isset($value))
        {
            setcookie($name, $value, $time + 86400);
        }
        if ($action == "get" && isset($_COOKIE[$name]))
        {
            echo $_COOKIE[$name]."\n";
        }
        if ($action == "del")
        {
            setcookie($name, $value, $time - 86400);
        }
    }
?>