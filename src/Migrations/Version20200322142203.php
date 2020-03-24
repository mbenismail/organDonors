<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200322142203 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE appointement CHANGE hospital_id hospital_id INT DEFAULT NULL, CHANGE patient_id patient_id INT DEFAULT NULL, CHANGE donor_id donor_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE doctor_request CHANGE donor_id donor_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE medicine_request CHANGE donor_id donor_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE patient CHANGE hospital_id hospital_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE hospital_id hospital_id INT DEFAULT NULL, CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE matching_test ADD donor_id INT DEFAULT NULL, CHANGE patient_id patient_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE matching_test ADD CONSTRAINT FK_24682BBB3DD7B7A7 FOREIGN KEY (donor_id) REFERENCES donor (id)');
        $this->addSql('CREATE INDEX IDX_24682BBB3DD7B7A7 ON matching_test (donor_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE appointement CHANGE hospital_id hospital_id INT DEFAULT NULL, CHANGE patient_id patient_id INT DEFAULT NULL, CHANGE donor_id donor_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE doctor_request CHANGE donor_id donor_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE matching_test DROP FOREIGN KEY FK_24682BBB3DD7B7A7');
        $this->addSql('DROP INDEX IDX_24682BBB3DD7B7A7 ON matching_test');
        $this->addSql('ALTER TABLE matching_test DROP donor_id, CHANGE patient_id patient_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE medicine_request CHANGE donor_id donor_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE patient CHANGE hospital_id hospital_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE hospital_id hospital_id INT DEFAULT NULL, CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
