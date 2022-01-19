<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>DnD Site - Add Character</title>
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
    require_once('PlayerCharacter.php');
    require_once('Fighter.php');
    require_once('Rogue.php');

    // Connect to database
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (isset($_POST['submit'])) {
        // Get player info from form
        $characterName = mysqli_real_escape_string($dbc, trim($_POST['characterName']));
        $playerId =  mysqli_real_escape_string($dbc, trim($_POST['player']));
        $dexScore =  mysqli_real_escape_string($dbc, trim($_POST['dexScore']));
        $strScore =  mysqli_real_escape_string($dbc, trim($_POST['strScore']));
        $conScore =  mysqli_real_escape_string($dbc, trim($_POST['conScore']));
        $intScore =  mysqli_real_escape_string($dbc, trim($_POST['intScore']));
        $wisScore = mysqli_real_escape_string($dbc, trim($_POST['wisScore']));
        $chaScore =  mysqli_real_escape_string($dbc, trim($_POST['chaScore']));
        $race =  mysqli_real_escape_string($dbc, trim($_POST['race']));
        $maxHP =  mysqli_real_escape_string($dbc, trim($_POST['maxHP']));
        $level =  mysqli_real_escape_string($dbc, trim($_POST['level']));
        $class =  mysqli_real_escape_string($dbc, trim($_POST['class']));

        // Instantiate object
        if($class == 'Rogue') {
            $new_player_character = new Rogue;
        } else if ($class == 'Fighter') {
            $new_player_character = new Fighter;
        }

        // Set object variables
        $new_player_character->setName($characterName);
        $new_player_character->setPlayerId($playerId);
        $new_player_character->setDexScore($dexScore);
        $new_player_character->setStrScore($strScore);
        $new_player_character->setConScore($conScore);
        $new_player_character->setIntScore($intScore);
        $new_player_character->setWisScore($wisScore);
        $new_player_character->setChaScore($chaScore);
        $new_player_character->setRace($race);
        $new_player_character->setMaxHP($maxHP);
        $new_player_character->setLevel($level);

        // Check for other players with the same name
        $other_characters = $new_player_character->checkOtherCharacters();

        if ($other_characters) {
            echo 'Error: Another character already exists with the same name';
            echo '<br /><br />';
        } else if ($playerName = '') {
            echo 'Error: Character does not have a name.';
            echo '<br /><br />';
        } else {
            // Add information to the database
            $new_player_character->addCharacter();

            mysqli_close($dbc);

            // Return user to viewallplayers.php
            $return_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/viewallcharacters.php';
            header('Location: ' . $return_url);
        }

    }

?>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form-horizontal">
        <h3 class="text-center">Add Character:</h3>
        <div class="form-group">
            <label for="characterName" class="control-label col-sm-2">Character Name:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="characterName" value="" />
            </div>
        </div>
        <?php
            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            $query = "SELECT player_name, player_id FROM player_info ORDER BY player_name";
            $data = mysqli_query($dbc, $query);
            
            if (mysqli_num_rows($data) > 0) {
        ?>
        <div class="form-group">
            <label for="player" class="control-label col-sm-2">Player:</label>
            <div class="col-sm-10">
                <select name="player">
        <?php
            while ($row = mysqli_fetch_array($data)) {
                echo '<option value="' . $row['player_id'] . '">' . $row['player_name'] . '</option>';
            }
        ?>
                </select>
            </div>
        </div>
        <?php
            }
            
        mysqli_close($dbc);       
        ?>
        <div class="form-group">
            <label for="dexScore" class="control-label col-sm-2">Dexterity Score:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="dexScore" value="" />
            </div>
        </div>
        <div class="form-group">
            <label for="strScore" class="control-label col-sm-2">Strength Score:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="strScore" value="" />
            </div>
        </div>
        <div class="form-group">
            <label for="conScore" class="control-label col-sm-2">Constitution Score:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="conScore" value="" />
            </div>
        </div>
        <div class="form-group">
            <label for="intScore" class="control-label col-sm-2">Intelligence Score:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="intScore" value="" />
            </div>
        </div>
        <div class="form-group">
            <label for="wisScore" class="control-label col-sm-2">Wisdom Score:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="wisScore" value="" />
            </div>
        </div>
        <div class="form-group">
            <label for="chaScore" class="control-label col-sm-2">Charisma Score:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="chaScore" value="" />
            </div>
        </div>
        <div class="form-group">
            <label for="maxHP" class="control-label col-sm-2">Max HP:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="maxHP" value="" />
            </div>
        </div>
        <div class="form-group">
            <label for="race" class="control-label col-sm-2">Race:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="race" value="" />
            </div>
        </div>
         <div class="form-group">
            <label for="class" class="control-label col-sm-2">Class:</label>
            <div class="col-sm-10">
                <select name="class">
                    <option value="Fighter">Fighter</option>
                    <option value="Rogue">Rogue</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="level" class="control-label col-sm-2">Level:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="level" value="" />
            </div>
        </div>
        <p class='centerButtonCushion'></p>
        <span class="centerButton">
            <input type="submit" value="Save Character" class="btn btn-primary" name="submit" />
        </span>
    </form>

</body>
</html>
