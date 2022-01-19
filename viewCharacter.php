<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>DnD Site - View Character</title>
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

     $characterID = $_GET['character_id'];


    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $query = "SELECT c.character_name, c.dex_score, c.str_score, c.con_score, c.int_score, c.wis_score, c.cha_score, c.race, c.current_hp, c.max_hp, c.level, c.class, p.player_name FROM character_info AS c INNER JOIN player_info AS p USING (player_id) where character_id = $characterID";


    $data = mysqli_query($dbc, $query);
    $total = mysqli_num_rows($data);
        
    if ($total != 1) {
        echo '<p>Error: Character not found</p>';
    } else {
    
        $row = mysqli_fetch_array($data);
        // Capture data
        $characterName = $row['character_name'];
        $dexScore = $row['dex_score'];
        $strScore = $row['str_score'];
        $conScore = $row['con_score'];
        $intScore = $row['int_score'];
        $wisScore = $row['wis_score'];
        $chaScore = $row['cha_score'];
        $race = $row['race'];
        $currentHP = $row['current_hp'];
        $maxHP = $row['max_hp'];
        $level = $row['level'];
        $class = $row['class'];
        $playerName = $row['player_name'];
        
        // Instantiate object
        if($class == 'Rogue') {
            $player_character = new Rogue;
        } else if ($class == 'Fighter') {
            $player_character = new Fighter;
        }

        $dexMod = $player_character->calculateScoreModifier($dexScore);
        $strMod = $player_character->calculateScoreModifier($strScore);
        $conMod = $player_character->calculateScoreModifier($conScore);
        $intMod = $player_character->calculateScoreModifier($intScore);
        $wisMod = $player_character->calculateScoreModifier($wisScore);
        $chaMod = $player_character->calculateScoreModifier($chaScore);

        
        echo "<section>";
        echo "<h2>" . $characterName . "</h2>";
        echo "<p>Level " . $level . " " . $race . " " . $class . " played by " . $playerName . "</p>";
        echo "<p>Hit Points: " . $currentHP . " out of " . $maxHP . "</p>";
        
        echo "<table>";
        echo "<tr><td class='gridDesign'>";
        echo 'Dexterity';
        echo "</td><td class='gridDesign'>";
        echo 'Strength';
        echo "</td><td class='gridDesign'>";
        echo 'Constitution';
        echo "</td><td class='gridDesign'>";
        echo 'Intelligence';
        echo "</td><td class='gridDesign'>";
        echo 'Wisdom';
        echo "</td><td class='gridDesign'>";
        echo 'Charisma';
        echo "</td></tr>";
        echo "<tr><td class='gridDesign'>";
        echo $dexMod;
        echo "</td><td class='gridDesign'>";
        echo $strMod;
        echo "</td><td class='gridDesign'>";
        echo $conMod;
        echo "</td><td class='gridDesign'>";
        echo $intMod;
        echo "</td><td class='gridDesign'>";
        echo $wisMod;
        echo "</td><td class='gridDesign'>";
        echo $chaMod;
        echo "</td></tr>";
        echo "<tr><td class='gridDesign'>";
        echo $dexScore;
        echo "</td><td class='gridDesign'>";
        echo $strScore;
        echo "</td><td class='gridDesign'>";
        echo $conScore;
        echo "</td><td class='gridDesign'>";
        echo $intScore;
        echo "</td><td class='gridDesign'>";
        echo $wisScore;
        echo "</td><td class='gridDesign'>";
        echo $chaScore;
        echo "</td></tr>";
        echo "</table>";
        echo "<article class='rollInfo'><p><a href='editcharacter.php?character_id=" . $characterID . "'>Edit</a></p></article>";
        echo "</section>";
    }

    mysqli_close($dbc);
?>

</body>
</HTML>