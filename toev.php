<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $errors = [];
    $formValues = [
        'naam' => $_POST['naam'] ?? '',
        'artiesten' => $_POST['artiesten'] ?? '',
        'release_datum' => $_POST['release_datum'] ?? '',
        'url' => $_POST['url'] ?? '',
        'prijs' => $_POST['prijs'] ?? '',
    ];

    if (empty($_POST['naam'])) {
        $errors['naam'] = "Naam is verplicht.";
    }

    if (empty($_POST['artiesten'])) {
        $errors['artiesten'] = "Artiesten is verplicht.";
    }

    if (!empty($_POST['release_datum']) && !strtotime($_POST['release_datum'])) {
        $errors['release_datum'] = "Ongeldige releasedatum.";
    }

    if (!empty($_POST['url']) && !filter_var($_POST['url'], FILTER_VALIDATE_URL)) {
        $errors['url'] = "Ongeldige URL.";
    }

    if (isset($_FILES['afbeelding']) && $_FILES['afbeelding']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['afbeelding']['tmp_name'];
        $fileName = $_FILES['afbeelding']['name'];
        $fileSize = $_FILES['afbeelding']['size'];
        $fileType = $_FILES['afbeelding']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

        $allowedfileExtensions = ['jpg', 'gif', 'png'];
        if (in_array($fileExtension, $allowedfileExtensions)) {
            $uploadFileDir = './uploaded_images/';
            $dest_path = $uploadFileDir . $newFileName;

            if (!file_exists($uploadFileDir)) {
                mkdir($uploadFileDir, 0777, true);
            }

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $formValues['afbeelding'] = $dest_path;
            } else {
                $errors['afbeelding'] = 'There was an error moving the uploaded file.';
            }
        } else {
            $errors['afbeelding'] = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
        }
    } else {
        $errors['afbeelding'] = 'Error in file upload.';
    }

    if (empty($errors)) {
        require_once 'db.php';
        require_once 'classes/Album.php';

        $album = new Album(
            null,
            $_POST['naam'],
            $_POST['artiesten'],
            $_POST['release_datum'],
            $_POST['url'],
            $formValues['afbeelding'],
            $_POST['prijs']
        );

        $album->save($db);

        header("Location: album.php");
        exit;
    } else {
        $_SESSION['errors'] = $errors;
        $_SESSION['formValues'] = $formValues;

        header("Location: album.php");
        exit;
    }

} else {
    header("Location: album.php");
    exit;
}

