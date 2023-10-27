<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230216001349 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire ADD reservation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCB83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_67F068BCB83297E7 ON commentaire (reservation_id)');
        $this->addSql('ALTER TABLE commentaire RENAME INDEX idx_d9bec0c4a76ed395 TO IDX_67F068BCA76ED395');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCB83297E7');
        $this->addSql('DROP INDEX UNIQ_67F068BCB83297E7 ON commentaire');
        $this->addSql('ALTER TABLE commentaire DROP reservation_id');
        $this->addSql('ALTER TABLE commentaire RENAME INDEX idx_67f068bca76ed395 TO IDX_D9BEC0C4A76ED395');
    }
}
