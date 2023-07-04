<?php
    session_start();
    require_once"config.php";
    $conn = @new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
    if($conn->connect_errno!=0)
    {
        echo "There was an error";
    }
    else
    {
        $login = $_POST['username'];
        $password = $_POST['password'];
        $login = htmlentities($login, ENT_QUOTES, "UTF-8");
        $password = htmlentities($password, ENT_QUOTES, "UTF-8");

        if($result = @$conn -> query(sprintf("SELECT * FROM users WHERE login='%s' AND password='%s'",mysqli_real_escape_string($conn, $login),mysqli_real_escape_string($conn, $password))))
        {
            if($result->num_rows>0)
            {
                $result->free_result();
                $_SESSION["username"] = $login;
                header('Location: index.php');
            }
            elseif($result = @$conn -> query(sprintf("SELECT * FROM users WHERE login='%s'",mysqli_real_escape_string($conn, $login))))
            {
                if($result->num_rows==0)
                {
                    $result->free_result();
                    @$conn -> query(sprintf("INSERT INTO users (login, password) VALUES ('%s', '%s')",mysqli_real_escape_string($conn, $login),mysqli_real_escape_string($conn, $password)));
                    $_SESSION["username"] = $login;
                    header('Location: index.php'); 
                }
                else
                {
                    $_SESSION["error"] = true;
                    unset($_SESSION["username"]);
                    header('Location: login.php');
                }
            }
            else
            {
                $_SESSION["error"] = true;
                unset($_SESSION["username"]);
                header('Location: login.php');
            }
        }
        $conn->close();
    }
?> 
