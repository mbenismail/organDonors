<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200320133626 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE doctor_request (id INT AUTO_INCREMENT NOT NULL, question_text VARCHAR(255) NOT NULL, question_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE doctor_request_donor (doctor_request_id INT NOT NULL, donor_id INT NOT NULL, INDEX IDX_B1A1346E75699134 (doctor_request_id), INDEX IDX_B1A1346E3DD7B7A7 (donor_id), PRIMARY KEY(doctor_request_id, donor_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medicine_request (id INT AUTO_INCREMENT NOT NULL, request_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medicine_request_donor (medicine_request_id INT NOT NULL, donor_id INT NOT NULL, INDEX IDX_A174A1731ED7F277 (medicine_request_id), INDEX IDX_A174A1733DD7B7A7 (donor_id), PRIMARY KEY(medicine_request_id, donor_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE doctor_request_donor ADD CONSTRAINT FK_B1A1346E75699134 FOREIGN KEY (doctor_request_id) REFERENCES doctor_request (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE doctor_request_donor ADD CONSTRAINT FK_B1A1346E3DD7B7A7 FOREIGN KEY (donor_id) REFERENCES donor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE medicine_request_donor ADD CONSTRAINT FK_A174A1731ED7F277 FOREIGN KEY (medicine_request_id) REFERENCES medicine_request (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE medicine_request_donor ADD CONSTRAINT FK_A174A1733DD7B7A7 FOREIGN KEY (donor_id) REFERENCES donor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE appointement CHANGE hospital_id hospital_id INT DEFAULT NULL, CHANGE patient_id patient_id INT DEFAULT NULL, CHANGE donor_id donor_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE patient CHANGE hospital_id hospital_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE hospital_id hospital_id INT DEFAULT NULL, CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE matching_test CHANGE patient_id patient_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE doctor_request_donor DROP FOREIGN KEY FK_B1A1346E75699134');
        $this->addSql('ALTER TABLE medicine_request_donor DROP FOREIGN KEY FK_A174A1731ED7F277');
        $this->addSql('DROP TABLE doctor_request');
        $this->addSql('DROP TABLE doctor_request_donor');
        $this->addSql('DROP TABLE medicine_request');
        $this->addSql('DROP TABLE medicine_request_donor');
        $this->addSql('ALTER TABLE appointement CHANGE hospital_id hospital_id INT DEFAULT NULL, CHANGE patient_id patient_id INT DEFAULT NULL, CHANGE donor_id donor_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE matching_test CHANGE patient_id patient_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE patient CHANGE hospital_id hospital_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE hospital_id hospital_id INT DEFAULT NULL, CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
