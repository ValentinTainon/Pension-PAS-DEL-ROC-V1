<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230212144835 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animal ADD select_animal VARCHAR(50) DEFAULT NULL, CHANGE date_chaleurs date_chaleurs VARCHAR(50) NOT NULL, CHANGE medical medical TINYINT(1) NOT NULL, CHANGE vaccins vaccins TINYINT(1) NOT NULL, CHANGE vermifuge vermifuge TINYINT(1) NOT NULL, CHANGE alimentation alimentation TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE animal RENAME INDEX fk_6aab231f79f37ae5 TO IDX_6AAB231FA76ED395');
        $this->addSql('ALTER TABLE reservation CHANGE date_creation date_creation VARCHAR(20) NOT NULL, CHANGE date_debut date_debut VARCHAR(50) NOT NULL, CHANGE date_fin date_fin VARCHAR(50) NOT NULL, CHANGE prix prix DOUBLE PRECISION NOT NULL, CHANGE status status VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE reservation RENAME INDEX fk_42c8495579f37ae5 TO IDX_42C84955A76ED395');
        $this->addSql('ALTER TABLE reservation RENAME INDEX fk_42c84955ea39031 TO IDX_42C849558E962C16');
        $this->addSql('ALTER TABLE user CHANGE username username VARCHAR(180) NOT NULL, CHANGE password password VARCHAR(255) NOT NULL, CHANGE nom nom VARCHAR(50) NOT NULL, CHANGE prenom prenom VARCHAR(50) NOT NULL, CHANGE adresse adresse VARCHAR(100) NOT NULL, CHANGE code_postal code_postal VARCHAR(5) NOT NULL, CHANGE ville ville VARCHAR(50) NOT NULL, CHANGE telephone telephone VARCHAR(16) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user CHANGE username username VARCHAR(180) DEFAULT NULL, CHANGE password password VARCHAR(255) DEFAULT NULL, CHANGE nom nom VARCHAR(50) DEFAULT NULL, CHANGE prenom prenom VARCHAR(50) DEFAULT NULL, CHANGE adresse adresse VARCHAR(100) DEFAULT NULL, CHANGE code_postal code_postal VARCHAR(5) DEFAULT NULL, CHANGE ville ville VARCHAR(50) DEFAULT NULL, CHANGE telephone telephone VARCHAR(16) DEFAULT NULL');
        $this->addSql('ALTER TABLE animal DROP select_animal, CHANGE date_chaleurs date_chaleurs VARCHAR(50) DEFAULT NULL, CHANGE medical medical TINYINT(1) DEFAULT NULL, CHANGE vaccins vaccins TINYINT(1) DEFAULT NULL, CHANGE vermifuge vermifuge TINYINT(1) DEFAULT NULL, CHANGE alimentation alimentation TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE animal RENAME INDEX idx_6aab231fa76ed395 TO FK_6AAB231F79F37AE5');
        $this->addSql('ALTER TABLE reservation CHANGE date_creation date_creation VARCHAR(20) DEFAULT NULL, CHANGE date_debut date_debut VARCHAR(50) DEFAULT NULL, CHANGE date_fin date_fin VARCHAR(50) DEFAULT NULL, CHANGE prix prix DOUBLE PRECISION DEFAULT NULL, CHANGE status status VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation RENAME INDEX idx_42c84955a76ed395 TO FK_42C8495579F37AE5');
        $this->addSql('ALTER TABLE reservation RENAME INDEX idx_42c849558e962c16 TO FK_42C84955EA39031');
    }
}
