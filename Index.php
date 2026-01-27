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
 * 
 */

$sql = "SELECT HAVE.Id
              ,HAVE.RollerCoaster
              ,HAVE.AmusementPark
              ,HAVE.Country
              ,HAVE.TopSpeed
              ,HAVE.Height
              ,DATE_FORMAT (Have.YearOfConstruction, '%d-%m-%Y') AS YOFC
        FROM Rollercoaster AS HAVE
        ORDER BY HAVE.Height DESC";


 /**
 * STATEMENTS
 */

$statement = $pdo->prepare($sql);

//uitvoeren

$statement->execute();


//Array

$result = $statement->fetchAll(PDO::FETCH_OBJ);

//data selecteren

//var_dump($result);

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
        
        <div class="row-justify-content-center">
            <div class="col-8">
                <h3>Hoogste achtbanen van Europa</h3>
            </div>
        </div>

        <div class="row justidy-content-center my-3">
            <div class="col-10"><h6>Nieuwe achtbaan <a href="./create.php"><i class="bi bi-plus-square text-danger text-danger"></i></h6></a></div>
        </div>

        <div class="row-justify-content-center mt-3">
            <div class="col-10">
                <table class="table table-striped table-hover ">
                    <thead>
                        <th>Naam Achtbaan</th>
                        <th>Naam Pretpark</th>
                        <th>Land</th>
                        <th>Topsnelheid (km/u)</th>
                        <th>hoogte(M)</th>
                        <th>Bouwjaar</th>
                        <th>Wijzig</th>
                        <th>Verwijder</th>
                    </thead>
                    <tbody>
                        <?php foreach ($result as $Rollercoaster):?>
                            <tr>
                                <td><?= $Rollercoaster->RollerCoaster; ?></td>
                                <td><?= $Rollercoaster->AmusementPark; ?></td>
                                <td><?= $Rollercoaster->Country; ?></td>
                                <td class="text-center"><?= $Rollercoaster->TopSpeed; ?></td>
                                <td class="text-center"><?= $Rollercoaster->Height; ?></td>
                                <td ><?= $Rollercoaster->YOFC; ?></td>
                                
                                <td class="text-center">
                                    <a href="update.php?id=<?=  $Rollercoaster->Id; ?>">
                                      <i class="bi bi-pencil-square text-success"></i>
                                    </a>
                                </td>
                                
                                <td class='text-center'>
                                    <a href="delete.php?id=<?= $Rollercoaster->Id; ?>">
                                        <i class="bi bi-x-square text-danger"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>   
                    </tbody>
                </table>
            </div>
        </div>

    </div>
   
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" 
            crossorigin="anonymous">
    </script>
</body>
</html

