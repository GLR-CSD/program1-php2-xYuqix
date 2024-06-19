<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AlbumLijst</title>
    <link rel="stylesheet" href="public/css/simple.css">
</head>
<body>
<h1>AlbumLijst</h1>
<table>
    <tr>
        <th>ID</th>
        <th>Naam</th>
        <th>Artiesten</th>
        <th>Release_datum</th>
        <th>Url</th>
        <th>Afbeelding</th>
        <th>Prijs</th>
    </tr>
    <?php foreach ($albums as $album): ?>
        <tr>
            <td><?= $album->getId() ?></td>
            <td><?= $album->getNaam() ?></td>
            <td><?= $album->getArtiesten() ?></td>
            <td><?= $album->getRelease_datum() ?></td>
            <td><?= $album->getUrl() ?></td>
            <td><img src="<?= $album->getAfbeelding() ?>"></td>
            <td><?= $album->getPrijs() ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<div class="notice">
    <h2>Album Toevoegen:</h2>
    <?php if (!empty($errors)): ?>
        <div style="color: red;">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <form action="../toev.php" method="post" enctype="multipart/form-data">
        <label for="naam">Naam:</label>
        <input type="text" id="naam" name="naam" value="<?= $formValues['naam'] ?? '' ?>" required>
        <?php if (isset($errors['naam'])): ?>
            <span style="color: red;"><?= $errors['naam'] ?></span>
        <?php endif; ?><br>

        <label for="artiesten">Artiesten:</label>
        <input type="text" id="artiesten" name="artiesten" value="<?= $formValues['artiesten'] ?? '' ?>"  required>
        <?php if (isset($errors['artiesten'])): ?>
            <span style="color: red;"><?= $errors['artiesten'] ?></span>
        <?php endif; ?><br>

        <label for="release_datum">Release_datum:</label>
        <input type="date" id="release_datum" name="release_datum" value="<?= $formValues['release_datum'] ?? '' ?>">
        <?php if (isset($errors['release_datum'])): ?>
            <span style="color: red;"><?= $errors['release_datum'] ?></span>
        <?php endif; ?><br>

        <label for="url">Url:</label>
        <input type="url" id="url" name="url" value="<?= $formValues['url'] ?? '' ?>">
        <?php if (isset($errors['url'])): ?>
            <span style="color: red;"><?= $errors['url'] ?></span>
        <?php endif; ?><br>

        <label for="afbeelding">Afbeelding:</label>
        <input type="file" id="afbeelding" name="afbeelding" accept="image/*" >
        <?php if (isset($errors['afbeelding'])): ?>
            <span style="color: red;"><?= $errors['afbeelding'] ?></span>
        <?php endif; ?><br>

        <label for="prijs">Prijs:</label>
        <input type="prijs" id="prijs" name="prijs" value="<?= $formValues['prijs'] ?? '' ?>">
        <?php if (isset($errors['prijs'])): ?>
            <span style="color: red;"><?= $errors['prijs'] ?></span>
        <?php endif; ?><br>

        <input type="submit" value="Toevoegen">
    </form>
</div>

</body>
</html>
