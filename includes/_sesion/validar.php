<?php

/**
 * Validacion de datos para poder iniciar sesion
 */
require_once("../_db.php");
$correo = $_POST['correo'];
$password = $_POST['password'];
/* $password=md5($_POST['password']);  */

session_start();
$_SESSION['correo'] = $correo;

$conexion = mysqli_connect("localhost", "root", "", "tienda");
$consulta = "SELECT*FROM user where correo='$correo' and password=hex(aes_encrypt('$password','hunter2'))";
$resultado = mysqli_query($conexion, $consulta);
$filas = mysqli_num_rows($resultado);

if($filas){
  
    header('Location: ../../views/usuarios/index.php');


}else{
    
    header('location: ../../index.php');
    session_destroy();
}
?>

<?php

/**
 * Parte de registro de usuarios
 */
if (isset($_POST['registrar'])) {
    if (strlen($_POST['nombre']) >= 1 && strlen($_POST['cargo']) >= 1 && strlen($_POST['correo']) >= 1 && strlen($_POST['password']) >= 1 && strlen($_POST['telefono']) >= 1) {
        $nombre = trim($_POST['nombre']);
        $cargo = trim($_POST['cargo']);
        $correo = trim($_POST['correo']);
        $password = trim($_POST['password']);
        $telefono = trim($_POST['telefono']);

        /*       $contra = md5($_POST['password']); */


        $consulta = "INSERT INTO user (nombre, cargo, correo, telefono, password)
      VALUES (hex(aes_encrypt('$nombre','hunter2')),hex(aes_encrypt('$cargo','hunter2')), '$correo', hex(aes_encrypt('$telefono','hunter2')), hex(aes_encrypt('$password','hunter2')))";
        /*       $consulta = "INSERT INTO user (nombre, correo, telefono, password)
              VALUES ('$nombre', '$correo', '$telefono','$contra')"; */

        mysqli_query($conexion, $consulta);
        mysqli_close($conexion);

    }
}
?>