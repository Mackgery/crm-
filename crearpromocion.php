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
    if(empty($_POST["Detalles"]) || empty($_POST["fv"])){
        $alert= '<p class="msg_error"> Todos los campos deben de ser completados.</p>'; 
    }
    else{
        include ("db.php");
        $detalle = $_POST["Detalles"];
        $fecha_vencimiento = $_POST["fv"];

        $query = mysqli_query($conexion, "SELECT * FROM promociones WHERE detalle = '$detalle'");
        $result= mysqli_fetch_array($query);

        if($result>0){
            $alert= '<p class="msg_error"> Esta promocion ya existe</p>';
        }else{
            $query_insert =mysqli_query($conexion,"INSERT INTO `promociones` ( `detalle`, `fecha_vencimiento`) 
            VALUES ('$detalle','$fecha_vencimiento')");
            if ($query_insert){
                $alert= '<p class="msg_save"> Promocion creada correctamete.</p>';
            }
            else{
                $alert= '<p class="msg_error"> Error al crear promocion.</p>';
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
        <h5 class="modal-title">Creacion de promociones</h5>
      </div>
      <div class="modal-body">
        <table>
        <tr>
        <td>  Detalles:</td>
        <td><textarea name="Detalles" maxlength="249" cols="30" rows="3"></textarea></td>
        </tr> 
        <tr>
        <td>   Fecha de vencimiento:</td>
        <td><input type="date" name="fv"></td>
        </tr>       
        </table>
      </div>
      <div class="modal-footer">
      <button type="submit" class="btn btn-primary">Crear</button>
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

