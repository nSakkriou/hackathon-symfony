<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240701130746 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE action_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, points INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE file (id INT AUTO_INCREMENT NOT NULL, profile_id INT NOT NULL, name VARCHAR(255) NOT NULL, path VARCHAR(255) NOT NULL, INDEX IDX_8C9F3610CCFA12B8 (profile_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pop_up_message (id INT AUTO_INCREMENT NOT NULL, message_text VARCHAR(255) NOT NULL, started_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ended_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profile (id INT AUTO_INCREMENT NOT NULL, coopted_by_id INT NOT NULL, status_id INT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, phone VARCHAR(10) DEFAULT NULL, email VARCHAR(255) NOT NULL, acquaintance_pro TINYINT(1) NOT NULL, linkedin VARCHAR(255) DEFAULT NULL, INDEX IDX_8157AA0F84EDDC6 (coopted_by_id), INDEX IDX_8157AA0F6BF700BD (status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profile_action (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, profile_id INT NOT NULL, action_type_id INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_2FE6EBF59D86650F (user_id_id), INDEX IDX_2FE6EBF5CCFA12B8 (profile_id), INDEX IDX_2FE6EBF51FEE0472 (action_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profile_status (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, team_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, phone VARCHAR(10) DEFAULT NULL, INDEX IDX_8D93D649296CD8AE (team_id), UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE file ADD CONSTRAINT FK_8C9F3610CCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id)');
        $this->addSql('ALTER TABLE profile ADD CONSTRAINT FK_8157AA0F84EDDC6 FOREIGN KEY (coopted_by_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE profile ADD CONSTRAINT FK_8157AA0F6BF700BD FOREIGN KEY (status_id) REFERENCES profile_status (id)');
        $this->addSql('ALTER TABLE profile_action ADD CONSTRAINT FK_2FE6EBF59D86650F FOREIGN KEY (user_id_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE profile_action ADD CONSTRAINT FK_2FE6EBF5CCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id)');
        $this->addSql('ALTER TABLE profile_action ADD CONSTRAINT FK_2FE6EBF51FEE0472 FOREIGN KEY (action_type_id) REFERENCES action_type (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D649296CD8AE FOREIGN KEY (team_id) REFERENCES team (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE file DROP FOREIGN KEY FK_8C9F3610CCFA12B8');
        $this->addSql('ALTER TABLE profile DROP FOREIGN KEY FK_8157AA0F84EDDC6');
        $this->addSql('ALTER TABLE profile DROP FOREIGN KEY FK_8157AA0F6BF700BD');
        $this->addSql('ALTER TABLE profile_action DROP FOREIGN KEY FK_2FE6EBF59D86650F');
        $this->addSql('ALTER TABLE profile_action DROP FOREIGN KEY FK_2FE6EBF5CCFA12B8');
        $this->addSql('ALTER TABLE profile_action DROP FOREIGN KEY FK_2FE6EBF51FEE0472');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649296CD8AE');
        $this->addSql('DROP TABLE action_type');
        $this->addSql('DROP TABLE file');
        $this->addSql('DROP TABLE pop_up_message');
        $this->addSql('DROP TABLE profile');
        $this->addSql('DROP TABLE profile_action');
        $this->addSql('DROP TABLE profile_status');
        $this->addSql('DROP TABLE team');
        $this->addSql('DROP TABLE `user`');
    }
}
