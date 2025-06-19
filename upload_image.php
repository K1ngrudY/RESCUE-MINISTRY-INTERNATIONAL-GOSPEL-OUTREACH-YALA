
<?php
$data = json_decode(file_get_contents("gallery_data.json"), true);
$target_dir = "images/";
$filename = basename($_FILES["galleryImage"]["name"]);
$target_file = $target_dir . $filename;

if (move_uploaded_file($_FILES["galleryImage"]["tmp_name"], $target_file)) {
    $data[] = ["filename" => $filename, "title" => $_POST['title'], "description" => $_POST['description']];
    file_put_contents("gallery_data.json", json_encode($data, JSON_PRETTY_PRINT));
    echo "Image uploaded successfully. <a href='gallery.php'>View Gallery</a>";
} else {
    echo "Upload failed.";
}
?>
