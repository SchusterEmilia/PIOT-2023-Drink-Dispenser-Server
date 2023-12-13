<?php

declare(strict_types=1);

namespace App\Storage\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231213130920 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Creates preference Table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(
            <<<'SQL'
                CREATE TABLE preferences (
                    uid VARCHAR(64) NOT NULL,
                    PRIMARY KEY(uid)
                                         ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
                SQL
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE preferences');
    }
}
