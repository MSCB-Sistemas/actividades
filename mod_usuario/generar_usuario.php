<html>
    <head>
        <meta charset="UTF-8">
        <title>Generar Usuario</title>
        <link rel="stylesheet" href="../css/estilos.css">
    </head>

    <body>
        <h1>Generar Usuario</h1>
        <div>
            <form action="generar_usuario.php" method="post">
                <label for="usuario">Usuario:</label>
                <input type="text" id="usuario" name="usuario" required><br><br>

                <label for="clave">Contraseña:</label>
                <input type="password" id="clave" name="clave" required><br><br>

                <input type="submit" value="Generar Usuario">
            </form>
        </div>
    </body>
</html>