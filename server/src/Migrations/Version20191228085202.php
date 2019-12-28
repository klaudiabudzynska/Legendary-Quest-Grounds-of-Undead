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
        $this->addSql('ALTER TABLE game_elements ADD COLUMN height INTEGER DEFAULT 1 NOT NULL, ADD COLUMN width INTEGER DEFAULT 1;');
        $this->addSql("INSERT INTO game_elements (id, name, description, weight, can_move, height, width) VALUES 
                            (nextval('game_elements_id_seq'), 'K', 'Kościół', 0, false, 6, 6),
                            (nextval('game_elements_id_seq'), 'P', 'Płot', 0, false, 1, 3),
                            (nextval('game_elements_id_seq'), 'S', 'Słupek', 0, false, 1, 1),
                            (nextval('game_elements_id_seq'), 'B', 'Bagno', 3, true, 1, 1),
                            (nextval('game_elements_id_seq'), 'H', 'Ścieżka', 1, true, 1, 1),
                            (nextval('game_elements_id_seq'), 'G', 'Nagrobek', 0, false, 1, 1),
                            (nextval('game_elements_id_seq'), 'T', 'Drzewo', 0, false, 1, 1),
                            (nextval('game_elements_id_seq'), 'R', 'Pochodnia', 0, false, 1, 1),                                                                                         
                            (nextval('game_elements_id_seq'), 'Z', 'Krzak', 0, false, 2, 2),                                                                                         
                            (nextval('game_elements_id_seq'), 'C1', 'Skrzynia 1', 0, false, 1, 2),                                                                                         
                            (nextval('game_elements_id_seq'), 'C2', 'Skrzynia 2', 0, false, 1, 2),                                                                                         
                            (nextval('game_elements_id_seq'), 'O', 'Kamień', 2, true, 1, 1);                                                                                                    
                            ");
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be execution safely with \'PostgreSql\' ');
    }
}
