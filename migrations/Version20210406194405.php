<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210406194405 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE annonces (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, is_premium TINYINT(1) NOT NULL, date_debut DATE NOT NULL, date_fin DATE DEFAULT NULL, prix DOUBLE PRECISION DEFAULT NULL, description LONGTEXT DEFAULT NULL, titre LONGTEXT NOT NULL, INDEX IDX_CB988C6FA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories_categories (categories_source INT NOT NULL, categories_target INT NOT NULL, INDEX IDX_9B7D066057E3414B (categories_source), INDEX IDX_9B7D06604E0611C4 (categories_target), PRIMARY KEY(categories_source, categories_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories_annonces (categories_id INT NOT NULL, annonces_id INT NOT NULL, INDEX IDX_1D662556A21214B7 (categories_id), INDEX IDX_1D6625564C2885D7 (annonces_id), PRIMARY KEY(categories_id, annonces_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commandes (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, prix DOUBLE PRECISION NOT NULL, date DATE NOT NULL, contenu LONGTEXT DEFAULT NULL, titre VARCHAR(500) DEFAULT NULL, INDEX IDX_35D4282CA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medias (id INT AUTO_INCREMENT NOT NULL, annonce_id INT NOT NULL, type VARCHAR(100) NOT NULL, duree INT DEFAULT NULL, chemin LONGTEXT NOT NULL, INDEX IDX_12D2AF818805AB2F (annonce_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, telephone VARCHAR(100) DEFAULT NULL, cp INT DEFAULT NULL, adresse LONGTEXT DEFAULT NULL, ville VARCHAR(500) DEFAULT NULL, pays VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE annonces ADD CONSTRAINT FK_CB988C6FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE categories_categories ADD CONSTRAINT FK_9B7D066057E3414B FOREIGN KEY (categories_source) REFERENCES categories (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categories_categories ADD CONSTRAINT FK_9B7D06604E0611C4 FOREIGN KEY (categories_target) REFERENCES categories (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categories_annonces ADD CONSTRAINT FK_1D662556A21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categories_annonces ADD CONSTRAINT FK_1D6625564C2885D7 FOREIGN KEY (annonces_id) REFERENCES annonces (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE medias ADD CONSTRAINT FK_12D2AF818805AB2F FOREIGN KEY (annonce_id) REFERENCES annonces (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categories_annonces DROP FOREIGN KEY FK_1D6625564C2885D7');
        $this->addSql('ALTER TABLE medias DROP FOREIGN KEY FK_12D2AF818805AB2F');
        $this->addSql('ALTER TABLE categories_categories DROP FOREIGN KEY FK_9B7D066057E3414B');
        $this->addSql('ALTER TABLE categories_categories DROP FOREIGN KEY FK_9B7D06604E0611C4');
        $this->addSql('ALTER TABLE categories_annonces DROP FOREIGN KEY FK_1D662556A21214B7');
        $this->addSql('ALTER TABLE annonces DROP FOREIGN KEY FK_CB988C6FA76ED395');
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY FK_35D4282CA76ED395');
        $this->addSql('DROP TABLE annonces');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE categories_categories');
        $this->addSql('DROP TABLE categories_annonces');
        $this->addSql('DROP TABLE commandes');
        $this->addSql('DROP TABLE medias');
        $this->addSql('DROP TABLE user');
    }
}
