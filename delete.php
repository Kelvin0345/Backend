<?php
/**
 * Haal de inloggevens op uit het bestand config.php
 */
include ('config/config.php');

/**
 * datasourcestrings maken
 * 
 */

$dsn = "mysql:host=$dbHost;
        dbname=$dbName;
        charset=UTF8";

/**
 * PDO-Object
 */
$pdo = new PDO($dsn, $dbUser,$dbPass);

/**
 * select sql query
 * 
 */

$sql = "DELETE FROM rollercoaster
        WHERE Id = :id";


 /**
 * STATEMENTS
 */

$statement = $pdo->prepare($sql);

//KOPPEL de id aan query

$statement->bindParam(':id', $_GET['id'], PDO::PARAM_INT);


//geprepareede uit sql database

$statement->execute();

//stuur gebruiker terug naar index.php

header('Refresh: 3; url=index.php');

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD-basic</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" 
         rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" 
         crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="container-mt-3">
        <div class="row-justify-content-center mt-3">
            <div class="col-10">
                <div class="alert alert-success text-center" role="alert">
                    De gegevens zijn verwijderd. u wordt teruggestuurd naar de index-pagina.
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" 
            crossorigin="anonymous">
    </script>
</body>
</html