<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200301194342 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE matching_test CHANGE patient_id patient_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE patient CHANGE hospital_id hospital_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD hospital_id INT DEFAULT NULL, CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64963DBB69 FOREIGN KEY (hospital_id) REFERENCES hospital (id)');
        $this->addSql('CREATE INDEX IDX_8D93D64963DBB69 ON user (hospital_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE matching_test CHANGE patient_id patient_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE patient CHANGE hospital_id hospital_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64963DBB69');
        $this->addSql('DROP INDEX IDX_8D93D64963DBB69 ON user');
        $this->addSql('ALTER TABLE user DROP hospital_id, CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
