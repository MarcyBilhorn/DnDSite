<?php
    require_once('connectvars.php');

    class PlayerCharacter {
        protected $characterId;
        protected $name;
        protected $playerId;
        protected $dexScore;
        protected $strScore;
        protected $conScore;
        protected $intScore;
        protected $wisScore;
        protected $chaScore;
        protected $race;
        protected $maxHP;
        protected $currentHP;
        protected $level;

        // Setters
        public function setCharacterId($characterId) {
            $this->characterId = $characterId;
        }

        public function setName($name) {
            $this->name = $name;
        }

        public function setPlayerId($playerId) {
            $this->playerId = $playerId;
        }

        public function setDexScore($dexScore) {
            $this->dexScore = $dexScore;
        }

        public function setStrScore($strScore) {
            $this->strScore = $strScore;
        }

        public function setConScore($conScore) {
            $this->conScore = $conScore;
        }

        public function setIntScore($intScore) {
            $this->intScore = $intScore;
        }

        public function setWisScore($wisScore) {
            $this->wisScore = $wisScore;
        }

        public function setChaScore($chaScore) {
            $this->chaScore = $chaScore;
        }

        public function setRace($race) {
            $this->race = $race;
        }

        public function setMaxHP($maxHP) {
            $this->maxHP = $maxHP;
        }

        public function setCurrentHP($currentHP) {
            $this->currentHP = $currentHP;
        }

        public function setLevel($level) {
            $this->level = $level;
        }

        // Getters
        public function getCharacterId() {
            return $this->characterId;
        }

        public function getName() {
            return $this->name;
        }

        public function getPlayerId() {
            return $this->playerId;
        }

        public function getDexScore() {
            return $this->dexScore;
        }

        public function getStrScore() {
            return $this->strScore;
        }

        public function getConScore() {
            return $this->conScore;
        }

        public function getIntScore() {
            return $this->intScore;
        }

        public function getWisScore() {
            return $this->wisScore;
        }

        public function getChaScore() {
            return $this->chaScore;
        }

        public function getRace() {
            return $this->race;
        }

        public function getMaxHP() {
            return $this->maxHP;
        }

        public function getCurrentHP() {
            return $this->currentHP;
        }

        public function getLevel() {
            return $this->level;
        }

        // Functions

        // The purpose of this function is to calculate the skill modifier based on the score
        public function calculateScoreModifier($score) {
            switch($score) {
                case 1:
                    return -5;
                case 2:
                    return -4;
                case 3:
                    return -4;
                case 4:
                    return -3;
                case 5:
                    return -3;
                case 6:
                    return -2;
                case 7:
                    return -2;
                case 8:
                    return -1;
                case 9:
                    return -1;
                case 10:
                    return 0;
                case 11:
                    return 0;
                case 12:
                    return 1;
                case 13:
                    return 1;
                case 14:
                    return 2;
                case 15:
                    return 2;
                case 16:
                    return 3;
                case 17:
                    return 3;
                case 18:
                    return 4;
                case 19:
                    return 4;
                case 20:
                    return 5;
                case 21:
                    return 5;
                case 22:
                    return 6;
                case 23:
                    return 6;
                case 24:
                    return 7;
                case 25:
                    return 7;
            }
        }

        // The purpose of this function is to return the character's first level ability
        public function firstLevelAbility() {
            return 'First level ability';
        }

        // The purpose of this function is to check if another character has the same name
        public function checkOtherCharacters() {
            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            $query = "SELECT player_id from character_info where character_name = '$this->characterName'";
            $data = mysqli_query($dbc, $query);
            $total = mysqli_num_rows($data);
            mysqli_close($dbc);

            if ($total > 0) {
                return true;
            } else {
                return false;
            } 
        }

        // The purpose of this function is to add a new character to character_info
        public function addCharacter() {
            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            $query = "INSERT INTO character_info (character_name, player_id, dex_score, str_score, con_score, int_score, wis_score, cha_score, race, current_hp, max_hp, level) VALUES ('$this->name', $this->playerId, $this->dexScore, $this->strScore, $this->conScore, $this->intScore, $this->wisScore, $this->chaScore, '$this->race', $this->maxHP, $this->maxHP, $this->level)";
            mysqli_query($dbc, $query);
            mysqli_close($dbc);
        }

        // The purpose of this function is to update a character in character_info
        public function updateCharacter() {
            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            $query = "UPDATE character_info SET character_name='$this->name', dex_score=$this->dexScore, str_score=$this->strScore, con_score=$this->conScore, int_score=$this->intScore, wis_score=$this->wisScore, cha_score=$this->chaScore, race='$this->race', max_hp=$this->maxHP, current_hp=$this->currentHP, level=$this->level WHERE character_id = $this->characterId";
            echo $query;
            mysqli_query($dbc, $query);
            mysqli_close($dbc);
        }

    }

?>
