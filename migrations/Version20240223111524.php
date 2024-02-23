<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240223111524 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA746D642E4');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FC4B56C08');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D479F37AE5');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D446D642E4');
    }
}
