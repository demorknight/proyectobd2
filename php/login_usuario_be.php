<?php

    session_start();

    include 'conexion_be.php';

    $Usuario = $_POST['Usuario'];
    $Contrasena = $_POST['Contrasena'];

    $validar_login = mysqli_query($conexion, "SELECT * FROM usuarios WHERE Usuario='$Usuario' and contrasena='$Contrasena'");

    if (mysqli_num_rows($validar_login) > 0) {
        
        header("location: ../documento.php");
        
        exit;
            
    } else{
        echo'
        <script>
                alert("Usuario no existente, por favor verifique los datos introducidos");

                window.location = "../index.php"; 
            </script>
        
            ';
        exit;

    }






?>