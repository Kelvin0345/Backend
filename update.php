<?php
include('config/config.php');


$dsn = "mysql:host=$dbHost;
        dbname=$dbName;
        charset=UTF8";




$pdo = new PDO($dsn, $dbUser,$dbPass);

if (isset($_POST['submit'])) {
    // Er is submit knop
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);



$sql = "UPDATE rollercoaster as HAVE
        SET    RollerCoaster = :rollercoaster
              ,AmusementPark = :amusementPark
              ,Country = :country
              ,TopSpeed = :topSpeed
              ,Height = :height
              ,YearOfConstruction = :yearOfConstruction
        WHERE HAVE.Id = :id";
    
    $statement = $pdo->prepare($sql);
    
    $statement->bindValue(':RollerCoaster', $_POST['naamAchtbaan'], PDO::PARAM_STR);
    $statement->bindValue(':AmusementPark', $_POST['naamPretpark'], PDO::PARAM_STR);
    $statement->bindValue(':Country', $_POST['Land'], PDO::PARAM_STR);
    $statement->bindValue(':TopSpeed', $_POST['Topsnelheid'], PDO::PARAM_STR);
    $statement->bindValue(':Height', $_POST['Hoogte'], PDO::PARAM_STR);
    $statement->bindValue(':YearOfConstruction', $_POST['bouwjaar'], PDO::PARAM_STR);

    $statement->execute();

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
    
    <div class="row justify-content-center">
            <div class="col-6">
                <form action="create.php" method="POST">
                    <div class="mb-3">
                        <label for="inputNaamAchtbaan" class="form-label">Naam Achtbaan:</label>
                        <input name="naamAchtbaan" placeholder="Vul de naam van de achtbaan in" type="text" class="form-control" id="inputNaamAchtbaan"
                               value="<?= $result->Rollercoaster ?? '' ?>">
                    
                    </div>
                    
                    <div class="mb-3">
                        <label for="inputNaamPretpark" class="form-label">Naam Pretpark:</label>
                        <input name="naamPretpark" placeholder="Vul de naam van het pretpark in" type="text" class="form-control" id="inputNaamPretpark"
                               value="<?= $result->Pretpark ?? '' ?>">
                    </div>

                    <div class="mb-3">
                        <label for="inputLand" class="form-label">Land:</label>
                        <input name="Land" placeholder="Vul het land in" type="text" class="form-control" id="inputLand"
                               value="<?=$result->Land ?? '' ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label for="inputTopsnelheid" class="form-label">Topsnelheid:</label>
                        <input name="Topsnelheid" placeholder="Vul de topsnelheid in" type="text" class="form-control" id="inputTopsnelheid"
                               value="<?=$result->Topsnelheid ?? '' ?>">
                    </div>

                    <div class="mb-3">
                        <label for="inputHoogte" class="form-label">Hoogte:</label>
                        <input name="Hoogte" placeholder="Vul de hoogte in" type="text" class="form-control" id="inputHoogte"
                               value="<?= $result->Hoogte ?? '' ?>">
                    </div>

                    <div class="mb-3">
                        <label for="inputYearOfConstruction" class="form-label">Bouwjaar:</label>
                        <input name="bouwjaar" placeholder="Vul het bouwjaar in" type="text" class="form-control" id="inputYearOfConstruction"
                               value="<?= $result->Bouwjaar ?? '' ?>">
                    </div>

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