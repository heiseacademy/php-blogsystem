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

if(isset($_POST["title"])) {
    $query = "UPDATE blogarticles SET title = :title, description = :description, image = :image, 
    author = :author, text = :text, date = :date WHERE id = :blogid";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam("title", $_POST["title"]);
    $stmt->bindParam("description", $_POST["description"]);
    $stmt->bindParam("image", $_POST["image"]);
    $stmt->bindParam("author", $_POST["author"]);
    $stmt->bindParam("text", $_POST["text"]);
    $stmt->bindParam("date", $_POST["date"]);
    $stmt->bindParam("blogid", $_GET["id"]);
    $stmt->execute();

    header("location: /detail.php?id=" . $_GET["id"]);
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
    <title>Blogarticle Editieren</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>

    <a href="/" class="btn btn-primary"><- Zurück</a>
    
    <div class="container mt-5">
    <form action="/edit.php?id=<?php echo $_GET["id"]; ?>" method="POST">
        <div class="mb-3">
            <label for="title" class="form-label">Titel des Artikels:</label>
            <input type="text" class="form-control" id="title" name="title" value="<?php echo $article["title"]; ?>">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Beschreibung</label>
            <input type="text" class="form-control" id="description" name="description" value="<?php echo $article["description"]; ?>">
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Bild:</label>
            <input type="text" class="form-control" id="image" name="image" value="<?php echo $article["image"]; ?>">
        </div>
        <div class="mb-3">
            <label for="author" class="form-label">Author</label>
            <input type="text" class="form-control" id="author" name="author" value="<?php echo $article["author"]; ?>">
        </div>
        <div class="mb-3">
            <label for="text" class="form-label">Blog Artikel Inhalt:</label>
            <textarea class="form-control" id="text" rows="5" name="text"><?php echo $article["text"]; ?></textarea>
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">Datum:</label>
            <input type="text" class="form-control" id="date" name="date" value="<?php echo $article["date"]; ?>">
        </div>
        
        
        <button type="submit" class="btn btn-primary mb-5">Artikel speichern</button>
    </form>
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>