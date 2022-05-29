<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220528183537 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, tissus_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prix NUMERIC(5, 2) NOT NULL, description LONGTEXT NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_23A0E6656CF4D1 (tissus_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E6656CF4D1 FOREIGN KEY (tissus_id) REFERENCES tissus (id)');
        $this->addSql('DROP TABLE articles');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE articles (id INT AUTO_INCREMENT NOT NULL, tissus_id INT DEFAULT NULL, nom VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, prix NUMERIC(5, 2) NOT NULL, description LONGTEXT CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_BFDD316856CF4D1 (tissus_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD316856CF4D1 FOREIGN KEY (tissus_id) REFERENCES tissus (id)');
        $this->addSql('DROP TABLE article');
    }
}
