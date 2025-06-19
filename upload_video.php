
<?php
$data = json_decode(file_get_contents("sermons_data.json"), true);
$title = $_POST['title'];
$preacher = $_POST['preacher'];
$date = $_POST['date'];
$youtube = $_POST['youtube'];

if (!empty($youtube)) {
    $data[] = ["video_type" => "youtube", "video_url" => $youtube, "title" => $title, "preacher" => $preacher, "date" => $date];
} else {
    $target_dir = "videos/";
    $filename = basename($_FILES["sermonVideo"]["name"]);
    $target_file = $target_dir . $filename;
    if (move_uploaded_file($_FILES["sermonVideo"]["tmp_name"], $target_file)) {
        $data[] = ["video_type" => "upload", "filename" => $filename, "title" => $title, "preacher" => $preacher, "date" => $date];
    }
}
file_put_contents("sermons_data.json", json_encode($data, JSON_PRETTY_PRINT));
echo "Video uploaded successfully. <a href='sermons.php'>View Sermons</a>";
?>
