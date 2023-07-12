<?php

    require_once "./config/db.php";
    require_once "./utils/functions.php";

    $num_per_page = 2;

    if (isset($_POST['search'])) {
        $search_word = sanitize_inputs($_POST['what']);
        $query = "SELECT * FROM `songs` WHERE `artist` LIKE '%$search_word%' OR `song_name` LIKE '%$search_word%' OR `genre` LIKE '%$search_word%' OR `album` LIKE '%$search_word%' LIMIT 0, $num_per_page";
        $result = mysqli_query($connnection, $query);
        $SEARCH = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    
    <style>
        img{
            height: 80px;
            width: 80px;
            border-radius: 50%;
        }
    </style>
</head>

<body>
    <div>
        <?php if($SEARCH): ?>
            <?php foreach($SEARCH as $search_result): ?>
                <div>
                    <!-- song image -->
                    <img src="./photos/<?= json_decode($search_result['song_photo'], true)['name'] ?>" alt="song photo">
                    <!-- artist name -->
                    <p><?= $search_result['artist'] ?></p>
                    <!-- song title -->
                    <p><?= $search_result['song_name'] ?></p>
                    <!-- song album -->
                    <?php if($search_result['album']): ?>
                        <p>Album: <?= $search_result['album'] ?></p>
                    <?php else: ?>
                        <p>Album: N/A</p>
                    <?php endif; ?>
                    <!-- song lyrics -->
                    <?php if($search_result['lyrics']): ?>
                        <p>Lyrics: <?= $search_result['lyrics'] ?></p>
                    <?php else: ?>
                        <p>Lyrics: N/A</p>
                    <?php endif; ?>
                    <!-- download link -->
                    <a href="./download.php?song=<?= json_decode($search_result['song'], true)['name'] ?>">Download mp3</a>
                    <br><br>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No result found.</p>
        <?php endif; ?>
    </div>
</body>

</html>