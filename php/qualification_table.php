

<?php
include dirname(__FILE__, 2) . "/" . "php/" . "connectConfig.php";

$get_id = $_GET['ID'];
if (isset($_GET['ID'])) {
    $select = mysqli_query($conn, "DELETE FROM Qualification_table where post_request_id=$get_id");
}

for ($i = 0; $i < count($_POST['education']); $i++) {

    $qualification_table_education = $_POST['education'][$i];
    $qualification_table_field = $_POST['field'][$i];
    $qualification_table_year = $_POST['year'][$i];
    $qualification_table_marks = $_POST['marks'][$i];

    if (isset($_GET['ID'])) {
        $insert_to_qualification = "INSERT INTO Qualification_table (post_request_id , education, branch , year, marks) VALUES('$get_id', '$qualification_table_education', '$qualification_table_field', '$qualification_table_year', '$qualification_table_marks')";
    } else {
        $insert_to_qualification = "INSERT INTO Qualification_table (post_request_id , education, branch , year, marks) VALUES('$id', '$qualification_table_education', '$qualification_table_field', '$qualification_table_year', '$qualification_table_marks')";
    }

    if ($conn->query($insert_to_qualification)) {
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}



?>