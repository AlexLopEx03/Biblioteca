<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
        <form action='scripts/login.php' method='POST'>
            <h2>Login</h2>
            Email: <input type='email' name='userEmail'/>
            Usuario: <input name='userName'/>
            Contraseña: <input type='password' name='userPassword'/>
            <button>Iniciar sesión</button>
            <p>¿No te has registrado? <a href='register.php'>Regístrate</a></p>
        </form>
    </main>
</body>
</html>