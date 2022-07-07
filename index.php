<?php
session_start();

$dbconn = '';
function connectDb() {
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $db = 'film';

     $dbconn = mysqli_connect($host,$username,$password,$db);

    if(!$dbconn) {
        echo 'A csatlakozás nem sikerült';
        exit();
    }

    return $dbconn;

}

$connection = connectDb();



function getAllMovie($connection) {


$queryString = 'SELECT * FROM film_data';

$moviesQuery = mysqli_query($connection,$queryString);


return $moviesQuery;

}

$osszesFilm = getAllMovie($connection);

while ($movie_row = mysqli_fetch_assoc($osszesFilm)) {
    echo '<br><b>Film címe:</b> ' . $movie_row['cim'] . ' <br><b>Rendező neve:</b> ' . $movie_row['rendezo'] . ' <br><b>Leírás:</b> ' . $movie_row['leiras'] . ' <br><b>Megjelenés éve:</b> ' . $movie_row['megj_ev'] . '<br><br>' ;
}



function newMovie($connection) {

    $title = $_POST['title'];
    $director = $_POST['director'];
    $descr = $_POST['description'];
    $date = $_POST['date'];

    $insertIntoString = 'INSTERT INTO film_data (cim, rendezo, leiras, megj_ev) VALUES ('.$title.','.$director.','.$descr.',$date)';
    
    $insertInto = mysqli_query($connection,$insertIntoString);
    }


if(isset($_POST['title']) && isset($_POST['description']) && isset($_POST['director']) && isset($_POST['date'])) {

    newMovie($connection);

}







?>

<form method="POST">
<span>Cím: </span> <input type="text" name="title"></input>
<span>Leírás: </span> <input type="text" name="description"></input>
<span>Rendező: </span> <input type="text" name="director"></input>
<span>Megjelenés éve: </span> <input type="date" name="date"></input>
<input type="submit" name="send"></input>
</form>