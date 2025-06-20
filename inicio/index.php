<?php
require 'php/inicio_sesion.php';
require 'php/conexion_db.php';
date_default_timezone_set('America/Mexico_City');
$hoy = getdate();
$id_cliente = $_SESSION['id'];
$usuario = $_SESSION['user'];
$email = $_SESSION['email'];
//ESCRIBIR SOLICITUD
$consulta = "SELECT alias FROM medidor WHERE id_usuario = '${id_cliente}'";
$consulta_general = "SELECT * FROM medidor INNER JOIN dato_4h ON medidor.id = dato_4h.id_medidor INNER JOIN nivel_diario_promedio ON medidor.id = nivel_diario_promedio.id_medidor WHERE medidor.id_usuario = '${id_cliente}'";

//CONSULTAR BD
$resultadoConsulta = mysqli_query($db, $consulta); 
$resultadoConsultaGeneral = mysqli_query($db, $consulta_general);
$lista_de_medidores = [];
if ($resultadoConsulta -> num_rows) {
    while($row = $resultadoConsulta->fetch_assoc()) {
        array_push($lista_de_medidores, $row["alias"]);
    } 
}



if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $id = $_POST['id'];

    $eliminacion = "DELETE FROM salidas WHERE id = '${id}'";

    $resultadoEliminacion = mysqli_query($db, $eliminacion);
    $_SESSION['login'] = true;
    $_SESSION['admin'] = '1';
    header("Refresh:0");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medidor|Log In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<div class="off-screen-menu">
    <ul>
        <li>
            <a href="">Home</a>
        </li>
        <li>
            <a href="">Seguridad &amp; alarmas</a>
        </li>
        <li>
            <a href="">Diseño web</a>
        </li>
        <li>
            <a href="">Automatización</a>
        </li>
        <li>
            <a href="">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                    <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/>
                </svg>
            </a>
        </li>
        <li>
            <a href="">
                <svg xmlns="http://www.w3.org/2000/svg"  fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                    <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"/>
                </svg>
            </a>
        </li>
    </ul>
</div>
    <div class="main">
        <nav>
            <ul>
                <li>
                    <a href="">Home</a>
                </li>
                <li>
                    <a href="">Seguridad &amp; alarmas</a>
                </li>
                <li>
                    <a href="">Diseño web</a>
                </li>
                <li>
                    <a href="">Automatización</a>
                </li>
                <li>
                    <a href="">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                            <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/>
                        </svg>
                    </a>
                </li>
                <li>
                    <a href="">
                        <svg xmlns="http://www.w3.org/2000/svg"  fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                            <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"/>
                        </svg>
                    </a>
                </li>
            </ul>
            <img class="logo" src="/img/logo2.png">
            <div class="ham-menu">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </nav>
    </div>
    <div class="title">
        <h1>¡Bienvenido <?php echo $usuario ?>!</h1>
        <p>Elige tu medidor</p>
        <select name="medidores" id="medidores">
            <option disabled selected value></option>
            <?php 
                foreach ($lista_de_medidores as $medidor) {
                    echo "<option class='medidorAlias' value='$medidor'>" . $medidor . "</option>";
                }
            ?>
        </select>
    </div>
    <?php while ($info = $resultadoConsultaGeneral->fetch_assoc()): ?>
        <div class="medidor <?php echo $info['alias']?>">
            <h1> <?php echo  ucwords($info['alias'])?> </h1>
            <div class="datos">
                <div class="info">
                    <div class="dato">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-water" viewBox="0 0 16 16">
                            <path d="M.036 3.314a.5.5 0 0 1 .65-.278l1.757.703a1.5 1.5 0 0 0 1.114 0l1.014-.406a2.5 2.5 0 0 1 1.857 0l1.015.406a1.5 1.5 0 0 0 1.114 0l1.014-.406a2.5 2.5 0 0 1 1.857 0l1.015.406a1.5 1.5 0 0 0 1.114 0l1.757-.703a.5.5 0 1 1 .372.928l-1.758.703a2.5 2.5 0 0 1-1.857 0l-1.014-.406a1.5 1.5 0 0 0-1.114 0l-1.015.406a2.5 2.5 0 0 1-1.857 0l-1.014-.406a1.5 1.5 0 0 0-1.114 0l-1.015.406a2.5 2.5 0 0 1-1.857 0L.314 3.964a.5.5 0 0 1-.278-.65m0 3a.5.5 0 0 1 .65-.278l1.757.703a1.5 1.5 0 0 0 1.114 0l1.014-.406a2.5 2.5 0 0 1 1.857 0l1.015.406a1.5 1.5 0 0 0 1.114 0l1.014-.406a2.5 2.5 0 0 1 1.857 0l1.015.406a1.5 1.5 0 0 0 1.114 0l1.757-.703a.5.5 0 1 1 .372.928l-1.758.703a2.5 2.5 0 0 1-1.857 0l-1.014-.406a1.5 1.5 0 0 0-1.114 0l-1.015.406a2.5 2.5 0 0 1-1.857 0l-1.014-.406a1.5 1.5 0 0 0-1.114 0l-1.015.406a2.5 2.5 0 0 1-1.857 0L.314 6.964a.5.5 0 0 1-.278-.65m0 3a.5.5 0 0 1 .65-.278l1.757.703a1.5 1.5 0 0 0 1.114 0l1.014-.406a2.5 2.5 0 0 1 1.857 0l1.015.406a1.5 1.5 0 0 0 1.114 0l1.014-.406a2.5 2.5 0 0 1 1.857 0l1.015.406a1.5 1.5 0 0 0 1.114 0l1.757-.703a.5.5 0 1 1 .372.928l-1.758.703a2.5 2.5 0 0 1-1.857 0l-1.014-.406a1.5 1.5 0 0 0-1.114 0l-1.015.406a2.5 2.5 0 0 1-1.857 0l-1.014-.406a1.5 1.5 0 0 0-1.114 0l-1.015.406a2.5 2.5 0 0 1-1.857 0L.314 9.964a.5.5 0 0 1-.278-.65m0 3a.5.5 0 0 1 .65-.278l1.757.703a1.5 1.5 0 0 0 1.114 0l1.014-.406a2.5 2.5 0 0 1 1.857 0l1.015.406a1.5 1.5 0 0 0 1.114 0l1.014-.406a2.5 2.5 0 0 1 1.857 0l1.015.406a1.5 1.5 0 0 0 1.114 0l1.757-.703a.5.5 0 1 1 .372.928l-1.758.703a2.5 2.5 0 0 1-1.857 0l-1.014-.406a1.5 1.5 0 0 0-1.114 0l-1.015.406a2.5 2.5 0 0 1-1.857 0l-1.014-.406a1.5 1.5 0 0 0-1.114 0l-1.015.406a2.5 2.5 0 0 1-1.857 0l-1.757-.703a.5.5 0 0 1-.278-.65"/>
                        </svg>
                        <div class="texto">
                            <h4>Capacidad:</h4>
                            <p> <?php echo $info['capacidad'] . "L"?> </p>
                        </div>
                    </div>
                    <div class="dato">
                        <svg xmlns="http://www.w3.org/2000/svg"  fill="currentColor" class="bi bi-moisture" viewBox="0 0 16 16">
                            <path d="M13.5 0a.5.5 0 0 0 0 1H15v2.75h-.5a.5.5 0 0 0 0 1h.5V7.5h-1.5a.5.5 0 0 0 0 1H15v2.75h-.5a.5.5 0 0 0 0 1h.5V15h-1.5a.5.5 0 0 0 0 1h2a.5.5 0 0 0 .5-.5V.5a.5.5 0 0 0-.5-.5zM7 1.5l.364-.343a.5.5 0 0 0-.728 0l-.002.002-.006.007-.022.023-.08.088a29 29 0 0 0-1.274 1.517c-.769.983-1.714 2.325-2.385 3.727C2.368 7.564 2 8.682 2 9.733 2 12.614 4.212 15 7 15s5-2.386 5-5.267c0-1.05-.368-2.169-.867-3.212-.671-1.402-1.616-2.744-2.385-3.727a29 29 0 0 0-1.354-1.605l-.022-.023-.006-.007-.002-.001zm0 0-.364-.343zm-.016.766L7 2.247l.016.019c.24.274.572.667.944 1.144.611.781 1.32 1.776 1.901 2.827H4.14c.58-1.051 1.29-2.046 1.9-2.827.373-.477.706-.87.945-1.144zM3 9.733c0-.755.244-1.612.638-2.496h6.724c.395.884.638 1.741.638 2.496C11 12.117 9.182 14 7 14s-4-1.883-4-4.267"/>
                        </svg>
                        <div class="texto">
                            <h4>Nivel:</h4>
                            <p> <?php echo $info['nivel'] . "%"?> </p>
                        </div>
                    </div>
                    <div class="dato">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-droplet" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M7.21.8C7.69.295 8 0 8 0q.164.544.371 1.038c.812 1.946 2.073 3.35 3.197 4.6C12.878 7.096 14 8.345 14 10a6 6 0 0 1-12 0C2 6.668 5.58 2.517 7.21.8m.413 1.021A31 31 0 0 0 5.794 3.99c-.726.95-1.436 2.008-1.96 3.07C3.304 8.133 3 9.138 3 10a5 5 0 0 0 10 0c0-1.201-.796-2.157-2.181-3.7l-.03-.032C9.75 5.11 8.5 3.72 7.623 1.82z"/>
                            <path fill-rule="evenodd" d="M4.553 7.776c.82-1.641 1.717-2.753 2.093-3.13l.708.708c-.29.29-1.128 1.311-1.907 2.87z"/>
                        </svg>
                        <div class="texto">
                            <h4>Estimado en litros:</h4>
                            <p> <?php echo ($info['nivel'] / 100) * 1100 . "L"?> </p>
                        </div>
                    </div>
                    <div class="dato">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-life-preserver" viewBox="0 0 16 16">
                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m6.43-5.228a7.03 7.03 0 0 1-3.658 3.658l-1.115-2.788a4 4 0 0 0 1.985-1.985zM5.228 14.43a7.03 7.03 0 0 1-3.658-3.658l2.788-1.115a4 4 0 0 0 1.985 1.985zm9.202-9.202-2.788 1.115a4 4 0 0 0-1.985-1.985l1.115-2.788a7.03 7.03 0 0 1 3.658 3.658m-8.087-.87a4 4 0 0 0-1.985 1.985L1.57 5.228A7.03 7.03 0 0 1 5.228 1.57zM8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6"/>
                        </svg>
                        <div class="texto">
                            <h4>Estado: </h4>
                            <p> <?php 
                                $index = strpos($info['ultAct']," ");
                                $hora = substr($info['ultAct'], $index + 1, 2);
                                $dia = substr($info['ultAct'], 0, 2);
                                $hora = str_replace(':', '', $hora);
                                $dia = str_replace('-', '', $dia);
                                $momentoHora = date("h");
                                $momentoDia = date("d");
                                $result = $momentoHora - $hora;
                                if ($dia == $momentoDia) {
                                    if ($result > 2) {
                                        echo "OFFLINE";
                                    } else {
                                        echo "ONLINE";
                                    }
                                } else {
                                    if ($result < 23) {
                                        echo "OFFLINE";
                                    } else {
                                        echo "ONLINE";
                                    }
                                }
                            ?> </p>
                        </div>
                    </div>
                    <div class="dato">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-droplet-half" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M7.21.8C7.69.295 8 0 8 0q.164.544.371 1.038c.812 1.946 2.073 3.35 3.197 4.6C12.878 7.096 14 8.345 14 10a6 6 0 0 1-12 0C2 6.668 5.58 2.517 7.21.8m.413 1.021A31 31 0 0 0 5.794 3.99c-.726.95-1.436 2.008-1.96 3.07C3.304 8.133 3 9.138 3 10c0 0 2.5 1.5 5 .5s5-.5 5-.5c0-1.201-.796-2.157-2.181-3.7l-.03-.032C9.75 5.11 8.5 3.72 7.623 1.82z"/>
                            <path fill-rule="evenodd" d="M4.553 7.776c.82-1.641 1.717-2.753 2.093-3.13l.708.708c-.29.29-1.128 1.311-1.907 2.87z"/>
                        </svg>
                        <div class="texto">
                            <h4>Última entrada de agua: </h4>
                            <p> <?php echo $info['ultLlenado'] ?> </p>
                        </div>
                    </div>
                    <div class="dato">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-droplet-fill" viewBox="0 0 16 16">
                            <path d="M8 16a6 6 0 0 0 6-6c0-1.655-1.122-2.904-2.432-4.362C10.254 4.176 8.75 2.503 8 0c0 0-6 5.686-6 10a6 6 0 0 0 6 6M6.646 4.646l.708.708c-.29.29-1.128 1.311-1.907 2.87l-.894-.448c.82-1.641 1.717-2.753 2.093-3.13"/>
                        </svg>
                        <div class="texto">
                            <h4>Consumo aprox. hoy: </h4>
                            <p> <?php echo $info['consumo'] ?> </p>
                        </div>
                    </div>
                </div>
                <div class="imagen-tinaco">
                    <img src="<?php echo "/img/" . $info['nivel'] . ".png"; ?>" alt="" class="img-nivel">
                </div>
            </div>
            <div class="reporte">
                <canvas id="<?php echo $info['alias'] . "Chart" ?>"></canvas>
                <canvas id="<?php echo $info['alias'] . "Chart2" ?>"></canvas>
            </div>
            <?php 
                    $index = strpos($info['horario1'],",");
                    $nivel1 = substr($info['horario1'], 0, $index);
                    $fecha1 = substr($info['horario1'], $index + 1, strlen($info['horario1']) - 1);
                    $fecha1 = new DateTime($fecha1);

                    $index = strpos($info['horario2'],",");
                    $nivel2 = substr($info['horario2'], 0, $index);
                    $fecha2 = substr($info['horario2'], $index + 1, strlen($info['horario2']) - 1);
                    $fecha2 = new DateTime($fecha2);

                    $index = strpos($info['horario3'],",");
                    $nivel3 = substr($info['horario3'], 0, $index);
                    $fecha3 = substr($info['horario3'], $index + 1, strlen($info['horario3']) - 1);
                    $fecha3 = new DateTime($fecha3);

                    $index = strpos($info['horario4'],",");
                    $nivel4 = substr($info['horario4'], 0, $index);
                    $fecha4 = substr($info['horario4'], $index + 1, strlen($info['horario4']) - 1);
                    $fecha4 = new DateTime($fecha4);

                    $index = strpos($info['horario5'],",");
                    $nivel5 = substr($info['horario5'], 0, $index);
                    $fecha5 = substr($info['horario5'], $index + 1, strlen($info['horario5']) - 1);
                    $fecha5 = new DateTime($fecha5);

                    $index = strpos($info['horario6'],",");
                    $nivel6 = substr($info['horario6'], 0, $index);
                    $fecha6 = substr($info['horario6'], $index + 1, strlen($info['horario6']) - 1);
                    $fecha6 = new DateTime($fecha6);
                    
                    $fechas = [$fecha1, $fecha2, $fecha3, $fecha4, $fecha5, $fecha6];
                    $niveles = [$nivel1, $nivel2, $nivel3, $nivel4, $nivel5, $nivel6];

                    array_multisort($fechas, $niveles);

                    $index = strpos($info['data1'],",");
                    $consumo1 = substr($info['data1'], 0, $index);
                    $dia1 = substr($info['data1'], $index + 1, strlen($info['data1']) - 1);
                    $dia1 = new DateTime($dia1);

                    $index = strpos($info['data2'],",");
                    $consumo2 = substr($info['data2'], 0, $index);
                    $dia2 = substr($info['data2'], $index + 1, strlen($info['data2']) - 1);
                    $dia2 = new DateTime($dia2);

                    $index = strpos($info['data3'],",");
                    $consumo3 = substr($info['data3'], 0, $index);
                    $dia3 = substr($info['data3'], $index + 1, strlen($info['data3']) - 1);
                    $dia3 = new DateTime($dia3);

                    $index = strpos($info['data4'],",");
                    $consumo4 = substr($info['data4'], 0, $index);
                    $dia4 = substr($info['data4'], $index + 1, strlen($info['data4']) - 1);
                    $dia4 = new DateTime($dia4);

                    $index = strpos($info['data5'],",");
                    $consumo5 = substr($info['data5'], 0, $index);
                    $dia5 = substr($info['data5'], $index + 1, strlen($info['data5']) - 1);
                    $dia5 = new DateTime($dia5);

                    $index = strpos($info['data6'],",");
                    $consumo6 = substr($info['data6'], 0, $index);
                    $dia6 = substr($info['data6'], $index + 1, strlen($info['data6']) - 1);
                    $dia6 = new DateTime($dia6);

                    $index = strpos($info['data7'],",");
                    $consumo7 = substr($info['data7'], 0, $index);
                    $dia7 = substr($info['data7'], $index + 1, strlen($info['data7']) - 1);
                    $dia7 = new DateTime($dia7);
                    
                    $dias = [$dia1, $dia2, $dia3, $dia4, $dia5, $dia6, $dia7];
                    $consumos = [$consumo1, $consumo2, $consumo3, $consumo4, $consumo5, $consumo6, $consumo7];

                    array_multisort($dias, $consumos);
                ?>
            <script>
                new Chart('<?php echo $info['alias'] . "Chart"?>', {
                    type: 'bar',
                    data: {
                        datasets: [{
                            label: 'Nivel en las últimas 24h',
                            borderWidth: 0,
                            borderColor: 'white',
                            backgroundColor: 'white',
                            hoverBackgroundColor: 'blue',
                            data: [{
                                x: '<?php echo $fechas[0]->format('d-m-Y H:i')?>',
                                y: <?php echo $niveles[0] ?>
                            }, {
                                x: '<?php echo $fechas[1]->format('d-m-Y H:i')?>',
                                y: <?php echo $niveles[1] ?>
                            }, {
                                x: '<?php echo $fechas[2]->format('d-m-Y H:i')?>',
                                y: <?php echo $niveles[2] ?>
                            }, {
                                x: '<?php echo $fechas[3]->format('d-m-Y H:i')?>',
                                y: <?php echo $niveles[3] ?>
                            }, {
                                x: '<?php echo $fechas[4]->format('d-m-Y H:i')?>',
                                y: <?php echo $niveles[4] ?>
                            }, {
                                x: '<?php echo $fechas[5]->format('d-m-Y H:i')?>',
                                y: <?php echo $niveles[5] ?>
                            }]
                        }],
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                max: 100,
                                ticks: {
                                    color: 'white'
                                },
                                grid: {
                                    color: 'white'
                                }
                            },
                            x: {
                                ticks: {
                                    color: 'white'
                                },
                            }
                        },
                        plugins: {
                            legend: {
                                labels: {
                                    color: "white",
                                    font: {
                                        size: 18,
                                        family: 'sans-serif',
                                        weight: 'bold'
                                    }
                                },
                            },
                        },
                    }
                });
            </script>
            <script>
                new Chart('<?php echo $info['alias'] . "Chart2"?>', {
                    type: 'line',
                    data: {
                        datasets: [{
                            label: 'Consumo promedio última semana',
                            borderWidth: 3.5,
                            borderColor: 'white',
                            backgroundColor: 'white',
                            hoverBackgroundColor: 'blue',
                            data: [{
                                x: '<?php echo $dias[0]->format('d-m-Y')?>',
                                y: <?php echo $consumos[0] ?>
                            }, {
                                x: '<?php echo $dias[1]->format('d-m-Y')?>',
                                y: <?php echo $consumos[1] ?>
                            }, {
                                x: '<?php echo $dias[2]->format('d-m-Y')?>',
                                y: <?php echo $consumos[2] ?>
                            }, {
                                x: '<?php echo $dias[3]->format('d-m-Y')?>',
                                y: <?php echo $consumos[3] ?>
                            }, {
                                x: '<?php echo $dias[4]->format('d-m-Y')?>',
                                y: <?php echo $consumos[4] ?>
                            }, {
                                x: '<?php echo $dias[5]->format('d-m-Y')?>',
                                y: <?php echo $consumos[5] ?>
                            }, {
                                x: '<?php echo $dias[6]->format('d-m-Y')?>',
                                y: <?php echo $consumos[6] ?>
                            }]
                        }],
                    },
                    options: {
                        scales: {
                            y: {
                                //beginAtZero: true,
                                max: 1100,
                                min: 0,
                                ticks: {
                                    color: 'white'
                                },
                                grid: {
                                    color: 'white'
                                }
                            },
                            x: {
                                ticks: {
                                    color: 'white'
                                },
                                grid: {
                                    color: 'white'
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                labels: {
                                    color: "white",
                                    font: {
                                        size: 18,
                                        family: 'sans-serif',
                                        weight: 'bold'
                                    }
                                },
                            },
                        },
                    }
                });
            </script>
        </div>
    <?php endwhile;?>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script>

        $('#medidores').change(function(){ 
            var value = $(this).val();
            medidores = <?php echo json_encode($lista_de_medidores) ?>;
            console.log(medidores);
            medidores.forEach(function(medidor) {
                $("." + medidor).css("display", "none");
            });
            $("." + value).fadeToggle().css("display", "block");
        });
    </script>
    <script src="index.js"></script>
</body>
</html>