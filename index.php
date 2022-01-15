    <!DOCTYPE html>
<html lang="en" xmlns:th="http://www.thymeleaf.org">
<head>
    <title>Pagina inicial</title>

    <!-- FRAMEWORK BOOTSTRAP para el estilo de la pagina-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    
    <!-- Los iconos tipo Solid de Fontawesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/solid.css">
    
    <!-- Nuestro css-->
    <link rel="stylesheet" type="text/css" href="css/index.css">

</head>
<body>
<form class="formulario" method="post" action="validar.php">
    <div class="modal-dialog text-center">
        <div class="col-sm-10 main-section">
            <div class="modal-content">
                <div class="col-12 user-img">
                    <img src="img/user.png"/>
                <form class="col-12" ">
                    <div class="form-group" id="user-group">
                        <input type="email" class="form-control" placeholder="Usuario" name="Usuario" required=""/> <br> 
                    </div>
                    <div class="form-group" id="contrasena-group">
                        <i class="fas fa-dragon"></i><input type="password" class="form-control" placeholder="Contraseña" name="contra"/>
                    </div>
                    <button type="submit" class="btn btn-primary">Ingresar</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
    </form>
</body>
</html>
