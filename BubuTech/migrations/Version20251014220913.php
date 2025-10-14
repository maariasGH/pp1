<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251014220913 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE comentario_usuario_megusta (comentario_id INT NOT NULL, usuario_id INT NOT NULL, INDEX IDX_49F9620EF3F2D7EC (comentario_id), INDEX IDX_49F9620EDB38439E (usuario_id), PRIMARY KEY(comentario_id, usuario_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comentario_usuario_megusta ADD CONSTRAINT FK_49F9620EF3F2D7EC FOREIGN KEY (comentario_id) REFERENCES comentario (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comentario_usuario_megusta ADD CONSTRAINT FK_49F9620EDB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comentario_usuario_megusta DROP FOREIGN KEY FK_49F9620EF3F2D7EC');
        $this->addSql('ALTER TABLE comentario_usuario_megusta DROP FOREIGN KEY FK_49F9620EDB38439E');
        $this->addSql('DROP TABLE comentario_usuario_megusta');
    }
}
