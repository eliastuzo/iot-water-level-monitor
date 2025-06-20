<?php
    require 'conexion_db.php';


    $api_key_value = "elisarmedidor120325";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $api_key = test_input($_POST["api_key"]);
        if($api_key == $api_key_value) {
            $usuario = $_POST["usuario"];
            $contrasena = $_POST["contrasena"];

            $squery = "SELECT * FROM usuario WHERE username = '$usuario'";
            $result = mysqli_query($db, $squery);

            if ($result -> num_rows) {
                $usuario = mysqli_fetch_assoc($result);
                $auth = password_verify($contrasena, $usuario['password']);
                if($auth){
                    echo "true";
                } else {
                    echo "true user false password";
                }
            } else {
                echo "false user";
            }
        } else {
            echo "API incorrecta";
        }
    } else {
        echo "error";
    }




    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>