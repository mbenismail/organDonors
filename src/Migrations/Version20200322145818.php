<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200322145818 extends AbstractMigration
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
        $this->addSql('ALTER TABLE matching_test DROP data_test, DROP analysis_time, DROP test_result, CHANGE patient_id patient_id INT DEFAULT NULL, CHANGE donor_id donor_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE medicine_request CHANGE donor_id donor_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE patient CHANGE hospital_id hospital_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE hospital_id hospital_id INT DEFAULT NULL, CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE appointement CHANGE hospital_id hospital_id INT DEFAULT NULL, CHANGE patient_id patient_id INT DEFAULT NULL, CHANGE donor_id donor_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE doctor_request CHANGE donor_id donor_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE matching_test ADD data_test VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD analysis_time DATETIME NOT NULL, ADD test_result VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE patient_id patient_id INT DEFAULT NULL, CHANGE donor_id donor_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE medicine_request CHANGE donor_id donor_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE patient CHANGE hospital_id hospital_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE hospital_id hospital_id INT DEFAULT NULL, CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
