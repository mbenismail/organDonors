<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200318144720 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE donor ADD emailcode VARCHAR(255) NOT NULL, ADD verified TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE appointement CHANGE hospital_id hospital_id INT DEFAULT NULL, CHANGE patient_id patient_id INT DEFAULT NULL, CHANGE donor_id donor_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE patient CHANGE hospital_id hospital_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE hospital_id hospital_id INT DEFAULT NULL, CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE matching_test CHANGE patient_id patient_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE appointement CHANGE hospital_id hospital_id INT DEFAULT NULL, CHANGE patient_id patient_id INT DEFAULT NULL, CHANGE donor_id donor_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE donor DROP emailcode, DROP verified');
        $this->addSql('ALTER TABLE matching_test CHANGE patient_id patient_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE patient CHANGE hospital_id hospital_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE hospital_id hospital_id INT DEFAULT NULL, CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
