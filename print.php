<!DOCTYPE html>

<html>

<body>
    <?php
    if (isset($_POST['submit'])) {
        foreach ($_POST as $key => $val) {
            echo "$key" . " = " . "$val<br>";
        }
    }

    $file_name = $_FILES["filename"]["name"];
    $file_size = $_FILES["filename"]["size"];
    $file_tmp = $_FILES["filename"]["tmp_name"];
    $file_type = $_FILES["filename"]["type"];
    $file_path = "upload-images/" . $file_name;

    if (move_uploaded_file($file_tmp, "upload-images/" . $file_name)) {
        echo '<img style = "width : 20rem" src="' . $file_path . '"/>';
    } else echo $_FILES["filename"]["tmp_name"];
    ?>
</body>

</html>