
<!DOCTYPE html>
<html lang="en">
<?php require '../../includes/_db.php' ?>
<?php require '../../includes/_header.php' ?>

<body>
  
<div id= "content">
        <section>
        <div class="container mt-5">
<div class="row">
<div class="col-sm-12 mb-3">
<center><h1>Información de sesion actual</h1></center>
</div>
<div class="col-sm-12">
<div class="table-responsive">


<table class="table table-striped table-hover">
<thead>

<tr>
<th>Nombre</th>
<th>Cargo</th>
<th>Telefono</th>
<th>Correo</th>
<th>Contraseña</th>
<th>registro</th>


</tr>

</thead>

<tbody>

<?php
$conexion = mysqli_connect("localhost","root","","tienda")
or die("Error no conecta".mysqli_error($conexion));
/* consulta para obtener el usuario descifrado */
$consulta=mysqli_query($conexion,"SELECT nombre, aes_decrypt(unhex(nombre),'hunter2') AS descifrado FROM user WHERE correo ='$actualsesion'");
if($row= mysqli_fetch_array($consulta)){
$user=$row[1];
} 
/* consulta para obtener el telefono descifrado */
$consulta=mysqli_query($conexion,"SELECT telefono, aes_decrypt(unhex(telefono),'hunter2') AS descifrado FROM user WHERE correo ='$actualsesion'");
if($row= mysqli_fetch_array($consulta)){
$telefono=$row[1];
} 

$consulta=mysqli_query($conexion,"SELECT cargo, aes_decrypt(unhex(cargo),'hunter2') AS descifrado FROM user WHERE correo ='$actualsesion'");
if($row= mysqli_fetch_array($consulta)){
$cargo=$row[1];
}
/* ------------- */
$sql = "SELECT  nombre, password, telefono, correo,registro FROM user WHERE correo ='$actualsesion'";
$usuarios = mysqli_query($conexion, $sql);
if($usuarios -> num_rows > 0){
foreach($usuarios as $key => $row ){

?>
<tr>
<td><?php echo $user; ?></td>
<td><?php echo $cargo; ?></td>
<td><?php echo $telefono; ?></td>
<td><?php echo $row['correo']; ?></td>
<td><?php echo $row['password']; ?></td>
<td><?php echo $row['registro']; ?></td>
</tr>


<?php
}
}else{

    ?>
    <tr class="text-center">
    <td colspan="4">No existe registros</td>
    </tr>

    <?php
}?>
</tbody>

</table>
</div>
</div>
</div>
</div>
        </section>


        <section>
            <div class= "container">
                <div class= "row">
                    <div class= "col-lg-9">
            </div>
        </section>
    </div>
    
    <?php require '../../includes/_footer.php' ?>
    </body>

</html>