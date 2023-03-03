<!-- 
null date();
textarea not more tha 150
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

  include dirname(__FILE__, 2) . "/" . "php/" . "connectConfig.php";

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




  date_default_timezone_set("Asia/Kolkata");
  $time = date('h:ia');

  $array['file'] = $_POST['filename'];

  $date = $_POST['date'];

  $imagePathString = "";
  for ($i = 0; $i < count($_FILES['filename']['name']); $i++) {

    $file_name = $_FILES["filename"]["name"][$i];
    $file_tmp = $_FILES["filename"]["tmp_name"][$i];
    $file_path = "upload-images/" . $file_name;
    $imagePathString .= $file_name . ",";
  }
  array_push($array, $imagePathString);

  $date = $_POST['date'];
  if (empty($date) == 'true') {
    $date = date('Y:m:d');
  }

  array_push($array, $date);


  $about = $_POST['about_yourself'];




  // foreach ($array as $key => $val) {
  //   if (empty($element)) {
  //     echo $key . " is empty";
  //     return;
  //   }
  // }







  $sql = "INSERT INTO table_form (firstname, lastname,email,gender,hobbies,subject,about_yourself	, image_files ,password, date ) VALUES ('$firstname', '$lastname','$email', '$gender', '$hobbies', '$subject', '$about', '$imagePathString'  ,MD5('" . $pwd . "'),  '$date')";

  if ($conn->query($sql)) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }



  $id = $conn->insert_id;

  // image
  // for ($i = 0; $i < count($_FILES['filename']['name']); $i++) {

  //   $file_name = $_FILES["filename"]["name"][$i];
  //   $file_size = $_FILES["filename"]["size"][$i];
  //   $file_tmp = $_FILES["filename"]["tmp_name"][$i];
  //   $file_type = $_FILES["filename"]["type"][$i];
  //   $file_path = dirname(__FILE__, 2) . "/" . "upload-images/" . $file_name;


  //   if (move_uploaded_file($file_tmp, dirname(__FILE__, 2) . "/" . "upload-images/" . $file_name)) {
  //     $imagedata = file_get_contents($file_path);

  //     $imgSQL = "INSERT INTO post_images_table (image_id	,blob_images) VALUES (?,?)";
  //     $statement = $conn->prepare($imgSQL);
  //     $statement->bind_param('ss', $id, $imagedata);
  //     $current_id = $statement->execute() or die("<b>Error:</b> Problem on Image Insert <br/>" . mysqli_connect_error());
  //   }
  // }


  // include dirname(__FILE__, 2) . "/" . "php/" . "blob_to_image.php";


  include dirname(__FILE__, 2) . "/" . "php/" . "qualification_table.php";

  include dirname(__FILE__, 2) . "/" . "php/" . "display.php";

  $conn->close();
  ?>
</body>

</html>