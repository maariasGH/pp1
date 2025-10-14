<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251014212141 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comentario ADD usuarios_me_gusta VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE subasta RENAME INDEX fk_subasta_vendedor TO IDX_5C3A06C48361A8B8');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comentario DROP usuarios_me_gusta');
        $this->addSql('ALTER TABLE subasta RENAME INDEX idx_5c3a06c48361a8b8 TO FK_SUBASTA_VENDEDOR');
    }
}
