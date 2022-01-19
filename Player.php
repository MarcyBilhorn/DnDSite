<?php
    require_once('connectvars.php');
    
    class Player {

        private $playerId;
        private $playerName;

        // Setters
        public function setPlayerId($playerId) {
            $this->playerId = $playerId;
        }

        public function setPlayerName($playerName) {
            $this->playerName = $playerName;
        }

        // Getters
        public function getPlayerId() {
            return $this->playerId;
        }

        public function getPlayerName() {
            return $this->playerName;
        }
        
        // The purpose of this function is to run an update query on player_info to update player data
        public function updatePlayer() {
            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            $query = "UPDATE player_info SET player_name = '$this->playerName' WHERE player_id = '$this->playerId'";
            mysqli_query($dbc, $query);
            mysqli_close($dbc);
        }

        // The purpose of this function is to add a new player to player_info
        public function addPlayer() {
            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            $query = "INSERT INTO player_info (player_name) VALUES ('$this->playerName')";
            mysqli_query($dbc, $query);
            mysqli_close($dbc);
        }

        // The purpose of this function is to check if there are any other players with the same name
        public function checkOtherPlayers() {
            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            $query = "SELECT player_id from player_info where player_name = '$this->playerName'";
            $data = mysqli_query($dbc, $query);
            $total = mysqli_num_rows($data);
            mysqli_close($dbc);

            if ($total > 0) {
                return true;
            } else {
                return false;
            } 
        }
    }
?>