<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200121135227 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be execution safely with \'PostgreSql\' ');
        $this->addSql("ALTER TABLE public.users ADD COLUMN owner_id INTEGER DEFAULT 0;");
        $this->addSql("ALTER TABLE public.users ADD COLUMN is_active BOOLEAN DEFAULT false;");
        $this->addSql("DELETE FROM public.users");
        $this->addSql("INSERT INTO public.users (id, username, class_id, type, strength, health, mana, lucky, move, token, owner_id) VALUES 
                            (1, 'Hero', 0, 0, 0, 0, 0, 0, false, '', 0), 
                            (2, 'DarkMaster', 0, 0, 0, 0, 0, 0, false, '', 0),
                            (3, 'Human', 2, 0, 2, 4, 1, 6,false,'',1),
                            (4, 'Pig', 4, 0, 0, 2, 0, 0,false,'',2),
                            (5, 'Skeleton', 5, 0, 1, 4, 0, 0,false,'',2),
                            (6, 'Troll', 6, 0, 2, 3, 0, 0,false,'',2);");
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be execution safely with \'PostgreSql\' ');
    }
}
