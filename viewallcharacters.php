<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>DnD Site - View All Characters</title>
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
    require_once('navbar.php');

    // Declare search variable
    $search = $_POST['search'];
?>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form-horizontal">
        <div class="form-group">
            <label for="search" class="control-label col-sm-2">Search:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="search" value="<?php if (!empty($search)) echo $search;?>" /><br />
            </div>
            <p class='centerButtonCushion'></p>
            <span class="centerButton">
                <input type="submit" value="Search" class="btn btn-primary" name="submit" />
            </span>
        </div>
    </form>
    
<?php 
    require_once('connectvars.php');
    require_once('PlayerCharacter.php');
    require_once('Fighter.php');
    require_once('Rogue.php');

    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if ($_POST['submit']) {
        $query = "SELECT character_id, character_name, level, race, class FROM character_info";

        // Extract search keywords
        $clean_search = str_replace(", ", ' ', $search);
        $search_words = explode(' ', $clean_search);
        $final_search_words = array();
        
        // If there are search words, create array of each word
        if (count($search_words) > 0) {
            foreach ($search_words as $word) {
                if (!empty($word)) {
                    $final_search_words[] = $word;
                }
            }
        }
        
        // Create where clause with search terms
        $where_list = array();
        if (count($final_search_words) > 0) {
            foreach($final_search_words as $word) {
                $where_list[] = "character_name LIKE '%$word%'";
            }
        }
        
        // Create clause with 'OR'
        $where_clause = implode(' OR ', $where_list);
        
        // If where clause contains content, append it to query. If not, only append ORDER BY clause
        if (!empty($where_clause)) {
            $query .= " WHERE $where_clause ORDER BY character_name";
        } else {
            $query .= " ORDER BY character_name";
        }

    } else {
        $query = "SELECT character_id, character_name, level, race, class FROM character_info ORDER BY character_name";
    }

        $data = mysqli_query($dbc, $query);
        $total = mysqli_num_rows($data);
        
        echo "<section>";
        echo "<h2>Characters</h2>";
        echo '<br /><br />';
        
        if ($total == 0) {
            echo '<p>No characters found</p>';
        } else {
            echo "<table>";
            
            while ($row = mysqli_fetch_array($data)) {
                echo "<tr><td class='gridDesign'>";
                echo $row['character_name'];
                echo "</td><td class='gridDesign'>";
                echo "Level " . $row['level'];
                echo "</td><td class='gridDesign'>";
                echo $row['race'];
                echo "</td><td class='gridDesign'>";
                echo $row['class'];
                echo "</td><td class='gridDesign'>";
                echo "<a href='viewCharacter.php?character_id=" . $row['character_id'] . "'>View</a>";
                echo "</td><td class='gridDesign'>";
                echo "<a href='editCharacter.php?character_id=" . $row['character_id'] . "'>Edit</a>";
                echo "</td></tr>";
            }
            
            echo "</table>";
        }
        
    mysqli_close($dbc);
?>
</body>
</HTML>