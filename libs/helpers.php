<?php

function isAjaxRequest()
{
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        //request is ajax
        return true;
    }
    return false;
}

function site_url($uri = '')
{
    return BASE_URL . $uri;
}

function diePage($msg)
{
    echo "<div style='padding: 30px; width: 80%; margin: 50px auto; background: #fbdde1; border: 1px solid #e0abab; color: #6b0404; border-radius: 6px; font-family: sans-serif;'>$msg</div>";
    die();
}

function redirect($url)
{
    header("Location:$url");
    die();
}

function massage($msg, $cssClass = 'info')
{
    echo "<div class='$cssClass' >$msg</div>";
}

function dd($var)
{
    echo "<pre style='color: #f77201; background: #fff; z-index: 999; position: relative; padding: 10px; margin: 10px; border-radius: 5px; border-left: 3px solid #f9b230;'>";
    var_dump($var);
    echo "</pre>";
}
