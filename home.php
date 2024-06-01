<?php

const HOST = 'localhost';
const USERNAME = 'root';
const PASSWORD = '';
const DATABASE = 'blog';

function createDBConnection(): mysqli {
  $conn = new mysqli(HOST, USERNAME, PASSWORD, DATABASE);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  return $conn;
}

function closeDBConnection(mysqli $conn): void {
  $conn->close();
}

function getAndPrintPostsFromDB(mysqli $conn): void {
    $sql = "SELECT * FROM post WHERE featured = 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while($post = $result->fetch_assoc()) {
        include "post_preview.php";
     }
    } else {
      echo "0 results";
    }
  }

function getAndPrintPostsFromDB2(mysqli $conn): void {
    $sql = "SELECT * FROM post WHERE featured = 0";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while($post = $result->fetch_assoc()) {
        include "most_recent_posts.php";
     }
    } else {
      echo "0 results";
    }
  }  

$posts = [
 [
    // id - число
    'id' => 1,
    'title' => 'The Road Ahead',
    'subtitle' => 'The road ahead might be paved - it might not be.',
    'main-img' => 'http://localhost:8001/static/images/polar_lights.png',
    'main-img-description' => 'Polar Lights',
    //'img-modifier' => 'featured-posts__block_first',
    'author' => 'Mat Vogels',
    'author-img' => 'http://localhost:8001/static/images/Mat_Vogels.png',
    // date сделать числом
    'date' => 1443139200,
 ],
 [
    'id' => 2,
    'title' => 'From Top Down',
    'subtitle' => 'Once a year, go someplace you’ve never been before.',
    'main-img' => 'http://localhost:8001/static/images/lanterns.png',
    'main-img-description' => 'Lanterns',
    //'img-modifier' => 'featured-posts__block_second',
    'author' => 'William Wong',
    'author-img' => 'http://localhost:8001/static/images/William_Wong.png',
    'date' => 1443139200,
 ],
];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Escape. Let's do it together.</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora&family=Oxygen&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./images/index_styles.css">
</head>
<body>
    <header class="header">
        <div class="top-menu">
            <img src="./images/escape_logo.svg" alt="Escape logo">
            <nav class="nav">
                <ul>
                    <li><a class = "link" href = "#">Home</a></li>
                    <li><a class = "link" href = "#">Categories</a></li>
                    <li><a class = "link" href = "#">About</a></li>
                    <li><a class = "link" href = "#">Contact</a></li>
                </ul>
            </nav>
        </div>
        <div class="top-header">
            <h1 class="top-header_title">Let's do it together.</h1>
            <h2 class="top-header_subtitle">We travel the world in search of stories. Come along for the ride.</h2>
            <button class="top-header_button">View Latest Posts</button>
        </div>
    </header>
    <nav class="topics">
        <ul class="topics_list">
            <li><a class = "topics_link" href = "#">Nature</a></li>
            <li><a class = "topics_link" href = "#">Photography</a></li>
            <li><a class = "topics_link" href = "#">Relaxation</a></li>
            <li><a class = "topics_link" href = "#">Vacation</a></li>
            <li><a class = "topics_link" href = "#">Travel</a></li>
            <li><a class = "topics_link" href = "#">Adventure</a></li>
        </ul>
    </nav>
    <div class="main-info">
        <div class="featured-posts">
            <h3 class="featured-posts__main-title">Featured Posts</h3>
            <div class="main-posts">
                <?php
                    $conn = createDBConnection();
                    getAndPrintPostsFromDB($conn);
                    closeDBConnection($conn);
                ?>
                <!-- <div class="featured-posts_block__first featured-posts_block">
                    <h4>The Road Ahead</h4>
                    <p>The road ahead might be paved - it might not be.</p>
                    <img src="./ images/Mat_Vogels.png" alt="Mat Vogels">
                    <h5>Mat Vogels</h5>
                    <h5 class="data">September 25, 2015</h5>
                </div>
                <div class="featured-posts_block__second featured-posts_block">
                    <button>Adventure</button>
                    <h4>From Top Down</h4>
                    <p>Once a year, go someplace you’ve never been before.</p>
                    <img src="./ images/William_Wong.png" alt="William Wong">
                    <h5>William Wong</h5>
                    <h5 class="data">September 25, 2015</h5>
                </div> -->
            </div>
        </div>
        <div class="most-recent">
            <h3 class="most-recent__title">Most Recent</h3>
            <div class="most-recent__posts">
                <?php
                    $conn = createDBConnection();
                    getAndPrintPostsFromDB2($conn);
                    closeDBConnection($conn);
                ?>
                <!--<div class="most-recent-blocks">
                    <img class="landscape" src="http://localhost:8001/static/images/balloons.png" alt="balloons">
                    <div class="discription">
                        <h6 class="discription_title">Still Standing Tall</h6>
                        <p class="discription_subtitle">Life begins at the end of your comfort zone.</p>
                    </div>
                    <div class="author">
                        <img class="most-recent__author-img" src="http://localhost:8001/static/images/William_Wong.png" alt="William Wong">
                        <p class="most-recent__text-style">William Wong</p>
                        <p class="most-recent__text-style data">9/25/2015</p>
                    </div>
                </div>
                <div class="most-recent-blocks">
                    <img class="landscape" src="http://localhost:8001/static/images/bridge.png" alt="bridge">
                    <div class="discription">
                        <h6 class="discription_title">Sunny Side Up</h6>
                        <p class="discription_subtitle">No place is ever as bad as they tell you it’s going to be.</p>
                    </div>
                    <div class="author">
                        <img class="most-recent__author-img" src="http://localhost:8001/static/images/Mat_Vogels.png" alt="Mat Vogels">
                        <p class="most-recent__text-style">Mat Vogels</p>
                        <p class="most-recent__text-style data">9/25/2015</p>
                    </div>
                </div>
                <div class="most-recent-blocks">
                    <img class="landscape" src="http://localhost:8001/static/images/lake.png" alt="lake">
                    <div class="discription">
                        <h6 class="discription_title">Water Falls</h6>
                        <p class="discription_subtitle">We travel not to escape life, but for life not to escape us.</p>
                    </div>
                    <div class="author">
                        <img class="most-recent__author-img" src="http://localhost:8001/static/images/Mat_Vogels.png" alt="Mat Vogels">
                        <p class="most-recent__text-style">Mat Vogels</p>
                        <p class="most-recent__text-style data">9/25/2015</p>
                    </div>
                </div>
                <div class="most-recent-blocks">
                    <img class="landscape" src="http://localhost:8001/static/images/ocean.png" alt="ocean">
                    <div class="discription">
                        <h6 class="discription_title">Through the Mist</h6>
                        <p class="discription_subtitle">Travel makes you see what a tiny place you occupy in the world.</p>
                    </div>
                    <div class="author">    
                        <img class="most-recent__author-img" src="http://localhost:8001/static/images/William_Wong.png" alt="William Wong">
                        <p class="most-recent__text-style">William Wong</p>
                        <p class="most-recent__text-style data">9/25/2015</p>
                    </div>
                </div>
                <div class="most-recent-blocks">
                    <img class="landscape" src="http://localhost:8001/static/images/cable_car.png" alt="cable_car">
                    <div class="discription">
                        <h6 class="discription_title">Awaken Early</h6>
                        <p class="discription_subtitle">Not all those who wander are lost.</p>
                    </div>
                    <div class="author">
                        <img class="most-recent__author-img" src="http://localhost:8001/static/images/Mat_Vogels.png" alt="Mat Vogels">
                        <p class="most-recent__text-style">Mat Vogels</p>
                        <p class="most-recent__text-style data">9/25/2015</p>
                    </div>
                </div>
                <div class="most-recent-blocks">
                    <img class="landscape" src="http://localhost:8001/static/images/waterfall.png" alt="waterfall">
                    <div class="discription">
                        <h6 class="discription_title">Try it Always</h6>
                        <p class="discription_subtitle">The world is a book, and those who do not travel read only one page.</p>
                    </div>
                    <div class="author">
                        <img class="most-recent__author-img" src="http://localhost:8001/static/images/Mat_Vogels.png" alt="Mat Vogels">
                        <p class="most-recent__text-style">Mat Vogels</p>
                        <p class="most-recent__text-style data">9/25/2015</p>
                    </div>
                </div>-->
            </div>
        </div>
    </div>
    <div class="bottom">
        <div class="bottom-menu">
            <img src="./images/escape_logo.svg" alt="Escape logo">
            <nav class="nav">
                <ul>
                    <li><a class = "link" href = "#">Home</a></li>
                    <li><a class = "link" href = "#">Categories</a></li>
                    <li><a class = "link" href = "#">About</a></li>
                    <li><a class = "link" href = "#">Contact</a></li>
                </ul>
            </nav>
        </div>
    </div>
</body>