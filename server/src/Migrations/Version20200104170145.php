<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200104170145 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be execution safely with \'PostgreSql\' ');
        $this->addSql("UPDATE game_elements SET width=4, height=4 WHERE game_elements.name='Church'");
        $this->addSql("ALTER TABLE public.class ADD COLUMN walk INTEGER DEFAULT 1");
        $this->addSql("UPDATE class SET health=2 WHERE class.name LIKE 'Pig';");
        $this->addSql("UPDATE class SET health=4 WHERE class.name LIKE 'Skeleton';");
        $this->addSql("UPDATE class SET health=3, strength=2 WHERE class.name LIKE 'Troll';");

    }

    public function down(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be execution safely with \'PostgreSql\' ');
        // this down() migration is auto-generated, please modify it to your needs

    }
}
