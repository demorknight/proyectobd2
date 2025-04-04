<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="acceso/styles.css">

</head>
<body>
    <!--encabezado pagina-->
    <header class="head">
        <h1>CARPINTERIA Y DISEÑO T.S.</h1>
        <h5>¡Diseñamos al alcance de tu presupuesto!</h5>

    </header>
    
    <!--espacio en la pagina-->
    <section class="espacio">

    </section>

    <!--contendor para llenar formulario login y registro-->
    <main>
        <div class="container">
            <!--caja trasera-->
            <div class="caja_atras">
                <div class="caja_atras_login">
                    <h3>¿Tienes una cuenta?</h3>
                    <p>Inicie sesión para ingresar a la pagina</p>
                    <button id="boton_sesion">Iniciar Sesión</button>

                </div>

                <div class="caja_atras_registro">
                    <h3>¿No tienes una cuenta?</h3>
                    <p>Registrate para ingresar a la pagina</p>
                    <button id="boton_registro">Registrarse</button>

                </div>
                

            </div>
        
            <!--formularios login y registro-->
            <div class="contenedor_login_registro">
            <!--login-->
                <form action="php/login_usuario_be.php" method="POST"   class="container_login">
                    <h2>Inicio Sesión</h2>
                    <span>escriba su usuario</span>
                    <input type="text" placeholder="Usuario" name="Usuario">
                    <span>escriba su contraseña</span>
                    <input type="password" placeholder="Contraseña" name="Contrasena">
                    <button>INICIO</button>

                </form>
                <!--registro-->
                <form action= "php/registro_usuario.php" method="POST"  class= "container_registro">
                    <h2>Registrarse</h2>
                    <span>escriba sus nombres</span>
                    <input type="text" placeholder="Nombres Empleado" name="Nombres_Empleado">
                    <span>escriba sus apellidos</span>
                    <input type="text" placeholder="Apellidos Empleado" name="Apellidos_Empleado">
                    <span>escriba su cargo</span>
                    <input type="number" placeholder="Cargo" name="Cargo">
                    <span>escriba su número de documento</span>
                    <input type="text" placeholder="Usuario" name="Usuario">
                    <span>escriba su contraseña</span>
                    <input type="password" placeholder="Contraseña" name="Contrasena">
                    <button>REGISTRO</button>

                </form>
            
            </div>
 
        </div>

    </main>

    <section class="espacio_2">

    </section>

>
    <aside class="empresa">
        <h6>Elaborado por DEEP TECH 2025</h6>
        <h6></h6>
    </aside>
    
    <script src="acceso/script.js"></script>

</body>
</html>


<!--
        </div> class="sign-in">
                <h2>Inicio Sesión</h2>
                <span>escriba su usuario</span>
                <div class="container-input">
                    <input type="text" placeholder="código">
                </div>

                <span>contraseña</span>
                <div class="container-input">
                    <input type="password" placeholder="Password">
                </div>

                <a href="#">¿Olvidaste la contraseña?</a>

                <button class="button">INICIO</button>

            </form>
        </div>

        <div class="container-form">
            <form class="sign-up">
                <h2>Registrarse</h2>
                <span>Escriba su nombre</span>
                <div class="container-input">
                    <input type="text" placeholder="Nombres">
                </div>

                <span>Escriba su apellido</span>
                <div class="container-input">
                    <input type="text" placeholder="Apellidos">
                </div>

                <span>Escriba su número de documento</span>
                <div class="container-input">
                    <input type="text" placeholder="Id">
                </div>

                <span>Escriba su contraseña</span>
                <div class="container-input">
                    <input type="password" placeholder="Password">
                </div>

                <button class="button">GUARDAR</button>
            </form>


        </div>


    </section>
    -->
<!--pie de pagina--