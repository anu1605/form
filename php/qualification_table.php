

<?php
include dirname(__FILE__, 2) . "/" . "php/" . "connectConfig.php";

$get_id = $_GET['ID'];
if (isset($_GET['ID'])) {
    $select = mysqli_query($conn, "DELETE FROM Qualification_table where post_request_id=$get_id");
}

for ($i = 0; $i < count($_POST['education']); $i++) {

    $education = $_POST['education'][$i];
    $field = $_POST['field'][$i];
    $year = $_POST['year'][$i];
    $marks = $_POST['marks'][$i];

    if (isset($_GET['ID'])) {
        $insert_to_qualification = "INSERT INTO Qualification_table (post_request_id , education, branch , year, marks) VALUES('$get_id', '$education', '$field', '$year', '$marks')";
    } else {
        $insert_to_qualification = "INSERT INTO Qualification_table (post_request_id , education, branch , year, marks) VALUES('$id', '$education', '$field', '$year', '$marks')";
    }

    if ($conn->query($insert_to_qualification)) {
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>