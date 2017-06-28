<?php
echo '<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Zeyada" rel="stylesheet" type="text/css">
    <title>CV</title>
  </head>
  <body>
    <header>
      <div class="IDs">
        <img id="me" src="photo.png" alt="me.png" width="128px" height="auto"/>
        <h2>GIRAUD Benjamin</h2>
      </div>
      <div class="code">
        <pre><span class="pink">#include</span> <span class="yellow">&ltiostream></span>

<span class="pink">int</span> <span class="green">main</span>(<span class="blue">int</span> <span class="orange">argc</span>, <span class="blue">char*</span> <span class="orange">argv[]</span>) {
  std::cout <span class="pink"><<</span><span class="yellow"> "Welcome!" </span><span class="pink"><< </span><span class="green">endl</span>;
  <span class="pink">return</span> <span class="violet">0</span>;
}</pre>
    </div>
    </header>
    <div class ="title">
      <h1>A Web Developers Diary</h1>
    </div>
    <div class="menu-container">
        <button class="logo menuicon menu-collapse">Menu</button>
        <div class="menu-content">
          <ul class="menu pages">
            <li><a class="logo home current" href="index.php">Home</a></li>
            <li><a class="logo cv " href="cv.php">CV</a></li>
            <li><a class="logo portfolio" href="portfolio.php">Portfolio</a> </li>
            <li><a class="logo article" href="articleindex.php">Articles</a></li>
          </ul>
          <ul class="menu contacts">
            <li><a class="logo contact" href="">E-mail</a></li>
            <li><a class="logo twitter" href="">Twitter</a></li>
            <li><a class="logo facebook" href="">Facebook</a></li>
            <li><a class="logo linkedin" href="">LinkedIn</a></li>
          </ul>
        </div>
    </div> '
?>
