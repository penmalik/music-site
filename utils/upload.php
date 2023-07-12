<?php

function get_songs(){
    global $connnection;
    $query = "SELECT * FROM `songs`";
    $result = mysqli_query($connnection, $query);
    return $result;
}

function get_songs_by_genre($genre, $start, $pages_number){
    global $connnection;
    $query = "SELECT * FROM `songs` WHERE `genre` = '$genre' LIMIT $start , $pages_number ";
    $result = mysqli_query($connnection, $query);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}