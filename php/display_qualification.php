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
                <?php
                if (isset($_GET['row_index_quali'])) {
                    $row_index_quali = $_GET['row_index_quali'];
                } else $row_index_quali = 0;
                ?>
                <th><a class="sort_anchor" href="/php/display.php?sort_item=firstname&switch=<?php echo isset($_GET['switch']) && $_GET['switch'] == 1 ? 0 : 1 ?>&row_index_quali=<?php echo $row_index_quali ?>&search=<?php echo isset($_GET['search']) ? $_GET['search'] : ""; ?>">firstname</a> </th>
                <th>education</th>
                <th>branch</th>
                <th><a class="sort_anchor" href="/php/display.php?sort_item=year&switch=<?php echo isset($_GET['switch']) && $_GET['switch'] == 1 ? 0 : 1 ?>&row_index_quali=<?php echo $row_index_quali ?>&search=<?php echo isset($_GET['search']) ? $_GET['search'] : ""; ?>">year</a> </th>
                <th><a class="sort_anchor" href="/php/display.php?sort_item=marks&switch=<?php echo isset($_GET['switch']) && $_GET['switch'] == 1 ? 0 : 1 ?>&row_index_quali=<?php echo $row_index_quali ?>&search=<?php echo isset($_GET['search']) ? $_GET['search'] : ""; ?>">marks</a> </th>
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
                    // if (isset($_GET['sort_item'])) {
                    //     $sort_item = $_GET['sort_item'];
                    //     $switch = $_GET['switch'];
                    //     if (isset($_GET['switch']))
                    //         if ($switch === '1') {
                    //             $quali_query = $conn->query("SELECT * FROM Qualification_table WHERE firstname LIKE '%$searched_item%' OR education LIKE '%$searched_item%' OR branch LIKE '%$searched_item%' OR year LIKE '%$searched_item%' OR marks LIKE '%$searched_item%'  ORDER BY $sort_item DESC LIMIT $row_index_quali,2");
                    //         } else if ($switch === '0') {
                    //             $quali_query = $conn->query("SELECT * FROM Qualification_table WHERE firstname LIKE '%$searched_item%' OR education LIKE '%$searched_item%' OR branch LIKE '%$searched_item%' OR year LIKE '%$searched_item%' OR marks LIKE '%$searched_item%'  ORDER BY $sort_item ASC LIMIT $row_index_quali,2");
                    //         }
                    // }
                    $quali_query = $conn->query("SELECT * FROM Qualification_table WHERE firstname LIKE '%$searched_item%' OR education LIKE '%$searched_item%' OR branch LIKE '%$searched_item%' OR year LIKE '%$searched_item%' OR marks LIKE '%$searched_item%'  LIMIT $row_index_quali,2");
                } else if (isset($_GET['sort_item'])) {
                    $sort_item = $_GET['sort_item'];
                    $switch = $_GET['switch'];
                    if (isset($_GET['switch']))
                        if ($switch === '1') {
                            $quali_query = $conn->query("SELECT * FROM Qualification_table WHERE post_request_id BETWEEN  (SELECT post_request_id  FROM Qualification_table LIMIT 1)+ $row_index_quali and (SELECT post_request_id FROM Qualification_table LIMIT 1)+$row_index_quali+1  ORDER BY $sort_item DESC");
                        } else if ($switch === '0') {
                            $quali_query = $conn->query("SELECT * FROM Qualification_table WHERE post_request_id BETWEEN  (SELECT post_request_id  FROM Qualification_table LIMIT 1)+ $row_index_quali and (SELECT post_request_id FROM Qualification_table LIMIT 1)+$row_index_quali+1  ORDER BY $sort_item ASC");
                        }
                } else
                    $quali_query = $conn->query("SELECT * FROM Qualification_table LIMIT $row_index_quali,2");

                if (isset($_GET['search']))
                    $numRow = mysqli_num_rows($conn->query("SELECT * FROM Qualification_table  WHERE firstname LIKE '%$searched_item%' OR education LIKE '%$searched_item%' OR branch LIKE '%$searched_item%' OR year LIKE '%$searched_item%' OR marks LIKE '%$searched_item%'  LIMIT $row_index_quali,2"));
                else
                    $numRow = mysqli_num_rows($conn->query("SELECT * FROM Qualification_table"));

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
    <table class="pagination_container">
        <tbody class="pagination_body">
            <tr class="pagination_row">
                <td class="pagination_cell page_no">Page No:</td>
            </tr>
            <?php
            if ($numRow % 2 == 0)
                $no_of_pages = intdiv($numRow, 2);
            else $no_of_pages = intdiv($numRow, 2) + 1;
            for ($i = 1; $i <= $no_of_pages; $i++) {
                $index = ($i - 1) * 2;
            ?>
                <tr class="pagination_row">
                    <td class="pagination_cell"><a class="sort_anchor pagination_anchor" href="/php/display.php?row_index_quali=<?php echo  $index ?>&search=<?php echo isset($_GET['search']) ? $_GET['search'] : ""; ?>"><?php echo $i; ?></a></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <?php include dirname(__FILE__, 2) . "/" . "php/" . "pagination.php"; ?>
</body>

</html>