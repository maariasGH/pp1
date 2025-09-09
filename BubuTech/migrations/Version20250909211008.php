<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250909211008 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comentario ADD comentador_id INT NOT NULL, ADD subasta_id INT NOT NULL');
        $this->addSql('ALTER TABLE comentario ADD CONSTRAINT FK_4B91E702B4E4C88 FOREIGN KEY (comentador_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE comentario ADD CONSTRAINT FK_4B91E70260B185C4 FOREIGN KEY (subasta_id) REFERENCES subasta (id)');
        $this->addSql('CREATE INDEX IDX_4B91E702B4E4C88 ON comentario (comentador_id)');
        $this->addSql('CREATE INDEX IDX_4B91E70260B185C4 ON comentario (subasta_id)');
        $this->addSql('ALTER TABLE oferta ADD ofertante_id INT NOT NULL, ADD subasta_id INT NOT NULL');
        $this->addSql('ALTER TABLE oferta ADD CONSTRAINT FK_7479C8F2DE66A607 FOREIGN KEY (ofertante_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE oferta ADD CONSTRAINT FK_7479C8F260B185C4 FOREIGN KEY (subasta_id) REFERENCES subasta (id)');
        $this->addSql('CREATE INDEX IDX_7479C8F2DE66A607 ON oferta (ofertante_id)');
        $this->addSql('CREATE INDEX IDX_7479C8F260B185C4 ON oferta (subasta_id)');
        $this->addSql('ALTER TABLE subasta ADD producto_id INT NOT NULL');
        $this->addSql('ALTER TABLE subasta ADD CONSTRAINT FK_5C3A06C47645698E FOREIGN KEY (producto_id) REFERENCES producto (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5C3A06C47645698E ON subasta (producto_id)');
        $this->addSql('ALTER TABLE usuario ADD roles JSON NOT NULL, ADD password VARCHAR(255) NOT NULL, DROP contraseña, DROP rol, CHANGE nombre_usuario nombre_usuario VARCHAR(180) NOT NULL, CHANGE nombre_real nombre_real VARCHAR(50) NOT NULL, CHANGE email email VARCHAR(30) NOT NULL, CHANGE fecha_nacimiento fecha_nacimiento DATETIME NOT NULL, CHANGE direccion direccion VARCHAR(50) DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_NOMBRE_USUARIO ON usuario (nombre_usuario)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comentario DROP FOREIGN KEY FK_4B91E702B4E4C88');
        $this->addSql('ALTER TABLE comentario DROP FOREIGN KEY FK_4B91E70260B185C4');
        $this->addSql('DROP INDEX IDX_4B91E702B4E4C88 ON comentario');
        $this->addSql('DROP INDEX IDX_4B91E70260B185C4 ON comentario');
        $this->addSql('ALTER TABLE comentario DROP comentador_id, DROP subasta_id');
        $this->addSql('ALTER TABLE subasta DROP FOREIGN KEY FK_5C3A06C47645698E');
        $this->addSql('DROP INDEX UNIQ_5C3A06C47645698E ON subasta');
        $this->addSql('ALTER TABLE subasta DROP producto_id');
        $this->addSql('ALTER TABLE oferta DROP FOREIGN KEY FK_7479C8F2DE66A607');
        $this->addSql('ALTER TABLE oferta DROP FOREIGN KEY FK_7479C8F260B185C4');
        $this->addSql('DROP INDEX IDX_7479C8F2DE66A607 ON oferta');
        $this->addSql('DROP INDEX IDX_7479C8F260B185C4 ON oferta');
        $this->addSql('ALTER TABLE oferta DROP ofertante_id, DROP subasta_id');
        $this->addSql('DROP INDEX UNIQ_IDENTIFIER_NOMBRE_USUARIO ON usuario');
        $this->addSql('ALTER TABLE usuario ADD contraseña VARCHAR(20) NOT NULL, ADD rol VARCHAR(15) NOT NULL, DROP roles, DROP password, CHANGE nombre_usuario nombre_usuario VARCHAR(12) NOT NULL, CHANGE nombre_real nombre_real VARCHAR(30) NOT NULL, CHANGE email email VARCHAR(20) NOT NULL, CHANGE fecha_nacimiento fecha_nacimiento DATE NOT NULL, CHANGE direccion direccion VARCHAR(30) DEFAULT NULL');
    }
}
