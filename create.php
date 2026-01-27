<?php
if (isset($_POST['submit'])) {

    // inloggegevens gebruiker database binnenhalen
    include('config/config.php');

    // PDO gebruiken
    $dsn = "mysql:host=$dbHost;
            dbname=$dbName;
            charset=UTF8";

    // maak nieuw PDO object
    $pdo = new PDO($dsn, $dbUser, $dbPass);
   

    // $_POST waarden schoonmaken
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // INSERT query
   $sql = "INSERT INTO rollercoaster
        (   
              RollerCoaster 
             ,AmusementPark 
             ,Country
             ,TopSpeed 
             ,Height
             ,YearOfConstruction
        )
        VALUES
        (
              :RollerCoaster 
             ,:AmusementPark 
             ,:Country 
             ,:TopSpeed
             ,:Height 
             ,:YearOfConstruction
        )";


    // voorbereiden sql query uitvoering PDO
    $statement = $pdo->prepare($sql);

    $statement->bindValue(':RollerCoaster', $_POST['naamAchtbaan'], PDO::PARAM_STR);
    $statement->bindValue(':AmusementPark', $_POST['naamPretpark'], PDO::PARAM_STR);
    $statement->bindValue(':Country', $_POST['Land'], PDO::PARAM_STR);
    $statement->bindValue(':TopSpeed', $_POST['Topsnelheid'], PDO::PARAM_STR);
    $statement->bindValue(':Height', $_POST['Hoogte'], PDO::PARAM_STR);
    $statement->bindValue(':YearOfConstruction', $_POST['bouwjaar'], PDO::PARAM_STR);

    // query uitvoeren
    $statement->execute();

    // melding toevoegen
    $display = 'block';
    header('Refresh:3; index.php');
}
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
    <link rel="stylesheet" 
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="container mt-3">

        <div class="row justify-content-center" style="display:<?= $display ?? 'none'; ?>;">
            <div class="col-6">
                <div class="alert alert-success text-center" role="alert">
                    De gegevens zijn toegevoegd. U wordt teruggestuurd naar de index-pagina.
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-6"><h3 class="text-primary">Voer een nieuwe achtbaan in:</h3></div>
        </div>

        <div class="row justify-content-center">
            <div class="col-6">
                <form action="create.php" method="POST">
                    <div class="mb-3">
                        <label for="inputNaamAchtbaan" class="form-label">Naam Achtbaan:</label>
                        <input name="naamAchtbaan" placeholder="Vul de naam van de achtbaan in" type="text" class="form-control" id="inputNaamAchtbaan"
                               value="<?= $_POST['naamAchtbaan'] ?? '' ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label for="inputNaamPretpark" class="form-label">Naam Pretpark:</label>
                        <input name="naamPretpark" placeholder="Vul de naam van het pretpark in" type="text" class="form-control" id="inputNaamPretpark"
                               value="<?= $_POST['naamPretpark'] ?? '' ?>">
                    </div>

                    <div class="mb-3">
                        <label for="inputLand" class="form-label">Land:</label>
                        <input name="Land" placeholder="Vul het land in" type="text" class="form-control" id="inputLand"
                               value="<?= $_POST['Land'] ?? '' ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label for="inputTopsnelheid" class="form-label">Topsnelheid:</label>
                        <input name="Topsnelheid" placeholder="Vul de topsnelheid in" type="text" class="form-control" id="inputTopsnelheid"
                               value="<?= $_POST['Topsnelheid'] ?? '' ?>">
                    </div>

                    <div class="mb-3">
                        <label for="inputHoogte" class="form-label">Hoogte:</label>
                        <input name="Hoogte" placeholder="Vul de hoogte in" type="text" class="form-control" id="inputHoogte"
                               value="<?= $_POST['Hoogte'] ?? '' ?>">
                    </div>

                    <div class="mb-3">
                        <label for="inputYearOfConstruction" class="form-label">Bouwjaar:</label>
                        <input name="bouwjaar" placeholder="Vul het bouwjaar in" type="text" class="form-control" id="inputYearOfConstruction"
                               value="<?= $_POST['bouwjaar'] ?? '' ?>">
                    </div>

                    <div class="d-grid gap-2">
                        <button name="submit" type="submit" class="btn btn-primary btn-lg mt-2">Verstuur</button>                      
                    </div>
                </form>
            </div>
        </div>

        <div class="row justify-content-center mt-3">
            <div class="col-6">
                <a href="index.php">
                    <i class="bi bi-arrow-left-square-fill text-danger" style="font-size:1.5em"></i>
                </a>
            </div>  
        </div>
    </div>
</body>
</html>
