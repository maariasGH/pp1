<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251021194044 extends AbstractMigration
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
        $this->addSql('ALTER TABLE usuario ADD dinero_ganado DOUBLE PRECISION NOT NULL, ADD cant_subastas_ganadas INT NOT NULL, ADD dinero_gastado DOUBLE PRECISION NOT NULL, ADD subasta_mas_cara DOUBLE PRECISION NOT NULL, ADD ultima_oferta DOUBLE PRECISION NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE usuario DROP dinero_ganado, DROP cant_subastas_ganadas, DROP dinero_gastado, DROP subasta_mas_cara, DROP ultima_oferta');
        $this->addSql('ALTER TABLE subasta DROP FOREIGN KEY FK_5C3A06C4A338CEA5');
        $this->addSql('DROP INDEX IDX_5C3A06C4A338CEA5 ON subasta');
        $this->addSql('ALTER TABLE subasta DROP ganador_id');
    }
}
