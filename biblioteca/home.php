<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        main{
            display: flex;
            flex-direction: row;
            .books{
                width: 50dvw;
                .book{
                    border: 2px, solid, black;
                }
                img{
                    width: 80px;
                    height: 80px;
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
        <section class='books'>
            <?php
                require_once "scripts/connection.php";

                try{

                    if(session_status() === PHP_SESSION_NONE){
                        session_start();
                    }

                    $statement = $connection -> prepare(
                        "SELECT * FROM books"
                    );
                    $statement -> execute();
                    $result = $statement -> fetchall(PDO::FETCH_ASSOC);

                    for($i = 0; $i < sizeof($result); $i++){
                        echo "<div class='book'>";
                        echo "<p>Título: <a href=" . 'http://localhost/biblioteca/details.php?book=' . $result[$i]['id'] . "'>" . $result[$i]['title'] . "</a></p>";
                        echo "<p>Autor: " . $result[$i]['author'] . "</p>";
                        echo "<img src=\"" . $result[$i]['image'] . "\"/>";
                        echo "<p>Año: " . $result[$i]['year'] . "</p>";
                        echo "</div>";
                        echo "<hr>";
                    }
                }catch(Exception $error){
                    echo "Unexpected error at home: " . $error -> getMessage();
                }
            ?>
        </section>
    </main>
</body>
</html>