<!-- 
    pagination
 -->


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            display: grid;
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
            color: darkblue;
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

        tr:nth-child(even) {
            background-color: rgb(250, 235, 240);
        }

        tr:nth-child(odd) {
            background-color: rgb(250, 222, 232);
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

        .clear_filter {
            width: 10%;
            border: 2px solid darkblue;
            color: darkblue;
            background-color: white;
            justify-self: center;
            height: 1.8rem;
            font-size: 1.2rem;
            margin: 2rem 0;
            border-radius: 20px;
        }

        .clear_filter:hover {
            background-color: darkblue;
            color: white;
        }

        .action_btn {
            display: flex;
        }

        h1 {
            color: darkblue;
        }

        .search_container {
            display: flex;
            justify-content: center;
        }

        .search {
            width: 50%;
            height: 3rem;
            padding: 0.5rem;
            border: 2px solid darkblue;
            border-radius: 50px;
            font-size: 1.3rem;
            color: darkblue;
        }

        .search::placeholder {
            color: darkblue;

        }

        .search-btn {
            border: none;
            position: relative;
            width: 7rem;
            height: 3rem;
            background-color: darkblue;
            border-radius: 50px;
            font-size: 1.3rem;
            left: -3cm;
            top: 0cm;
            color: white;
            font-size: 1rem;
        }

        .sort_anchor {
            background-color: transparent;
        }

        .sort_anchor:hover {
            background-color: transparent;
        }

        .search-btn:hover {
            background-color: blue;
        }

        tr.pagination_row,
        td.pagination_cell,
        .pagination_body {
            display: flex;
            align-items: center;
            width: fit-content;
            background-color: transparent;
            margin: 0;
            padding: 0;
        }


        .pagination_anchor {
            color: darkblue;
            border: 2px solid darkblue;
            border-radius: 0;
            font-weight: 600;

        }

        h3 {
            display: inline;
            color: darkblue;
        }

        .page_no {
            font-size: 1.2rem;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <br>
    <form class="search_container" method="get" action="/php/display.php">
        <input type="search" name="search" class="search" id="search" value="" placeholder="search by name">
        <button type="submit" class="search-btn" id="search-btn" name="search-btn">Search</button>
    </form>
    <a class="clear_filter" href="/php/display.php">Clear Filter</a>

    <h1>Display Form Information</h1>
    <div class="preview">
        <?php
        if (isset($_GET['row_index'])) {
            $row_index = $_GET['row_index'];
        } else $row_index = 0;
        ?>
        <table class="preview_table">
            <tr>
                <th class="main_data"> <a class="sort_anchor" href="/php/display.php?filter_item=firstname&switch=<?php echo isset($_GET['switch']) && $_GET['switch'] == 1 ? 0 : 1 ?>&row_index=<?php echo $row_index ?>">firstname</a> </th>
                <th class="main_data"><a class="sort_anchor" href="/php/display.php?filter_item=lastname&switch=<?php echo isset($_GET['switch']) && $_GET['switch'] == 1 ? 0 : 1 ?>&row_index=<?php echo $row_index ?>">lastname</a></th>
                <th class="main_data"><a class="sort_anchor" href="/php/display.php?filter_item=email&switch=<?php echo isset($_GET['switch']) && $_GET['switch'] == 1 ? 0 : 1 ?>&row_index=<?php echo $row_index ?>">email</a></th>
                <th class="main_data">gender</th>
                <th class="main_data">hobbies</th>
                <th class="main_data">subject</th>
                <th class="main_data">about_yourself</th>
                <th class="main_data">image_files</th>
                <th class="main_data"><a class="sort_anchor" href="/php/display.php?filter_item=date&switch=<?php echo isset($_GET['switch']) && $_GET['switch'] == 1 ? 0 : 1 ?>&row_index=<?php echo $row_index ?>">date</a></th>
                <th class="main_data"><a class="sort_anchor" href="/php/display.php?filter_item=edited_at&switch=<?php echo isset($_GET['switch']) && $_GET['switch'] == 1 ? 0 : 1 ?>&row_index=<?php echo $row_index ?>">edited_at</a></th>
                <th class="main_data">Uploaded_Images</th>
                <th class="main_data">Action</th>
            </tr>

            <tr>
                <?php
                include dirname(__FILE__, 2) . "/" . "php/" . "connectConfig.php";
                if (isset($_GET['ID'])) {
                    $main_ID = $_GET['ID'];
                    $delete_main = mysqli_query($conn, "DELETE FROM table_form WHERE post_id = $main_ID");
                    if ($delete_main) {
                        header("location: /php/display.php");
                        die();
                    }
                }



                if (isset($_GET['search'])) {
                    $searched_item = $_GET['search'];
                    $query = $conn->query("SELECT * FROM table_form WHERE firstname LIKE '%$searched_item%' OR lastname LIKE '%$searched_item%' OR email LIKE '%$searched_item%' OR hobbies LIKE '%$searched_item%' OR subject LIKE '%$searched_item%' or date LIKE '%$searched_item%' and post_id  BETWEEN  (SELECT MIN(post_id)+ $row_index FROM table_form) and (SELECT MIN(post_id)+ $row_index+1 ");
                } else if (isset($_GET['filter_item'])) {
                    $filter_item = $_GET['filter_item'];
                    $switch = $_GET['switch'];

                    if (isset($_GET['switch']))
                        if ($switch === '1') {
                            $query = $conn->query("SELECT * FROM table_form WHERE post_id BETWEEN  (SELECT post_id  FROM table_form LIMIT 1)+ $row_index and (SELECT post_id FROM table_form LIMIT 1)+$row_index+1  ORDER BY $filter_item DESC ");
                        } else if ($switch === '0') {
                            $query = $conn->query("SELECT * FROM table_form WHERE post_id BETWEEN  (SELECT post_id  FROM table_form LIMIT 1)+ $row_index and (SELECT post_id FROM table_form LIMIT 1)+$row_index+1  ORDER BY $filter_item ASC");
                        }
                } else
                    $query = $conn->query("SELECT * FROM table_form WHERE post_id BETWEEN  (SELECT post_id  FROM table_form LIMIT 1)+ $row_index and (SELECT post_id FROM table_form LIMIT 1)+$row_index+1 ");

                $numRow = mysqli_num_rows($conn->query("SELECT * FROM table_form"));



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
                        <td> <?php echo date("d-M-Y H:ia", strtotime($row['edited_at'])); ?> </td>
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
    <table class="pagination_container">
        <tbody class="pagination_body">
            <tr class="pagination_row">
                <td class="pagination_cell page_no">Page No:</td>
            </tr>
            <?php
            if ($numRow % 2 == 0)
                $no_of_pages = intdiv($numRow, 2);
            else $no_of_pages = intdiv($numRow, 2) + 1;
            for ($i = 1; $i <= $no_of_pages; $i++) { ?>
                <tr class="pagination_row">
                    <td class="pagination_cell"><a class="sort_anchor pagination_anchor" href="/php/display.php?row_index=<?php echo isset($_GET['row_index']) ? (($i - 1) * 2) : 0 ?>"><?php echo $i; ?></a></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>


    <?php
    include dirname(__FILE__, 2) . "/" . "php/" . "display_qualification.php";
    include dirname(__FILE__, 2) . "/" . "php/" . "pagination.php";
    ?>
</body>

</html>