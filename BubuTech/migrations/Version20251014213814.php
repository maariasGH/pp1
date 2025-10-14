<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251014213814 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE comentario_usuario (comentario_id INT NOT NULL, usuario_id INT NOT NULL, INDEX IDX_2B16627AF3F2D7EC (comentario_id), INDEX IDX_2B16627ADB38439E (usuario_id), PRIMARY KEY(comentario_id, usuario_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comentario_usuario ADD CONSTRAINT FK_2B16627AF3F2D7EC FOREIGN KEY (comentario_id) REFERENCES comentario (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comentario_usuario ADD CONSTRAINT FK_2B16627ADB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comentario DROP usuarios_me_gusta');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comentario_usuario DROP FOREIGN KEY FK_2B16627AF3F2D7EC');
        $this->addSql('ALTER TABLE comentario_usuario DROP FOREIGN KEY FK_2B16627ADB38439E');
        $this->addSql('DROP TABLE comentario_usuario');
        $this->addSql('ALTER TABLE comentario ADD usuarios_me_gusta VARCHAR(255) NOT NULL');
    }
}
