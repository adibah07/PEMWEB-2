-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema dbkegiatan_dosen
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema dbkegiatan_dosen
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `dbkegiatan_dosen` DEFAULT CHARACTER SET utf8 ;
USE `dbkegiatan_dosen` ;

-- -----------------------------------------------------
-- Table `dbkegiatan_dosen`.`prodi`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbkegiatan_dosen`.`prodi` (
  `id` INT(11) NOT NULL,
  `kode` VARCHAR(10) NOT NULL,
  `nama` VARCHAR(100) NOT NULL,
  `alamat` VARCHAR(100) NOT NULL,
  `telepon` VARCHAR(20) NOT NULL,
  `ketua` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbkegiatan_dosen`.`dosen`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbkegiatan_dosen`.`dosen` (
  `id` INT(11) NOT NULL,
  `nidn` VARCHAR(20) NOT NULL,
  `nama` VARCHAR(45) NOT NULL,
  `gelar_belakang` VARCHAR(30) NULL,
  `gelar_depan` VARCHAR(20) NULL,
  `jenis_kelamin` CHAR(1) NULL,
  `tempat_lahir` VARCHAR(45) NOT NULL,
  `tanggal_lahir` DATE NOT NULL,
  `alamat` VARCHAR(100) NULL,
  `email` VARCHAR(45) NULL,
  `tahun_masuk` INT(11) NOT NULL,
  `prodi_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `prodi_id_idx` (`prodi_id` ASC) ,
  CONSTRAINT `prodi_id`
    FOREIGN KEY (`prodi_id`)
    REFERENCES `dbkegiatan_dosen`.`prodi` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbkegiatan_dosen`.`bidang_ilmu`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbkegiatan_dosen`.`bidang_ilmu` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nama` VARCHAR(45) NOT NULL,
  `deskripsi` TEXT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbkegiatan_dosen`.`penelitian`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbkegiatan_dosen`.`penelitian` (
  `id` INT(11) NOT NULL,
  `judul` TEXT NOT NULL,
  `mulai` DATE NOT NULL,
  `akhir` DATE NOT NULL,
  `tahun_ajaran` VARCHAR(5) NOT NULL,
  `bidang_ilmu_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `id`
    FOREIGN KEY (`bidang_ilmu_id`)
    REFERENCES `dbkegiatan_dosen`.`bidang_ilmu` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbkegiatan_dosen`.`tim_penelitian`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbkegiatan_dosen`.`tim_penelitian` (
  `dosen_id` INT(11) NOT NULL AUTO_INCREMENT,
  `penelitian_id` INT(11) NOT NULL,
  `peran` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`dosen_id`, `penelitian_id`),
  INDEX `penelitian_id_idx` (`penelitian_id` ASC) ,
  CONSTRAINT `penelitian_id`
    FOREIGN KEY (`penelitian_id`)
    REFERENCES `dbkegiatan_dosen`.`penelitian` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `dosen_id`
    FOREIGN KEY (`dosen_id`)
    REFERENCES `dbkegiatan_dosen`.`dosen` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbkegiatan_dosen`.`jenis_kegiatan`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbkegiatan_dosen`.`jenis_kegiatan` (
  `id` INT(11) NOT NULL,
  `nama` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbkegiatan_dosen`.`kegiatan`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbkegiatan_dosen`.`kegiatan` (
  `id` INT(11) NOT NULL,
  `tanggal_mulai` DATE NOT NULL,
  `tanggal_selesai` DATE NOT NULL,
  `tempat` VARCHAR(100) NOT NULL,
  `deskripsi` TEXT NULL,
  `jenis_kegiatan_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `jenis_kegiatan_id_idx` (`jenis_kegiatan_id` ASC) ,
  CONSTRAINT `jenis_kegiatan_id`
    FOREIGN KEY (`jenis_kegiatan_id`)
    REFERENCES `dbkegiatan_dosen`.`jenis_kegiatan` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbkegiatan_dosen`.`dosen_kegiatan`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbkegiatan_dosen`.`dosen_kegiatan` (
  `dosen_id` INT(11) NOT NULL,
  `kegiatan_id` INT(11) NOT NULL,
  PRIMARY KEY (`dosen_id`, `kegiatan_id`),
  INDEX `kegiatan_id_idx` (`kegiatan_id` ASC) ,
  CONSTRAINT `dosen_id`
    FOREIGN KEY (`dosen_id`)
    REFERENCES `dbkegiatan_dosen`.`dosen` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `kegiatan_id`
    FOREIGN KEY (`kegiatan_id`)
    REFERENCES `dbkegiatan_dosen`.`kegiatan` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
