<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        main{
            height: 80dvh;
            display: flex;
            justify-content: center;
            align-content: center;
            form{
                display: flex;
                flex-flow: column;
                justify-content: center;
                align-content: center;
                .error{
                    color: red;
                }
            }
        }
    </style>
</head>
<body>
    <?php
        require_once 'components/navbar.php';
    ?>
    <main>
        <form action='scripts/register.php' method='POST'>
            <h2>Registro</h2>
            Email: <input type='email' name='userEmail'/>
            Usuario: <input name='userName'/>
            Contraseña: <input type='password' name='userPassword'/>
            <button>Registrarse</button>
            <p>¿Ya te has registrado? <a href='login.php'>Inicia sesión</a></p>
        </form>
    </main>
</body>
</html>