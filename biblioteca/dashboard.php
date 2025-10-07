<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        button{
            margin-bottom: 10px;
        }
        main{
            display: flex;
            flex-direction: row;
            .books{
                width: 50%;
                .book{
                    border: 2px, solid, black;
                }
                img{
                    width: 80px;
                    height: 80px;
                }
            }
            .insert-book{
                width: 50%;
                display: flex;
                justify-content: center;
                align-content: center;
                input{
                    display: block;
                    margin-bottom: 5px;
                }
            }
        }
    </style>
</head>
<body>
    <?php
        require_once 'components/navbar.php';
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
        if(!isset($_SESSION['userId'])){
            header('Location: http://localhost/biblioteca/login.php');
        }
    ?>
    <form action='scripts/logout.php' method='POST'>
        <p>Usuario: <?php echo $_SESSION['userName']?></p>
        <button>Cerrar sesión</button>
    </form>
    <main>
        <section class='books'>
            <?php
                require_once "scripts/connection.php";
                
                try{
                    if(session_status() === PHP_SESSION_NONE){
                        session_start();
                    }

                    $statement = $connection -> prepare(
                        "SELECT * FROM books WHERE user_id = (
                            SELECT id FROM users WHERE id = (?)
                        ) ORDER BY YEAR"
                    );
                    $statement -> execute([$_SESSION['userId']]);
                    $result = $statement -> fetchall(PDO::FETCH_ASSOC);

                    for($i = 0; $i < sizeof($result); $i++){
                        echo "<div class='book'>";
                        echo "<p>Título: " . $result[$i]['title'] . "</p>";
                        echo "<p>Autor: " . $result[$i]['author'] . "</p>";
                        echo "<p>Categoría: " . $result[$i]['category'] . "</p>";
                        echo "<p>Año: " . $result[$i]['year'] . "</p>";
                        echo "<img src=\"" . $result[$i]['image'] . "\"/>";
                        echo "<p>Descripción: " . $result[$i]['description'] . "</p>";
                        echo "<p>Url: <a href='" . $result[$i]['url'] . "'>" . $result[$i]['url'] .  "</a></p>";
                        echo "<p>Id del libro: " . $result[$i]['id'] . "</p>";
                        // echo "<button>Actualizar libro</button>";
                        // echo "        
                        //     <form action='scripts/update.php' method='POST' id='update-form'>
                        //         <h2>Actualizar libro</h2>
                        //         <input type='hidden' name='id' value='" . $result[$i]['id'] . "'>
                        //         Título: <input name='title'/>
                        //         Descripción: <input name='description'/>
                        //         Autor: <input name='author'/>
                        //         Imagen: <input type='file' name='image'/>
                        //         Categoría: <input name='category'/>
                        //         Enlace URL: <input name='url'/>
                        //         Año: <input name='year'/>
                        //         <button>Registrar libro</button>
                        //     </form>
                        // ";
                        echo "</div>";
                        echo "<hr>";
                    }
                }catch(Exception $error){
                    echo "Unexpected error at dashboard: " . $error -> getMessage();
                }
            ?>
        </section>
        <section class='insert-book'>
            <form action='scripts/insert.php' method='POST' enctype='multipart/form-data'>
                <h2>Registrar nuevo libro</h2>
                Título: <input name='title'/>
                Descripción: <input name='description'/>
                Autor: <input name='author'/>
                Imagen: <input type='file' name='image'/>
                Categoría: <input name='category'/>
                Enlace URL: <input name='url'/>
                Año: <input name='year'/>
                <button>Registrar libro</button>
            </form>
        </section>
    </main>
</body>
</html>