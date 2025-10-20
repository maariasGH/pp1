<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251020055752 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE subasta ADD ganador_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE subasta ADD CONSTRAINT FK_5C3A06C4A338CEA5 FOREIGN KEY (ganador_id) REFERENCES usuario (id)');
        $this->addSql('CREATE INDEX IDX_5C3A06C4A338CEA5 ON subasta (ganador_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE subasta DROP FOREIGN KEY FK_5C3A06C4A338CEA5');
        $this->addSql('DROP INDEX IDX_5C3A06C4A338CEA5 ON subasta');
        $this->addSql('ALTER TABLE subasta DROP ganador_id');
    }
}
