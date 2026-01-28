<?php
include('config/config.php');


$dsn = "mysql:host=$dbHost;
        dbname=$dbName;
        charset=UTF8";




$pdo = new PDO($dsn, $dbUser,$dbPass);

if (isset($_POST['submit'])) {
    // Er is submit knop
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

 // var_dump($_POST);

$sql = "UPDATE   Rollercoaster as HAVE
        SET      RollerCoaster = :rollercoaster
                 ,AmusementPark = :amusementPark
                 ,Country = :country
                 ,TopSpeed = :topSpeed
                 ,Height = :height
                 ,YearOfConstruction = :yofc
        WHERE HAVE.Id = :id";
    
    $statement = $pdo->prepare($sql);
    
    $statement->bindValue(':rollercoaster', $_POST['RollerCoaster'], PDO::PARAM_STR);
    $statement->bindValue(':amusementPark', $_POST['AmusementPark'], PDO::PARAM_STR);
    $statement->bindValue(':country', $_POST['Country'], PDO::PARAM_STR);
    $statement->bindValue(':topSpeed', $_POST['TopSpeed'], PDO::PARAM_INT);
    $statement->bindValue(':height', $_POST['Height'], PDO::PARAM_INT);
    $statement->bindValue(':yofc', $_POST['YOFC'], PDO::PARAM_STR);
    $statement->bindValue(':id', $_POST['id'], PDO::PARAM_INT);

    $statement->execute();

    //Melding
    $display = 'flex';
    
    header('Refresh:3; index.php');

} else{
    // we komen op de update pagina

 


$sql = "SELECT HAVE.Id
              ,HAVE.RollerCoaster
              ,HAVE.AmusementPark
              ,HAVE.Country
              ,HAVE.TopSpeed
              ,HAVE.Height
              ,DATE_FORMAT (Have.YearOfConstruction, '%d-%m-%Y') AS YOFC
        FROM rollercoaster AS HAVE
        WHERE HAVE.Id = :id";

$statement = $pdo->prepare($sql);

$statement->bindValue(':id', $_GET['id'],PDO::PARAM_INT);

$statement->execute();


//Array

$result = $statement->fetch(PDO::FETCH_OBJ);

//data selecteren

// var_dump($result);



}
?>






<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" 
          rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" 
          crossorigin="anonymous">
</head>
<body>
  <div class="container mt-3">

    <!-- titel pagina -->
    <div class="row justify-content-center">
        <div class="col-6"><h3 class="text-primary">Wijzig de achtbaangegevens:</h3></div>
    </div>
    
    <div class="row justify-content-center" style="display:<?=$display ?? 'none'; ?>">
        <div class="col-6">
            <div class="alert alert-succes text-center" role="alert">
                De gegevens zijn gewijzigd. U wordt teruggestuurd naar de index-pagina
            </div>
        </div>
    </div>


    <div class="row justify-content-center">
            <div class="col-6">
                <form action="update.php" method="POST">
                    <div class="mb-3">
                        <label for="inputNaamAchtbaan" class="form-label">Naam Achtbaan:</label>
                        <input name="RollerCoaster" placeholder="Vul de naam van de achtbaan in" type="text" class="form-control" id="inputNaamAchtbaan"
                               value="<?= $result->RollerCoaster ?? $_POST['RollerCoaster'] ?>">
                    
                    </div>
                    
                    <div class="mb-3">
                        <label for="inputNaamPretpark" class="form-label">Naam Pretpark:</label>
                        <input name="AmusementPark" placeholder="Vul de naam van het pretpark in" type="text" class="form-control" id="inputNaamPretpark"                        
                               value="<?= $result->AmusementPark ?? $_POST ['AmusementPark'] ?>">
                    </div>

                    <div class="mb-3">
                        <label for="inputLand" class="form-label">Land:</label>
                        <input name="Country" placeholder="Vul het land in" type="text" class="form-control" id="inputLand"
                               value="<?=$result->Country ?? $_POST['Country'] ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label for="inputTopsnelheid" class="form-label">Topsnelheid:</label>
                        <input name="TopSpeed" placeholder="Vul de topsnelheid in" type="text" class="form-control" id="inputTopsnelheid"
                               value="<?=$result->TopSpeed ?? $_POST ['TopSpeed'] ?>">
                    </div>

                    <div class="mb-3">
                        <label for="inputHoogte" class="form-label">Hoogte:</label>
                        <input name="Height" placeholder="Vul de hoogte in" type="text" class="form-control" id="inputHoogte"
                               value="<?= $result->Height ?? $_POST['Height'] ?>">
                    </div>

                    <div class="mb-3">
                        <label for="inputYearOfConstruction" class="form-label">Bouwjaar:</label>
                        <input name="YOFC" placeholder="Vul het bouwjaar in" type="date" class="form-control" id="inputYearOfConstruction"
                               value="<?= $result->YOFC ?? $_POST ['YOFC'] ?>">
                    </div>

                    <input name="id" type= "hidden" value="<?= $result->Id ?? $_POST['id'] ?>">

                    <div class="d-grid gap-2">
                        <button name="submit" type="submit" class="btn btn-primary btn-lg mt-2">Verstuur</button>                      
                    </div>
                </form>
            </div>
        </div>
  </div>
    







    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>