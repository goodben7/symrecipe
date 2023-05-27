<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230525213527 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cote_l1_genie (id INT AUTO_INCREMENT NOT NULL, etudiant_id INT NOT NULL, tp1 VARCHAR(255) NOT NULL, tp2 VARCHAR(255) NOT NULL, interro1 VARCHAR(255) NOT NULL, interro2 VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_AA99CDC6DDEAB1A3 (etudiant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etudiant_l1_genie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, postnom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, sexe VARCHAR(1) NOT NULL, code VARCHAR(8) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cote_l1_genie ADD CONSTRAINT FK_AA99CDC6DDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES etudiant_l1_genie (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cote_l1_genie DROP FOREIGN KEY FK_AA99CDC6DDEAB1A3');
        $this->addSql('DROP TABLE cote_l1_genie');
        $this->addSql('DROP TABLE etudiant_l1_genie');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
