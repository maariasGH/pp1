<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250923205800 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE subasta ADD vendedor_id INT DEFAULT 1'); // 1 = ID de usuario existente
        $this->addSql('UPDATE subasta SET vendedor_id = 1 WHERE vendedor_id IS NULL');
        $this->addSql('ALTER TABLE subasta MODIFY vendedor_id INT NOT NULL');
        $this->addSql('ALTER TABLE subasta ADD CONSTRAINT FK_SUBASTA_VENDEDOR FOREIGN KEY (vendedor_id) REFERENCES usuario(id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE subasta DROP FOREIGN KEY FK_5C3A06C48361A8B8');
        $this->addSql('DROP INDEX IDX_5C3A06C48361A8B8 ON subasta');
        $this->addSql('ALTER TABLE subasta CHANGE vendedor_id vendedor_id INT NOT NULL');
    }
}
