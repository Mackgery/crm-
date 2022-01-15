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
    <form method="POST"  action="busqueda_usuario.php">
    <section id="container">
        <?php 
        $busqueda = strtolower($_REQUEST['busqueda']);
        if(empty($busqueda)){
            header("location:buscador.php");
        }
        ?>
        <h1>Lista de clientes</h1>
        <a href="crearcp.php" class="btn_new">Crear cliente potencial</a>
        <form action="busqueda_usuario" method="get" class="form_search" > 
            <input type="text" name="busqueda" placeholder="Buscar" value="<?php echo $busqueda; ?>">
        </form>
        <table>
            <tr>
                <th>ID_CLIENTE</th>
                <th>NOMBRES</th>
                <th>APELLIDOS</th>
                <th>EDAD</th>
                <th>OCUPACION</th>
                <th>SEXO</th>
                <th>DEPARTAMENTO</th>
                <th>CORREO</th>
                <th>TELEFONO</th>
                <th>TIPO CLIENTE</th>
                <th>ACCIONES</th>
            </tr>
            <?php
            require('db.php');
            //Paginador
            $sql_registe = mysqli_query($conexion, "SELECT COUNT(*) as total_clientes FROM clientes WHERE
            (nombres LIKE '%$busqueda%' OR apellidos LIKE '%$busqueda%')");
            $result_register= mysqli_fetch_array($sql_registe);
            $total_registro = $result_register ['total_clientes'];

            $por_pagina = 10;

            if(empty($_GET['pagina'])){
                $pagina=1;
            }else{
                $pagina = $_GET['pagina'];
            }

            $desde = ($pagina-1) * $por_pagina;
            $total_paginas = ceil($total_registro / $por_pagina);


            $query= mysqli_query($conexion,"SELECT c.id_cliente, c.nombres, c.apellidos, c.edad, c.ocupacion, c.sexo, d.nombred, c.correo, c.telefono, tc.nombre
            FROM clientes c 
            INNER JOIN tipo_cliente tc ON c.id_tc = tc.id_tc 
            INNER JOIN departamento d ON c.id_dep = d.id_dep
            WHERE nombres LIKE '%$busqueda%'
            OR apellidos LIKE '%$busqueda%' 
            ORDER BY id_cliente ASC
            LIMIT $desde, $por_pagina;");
            $result= mysqli_num_rows($query);
            if($result>0){
                while($data = mysqli_fetch_array($query)){
                    
                    ?>
                <tr>
                    <td> <?php echo $data ["id_cliente"] ?></td>
                    <td> <?php echo $data ["nombres"] ?></td>
                    <td><?php echo $data ["apellidos"] ?></td>
                    <td><?php echo $data ["edad"] ?></td>
                    <td><?php echo $data ["ocupacion"] ?></td>
                    <td><?php echo $data ["sexo"] ?></td>
                    <td><?php echo $data ["nombred"] ?></td>
                    <td><?php echo $data ["correo"] ?></td>
                    <td><?php echo $data ["telefono"] ?></td>
                    <td><?php echo $data ["nombre"] ?></td>
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

                <li><a href="?pagina=<?php echo 1; ?>&busqueda=<?php echo $busqueda; ?>">|<</a></li>
                <li><a href="?pagina=<?php echo $pagina-1; ?>&busqueda=<?php echo $busqueda; ?>"><<</a></li>
                <?php
                } 
                for ($i = 1; $i <= $total_paginas; $i++){
                    if($i== $pagina){
                        echo '<li class="pageSelected">'.$i.'</li>';
                    }else{

                    echo '<li><a href="?pagina='.$i.'&busqueda='.$busqueda.'">'.$i.'</a></li>';
                }
            }
            if ($pagina != $total_paginas){

                ?>
                <li><a href="?pagina=<?php echo $pagina + 1; ?>&busqueda=<?php echo $busqueda; ?>">>></a></li>
                <li><a href="?pagina=<?php echo $total_paginas; ?>&busqueda=<?php echo $busqueda; ?>">>|</a></li>
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

