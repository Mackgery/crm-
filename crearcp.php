<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BV CRM</title>
    <link rel="stylesheet" href="css/principal.css">
    <link rel="stylesheet" href="css/crearcp.css">
    <!-- FRAMEWORK BOOTSTRAP para el estilo de la pagina-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- BOXICONS CDN LINK --> 
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

</head>
<body>
<?php
session_start();
if(!isset($_SESSION["Usuario"])){
    header("location:index.php");
}
?>

<?php
if(!empty($_POST)){
    $alert='';
    if(empty($_POST["tc"]) || empty($_POST["nombres"]) || empty($_POST["apellidos"]) || empty($_POST["edad"]) 
    || empty($_POST["ocupacion"]) || empty($_POST["sexo"]) || empty($_POST["dep"]) || empty($_POST["direccion"])
    || empty($_POST["correo"]) || empty($_POST["tel"])|| empty($_POST["fct"])){
        $alert= '<p class="msg_error"> Todos los campos deben de ser completados.</p>'; 
    }
    else{
        include ("db.php");
        $tipo_cliente = $_POST["tc"];
        $nombres = $_POST["nombres"];
        $apellidos = $_POST["apellidos"];
        $edad = $_POST["edad"];
        $ocupacion = $_POST["ocupacion"];
        $sexo = $_POST["sexo"];
        $departamento = $_POST["dep"];
        $direccion = $_POST["direccion"];
        $correo = $_POST["correo"];
        $tel = $_POST["tel"];
        $forma_ct = $_POST["fct"];


        $query = mysqli_query($conexion, "SELECT * FROM clientes WHERE correo = '$correo'");
        $result= mysqli_fetch_array($query);

        if($result>0){
            $alert= '<p class="msg_error"> Un usuario ya a sido registrado con este correo electronico.</p>';
        }else{
            $query_insert =mysqli_query($conexion,"INSERT INTO `clientes` (`id_tc`, `nombres`, `apellidos`, `edad`, `ocupacion`, `sexo`, `id_dep`, `direccion_exacta`, `correo`, `telefono`, `id_ct`) 
            VALUES ('$tipo_cliente','$nombres','$apellidos','$edad','$ocupacion','$sexo','$departamento','$direccion','$correo','$tel','$forma_ct')");
            if ($query_insert){
                $alert= '<p class="msg_save"> Usuario registrado correctamete.</p>';
            }
            else{
                $alert= '<p class="msg_error"> Error al crear usuario.</p>';
            }
        }
    }
}
?>

    <div class="sidebar">
     <div class="logo_content">
       <div class="logo">
       <i class='bx bx-store-alt'></i>
          <div class="logo_name">BV CRM </div>
       </div>
       <i class='bx bx-menu' id="btnmen" ></i>
     </div>
     <ul class="navlist">
          <li>
             <a href="principal.php">
             <i class='bx bx-user' ></i>
             <spa class="links_name"> Usuario </spa>
             </a>
              <spa class="tooltip"> Usuario </spa> 
         </li>
         <li>
             <a href="buscador.php">
             <i class='bx bx-search-alt' ></i>
             <spa class="links_name"> Buscar </spa>
             </a>
              <spa class="tooltip"> Buscar </spa> 
         </li>      
             <li>
             <a href="#">
             <i class='bx bxs-book-bookmark' ></i>
             <spa class="links_name"> Actualizar datos </spa>
             </a>
              <spa class="tooltip"> Act <datagrid></datagrid> </spa> 
         </li>         <li>
             <a href="#">
             <i class='bx bxs-message-detail'></i>
             <spa class="links_name"> Promociones </spa>
             </a>
              <spa class="tooltip"> Promociones </spa> 
         </li>  
             <li>
             <a href="crearcp.php">
             <i class='bx bx-user-plus' ></i>
             <spa class="links_name"> Crear C.P </spa>
             </a>
              <spa class="tooltip"> Crear C.P </spa> 
         </li>
         <li>
             <a href="#">
             <i class='bx bx-cog'></i>
             <spa class="links_name"> Configuracion </spa>
             </a>
              <spa class="tooltip"> Configuracion </spa> 
         </li>
         <li>
             <a href="cerrar.php">
             <i class='bx bx-arrow-back' ></i>
             <spa class="links_name"> Cerrar sesion </spa>
             </a>
              <spa class="tooltip"> Cerrar sesion </spa> 
         </li>
     </ul>
    </div>
    <div class="home_content">
    <section id="container">
    <div class="alert"><?php echo isset($alert) ? $alert : ' '; ?></div>
    <form  action="" method="POST">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Registro Clientes Potenciales</h5>
      </div>
      <div class="modal-body">
        <table>
        <tr>
        <td>    Tipo Cliente:</td>
        <td>  <label for="">
        <select name="tc">
        <?php include ("db.php");
        $consulta="SELECT * FROM tipo_cliente";
        $ejecutar = mysqli_query($conexion,$consulta);
        ?>
        <?php 
        foreach ($ejecutar as $opciones):
        ?>
        <option value="<?php echo $opciones["id_tc"]?>"> <?php echo $opciones["nombre"]?></option>
        <?php         endforeach        ?>
        </select></label></td>
        </tr>
        <tr>
        <td>  Nombres:</td>
        <td><input type="text" name="nombres"></td>
        </tr> 
        <tr>
        <td>   Apellidos:</td>
        <td><input type="text" name="apellidos"></td>
        </tr>   
        <tr>
        <td>    Edad:</td>
        <td><input type="text" name="edad" ></td>
        </tr>
        <tr>
        <td>    Ocupacion:</td>
        <td><input type="text" name="ocupacion"></td>
        </tr>
        <tr>
        <td>    Sexo:</td>
        <td><input type="text" name="sexo" placeholder="Masculino o Femenino"></td>
        </tr>
        <tr>
        <td>    Departamento:</td>
        <td>  <label for="">
        <select name="dep">
        <?php include ("db.php");
        $consulta="SELECT * FROM departamento ORDER BY nombred ASC";
        $ejecutar = mysqli_query($conexion,$consulta);
        ?>
        <?php 
        foreach ($ejecutar as $opciones):
        ?>
        <option value="<?php echo $opciones["id_dep"]?>"> <?php echo $opciones["nombred"]?></option>
        <?php         endforeach        ?>
        </select></label></td>
        </tr>
        <tr>
        <td>    Direccion:</td>
        <td><input type="text" name="direccion"></td>
        </tr>
        <tr>
        <td>    Correo:</td>
        <td><input type="email" name="correo"></td>
        </tr>
        <tr>
        <tr>
        <td>    Telefono:</td>
        <td><input type="text" name="tel"></td>
        </tr>
        <td>    Contacto por:</td>
        <td>  <label for="">
        <select name="fct">
        <?php include ("db.php");
        $consulta="SELECT * FROM forma_ct ORDER BY id_ct ASC";
        $ejecutar = mysqli_query($conexion,$consulta);
        ?>
        <?php 
        foreach ($ejecutar as $opciones):
        ?>
        <option value="<?php echo $opciones["id_ct"]?>"> <?php echo $opciones["forma"]?></option>
        <?php         endforeach        ?>
        </select></label></td>
        </tr>
        </table>
      </div>
      <div class="modal-footer">
      <button type="submit" class="btn btn-primary">Registrar</button>
      </div>
    </div>
  </div>
  </div>    
  </form>
        </table>
    </section>
    </form> 
    </div>
    <script>
        let btn = document.querySelector("#btnmen"); 
        let sidebar = document.querySelector(".sidebar"); 
        btn.onclick = function(){
            sidebar.classList.toggle("active");
        }
    </script>
</body>
</html>

