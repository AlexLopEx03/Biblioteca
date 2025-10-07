<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details</title>
</head>
<body>
    <?php
        require_once 'components/navbar.php';
    ?>
    <main>
        <?php
            require_once "scripts/connection.php";

            try{
                $statement = $connection -> prepare(
                    "SELECT * FROM books WHERE id = (?)"
                );
                $statement -> execute([$_GET['book']]);
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
                    echo "</div>";
                    echo "<hr>";
                }
            }catch(Exception $error){
                echo "Unexpected error at details: " . $error -> getMessage();
            }
        ?>
    </main>
</body>
</html>