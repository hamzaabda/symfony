<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220411084802 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tache DROP FOREIGN KEY ID_EMP_FK');
        $this->addSql('DROP INDEX ID_EMP_FK ON tache');
        $this->addSql('ALTER TABLE tache CHANGE emp_id employee_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT FK_938720758C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id)');
        $this->addSql('CREATE INDEX IDX_938720758C03F15C ON tache (employee_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tache DROP FOREIGN KEY FK_938720758C03F15C');
        $this->addSql('DROP INDEX IDX_938720758C03F15C ON tache');
        $this->addSql('ALTER TABLE tache CHANGE employee_id emp_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT ID_EMP_FK FOREIGN KEY (emp_id) REFERENCES employee (id)');
        $this->addSql('CREATE INDEX ID_EMP_FK ON tache (emp_id)');
    }
}
