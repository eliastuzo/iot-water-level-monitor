<?php
     require 'conexion_db.php';


     $api_key_value = "elisarmedidor120325";
     $ID = "";

     if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $api_key = test_input($_POST["api_key"]);
        if($api_key == $api_key_value) {
            $usuario = test_input($_POST["usuario"]);
            $op = test_input($_POST["op"]);
            $id_usuario = test_input($_POST["id"]);
            $alias = test_input($_POST["alias"]);

            switch($op) {
                case 1: 
                    $squery = "SELECT * FROM usuario WHERE username = '$usuario'";
                    $result = mysqli_query($db, $squery);

                    if ($result -> num_rows) {
                        $usuario = mysqli_fetch_assoc($result);
                        $ID = $usuario['id'];
                        
                        $squery = "SELECT alias FROM medidor WHERE id_usuario = '$ID'";
                        $result = mysqli_query($db, $squery);
                        $conteo = 0;
                        $operacion = 1;
                        $lista_de_medidores = "";
                        if ($result -> num_rows) {
                            while($row = $result->fetch_assoc()) {
                                $lista_de_medidores = $lista_de_medidores . $row['alias'] . ",";
                                $conteo += 1;
                            } 
                        }
                        $lista_de_medidores = $ID . $operacion . $conteo . $lista_de_medidores;
                        echo $lista_de_medidores;
                    } else {
                        echo "Error";
                    }
                    break;


                case 2:
                    $operacion = 2;
                    
                    $squery = "SELECT id FROM medidor WHERE alias = '$alias' AND id_usuario = '$id_usuario'";
                    $result = mysqli_query($db, $squery);
                    $id_medidor = 0;

                    if ($result -> num_rows) {
                        while($row = $result->fetch_assoc()) {
                            $id_medidor = $row['id'];
                        }
                    }

                    $consulta_general = "SELECT * FROM medidor INNER JOIN dato_4h ON medidor.id = dato_4h.id_medidor INNER JOIN nivel_diario_promedio ON medidor.id = nivel_diario_promedio.id_medidor WHERE medidor.id = '$id_medidor'";
                    $result = mysqli_query($db, $consulta_general);
                    while ($data = $result->fetch_assoc()){
                        $sensor_data[] = $data;
                        echo json_encode($data);
                    }



                    break;

            }
            $conn->close();
        } else {
            echo "API KEY INCORRECTA";
        }
    } else {
        echo "No data posted";
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>