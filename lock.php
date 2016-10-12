<?php
DB::$dbName = 'cp4724_tors';
DB::$user = 'cp4724_tors';
DB::$password = 'bAltllSiuAad';

if (!isset($_SERVER['PHP_AUTH_USER']))

{
        Header ("WWW-Authenticate: Basic realm=\"Admin Page\"");
        Header ("HTTP/1.0 401 Unauthorized");
        exit();
}

else {
        if (!get_magic_quotes_gpc()) {
                $_SERVER['PHP_AUTH_USER'] = mysql_real_escape_string($_SERVER['PHP_AUTH_USER']);
                $_SERVER['PHP_AUTH_PW'] = mysql_real_escape_string($_SERVER['PHP_AUTH_PW']);
        }

        $lst = DB::query("SELECT * FROM users WHERE userName=%s", $_SERVER['PHP_AUTH_USER']);
        //if (!$tripInfo) {
        //    $app->response->setStatus(404);
        //    return;
        //}
        //$query = "SELECT userName FROM users WHERE userName='".$_SERVER['PHP_AUTH_USER']."'";
        //$lst = @mysql_query($query);
//echo ($lst);
        if (!$lst)
        {
            Header ("WWW-Authenticate: Basic realm=\"Admin Page\"");
            Header ("HTTP/1.0 401 Unauthorized");
        exit();
        }

        if (mysql_num_rows($lst) == 0)
        {
           Header ("WWW-Authenticate: Basic realm=\"Admin Page\"");
           Header ("HTTP/1.0 401 Unauthorized");
           exit();
        }

        $pass =  $lst['userName'];
        if ($_SERVER['PHP_AUTH_PW']!= $pass)
        {
           Header ("WWW-Authenticate: Basic realm=\"Admin Page\"");
           Header ("HTTP/1.0 401 Unauthorized");
           exit();
        }
}