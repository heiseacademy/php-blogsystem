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

if(isset($_POST["submit"])) {
    $query = "DELETE FROM blogarticles WHERE id = :blogid;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam("blogid", $_POST["submit"]);
    $stmt->execute();
    header("location: /");
    exit();
} 

$query = "SELECT * FROM blogarticles WHERE id = :blogid;";
$stmt = $pdo->prepare($query);
$stmt->bindParam("blogid", $_GET["id"]);
$stmt->execute();

$article = $stmt->fetch(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogarticles Detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>

    <a href="/" class="btn btn-primary"><- Zurück</a>
    
    <div class="container mt-5">

        <form action="/detail.php" method="POST">
            <button type="submit" class="btn btn-danger" name="submit" value="<?php echo $_GET["id"]; ?>">
                Artikel löschen
            </button>
        </form>

        <a href="/edit.php?id=<?php echo $_GET["id"]; ?>" class="btn btn-secondary mt-3 mb-4">Artikel Editieren</a>
        
        <img src="<?php echo $article["image"]; ?>" style="width:100%;height:auto;" />
        <div class="d-flex justify-content-between">
            <p>Author: <?php echo $article["author"]; ?></p>
            <p>Veröffentlichung: <?php echo $article["date"]; ?></p>
        </div>
        <h1><?php echo $article["title"]; ?></h1>
        <p><?php echo $article["text"]; ?></p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>