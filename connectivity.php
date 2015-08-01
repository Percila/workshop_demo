<?php
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'hackon');
    define('DB_USER','root');
    define('DB_PASSWORD','');
    $con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error());
    $db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());

    function SignIn()
    {
        session_start(); //starting the session for user profile page
        if(!empty($_POST['user_input'])) //checking the 'user' name which is from Sign-In.html, is it empty or have some text 
        {
            $user_input = mysql_real_escape_string($_POST['user_input']);
            $pass_input = mysql_real_escape_string($_POST['pass_input']);
            $query = mysql_query("SELECT * FROM users where userName = $user_input AND pass = $pass_input") or die(mysql_error());
            $row = mysql_fetch_array($query);              
            if(!empty($row['userName']) AND !empty($row['pass']))
            {
                $_SESSION['UserName'] = $row['pass'];
                $_SESSION['login'] = 1;
                header("location: content.php");
            }
            else
            {
                echo "SORRY... YOU ENTERD WRONG ID AND PASSWORD... PLEASE RETRY...";
            }
        }       
        else
        {
        echo "PLEASE INPUT SOMETHING";
        }
    }
    if(isset($_POST['submit']))
    {
        SignIn();
    }
?>
