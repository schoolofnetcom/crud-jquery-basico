SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP TABLE IF EXISTS `crud_jquery`.`clients`;
CREATE TABLE IF NOT EXISTS `crud_jquery`.`clients` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `cpf` VARCHAR(11) NOT NULL,
  `phone` VARCHAR(11) NOT NULL,
  `birthday` DATE NOT NULL,
  `marital_status` SMALLINT(5) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
);

INSERT INTO `crud_jquery`.`clients`(name,email,cpf,phone,birthday,marital_status)
    VALUES('Cliente 1','cliente1@schoolofnet.com','00000000000','00000000000','2017-07-08',1);
INSERT INTO `crud_jquery`.`clients`(name,email,cpf,phone,birthday,marital_status)
    VALUES('Cliente 2','cliente2@schoolofnet.com','11111111111','11111111111','2017-07-09',2);
INSERT INTO `crud_jquery`.`clients`(name,email,cpf,phone,birthday,marital_status)
    VALUES('Cliente 3','cliente3@schoolofnet.com','22222222222','22222222222','2017-07-10',3);
INSERT INTO `crud_jquery`.`clients`(name,email,cpf,phone,birthday,marital_status)
    VALUES('Cliente 4','cliente4@schoolofnet.com','33333333333','33333333333','2017-07-11',1);
INSERT INTO `crud_jquery`.`clients`(name,email,cpf,phone,birthday,marital_status)
    VALUES('Cliente 5','cliente5@schoolofnet.com','44444444444','44444444444','2017-07-12',2);
INSERT INTO `crud_jquery`.`clients`(name,email,cpf,phone,birthday,marital_status)
    VALUES('Cliente 6','cliente6@schoolofnet.com','55555555555','55555555555','2017-07-13',3);
INSERT INTO `crud_jquery`.`clients`(name,email,cpf,phone,birthday,marital_status)
    VALUES('Cliente 7','cliente7@schoolofnet.com','66666666666','66666666666','2017-07-14',1);
INSERT INTO `crud_jquery`.`clients`(name,email,cpf,phone,birthday,marital_status)
    VALUES('Cliente 8','cliente8@schoolofnet.com','77777777777','77777777777','2017-07-15',2);

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
