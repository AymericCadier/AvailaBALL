<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240225122330 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user CHANGE lname lname LONGTEXT DEFAULT NULL, CHANGE fname fname LONGTEXT DEFAULT NULL, CHANGE username username LONGTEXT DEFAULT NULL, CHANGE email email LONGTEXT DEFAULT NULL, CHANGE password password LONGTEXT DEFAULT NULL, CHANGE created_at created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE deleted_at deleted_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA746D642E4');
        $this->addSql('ALTER TABLE user CHANGE lname lname VARCHAR(255) DEFAULT NULL, CHANGE fname fname VARCHAR(255) DEFAULT NULL, CHANGE username username VARCHAR(25) DEFAULT NULL, CHANGE email email VARCHAR(255) DEFAULT NULL, CHANGE password password VARCHAR(255) DEFAULT NULL, CHANGE created_at created_at DATETIME DEFAULT NULL, CHANGE deleted_at deleted_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D479F37AE5');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D446D642E4');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FC4B56C08');
    }
}
