<?php
if (isset($_FILES['fname'])) {
    $fileinfo = $_FILES['fname'];
    $allowed = ['application/pdf','application/msword','image/webp','image/gif','image/jpg','image/jpeg','image/png'];
    $size =  $fileinfo['size'];

    $uploadDir = "files/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    if (in_array($fileinfo['type'], $allowed) && $size <= 400 * 1024) {
        if (move_uploaded_file($fileinfo['tmp_name'], $uploadDir . basename($fileinfo['name']))) {
            $message = "Success!";
        } else {
            $message = "Failed to move uploaded file.";
        }
    } else {
        $message = "Check type and size.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>File Upload</title>
</head>
<body>
    <h1>File upload: <?php echo isset($message) ? $message : ""; ?></h1>
    <fieldset>
        <legend>File</legend>
        <form action="" method="post" enctype="multipart/form-data">
            <label style="padding: 5px; border:2px solid gray" for="fname">Select File</label>
            <input type="file" name="fname" id="fname" required style="display:none">
            <hr>
            <input type="submit" value="Upload" name="upload">
        </form>
    </fieldset>
</body>
</html>
