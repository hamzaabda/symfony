<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220411002136 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY S_NOM_FK');
        $this->addSql('DROP INDEX num_equipe ON equipe');
        $this->addSql('DROP INDEX S_NOM_FK ON equipe');
        $this->addSql('ALTER TABLE equipe ADD service_id INT DEFAULT NULL, DROP Service_nom, CHANGE nbre_emp nbre_emp INT NOT NULL');
        $this->addSql('ALTER TABLE equipe ADD CONSTRAINT FK_2449BA15ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('CREATE INDEX IDX_2449BA15ED5CA9E6 ON equipe (service_id)');
        $this->addSql('ALTER TABLE tache CHANGE emp_id emp_id INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA15ED5CA9E6');
        $this->addSql('DROP INDEX IDX_2449BA15ED5CA9E6 ON equipe');
        $this->addSql('ALTER TABLE equipe ADD Service_nom VARCHAR(255) DEFAULT \'AUCUN\' NOT NULL, DROP service_id, CHANGE nbre_emp nbre_emp INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE equipe ADD CONSTRAINT S_NOM_FK FOREIGN KEY (Service_nom) REFERENCES service (nomService)');
        $this->addSql('CREATE UNIQUE INDEX num_equipe ON equipe (num_equipe)');
        $this->addSql('CREATE INDEX S_NOM_FK ON equipe (Service_nom)');
        $this->addSql('ALTER TABLE tache CHANGE emp_id emp_id INT NOT NULL');
    }
}
