<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>DnD Site - View All Players</title>
     <link rel="stylesheet" type="text/css" href="dndSite.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>
</head>
<body>
    
<?php
    require_once('connectvars.php');
    require_once('navbar.php');
    require_once('Player.php');

    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $query = "SELECT player_id, player_name FROM player_info ORDER BY player_name";
        $data = mysqli_query($dbc, $query);
        $total = mysqli_num_rows($data);
        
        echo "<section>";
        echo "<h2>Players</h2>";
        echo '<br /><br />';
        
        if ($total == 0) {
            echo '<p>No players found</p>';
        } else {
            
            echo "<table>";
            
            while ($row = mysqli_fetch_array($data)) {
                echo "<tr><td class='gridDesign'>";
                echo $row['player_name'];
                echo "</td><td class='gridDesign'>";
                echo "<a href='editPlayer.php?player_id=" . $row['player_id'] . "'>Edit</a>";
                echo "</td></tr>";
            }
            
            echo "</table>";
        }
        mysqli_close($dbc);
?>
</body>
</HTML>