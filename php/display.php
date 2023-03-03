<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table,
        td,
        th {
            border: 1px solid rgb(169, 169, 169);
            border-collapse: collapse;
        }

        td,
        th {
            padding: 0.5rem 1rem;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
        }

        .qualification_column {
            padding: 0;

        }
    </style>
</head>

<body>
    <br>

    <?php
    include dirname(__FILE__, 2) . "/" . "php/" . "connectConfig.php";
    echo "display.php";

    $query = $conn->query("SELECT * FROM table_form where post_id = $id");
    if ($query->num_rows > 0) {
        $row = $query->fetch_assoc();
    }
    ?>

    <div class="preview">
        <h1>Display</h1>
        <table style=" border: 1px solid rgb(169, 169, 169); border-collapse: collapse;">
            <tr>
                <th>firstname</th>
                <th>lastname</th>
                <th>email</th>
                <th>gender</th>
                <th>hobbies</th>
                <th>subject</th>
                <th>about_yourself</th>
                <th>image_files</th>
                <th>password</th>
                <th>date</th>
                <th>edited_at</th>
                <th>Qualification Table</th>
                <th>Uploaded Images</th>
            </tr>
            <tr>
                <td> <?php echo $row['firstname']; ?> </td>
                <td> <?php echo $row['lastname']; ?> </td>
                <td> <?php echo $row['email']; ?> </td>
                <td> <?php echo $row['gender']; ?> </td>
                <td> <?php echo $row['hobbies']; ?> </td>
                <td> <?php echo $row['subject']; ?> </td>
                <td> <?php echo $row['about_yourself']; ?> </td>
                <td> <?php echo $row['image_files']; ?> </td>
                <td> <?php echo $row['password']; ?> </td>
                <td> <?php echo $row['date']; ?> </td>
                <td> <?php echo $row['edited_at']; ?> </td>
                <td class="qualification_column">
                    <table>
                        <tr>
                            <th>education</th>
                            <th>branch</th>
                            <th>year</th>
                            <th>marks</th>
                        </tr>
                        <tr>
                            <?php
                            $quali_query = $conn->query("SELECT * FROM Qualification_table where post_request_id = $id");
                            if ($quali_query->num_rows > 0) {
                                while ($quali_row = $quali_query->fetch_assoc()) { ?>
                                    <td> <?php echo $quali_row['education'] ?> </td>
                                    <td> <?php echo $quali_row['branch'] ?> </td>
                                    <td> <?php echo $quali_row['year'] ?> </td>
                                    <td> <?php echo $quali_row['marks'] ?> </td>
                        </tr>

                <?php }
                            } ?>
                </td>

        </table>
        <td>
            <?php
            for ($i = 0; $i < count($_FILES['filename']['name']); $i++) {
                $file_name = $_FILES["filename"]["name"][$i];
                $file_size = $_FILES["filename"]["size"][$i];
                $file_tmp = $_FILES["filename"]["tmp_name"][$i];
                $file_type = $_FILES["filename"]["type"][$i];
                $file_path =  "../upload-images" . $file_name;

                if (move_uploaded_file($file_tmp, "../upload-images/" . $file_name)) {
                    echo '<img style = "width : 20rem" src="../upload-images/'  . $file_name . '"><br>';
                }
            }
            ?>
        </td>
        </tr>

        </table>
    </div>
    <div class="image">

    </div>

</body>

</html>