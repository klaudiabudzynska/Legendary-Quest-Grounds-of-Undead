<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191227143016 extends AbstractMigration
{

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');
        $this->addSql("CREATE TABLE users (
            id serial PRIMARY KEY,
            username text NOT NULL,
            class_id INTEGER DEFAULT 1 NOT NULL,
            type INTEGER DEFAULT 0 NOT NULL ,
            strength INTEGER DEFAULT 0 NOT NULL,
            health INTEGER DEFAULT 0 NOT NULL,
            mana INTEGER DEFAULT 0 NOT NULL,
            lucky INTEGER DEFAULT 0 NOT NULL,
            move BOOLEAN DEFAULT false NOT NULL,
            token varchar (64) DEFAULT '' NOT NULL
        );");
        $this->addSql("CREATE TABLE mobs (
            id serial PRIMARY KEY,
            name text NOT NULL,
            description text NOT NULL,
            class_id INTEGER DEFAULT 1 NOT NULL,
            strength INTEGER DEFAULT 0 NOT NULL,
            health INTEGER DEFAULT 0 NOT NULL,
            mana INTEGER DEFAULT 0 NOT NULL,
            move BOOLEAN DEFAULT false NOT NULL
        );");
        $this->addSql('CREATE TABLE class (
            id serial PRIMARY KEY,
            name text  NOT NULL,
            description text NOT NULL,
            strength INTEGER DEFAULT 0 NOT NULL,
            health INTEGER DEFAULT 0 NOT NULL,
            mana INTEGER DEFAULT 0 NOT NULL,
            lucky INTEGER DEFAULT 0 NOT NULL
            );');

        $this->addSql("CREATE TABLE items (
            id serial PRIMARY KEY,
            name text NOT NULL,
            description text NOT NULL,
            strength INTEGER DEFAULT 0 NOT NULL,
            health INTEGER DEFAULT 0 NOT NULL,
            mana INTEGER DEFAULT 0 NOT NULL,
            lucky INTEGER DEFAULT 0 NOT NULL
        );");
        $this->addSql("CREATE TABLE board (
            id serial PRIMARY KEY,
            name text NOT NULL,
            json text NOT NULL
        );");
        $this->addSql("CREATE TABLE game_elements (
            id serial PRIMARY KEY,
            name text NOT NULL,
            description text NOT NULL,
            weight INTEGER DEFAULT 0 NOT NULL,           
            can_move BOOLEAN DEFAULT true NOT NULL           
        );");
        $this->addSql("CREATE TABLE inventory (
            id serial PRIMARY KEY,
            user_id INTEGER NOT NULL,
            is_active BOOLEAN DEFAULT true NOT NULL
        );");
        $this->addSql("CREATE TABLE actions (
            id serial PRIMARY KEY,
            item INTEGER,
            position TEXT,
            description TEXT,
            attack_mob_id INTEGER
        );");
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');
        $this->addSql("DROP TABLE actions;");
        $this->addSql("DROP TABLE inventory;");
        $this->addSql("DROP TABLE game_elements;");
        $this->addSql("DROP TABLE board;");
        $this->addSql("DROP TABLE items;");
        $this->addSql("DROP TABLE class;");
        $this->addSql("DROP TABLE mobs;");
        $this->addSql("DROP TABLE users;");
    }
}
