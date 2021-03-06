-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema ynews
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema ynews
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `ynews` DEFAULT CHARACTER SET utf8 ;
USE `ynews` ;

-- -----------------------------------------------------
-- Table `ynews`.`categories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ynews`.`categories` (
  `id_categories` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `uuid` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_categories`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ynews`.`feeds`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ynews`.`feeds` (
  `id_feeds` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `source` VARCHAR(3000) NOT NULL,
  `categories_id_categories` INT NOT NULL,
  `uuid` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_feeds`, `categories_id_categories`),
  INDEX `fk_feeds_categories1_idx` (`categories_id_categories` ASC),
  CONSTRAINT `fk_feeds_categories1`
    FOREIGN KEY (`categories_id_categories`)
    REFERENCES `ynews`.`categories` (`id_categories`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ynews`.`news`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ynews`.`news` (
  `id_news` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `description` MEDIUMTEXT NOT NULL,
  `link` VARCHAR(3000) NOT NULL,
  `pubdate` DATETIME NOT NULL,
  `feeds_id_feeds` INT NOT NULL,
  `saved_at` DATETIME NOT NULL,
  `uuid` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_news`, `feeds_id_feeds`),
  INDEX `fk_news_feeds1_idx` (`feeds_id_feeds` ASC),
  CONSTRAINT `fk_news_feeds1`
    FOREIGN KEY (`feeds_id_feeds`)
    REFERENCES `ynews`.`feeds` (`id_feeds`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ynews`.`rating`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ynews`.`rating` (
  `id_rating` INT NOT NULL AUTO_INCREMENT,
  `score` INT NOT NULL,
  `uuid` VARCHAR(45) NOT NULL,
  `news_id_news` INT NOT NULL,
  PRIMARY KEY (`id_rating`, `news_id_news`),
  INDEX `fk_rating_news1_idx` (`news_id_news` ASC),
  CONSTRAINT `fk_rating_news1`
    FOREIGN KEY (`news_id_news`)
    REFERENCES `ynews`.`news` (`id_news`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ynews`.`static_pages`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ynews`.`static_pages` (
  `id_static_page` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(45) NOT NULL,
  `content` LONGTEXT NOT NULL,
  `uuid` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_static_page`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ynews`.`contact_messages`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ynews`.`contact_messages` (
  `idcontact_messages` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `message` LONGTEXT NULL,
  `uuid` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idcontact_messages`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ynews`.`likes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ynews`.`likes` (
  `idlikes` INT NOT NULL AUTO_INCREMENT,
  `user` VARCHAR(45) NOT NULL,
  `uuid` VARCHAR(45) NOT NULL,
  `news_id_news` INT NOT NULL,
  PRIMARY KEY (`idlikes`, `news_id_news`),
  INDEX `fk_likes_news1_idx` (`news_id_news` ASC),
  CONSTRAINT `fk_likes_news1`
    FOREIGN KEY (`news_id_news`)
    REFERENCES `ynews`.`news` (`id_news`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ynews`.`shares`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ynews`.`shares` (
  `idshares` INT NOT NULL AUTO_INCREMENT,
  `user` VARCHAR(45) NOT NULL,
  `uuid` VARCHAR(45) NOT NULL,
  `news_id_news` INT NOT NULL,
  PRIMARY KEY (`idshares`, `news_id_news`),
  INDEX `fk_shares_news1_idx` (`news_id_news` ASC),
  CONSTRAINT `fk_shares_news1`
    FOREIGN KEY (`news_id_news`)
    REFERENCES `ynews`.`news` (`id_news`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ynews`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ynews`.`users` (
  `idusers` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `uuid` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idusers`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
