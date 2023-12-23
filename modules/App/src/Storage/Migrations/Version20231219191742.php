<?php

declare(strict_types=1);

namespace App\Storage\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231219191742 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Inserts Sample Ingredients';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(
            <<<'SQL'
                INSERT INTO ingredients (id, name, description) VALUES
                    (1, 'water', 'Plain Water'),
                    (11, 'wine-red', 'Red Wine'),
                    (12, 'wine-white', 'White Wine')
                SQL
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(
            <<<'SQL'
                DELETE FROM ingredients WHERE id = 1 or id = 11 or id = 12
                SQL
        );
    }
}
