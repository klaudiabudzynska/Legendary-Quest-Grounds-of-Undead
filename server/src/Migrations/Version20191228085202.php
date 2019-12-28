<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191228085202 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be execution safely with \'PostgreSql\' ');
        $this->addSql("INSERT INTO class (id, name, description, strength, health, mana, lucky) VALUES 
                        (nextval('class_id_seq'), 'Elf', 'desc', 2 , 6, 4, 2),
                        (nextval('class_id_seq'), 'Human', 'desc', 2 , 4, 1, 6),
                        (nextval('class_id_seq'), 'Orc', 'desc', 4 , 4, 0, 1),
                        (nextval('class_id_seq'), 'Pig', 'desc', 0 , 8, 0, 0),
                        (nextval('class_id_seq'), 'Skeleton', 'desc', 1 , 3, 0, 0),
                        (nextval('class_id_seq'), 'Troll', 'desc', 4 , 5, 0, 0);
                        ");
        $this->addSql('ALTER TABLE game_elements ADD COLUMN height INTEGER DEFAULT 1 NOT NULL, ADD COLUMN width INTEGER DEFAULT 1, ADD COLUMN type INTEGER DEFAULT 1;');
        $this->addSql("INSERT INTO game_elements (id, name, description, weight, can_move, height, width, type) VALUES 
                            (nextval('game_elements_id_seq'), 'Kościół', 'Kościół', 1, false, 3, 6, 2),
                            (nextval('game_elements_id_seq'), 'Płot', 'Płot', 0, false, 1, 3, 1),
                            (nextval('game_elements_id_seq'), 'Słupek', 'Słupek', 0, false, 1, 1, 1),
                            (nextval('game_elements_id_seq'), 'Bagno', 'Bagno', 3, true, 1, 1, 0),
                            (nextval('game_elements_id_seq'), 'Ścieżka', 'Ścieżka', 1, true, 1, 1, 0),
                            (nextval('game_elements_id_seq'), 'Nagrobek', 'Nagrobek', 0, false, 1, 1, 1),
                            (nextval('game_elements_id_seq'), 'Drzewo', 'Drzewo', 0, false, 1, 1, 1),
                            (nextval('game_elements_id_seq'), 'Pochodnia', 'Pochodnia', 0, false, 1, 1, 1),                                                                                         
                            (nextval('game_elements_id_seq'), 'Krzak', 'Krzak', 0, false, 2, 2, 1),                                                                                         
                            (nextval('game_elements_id_seq'), 'Skrzynia1', 'Skrzynia 1', 0, false, 1, 2, 1),                                                                                         
                            (nextval('game_elements_id_seq'), 'Skrzynia2', 'Skrzynia 2', 0, false, 1, 2, 1),                                                                                         
                            (nextval('game_elements_id_seq'), 'Kamień', 'Kamień', 2, true, 1, 1, 1);                                                                                                    
                            ");
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be execution safely with \'PostgreSql\' ');
    }
}
