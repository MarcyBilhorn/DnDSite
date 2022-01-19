<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>DnD Site - Edit Player</title>
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
    
    // Connect to database
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    
    if (isset($_POST['submit'])) {
        // Get player info from form
        $playerName = mysqli_real_escape_string($dbc, trim($_POST['player_name']));
        $playerId = mysqli_real_escape_string($dbc, trim($_POST['player_id']));
        
        // Instantiate object
        $new_player = new Player;
        
        // Set object variables
        $new_player->setPlayerName($playerName);
        $new_player->setPlayerId($playerId);
        
        // Check for other players with the same name
        $other_players = $new_player->checkOtherPlayers();

        if ($other_players) {
            echo 'Error: Pick a new name';
            echo '<br /><br />';
        } else if ($playerName = '') {
            echo 'Error: Player does not have a name.';
            echo '<br /><br />';
        } else {
            // Add information to the database
            $new_player->updatePlayer();
        
            mysqli_close($dbc);
        
            // Return user to viewplayer.php
            $return_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/viewallplayers.php';
            header('Location: ' . $return_url);
        }
    }
    else {
        // Get player info
        $query = "SELECT player_name FROM player_info  WHERE player_id = '" . $_GET['player_id'] . "'";
        $data = mysqli_query($dbc, $query);
        $row = mysqli_fetch_array($data);
        $total = mysqli_num_rows($data);

        if ($total != 1) {
            echo '<p>Error: Character not found</p>';
        } else {
            $playerName = $row['player_name'];
            $playerId = $_GET['player_id'];
        }
       
        mysqli_close($dbc);
    }
    
?>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form-horizontal">
        <h3 class="text-center">Change <?php echo $playerName; ?>?</h3>
        <div class="form-group">
            <label for="title" class="control-label col-sm-2">Player Name:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="player_name" value="" />
            </div>
        </div>
        <input type="hidden" name="player_id" value="<?php if (!empty($playerId)) echo $playerId; ?>" />
        <p class='centerButtonCushion'></p>
        <span class="centerButton">
            <input type="submit" value="Save Player" class="btn btn-primary" name="submit" />
        </span>
    </form>

</body>
</html>