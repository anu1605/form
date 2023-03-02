<!-- datetime
blob to image comma seperated
timestamp
qualification 
password encryption 
textarea not more tha 150
preview in table form
enum -->


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

  // firstname
  $array = [];
  $firstname = $_POST['Firstname'];
  $array['Firstname'] =  $firstname;

  // Lastname
  $lastname = $_POST['Lastname'];
  $array['Lastname'] = $lastname;

  // Email
  $email = $_POST['Email'];
  $array['Email'] = $$email;

  // password
  $pwd = $_POST['pwd'];
  $array['pwd'] = $email;

  // gender
  $gender = $_POST['gender'];
  $array['gender'] = $gender;

  $hobbies = '';
  $subject = '';

  $education = '';
  $field = '';
  $year = '';
  $marks = '';

  // Hobbies
  foreach ($_POST['Hobbies'] as $index)
    $hobbies .= "$index" . ",";

  $array['Hobbies'] = $hobbies;

  // subject
  foreach ($_POST['subject'] as $index)
    $subject .= "$index" . ",";

  $array['subject'] = $subject;


  // education
  foreach ($_POST['education'] as $index)
    $education .= "$index" . ",";

  $array['education'] = $education;

  // field
  foreach ($_POST['field'] as $index)
    $field .= "$index" . ",";

  $array['field'] = $field;


  // year
  foreach ($_POST['year'] as $index)
    $year .= "$index" . ",";

  $array['year'] = $year;


  // marks
  foreach ($_POST['marks'] as $index)
    $marks .= "$index" . ",";

  $array['marks'] = $marks;

  date_default_timezone_set("Asia/Kolkata");
  $time = date('h:ia');

  $array['file'] = $_POST['filename'];

  $date = $_POST['date'];






  // foreach ($array as $key => $val) {
  //   if (empty($element)) {
  //     echo $key . " is empty";
  //     return;
  //   }
  // }




  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);




  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  } else {
    echo "Connected successfully<br>";
  }




  $sql = "INSERT INTO table_form (firstname, lastname,email,gender,hobbies,subject,education,field,year,marks ,password ,edited_at) VALUES ('$firstname', '$lastname','$email', '$gender', '$hobbies', '$subject', '$education' , '$field', '$year' , '$marks'  ,'$pwd', '$time')";


  if ($conn->query($sql)) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $id = $conn->insert_id;
  // image


  for ($i = 0; $i < count($_FILES['filename']['name']); $i++) {

    $file_name = $_FILES["filename"]["name"][$i];
    $file_size = $_FILES["filename"]["size"][$i];
    $file_tmp = $_FILES["filename"]["tmp_name"][$i];
    $file_type = $_FILES["filename"]["type"][$i];
    $file_path = dirname(__FILE__, 2) . "/" . "upload-images/" . $file_name;


    if (move_uploaded_file($file_tmp, dirname(__FILE__, 2) . "/" . "upload-images/" . $file_name)) {

      $imgSQL = "INSERT INTO post_images_table (image_ID,blob_images) VALUES ('$id','$file_path')";
      if ($conn->query($imgSQL)) {
        echo "<br> images added succesfully in images_table";
      } else "Error: " . $sql . "<br>" . $conn->error;
    }
  }


  include dirname(__FILE__, 2) . "/" . "php/" . "blob_to_image.php";


  $conn->close();
  ?>
</body>

</html>