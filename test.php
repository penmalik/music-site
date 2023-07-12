<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="./handler/test_handler.php" method="post">
        <input type="text" name="text">
        <input type="submit" value="submit" name="submit">
    </form>


    <div>
        <h3>POP</h3>
        <div>
            <?php $POP = get_songs_by_genre('Pop') ?>
            <?php if ($POP) : ?>
                <?php foreach ($POP as $pop_songs) : ?>
                    <br>
                    <img src="./photos/<?= json_decode($pop_songs['song_photo'], true)['name'] ?>" alt="">
                    <p>Artist: <?= $pop_songs['artist'] ?> </p>
                    <p>Title: <?= $pop_songs['song_name'] ?> </p>
                    <?php if ($pop_songs['album']) : ?>
                        <p>Album: <?= $pop_songs['album'] ?> </p>
                    <?php else : ?>
                        <p>Album: N/A</p>
                    <?php endif; ?>
                    <div>
                        <!-- download link -->
                        <a href="./download.php?song=<?= json_decode($pop_songs['song'], true)['name'] ?> ?>">Download mp3</a>
                        <br><br>
                        <!-- <audio src="./uploads/<?= json_decode($pop_songs['song'], true)['name'] ?> " controls></audio> -->
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>No pop songs to display</p>
            <?php endif; ?>
        </div>
    </div>

    <div>
        <h3>RAP</h3>
        <div>
            <?php $RAP = get_songs_by_genre('Rap') ?>
            <?php if ($RAP) : ?>
                <?php foreach ($RAP as $rap_songs) : ?>
                    <br>
                    <img src="./photos/<?= json_decode($rap_songs['song_photo'], true)['name'] ?>" alt="">
                    <p>Artist: <?= $rap_songs['artist'] ?> </p>
                    <p>Title: <?= $rap_songs['song_name'] ?> </p>
                    <?php if ($rap_songs['album']) : ?>
                        <p>Album: <?= $rap_songs['album'] ?> </p>
                    <?php else : ?>
                        <p>Album: N/A</p>
                    <?php endif; ?>
                    <div>
                        <!-- download link -->
                        <a href="./download.php?song=<?= json_decode($rap_songs['song'], true)['name'] ?>">Download mp3</a>
                        <br><br>
                        <!-- <audio src="./uploads/<?= json_decode($rap_songs['song'], true)['name'] ?> " controls></audio> -->
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>No rap songs to display</p>
            <?php endif; ?>
        </div>
    </div>

    <div>
        <h3>BLUES</h3>
        <div>
            <?php $BLUES = get_songs_by_genre('Blues') ?>
            <?php if ($BLUES) : ?>
                <?php foreach ($BLUES as $blues_songs) : ?>
                    <br>
                    <img src="./photos/<?= json_decode($blues_songs['song_photo'], true)['name'] ?>" alt="">
                    <p>Artist: <?= $blues_songs['artist'] ?> </p>
                    <p>Title: <?= $blues_songs['song_name'] ?> </p>
                    <?php if ($blues_songs['album']) : ?>
                        <p>Album: <?= $blues_songs['album'] ?> </p>
                    <?php else : ?>
                        <p>Album: N/A</p>
                    <?php endif; ?>
                    <div>
                        <!-- download link -->
                        <a href="./download.php?song=<?= json_decode($blues_songs['song'], true)['name'] ?>">Download mp3</a>
                        <br><br>
                        <!-- <audio src="./uploads/<?= json_decode($blues_songs['song'], true)['name'] ?> " controls></audio> -->
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>No blues songs to display</p>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>