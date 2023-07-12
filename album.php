<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Album Upload</title>
</head>

<body>
<h3>Upload by album</h3>
<form action="./handler/audio_handler.php" method="post" enctype="multipart/form-data">
    <p>Song photo</p>
    <input type="file" name="album_art" accept="image/*" required>
    <br>
    <br>
    <input type="text" name="artist" placeholder="Artist" required>
    <br>
    <br>
    <span>Genre: </span>
    <select name="genre" required>
        <option value=""></option>
        <option value="Rap">Rap</option>
        <option value="Pop">Pop</option>
        <option value="Afro">Afro</option>
        <option value="Blues">Blues</option>
    </select>
    <br>
    <br>
    <input type="text" name="label" placeholder="Label">
    <br>
    <br>
    <input type="text" name="album_name" placeholder="Album">
    <br>
    <br>
    <input type="date" name="release_date" placeholder="Release Date">
    <br>
    <p>Song files</p>
    <div id="song_fields">
        <input type="text" name="song_title[]" placeholder="Song Title" required>
        <br>
        <textarea name="lyrics" id="" cols="30" rows="5" placeholder="Song lyrics"></textarea>
        <br>
        <input type="file" name="song[]" accept="audio/*" required>
        <br>
        <br>
    </div>
    <button type="button" onclick="addSongField()">Add Another Song</button>
    <br>
    <br>
    <input type="submit" value="Upload Album" name="album">
</form>

<script>
    function addSongField() {
        var songFieldsContainer = document.getElementById("song_fields");
        var newSongField = document.createElement("div");
        newSongField.innerHTML = '<input type="text" name="song_title[]" placeholder="Song Title" required>' + '<br>' +
                                 '<textarea name="lyrics" id="" cols="30" rows="5" placeholder="Song lyrics"></textarea>' + '<br>' +
                                 '<input type="file" name="song[]" accept="audio/*" required>' +
                                 '<br><br>';
        songFieldsContainer.appendChild(newSongField);
    }
</script>

    <br>
    <br>
    <br>
    <a href="./">
        <input type="submit" value="Upload singles">
    </a>
</body>

</html>