<?php

require_once "./config/db.php";

if(!empty($_GET['song'])){
    // print_r($_POST);
    // print_r($_GET);
    // die(); 

    // song name
    $song_name = basename($_GET['song']);

    // song file path
    $song_path = "uploads/".$song_name;

    // check to see if song exist
    if(!empty($song_name) && file_exists($song_path)){

        // echo "Song exist!!";
        // make song cacheable
        header("Cache-Control: public");
        // to make song available for download
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$song_name");
        // set file type to audio
        header("Content-Type: audio/mp3");
        // 
        header("Content-Transfer-Encoding: binary");

        // increase the number of download of song to be downloaded by 1
        // mysqli_query($connnection, "UPDATE `songs` SET `downloaded` = `downloaded` + 1 WHERE `song_name` = '$song_name' ");

        // read song
        readfile($song_path);
        exit;
    }
    else{
        echo "Song not found";
    }

}


// for streaming rather than downloading 

// if (!empty($_GET['song'])) {
//     // song name
//     $song_name = basename($_GET['song']);

//     // song file path
//     $song_path = "uploads/" . $song_name;

//     if (!empty($song_name) && file_exists($song_path)) {
//         // Set the appropriate content type
//         header("Content-Type: audio/mpeg");

//         // Set the content length
//         header("Content-Length: " . filesize($song_path));

//         // Open the file for reading
//         $file = fopen($song_path, 'rb');

//         // Output the file content
//         while (!feof($file)) {
//             echo fread($file, 1024);
//             ob_flush();
//             flush();
//         }

//         // Close the file
//         fclose($file);
//         exit;
//     } else {
//         echo "Song not found";
//     }
// }