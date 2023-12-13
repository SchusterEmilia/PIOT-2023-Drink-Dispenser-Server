<?php

declare(strict_types=1);

namespace App\Storage\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231211151934 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Creates Action Table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(
            <<<'SQL'
                CREATE TABLE actions (
                    id INT AUTO_INCREMENT NOT NULL,
                    uid VARCHAR(64) NOT NULL,
                    date DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)',
                    successful TINYINT(1) NOT NULL,
                    UNIQUE INDEX UNIQ_548F1EF539B0606 (uid),
                    PRIMARY KEY(id)
                                     ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;
                SQL
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE actions');
    }
}
