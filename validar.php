<?php
include('db.php');
$Usuario=$_POST['Usuario'];
$Contra=$_POST['contra'];

session_start();
$_SESSION['Usuario']=$Usuario;


$consulta="SELECT*FROM login where correo='$Usuario' and contra='$Contra'";
$resultado=mysqli_query($conexion,$consulta);

$filas=mysqli_num_rows($resultado);

if($filas){
  header("location:principal.php");
}else{
  echo "<script> alert('Usuario Incorrecto');
  location.href = 'index.php';
  </script>";
}
mysqli_free_result($resultado);
mysqli_close($conexion);
?>