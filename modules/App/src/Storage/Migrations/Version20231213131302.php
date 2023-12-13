<?php

declare(strict_types=1);

namespace App\Storage\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231213131302 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Creates Table between Preference and Ingredients';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(
            <<<'SQL'
                CREATE TABLE preferences2ingredients (
                    id INT AUTO_INCREMENT NOT NULL,
                    preference_uid VARCHAR(64) NOT NULL,
                    ingredient_id INT NOT NULL,
                    percentage INT NOT NULL,
                    INDEX IDX_7762F9EEA3F3BC07 (preference_uid),
                    INDEX IDX_7762F9EE933FE08C (ingredient_id),
                    PRIMARY KEY(id)
                        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
                SQL
        );
        $this->addSql(
            <<<'SQL'
                ALTER TABLE preferences2ingredients
                    ADD CONSTRAINT FK_7762F9EEA3F3BC07
                        FOREIGN KEY (preference_uid)
                        REFERENCES preferences (uid)
                        ON DELETE CASCADE
                SQL
        );
        $this->addSql(
            <<<'SQL'
                ALTER TABLE preferences2ingredients
                    ADD CONSTRAINT FK_7762F9EE933FE08C 
                        FOREIGN KEY (ingredient_id) 
                        REFERENCES ingredients (id)
                SQL
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE preferences2ingredients DROP FOREIGN KEY FK_7762F9EEA3F3BC07');
        $this->addSql('ALTER TABLE preferences2ingredients DROP FOREIGN KEY FK_7762F9EE933FE08C');
        $this->addSql('DROP TABLE preferences2ingredients');
    }
}
