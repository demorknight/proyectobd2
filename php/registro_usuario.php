<?php

    include 'conexion_be.php';

    $Nombres_Empleado = $_POST['Nombres_Empleado'];
    $Apellidos_Empleado = $_POST['Apellidos_Empleado'];
    $Cargo = $_POST['Cargo'];
    $Usuario = $_POST['Usuario'];
    $Contrasena = $_POST['Contrasena'];
    //para encriptar un campo, en este caso contraseña//
    /*$Contrasena = hash('sha512', $Contrasena);*/

    $query = "INSERT INTO usuarios(Nombres_Empleado, Apellidos_Empleado, Cargo, Usuario, Contrasena) 
              VALUES('$Nombres_Empleado', '$Apellidos_Empleado', '$Cargo', '$Usuario', '$Contrasena')";

//evitar que no se repitan datos en la tabla //
    
    $verificar_usuario = mysqli_query($conexion, "SELECT * FROM usuarios WHERE Usuario = '$Usuario'");

    if (mysqli_num_rows($verificar_usuario) > 0) {
        echo '
            <script>
                alert("Ya existe este usuario, verifique nuevamente");

                window.location = "../index.php";
            </script>
        ';
        exit();
    }

    
    $ejecutar = mysqli_query($conexion, $query);

//en la linea window.location se puede cambiar la pagina a acceder, para no volver a la misma//
    if ($ejecutar) {
        echo '
            <script>
                alert("Usuario almacenado exitosamente");

                window.location = "../index.php"; 
            </script>
        ';
    
    } else{
        echo '
        <script>
                alert("Usuario no registrado, intentelo nuevamente");

                window.location = "../index.php"; 
            </script>
        
            ';

    }

    mysqli_close($conexion);



?>