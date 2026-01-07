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

$sql = "select Have Id
              ,Have RollerCoaster
              ,Have AmusmentPark
              ,Have Country
              ,Have TopSpeed
              ,Have Height
              ,DATE_FORMAT(Have YearOfConstruction, '%d-%m-%Y') AS YOFC
        FROM HoogsteAchtbaanVanEuropaAS HAVE 
        ORDER BY HAVE Height DESC";


 /**
 * STATEMENTS
 */

$statement = $pdo->prepare($sql);

//uitvoeren

$statement ->execute();


//Array

$result = $statement->fetchAll(PDO::FETCH_OBJ);

//data selecteren

var_dump($result);

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
</head>
<body>
    <div class="container-mt-3">
        
        <div class="row-justify-content-center">
            <div class="col-8">
                <h3>Hoogste achtbanen van Europa</h3>
            </div>
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
                    </thead>
                    <tbody>
                        <tr>
                            <td>Kingda Ka</td>
                            <td>Six Flags Great Adventure</td>
                            <td>Verenigd Koninkrijk</td>
                            <td>206</td>
                            <td>127</td>
                            <td>2005-10-21</td>
                        </tr>
                        <tr>
                            <td>Red Force</td>
                            <td>Ferrari Land</td>
                            <td>Spanje</td>
                            <td>180</td>
                            <td>112</td>
                            <td>2017-04-07</td>
                        </tr>
                        <tr>
                            <td>Hyperion</td>
                            <td>Energylandia</td>
                            <td>Polen</td>
                            <td>142</td>
                            <td>77</td>
                            <td>2018-08-14</td>
                        </tr>
                        <tr>
                            <td>Shambhala</td>
                            <td>PortAventura Park</td>
                            <td>Spanje</td>
                            <td>134</td>
                            <td>76</td>
                            <td>2012-04-07</td>
                        </tr>
                        <tr>
                            <td>Schwur des Kärnen</td>
                            <td>Hansa Park</td>
                            <td>Duitsland</td>
                            <td>127</td>
                            <td>73</td>
                            <td>2017-02-25</td>
                        </tr>
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

