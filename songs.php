<?php
require_once "./config/db.php";
require_once "./utils/upload.php";

$SONGS = get_songs();

// number of songs per page
$num_per_page = 1;

if (isset($_GET['page'])) {
    // to get current page
    $page = $_GET['page'];
    // echo $page;
} else {
    $page = 1;
}

$start_from = ($page - 1) * $num_per_page;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Songs</title>
    <style>
        img {
            height: 80px;
            width: 80px;
            border-radius: 50%;
        }

        .pagination{
            display: flex;
            justify-content: center;
        }

        a{
            margin-right: 5px;
        }
    </style>
</head>

<body>
    <form method="post" action="./search.php">
        <input type="search" style="width: 300px;" name="what" id="" placeholder="Search by artist or song or album or genre">
        <input type="submit" value="search" name="search">
    </form>

    <div>
        <h1>Songs</h1>

        <div>
            <h3>AFRO</h3>
            <div>
                <?php $AFRO = get_songs_by_genre('Afro', $start_from, $num_per_page) ?>
                <?php if ($AFRO) : ?>
                    <?php foreach ($AFRO as $afro_songs) : ?>
                        <br>
                        <img src="./photos/<?= json_decode($afro_songs['song_photo'], true)['name'] ?>" alt="">
                        <p>Artist: <?= $afro_songs['artist'] ?> </p>
                        <p>Title: <?= $afro_songs['song_name'] ?> </p>
                        <?php if ($afro_songs['album']) : ?>
                            <p>Album: <?= $afro_songs['album'] ?> </p>
                        <?php else : ?>
                            <p>Album: N/A</p>
                        <?php endif; ?>
                        <?php if ($afro_songs['lyrics']) : ?>
                            <p>Lyrics: <?= $afro_songs['lyrics'] ?> </p>
                        <?php else : ?>
                            <p>Lyrics: N/A</p>
                        <?php endif; ?>
                        <div>
                            <!-- download link -->
                            <form action="./download.php?song=<?= json_decode($afro_songs['song'], true)['name'] ?>" method="post">
                                <button name="download" value="<?php $afro_songs['song_id'] ?>"> Download mp3 </button>
                            </form>
                            <br><br>
                            <!-- <audio src="./uploads/<?= json_decode($afro_songs['song'], true)['name'] ?> " controls></audio> -->
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p>No songs to display</p>
                <?php endif; ?>
            </div>
        </div>



    </div>

    <?php
        $total_songs = mysqli_num_rows($SONGS);
        // echo $total_songs;
        $total_pages = ceil($total_songs / $num_per_page);
        // echo $total_pages;
    ?>

    <!-- display page info -->
    <div class="page-info">
        <p>Showing 1 of <?= $total_pages; ?> </p>
    </div>

    <!-- pagination buttons -->
    <div class="pagination">

        <!-- go to first page -->
        <a href="?page=1">First</a>

        <!-- go to previous page -->
        <?php if($page == 1): ?>
            <a href="?page=<?= $page; ?>">Previous</a>
        <?php else: ?>
            <a href="?page=<?= $page - 1; ?>">Previous</a>
        <?php endif; ?>

        <!-- output the page numbers -->
        <div class="page-numbers">
            <?php
                for ($i = 1; $i <= $total_pages; $i++) {
                    echo "<a href='?page=$i'>" . $i . "</a>";
                }
            ?>
        </div>

        <!-- go to next page -->
        <?php if($page == $total_pages): ?>
            <a href="?page=<?= $page; ?>">Next</a>
        <?php else: ?>
            <a href="?page=<?= $page + 1; ?>">Next</a>
        <?php endif; ?>

        <!-- go to last page -->
        <a href="?page=<?= $total_pages ?>">Last</a>
    </div>

</body>

</html>