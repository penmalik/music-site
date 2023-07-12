<?php

// function sanitize_inputs($input){
//     global $connnection;
//     return mysqli_real_escape_string($connnection, htmlspecialchars(trim($_POST[$input])));
// }

function sanitize_inputs($input){
    global $connnection;
    return mysqli_real_escape_string($connnection, htmlspecialchars(trim($input)));
}

function check_if_song_in_db($title, $artist){
    global $connnection;

    $query = "SELECT * FROM `songs` WHERE `artist` = '$artist' and `song_name` = '$title' ";
    $result = mysqli_query($connnection, $query);
    return mysqli_fetch_assoc($result);
}

function check_if_song_in_album($title, $artist){
    global $connnection;

    $query = "SELECT * FROM `album` WHERE `artist` = '$artist' and `song_name` = '$title' ";
    $result = mysqli_query($connnection, $query);
    return mysqli_fetch_assoc($result);
}

function song_result($keyword){
    global $connnection;

    $query = "SELECT * FROM `songs` WHERE `artist` LIKE '%$keyword%' OR `song_name` LIKE '%$keyword%' OR `genre` LIKE '%$keyword%' OR `album` LIKE '%$keyword%'  ";
    $result = mysqli_query($connnection, $query);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function insert_song_into_db($song_id, $artist, $song_title, $song_file, $image, $genre, $lyrics, $label, $album, $release_date) {

    $query = "INSERT INTO `songs`(`song_id`, `artist`, `song_name`, `song`, `song_photo`, `genre`, `lyrics`, `label`, `album`, `release_date`) VALUES ('$song_id','$artist','$song_title', '$song_file', '$image','$genre','$lyrics','$label','$album','$release_date')";

    // Return true if the song is successfully inserted, false otherwise
    return $query;
}
