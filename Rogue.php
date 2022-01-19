<?php
    require_once('connectvars.php');
    
    class Rogue extends PlayerCharacter {
    
        // The purpose of this function is to return the rogue's first level ability
        public function firstLevelAbility() {
            return 'Sneak Attack - Beginning at 1st level, you know how to strike subtly and exploit a foe’s distraction. Once per turn, you can deal an extra 1d6 damage to one creature you hit with an attack if you have advantage on the attack roll. The attack must use a finesse or a ranged weapon.';
        }

        // The purpose of this function is to add a new character to character_info
        public function addCharacter() {
            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            $query = "INSERT INTO character_info (character_name, player_id, dex_score, str_score, con_score, int_score, wis_score, cha_score, race, current_hp, max_hp, level, class) VALUES ('$this->name', $this->playerId, $this->dexScore, $this->strScore, $this->conScore, $this->intScore, $this->wisScore, $this->chaScore, '$this->race', $this->maxHP, $this->maxHP, $this->level, 'Rogue')";
            mysqli_query($dbc, $query);
            mysqli_close($dbc);
        }
        
    }
?>