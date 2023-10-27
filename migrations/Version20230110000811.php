<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230110000811 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation ADD id_animal_id INT NOT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955EA39031 FOREIGN KEY (id_animal_id) REFERENCES animal (id)');
        $this->addSql('CREATE INDEX IDX_42C84955EA39031 ON reservation (id_animal_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955EA39031');
        $this->addSql('DROP INDEX IDX_42C84955EA39031 ON reservation');
        $this->addSql('ALTER TABLE reservation DROP id_animal_id');
    }
}
