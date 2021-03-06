<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BV CRM</title>
    <link rel="stylesheet" href="css/principal.css">
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
              <spa class="tooltip"> Act data </spa> 
         </li>         <li>
             <a href="promociones.php">
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
        <div class="text">Bienvenido <?php echo $_SESSION["Usuario"]?> por favor seleccione una opcion para continuar </div>
        <img class="decorativa" src="img/inicial.png" alt="no se encontro la imagen">
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

