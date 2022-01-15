<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BV CRM</title>
    <link rel="stylesheet" href="css/buscador.css">
    <link rel="stylesheet" href="css/lista.css">
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
    <form method="POST">
    <section id="container">
        <h1>Lista de promociones</h1>
        <a href="crearpromocion.php" class="btn_new">Crear promocion</a>
        <table>
            <tr>
                <th>DETALLE PROMOCION</th>
                <th>FECHA DE VENCIMIENTO</th>
                <th>ACCIONES</th>
            </tr>
            <?php
            require('db.php');
            //Paginador
            $sql_registe = mysqli_query($conexion, "SELECT COUNT(*) as total_promociones FROM promociones");
            $result_register= mysqli_fetch_array($sql_registe);
            $total_registro = $result_register ['total_promociones'];

            $por_pagina = 5;

            if(empty($_GET['pagina'])){
                $pagina=1;
            }else{
                $pagina = $_GET['pagina'];
            }

            $desde = ($pagina-1) * $por_pagina;
            $total_paginas = ceil($total_registro / $por_pagina);


            $query= mysqli_query($conexion,"SELECT  `detalle`, `fecha_vencimiento` FROM `promociones`  
            ORDER BY fecha_vencimiento ASC
            LIMIT $desde, $por_pagina;");
            $result= mysqli_num_rows($query);
            if($result>0){
                while($data = mysqli_fetch_array($query)){
                    
                    ?>
                <tr>
                    <td><?php echo $data ["detalle"] ?></td>
                    <td> <?php echo $data ["fecha_vencimiento"] ?></td>
                    <td>
                        <a class="edit" href="actualizar.php?id=<?php echo $data ["id_cliente"] ?>">Editar</a>
                        |
                        <a class="elim" href="eliminar.php?id=<?php echo $data ["id_cliente"] ?>">Eliminar</a>
                    </td>
                </tr>
            <?php
        }
    }
    ?>
        </table>
        <div class="paginador">
            <ul>
                <?php
                if($pagina !=1){

                ?>

                <li><a href="?pagina=<?php echo 1; ?>">|<</a></li>
                <li><a href="?pagina=<?php echo $pagina-1; ?>"><<</a></li>
                <?php
                } 
                for ($i = 1; $i <= $total_paginas; $i++){
                    if($i== $pagina){
                        echo '<li class="pageSelected">'.$i.'</li>';
                    }else{

                    echo '<li><a href="?pagina='.$i.'">'.$i.'</a></li>';
                }
            }
            if ($pagina != $total_paginas){

                ?>
                <li><a href="?pagina=<?php echo $pagina + 1; ?>">>></a></li>
                <li><a href="?pagina=<?php echo $total_paginas; ?>">>|</a></li>
<?php }?>            
            </ul>
        </div>
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

