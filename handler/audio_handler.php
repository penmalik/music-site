<?php

session_start();
require_once "../config/db.php";
require_once "../utils/functions.php";

// uploading singles
if (isset($_POST['songs'])) {
    // uncomment the line below to see the infomation about the files to be uploaded
    print_r($_FILES);

    $artist = sanitize_inputs($_POST['artist']);
    $title = sanitize_inputs($_POST['song_title']);
    $genre = sanitize_inputs($_POST['genre']);
    $lyrics = sanitize_inputs($_POST['lyrics']);
    $label = sanitize_inputs($_POST['label']);
    $album = sanitize_inputs($_POST['album']);
    $released_date = sanitize_inputs($_POST['release_date']);

    // CHECK IF SONG ALREADY EXIST IN DATABASE
    $check = check_if_song_in_db($title, $artist);
    if($check) die("Song already in database");
    
    // song to be uploaded
    $image = $_FILES['song_photo'];
    $file = $_FILES['song'];

    // check if file has any error
    if($image['error'] || $file['error']) die("Selected file has error!!!");

    // SET FILESIZE OF 50MB AS HIGHEST
    $image_size = $image['size'];
    $image_max_size = 10 * 1024 * 1024;
    $file_size = $file['size'];
    $max_size = 50 * 1024 * 1024;

    if($image_size > $image_max_size || $file_size > $max_size) die("File size too big to be uploaded");

    // RENAMING SONG TO BE UPLOADED USING THE TIME STAMP OF FILE UPLOAD
    $image_name = time() . $image['name'];
    $filename = $file['name'];
    // $filename = time() . $file['name'];

    // CURRENT LOCATION
    $image_location = $image['tmp_name'];
    $tmp_location = $file['tmp_name'];

    // FILE NEW LOCATION
    $image_destination = "../photos/";
    $destination = "../uploads/";

    if(move_uploaded_file($image_location, $image_destination . $image_name)){
        $image_file = [
            "name" => "$image_name",
            "type" => explode("/", $image['type'])
        ];
    }

    if(move_uploaded_file($tmp_location, $destination . $filename)){
        $uploaded_file = [
            "name" => "$filename",
            "type" => explode("/", $file['type'])
        ];
    }

    $image_upload = json_encode($image_file);
    $uploads = json_encode($uploaded_file);

    // SONG ID
    $song_id = uniqid("aud_");

    // INSERTING INTO DB
    $query = insert_song_into_db($song_id, $artist, $title,  $uploads,  $image_upload, $genre, $lyrics, $label, $album, $released_date);

    $result = mysqli_query($connnection, $query);

    if(!$result) die("Error uploading file");
    header("Location: ../");
    
}

// uploading an album
if (isset($_POST['album'])) {
    // uncomment the line below to see the information about the files to be uploaded
    // print_r($_FILES);
    // print_r($_POST);
    // die();

    $artist = sanitize_inputs($_POST['artist']);
    $genre = $_POST['genre'];
    $label = sanitize_inputs($_POST['label']);
    $album = sanitize_inputs($_POST['album_name']);
    $released_date = sanitize_inputs($_POST['release_date']);
    
    
    $image = $_FILES['album_art'];
    $song_files = $_FILES['song'];

    echo "<br> <br>";
    print_r($song_files);

    // Check if the album photo has an error
    if ($image['error']) die("Selected file has an error!!!");

    // Set maximum file size for album photo
    $image_max_size = 10 * 1024 * 1024; // 10MB

    // Check file size for album photo
    $image_size = $image['size'];
    if ($image_size > $image_max_size) die("File size is too big to be uploaded");

    // Rename album photo using the current timestamp
    $image_name = time() . $image['name'];

    // Current location of album photo
    $image_location = $image['tmp_name'];

    // File new location for album photo
    $image_destination = "../photos/";

    if (move_uploaded_file($image_location, $image_destination . $image_name)) {
        $album_art = [
            "name" => $image_name,
            "type" => explode("/", $image['type'])
        ];
    }

    $album_art_upload = json_encode($album_art);

    // Set maximum file size
    $max_size = 50 * 1024 * 1024; // 50MB

    $success_count = 0;
    $error_count = 0;

    // Upload each song
    for ($index = 0; $index < count($song_files['name']); $index++) {
        // print_r($song_files["name"][$index]);
        // echo "<br />";

        // die();
        
        // sanitize each song lyric
        $song_lyrics = sanitize_inputs($_POST['lyrics'][$index]);
        
        // sanitize each song name
        $song_title = sanitize_inputs($_POST['song_title'][$index]);
        // print_r($song_title);

        // check if song in DB
        $check = check_if_song_in_db($song_title, $artist);
        if($check){
            $error_count++;
            // Skip this song and move to the next one
            continue;
        }

        // Check if file has any error
        if ($song_files['error'][$index]) {
            $error_count++;
            continue; // Skip this song and move to the next one
        }

        // Check file size
        if ($song_files['size'][$index] > $max_size) {
            $error_count++;
            continue; // Skip this song and move to the next one
        }

        // get song file location
        $song_file = $song_files['tmp_name'][$index];

        // rename song file
        $filename = time() . $song_files['name'][$index];

        // get song size
        $file_size = $song_files['size'][$index];

        // Generate a unique song ID for each song
        $song_id = uniqid("aud_");

        // New file location
        $destination = "../uploads/";

        if (move_uploaded_file($song_file, $destination . $filename)) {
            $uploaded_file = [
                "name" => $filename,
                "type" => explode("/", $song_files['type'][$index])
            ];
            $uploads = json_encode($uploaded_file);

            // Insert the song into the database
            $query = insert_song_into_db($song_id, $artist, $song_title, $song_file, $image, $genre, $lyrics, $label, $album, $release_date);
            $result = mysqli_query($connnection, $query);
            if ($result) {
                $success_count++;
            } else {
                $error_count++;
            }
        } else {
            $error_count++;
        }
    }

    if ($success_count > 0) {
        echo "Successfully uploaded $success_count song(s).";
    }

    if ($error_count > 0) {
        echo "Failed to upload $error_count song(s).";
    }

    if ($success_count > 0 && $error_count == 0) {
        // Redirect to success page
        header("Location: ../album.php"); 
    } else {
        die("Error uploading Album $album");
    }
}
