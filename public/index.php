<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="../assets/css/index.css">
</head>
<body>
    <!-- Encabezado -->
    <header class="head">
        <h1>CARPINTERÍA Y DISEÑO T.S.</h1>
        <h5>¡Diseñamos al alcance de tu presupuesto!</h5>
    </header>

    <!-- Espacio superior -->
    <section class="espacio"></section>

    <!-- Contenedor principal -->
    <main>
        <div class="container">

            <!-- Caja trasera: login o registro -->
            <div class="caja_atras">
                <div class="caja_atras_login">
                    <h3>¿Tienes una cuenta?</h3>
                    <p>Inicia sesión para ingresar al sistema</p>
                    <button id="boton_sesion">Iniciar Sesión</button>
                </div>

                <div class="caja_atras_registro">
                    <h3>¿No tienes una cuenta?</h3>
                    <p>Regístrate para empezar a usar el sistema</p>
                    <button id="boton_registro">Registrarse</button>
                </div>
            </div>

            <!-- Formularios login y registro -->
            <div class="contenedor_login_registro">
                <!-- Formulario de inicio de sesión -->
                <form action="login_usuario_be.php" method="POST" class="container_login">
                    <h2>Inicio de Sesión</h2>
                    <span>Escriba su usuario</span>
                    <input type="text" name="identificacion" placeholder="Identificación" required>

                    <span>Escriba su contraseña</span>
                    <input type="password" name="Contrasena" placeholder="Contraseña" required>

                    <button type="submit">INICIO</button>
                </form>

                <!-- Formulario de registro -->
                <form action="registro_usuario.php" method="POST" class="container_registro">
                    <h2>Registro</h2>
                    <span>Nombre completo</span>
                    <input type="text" name="nombre_usuario" placeholder="Nombre y Apellidos" required>

                    <span>Identificación</span>
                    <input type="text" name="identificacion" placeholder="Número de documento" required>

                    <span>Correo electrónico</span>
                    <input type="email" name="correo" placeholder="Correo" required>

                    <span>Contraseña</span>
                    <input type="password" name="contrasena" placeholder="Contraseña" required>

                    <span>Rol</span>
                    <select name="rol" required>
                        <option value="vendedor">Vendedor</option>
                        <option value="admin">Administrador</option>
                    </select>

                    <button type="submit">REGISTRO</button>
                </form>
            </div>
        </div>
    </main>

    <!-- Pie de página -->
    <section class="espacio_2"></section>
    <aside class="empresa">
        <h6>Elaborado por DEEP TECH 2025</h6>
    </aside>

    <script src="/assets/js/script.js"></script>
</body>
</html>
