<?php


$query = $conn->query("SELECT * FROM post_images_table ORDER BY image_id DESC");

if ($query->num_rows > 0) {
    while ($row = $query->fetch_assoc()) {
        // $imageURL = 'data:image/jpeg;base64,' . base64_encode($row['blob_images']);
        echo '<img style="width:10rem" src="' . base64_encode($row['blob_images']) . '"/>';

?>

    <?php }
} else { ?>
    <p>No image(s) found...</p>
<?php } ?>