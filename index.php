<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>song upload</title>
</head>
<body>
    <h3>Upload singles</h3>
    <form action="./handler/audio_handler.php" method="post" enctype="multipart/form-data">
        <p>Song photo</p>
        <input type="file" name="song_photo" accept="image/*" required>
        <br>
        <br>
        <input type="text" name="artist" placeholder="artist" required>
        <br>
        <br>
        <input type="text" name="song_title" placeholder="song title" required>
        <br>
        <br>
        <textarea name="lyrics" id="" cols="30" rows="5" placeholder="Song lyrics"></textarea>
        <br>
        <br>
        <span>Genre: </span>
        <select name="genre" id="" required>
            <option value=""></option>
            <option value="Rap">Rap</option>
            <option value="Pop">Pop</option>
            <option value="Afro">Afro</option>
            <option value="Blues">Blues</option>
        </select>
        <br>
        <br>
        <input type="text" name="label" placeholder="label">
        <br>
        <br>
        <input type="text" name="album" placeholder="album">
        <br>
        <br>
        <input type="date" name="release_date" id="" placeholder="release_date">
        <br>
        <p>Song file</p>
        <input type="file" name="song" accept="audio/*" required>
        <br>
        <br>
        <input type="submit" value="upload song" name="songs">
    </form>
    <br>
    <br>
    <br>
    <a href="./album.php">
        <input type="submit" value="Upload album">
    </a>
</body>
</html>