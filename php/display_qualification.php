<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .qualification_container {
            height: 30vh;
            overflow-y: scroll;
        }

        .qualification_table {
            height: fit-content;
        }

        .delete_btn:hover {
            background-color: blue;
        }

        a {
            text-decoration: none;
            border: none;
            outline: none;
            background-color: red;
            border-radius: 10px;
            padding: 0.3rem 1rem;
            color: white;
        }

        a:hover {
            background-color: blue;
        }
    </style>

</head>

<body>
    <h1>Qualification Table</h1>
    <div class="qualification_container">
        <table class="qualification_table">
            <tr>
                <th>Firstname</th>
                <th>education</th>
                <th>branch</th>
                <th>year</th>
                <th>marks</th>
                <th>action</th>
            </tr>
            <tr>
                <?php
                include dirname(__FILE__, 2) . "/" . "php/" . "connectConfig.php";
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $delete = mysqli_query($conn, "DELETE FROM Qualification_table WHERE qualification_records_id= $id");
                }

                if (isset($_GET['search'])) {
                    $quali_query = $conn->query("SELECT * FROM Qualification_table WHERE post_request_id in (SELECT post_id FROM table_form WHERE firstname LIKE '%$searched_item%' OR education LIKE '%$searched_item%' OR branch LIKE '%$searched_item%' OR year LIKE '%$searched_item%' OR marks LIKE '%$searched_item%')");
                } else
                    $quali_query = $conn->query("SELECT * FROM Qualification_table");
                if ($quali_query->num_rows > 0) {
                    while ($quali_row = $quali_query->fetch_assoc()) {


                ?>

                        <td> <?php echo $quali_row['firstname']; ?> </td>
                        <td> <?php echo $quali_row['education']; ?> </td>
                        <td> <?php echo $quali_row['branch']; ?> </td>
                        <td> <?php echo $quali_row['year']; ?> </td>
                        <td> <?php echo $quali_row['marks']; ?> </td>
                        <td class="action_button">
                            <div class="action_btn">
                                <a onclick="return confirm('Press OK to delete or Cancel button')" href="/php/display.php?id=<?php echo $quali_row['qualification_records_id']; ?>">Delete</a>
                                <a onclick="return confirm('Press OK to edit or Cancel button')" href="/index.php?ID=<?php echo $quali_row['post_request_id']; ?>">Edit</a>
                            </div>


                        </td>
            </tr>

    <?php }
                } ?>
        </table>
    </div>
    <?php  ?>
</body>

</html>