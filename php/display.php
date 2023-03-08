<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }



        td,
        th {
            padding: 0.5rem 0.5rem;
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

        td {
            vertical-align: top;
        }

        .image_column {
            display: flex;
        }

        th {
            background-color: rgb(227, 129, 163);
            color: white;
        }

        .main_data {
            background-color: rgb(219, 81, 129);
            color: white;
        }

        td:nth-child(even) {
            background-color: rgb(250, 235, 240);
        }

        td:nth-child(odd) {
            background-color: rgb(250, 242, 245);
        }

        .qualification_table {
            height: 100%;
        }

        .preview {
            height: 50vh;
            overflow-y: scroll;
        }

        .preview_table {
            height: fit-content;
        }

        a {
            margin: 0.5rem;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .action_btn {
            display: flex;
        }
    </style>
</head>

<body>
    <br>


    <div class="preview">
        <h1>Display</h1>
        <table class="preview_table">
            <tr>
                <th class="main_data">firstname</th>
                <th class="main_data">lastname</th>
                <th class="main_data">email</th>
                <th class="main_data">gender</th>
                <th class="main_data">hobbies</th>
                <th class="main_data">subject</th>
                <th class="main_data">about_yourself</th>
                <th class="main_data">image_files</th>
                <th class="main_data">date</th>
                <th class="main_data">edited_at</th>
                <th class="main_data">Uploaded Images</th>
                <th class="main_data">Action</th>
            </tr>

            <tr>
                <?php
                include dirname(__FILE__, 2) . "/" . "php/" . "connectConfig.php";
                if (isset($_GET['ID'])) {
                    $main_id = $_GET['ID'];

                    $delete_main = mysqli_query($conn, "DELETE FROM table_form WHERE post_id = $main_id");
                    if ($delete_main) {
                        header("location: /php/display.php");
                        die();
                    }
                }


                $query = $conn->query("SELECT * FROM table_form");
                if ($query->num_rows > 0) {
                    while ($row = $query->fetch_assoc()) {
                ?>
                        <td> <?php echo $row['firstname']; ?> </td>
                        <td> <?php echo $row['lastname']; ?> </td>
                        <td> <?php echo $row['email']; ?> </td>
                        <td> <?php echo $row['gender']; ?> </td>
                        <td> <?php echo $row['hobbies']; ?> </td>
                        <td> <?php echo $row['subject']; ?> </td>
                        <td> <?php echo $row['about_yourself']; ?> </td>
                        <td> <?php echo $row['image_files']; ?> </td>
                        <td> <?php echo $row['date']; ?> </td>
                        <td> <?php echo $row['edited_at']; ?> </td>
                        <td class="image_column">
                            <?php
                            $array = explode(',', $row['image_files']);
                            for ($i = 0; $i < count($array) - 1; $i++) {
                                $filename = $array[$i];
                                echo '<img style = "width : 10rem; padding: 0 0.5rem" src="../upload-images/'  . $filename . '"><br>';
                            }
                            ?>
                        </td>

                        <td>
                            <div class="action_btn">
                                <a onclick="return confirm('Press OK to delete or Cancel button')" href="/php/display.php?ID=<?php echo $row['post_id']; ?>">Delete</a>
                                <a onclick="return confirm('Press OK to edit or Cancel button')" href="/index.php?ID=<?php echo $row['post_id']; ?>">Edit</a>
                            </div>
                        </td>

            </tr>
    <?php }
                } ?>


        </table>



    </div>


    <?php
    include dirname(__FILE__, 2) . "/" . "php/" . "display_qualification.php";
    ?>
</body>

</html>