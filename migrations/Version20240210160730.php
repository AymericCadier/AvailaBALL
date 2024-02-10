<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240210160730 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP INDEX id_playground ON event');
        $this->addSql('ALTER TABLE event CHANGE name name LONGTEXT DEFAULT NULL, CHANGE duration duration LONGTEXT DEFAULT NULL, CHANGE type type LONGTEXT DEFAULT NULL, CHANGE id_playground id_playground_id INT DEFAULT NULL');
        $this->addSql('CREATE INDEX IDX_3BAE0AA746D642E4 ON event (id_playground_id)');
        $this->addSql('DROP INDEX id_session ON message');
        $this->addSql('ALTER TABLE message ADD id_session_id INT NOT NULL, DROP id_session, CHANGE body body LONGTEXT DEFAULT NULL');
        $this->addSql('CREATE INDEX IDX_B6BD307FC4B56C08 ON message (id_session_id)');
        $this->addSql('DROP INDEX id_user ON session');
        $this->addSql('DROP INDEX id_playground ON session');
        $this->addSql('ALTER TABLE session ADD id_user_id INT NOT NULL, ADD id_playground_id INT NOT NULL, DROP id_user, DROP id_playground');
        $this->addSql('CREATE INDEX IDX_D044D5D479F37AE5 ON session (id_user_id)');
        $this->addSql('CREATE INDEX IDX_D044D5D446D642E4 ON session (id_playground_id)');
        $this->addSql('ALTER TABLE user CHANGE lname lname LONGTEXT DEFAULT NULL, CHANGE fname fname LONGTEXT DEFAULT NULL, CHANGE username username LONGTEXT DEFAULT NULL, CHANGE email email LONGTEXT DEFAULT NULL, CHANGE password password LONGTEXT DEFAULT NULL, CHANGE created_at created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE deleted_at deleted_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA746D642E4');
        $this->addSql('DROP INDEX IDX_3BAE0AA746D642E4 ON event');
        $this->addSql('ALTER TABLE event CHANGE name name VARCHAR(255) DEFAULT NULL, CHANGE duration duration VARCHAR(255) DEFAULT NULL, CHANGE type type VARCHAR(255) DEFAULT NULL, CHANGE id_playground_id id_playground INT DEFAULT NULL');
        $this->addSql('CREATE INDEX id_playground ON event (id_playground)');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FC4B56C08');
        $this->addSql('DROP INDEX IDX_B6BD307FC4B56C08 ON message');
        $this->addSql('ALTER TABLE message ADD id_session INT DEFAULT NULL, DROP id_session_id, CHANGE body body TEXT DEFAULT NULL');
        $this->addSql('CREATE INDEX id_session ON message (id_session)');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D479F37AE5');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D446D642E4');
        $this->addSql('DROP INDEX IDX_D044D5D479F37AE5 ON session');
        $this->addSql('DROP INDEX IDX_D044D5D446D642E4 ON session');
        $this->addSql('ALTER TABLE session ADD id_user INT DEFAULT NULL, ADD id_playground INT DEFAULT NULL, DROP id_user_id, DROP id_playground_id');
        $this->addSql('CREATE INDEX id_user ON session (id_user)');
        $this->addSql('CREATE INDEX id_playground ON session (id_playground)');
        $this->addSql('ALTER TABLE user CHANGE lname lname VARCHAR(255) DEFAULT NULL, CHANGE fname fname VARCHAR(255) DEFAULT NULL, CHANGE username username VARCHAR(25) DEFAULT NULL, CHANGE email email VARCHAR(255) DEFAULT NULL, CHANGE password password VARCHAR(255) DEFAULT NULL, CHANGE created_at created_at DATETIME DEFAULT NULL, CHANGE deleted_at deleted_at DATETIME DEFAULT NULL');
    }
}
