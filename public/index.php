<?php

//Require config php for credentials.
require_once __DIR__ . "/../config.php";


//PDO Connection:
$pdo = new PDO(
    "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . "", 
    DB_USERNAME, 
    DB_PASSWORD
);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$query = "SELECT * FROM blogarticles;";
$stmt = $pdo->prepare($query);
$stmt->execute();

$blogarticles = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogsystem</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    

    <div class="container mt-5">
        <a href="/create.php" class="btn btn-secondary mb-4">Artikel erstellen +</a>
        <div class="row">
            <?php foreach($blogarticles as $article): ?>
                <div class="col col-lg-4">
                    <div class="card" style="width: 18rem;">
                        <img src="<?php echo $article["image"]; ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">
                                <?php echo $article["title"]; ?>
                            </h5>
                            <p class="card-text">
                                <?php echo $article["description"]; ?>
                            </p>
                            <a href="/detail.php?id=<?php echo $article["id"]; ?>" class="btn btn-primary">Weiter lesen</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>

