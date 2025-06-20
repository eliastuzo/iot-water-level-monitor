<?php
    require 'php/conexion_db.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require 'vendor/autoload.php'; 
    $errores = "";
    $recuperar = "";
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if (isset($_POST['usuario'])) {
            $usuario = $_POST['usuario'];
            $pswd = $_POST['password'];
            $squery = "SELECT * FROM usuario WHERE username = '${usuario}'";
            $result = mysqli_query($db, $squery);
            if ($result -> num_rows) {
                $usuario = mysqli_fetch_assoc($result);
                $auth = password_verify($pswd, $usuario['password']);
                if($auth){
                    session_start();
                    $_SESSION['user'] = $usuario['username'];
                    $_SESSION['email'] = $usuario['email'];
                    $_SESSION['id'] = $usuario['id'];
                    $_SESSION['login'] = true;
                    header('Location: inicio/');
                } else {
                    $errores = "Usuario o contraseña incorrecta";
                    $recuperar = "Haz click aquí para recuperar tu usuario o contraseña.";
                }
            } else {
                $errores = "Usuario o contraseña incorrecta";
                $recuperar = "Haz click aquí para recuperar tu usuario o contraseña.";
            }
        } else if(isset($_POST['email'])) {
            $email = $_POST['email'];
            $squery2 = "SELECT * FROM usuario WHERE email = '${email}'";
            $result = mysqli_query($db, $squery2);
            if ($result -> num_rows) {
                $usuario = mysqli_fetch_assoc($result);
                
                $mail = new PHPMailer(true);
                $username = $usuario['username'];
                $password = $usuario['password2'];
                $email = $usuario['email'];
                try {
                    $mail->IsSMTP();
                    $mail->SMTPAuth = true;
                    $mail->Host = "smtp.gmail.com";
                    $mail->Port = 587;
                    $mail->Username = "eliasnook2013@gmail.com";
                    $mail->Password = "ormw pury pyvl qamb";
                
                    $mail->From         = 'eliasnook2013@gmail.com';
                    $mail->FromName     = 'Admin';
                    $mail->AddAddress($email, 'Receiver');  // Add a recipient
                    //$mail->AddCC('tuzosperez2010@hotmail.com', 'Person One');
                    $mail->IsHTML(true);
                
                    $mail->Subject = 'Recuperacion cuenta Soluciones Elisar';
                    $mail->WordWrap = 50;  
                    $mail->Body = "Usuario: '${username}'\nPassword: '${password}'";
                    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                    $mail->send();
                    $errores = "¡Correo enviado exitosamente!";
                } catch (Exception $e) {
                    $errores =  "No se pudo enviar correo. Error: {$mail->ErrorInfo}";
                }
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medidor|Log In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
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
            <div class="ham-menu">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </nav>
        <div class="login">
            <div class="art">
                <img src="img/logo2.png" alt="">
            </div>
            <div class="line-vr-section"></div>
            <div class="form">
                <h1>Iniciar sesión</h1>
                <form method="POST">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Usuario</label>
                        <input type="text" class="form-control" id="username" name="usuario">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary" value="log_in">Acceder</button>
                </form>
            </div>
        </div>
        <div class="recuperar-pwsd">
            <div class="art">
                <img src="img/logo2.png" alt="">
            </div>
            <div class="line-vr-section"></div>
            <div class="form">
                <h1>Recuperar contraseña</h1>
                <form method="POST">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email">
                    </div>
                    <button type="submit" class="btn btn-primary correo" value = "recuperar_pwsd">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <div class="prompts">
        <h4 class = "error" id = "error"> <?php echo $errores ?> </h3>
        <h4 class = "recuperar" id = "recuperar"> <?php echo $recuperar ?> </h3>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="index.js"></script>
</body>
</html>