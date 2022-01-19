<?php
    require_once('connectvars.php');
    
    class Fighter extends PlayerCharacter {

        // The purpose of this function is to return the fighter's first level ability
        public function firstLevelAbility() {
            return 'Second Wind - You have a limited well of stamina that you can draw on to protect yourself from harm. On your turn, you can use a bonus action to regain hit points equal to 1d10 + your fighter level. Once you use this feature, you must finish a short or long rest before you can use it again.';
        }

                // The purpose of this function is to add a new character to character_info
        public function addCharacter() {
            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            $query = "INSERT INTO character_info (character_name, player_id, dex_score, str_score, con_score, int_score, wis_score, cha_score, race, current_hp, max_hp, level, class) VALUES ('$this->name', $this->playerId, $this->dexScore, $this->strScore, $this->conScore, $this->intScore, $this->wisScore, $this->chaScore, '$this->race', $this->maxHP, $this->maxHP, $this->level, 'Fighter')";
            echo $query;
            mysqli_query($dbc, $query);
            mysqli_close($dbc);
        }
       
    }
?>