<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>DnD - Home</title>
     <link rel="stylesheet" type="text/css" href="dndSite.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<?php
    session_start();
    require_once('navbar.php');
?>
<h1>Need a roll?</h1>
<article class='diceBox'>
    <p>D4:</p>
    <br />
<?php
    echo rand(1,4);
?>
</article>
<article class='diceBox'>
    <p>D6:</p>
    <br />
<?php
    echo rand(1,6);
?>
</article>
<article class='diceBox'>
    <p>D8:</p>
    <br />
<?php
    echo rand(1,8);
?>
</article>
<article class='diceBox'>
    <p>D10:</p>
    <br />
<?php
    echo rand(1,10);
?>
</article>
<article class='diceBox'>
    <p>D12:</p>
    <br />
<?php
    echo rand(1,12);
?>
</article>
<article class='diceBox'>
    <p>D20:</p>
    <br />
<?php
    echo rand(1,20);
?>
</article>
<article class='diceBox'>
    <p>D100:</p>
    <br />
<?php
    echo rand(1,100);
?>
</article>
<article class='rollInfo'>
    <p>Refresh page for new rolls</p>
</article>

</body>
</html>