CREATE SCHEMA IF NOT EXISTS `quiz`;
USE `quiz` ;

DROP TABLE IF EXISTS `quiz` ;
CREATE TABLE IF NOT EXISTS `quiz` (
  `quiz_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `quiz_name` VARCHAR(45) NOT NULL,
  `quiz_question_count` INT NOT NULL,
  PRIMARY KEY (`quiz_id`),
  UNIQUE INDEX `quiz_name_UNIQUE` (`quiz_name` ASC) VISIBLE);

DROP TABLE IF EXISTS `question` ;
CREATE TABLE IF NOT EXISTS `question` (
  `question_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `question_quiz_id` INT UNSIGNED NOT NULL,
  `question_content` VARCHAR(500) NOT NULL,
  `question_answer_count` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`question_id`),
  INDEX `question_quiz_id_idx` (`question_quiz_id` ASC) VISIBLE,
  CONSTRAINT `question_quiz_id`
    FOREIGN KEY (`question_quiz_id`)
    REFERENCES `quiz` (`quiz_id`));

DROP TABLE IF EXISTS `answer` ;
CREATE TABLE IF NOT EXISTS `answer` (
  `answer_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `answer_question_id` INT UNSIGNED NOT NULL,
  `answer_content` VARCHAR(500) NOT NULL,
  `answer_correct` TINYINT UNSIGNED NOT NULL,
  PRIMARY KEY (`answer_id`),
  INDEX `answer_question_id_idx` (`answer_question_id` ASC) VISIBLE,
  CONSTRAINT `answer_question_id`
    FOREIGN KEY (`answer_question_id`)
    REFERENCES `question` (`question_id`));

DROP TABLE IF EXISTS `user` ;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_username` VARCHAR(45) NOT NULL,
  `user_password` VARCHAR(200) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE INDEX `user_username_UNIQUE` (`user_username` ASC) VISIBLE);
