
-- Database: `dnd_database`
-- 
-- Table structure for table `character_info`
--
CREATE TABLE `character_info` (
  `character_id` int(11) NOT NULL,
  `character_name` varchar(250) NOT NULL,
  `player_id` int(11) NOT NULL,
  `dex_score` int(11) NOT NULL,
  `str_score` int(11) NOT NULL,
  `con_score` int(11) NOT NULL,
  `int_score` int(11) NOT NULL,
  `wis_score` int(11) NOT NULL,
  `cha_score` int(11) NOT NULL,
  `race` varchar(250) NOT NULL,
  `current_hp` int(11) NOT NULL,
  `max_hp` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `class` varchar(250) NOT NULL
);
--
-- Table structure for table `player_info`
--
CREATE TABLE `player_info` (
  `player_id` int(11) NOT NULL,
  `player_name` varchar(250) NOT NULL
);
--
-- Indexes for table `character_info`
--
ALTER TABLE `character_info`
  ADD PRIMARY KEY (`character_id`);
--
-- Indexes for table `player_info`
--
ALTER TABLE `player_info`
  ADD PRIMARY KEY (`player_id`);
--
-- AUTO_INCREMENT for table `character_info`
--
ALTER TABLE `character_info`
  MODIFY `character_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `player_info`
--
ALTER TABLE `player_info`
  MODIFY `player_id` int(11) NOT NULL AUTO_INCREMENT;
-- 
-- 
-- 
COMMIT;