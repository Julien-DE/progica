<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230111143745 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE equipment_ext (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipment_int (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gite (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, animals_allowed TINYINT(1) DEFAULT NULL, price_animals DOUBLE PRECISION DEFAULT NULL, adresse VARCHAR(255) NOT NULL, postal_code VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, departement VARCHAR(255) NOT NULL, region VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gite_equipment_int (gite_id INT NOT NULL, equipment_int_id INT NOT NULL, INDEX IDX_5279F165652CAE9B (gite_id), INDEX IDX_5279F16562E862B4 (equipment_int_id), PRIMARY KEY(gite_id, equipment_int_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gite_equipment_ext (gite_id INT NOT NULL, equipment_ext_id INT NOT NULL, INDEX IDX_47FBBDD6652CAE9B (gite_id), INDEX IDX_47FBBDD6FA8AC0ED (equipment_ext_id), PRIMARY KEY(gite_id, equipment_ext_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE gite_equipment_int ADD CONSTRAINT FK_5279F165652CAE9B FOREIGN KEY (gite_id) REFERENCES gite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gite_equipment_int ADD CONSTRAINT FK_5279F16562E862B4 FOREIGN KEY (equipment_int_id) REFERENCES equipment_int (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gite_equipment_ext ADD CONSTRAINT FK_47FBBDD6652CAE9B FOREIGN KEY (gite_id) REFERENCES gite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gite_equipment_ext ADD CONSTRAINT FK_47FBBDD6FA8AC0ED FOREIGN KEY (equipment_ext_id) REFERENCES equipment_ext (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gite_equipment_int DROP FOREIGN KEY FK_5279F165652CAE9B');
        $this->addSql('ALTER TABLE gite_equipment_int DROP FOREIGN KEY FK_5279F16562E862B4');
        $this->addSql('ALTER TABLE gite_equipment_ext DROP FOREIGN KEY FK_47FBBDD6652CAE9B');
        $this->addSql('ALTER TABLE gite_equipment_ext DROP FOREIGN KEY FK_47FBBDD6FA8AC0ED');
        $this->addSql('DROP TABLE equipment_ext');
        $this->addSql('DROP TABLE equipment_int');
        $this->addSql('DROP TABLE gite');
        $this->addSql('DROP TABLE gite_equipment_int');
        $this->addSql('DROP TABLE gite_equipment_ext');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
