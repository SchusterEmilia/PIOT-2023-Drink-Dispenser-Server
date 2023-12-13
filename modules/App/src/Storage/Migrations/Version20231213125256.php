<?php

declare(strict_types=1);

namespace App\Storage\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231213125256 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Creates Ingredients Table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(
            <<<'SQL'
                CREATE TABLE ingredients (
                    id INT NOT NULL,
                    name VARCHAR(255) NOT NULL,
                    description TEXT NOT NULL,
                    PRIMARY KEY(id)
                                         ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
                SQL
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE ingredients');
    }
}
