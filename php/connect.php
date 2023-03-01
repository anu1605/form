<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <?php

  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "form";


  $firstname = $_POST['Firstname'];
  $lastname = $_POST['Lastname'];
  $email = $_POST['Email'];
  $pwd = $_POST['pwd'];
  $gender = $_POST['gender'];
  $hobbies;
  $subject;

  $education;
  $field;
  $year;
  $marks;
  $timestamp = date('h:i');

  foreach ($_POST['Hobbies'] as $index)
    $hobbies .= "$index" . ",";

  foreach ($_POST['subject'] as $index)
    $subject .= "$index" . ",";

  foreach ($_POST['education'] as $index)
    $education .= "$index" . ",";

  foreach ($_POST['field'] as $index)
    $field .= "$index" . ",";


  foreach ($_POST['year'] as $index)
    $year .= "$index" . ",";


  foreach ($_POST['marks'] as $index)
    $marks .= "$index" . ",";









  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  } else {
    echo "Connected successfully<br>";
  }

  $sql = "INSERT INTO form_table (firstname, lastname,email,gender,hobbies,subject,education,field,year,marks ,password ,edited_at) VALUES ('$firstname', '$lastname','$email', '$gender', '$hobbies', '$subject', '$education' , '$field', '$year' , '$marks'  ,'$pwd','$timestamp')";

  if ($conn->query($sql)) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();
  ?>
</body>

</html>