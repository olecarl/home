<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230424134308 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'House';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE geo_coordinates_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE postal_address_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql(
            'CREATE TABLE geo_coordinates (id INT NOT NULL, latitude TEXT DEFAULT NULL, longitude TEXT DEFAULT NULL, PRIMARY KEY(id))'
        );
        $this->addSql(
            'CREATE TABLE house (id UUID NOT NULL, address_id INT DEFAULT NULL, geo_id INT DEFAULT NULL, name TEXT DEFAULT NULL, PRIMARY KEY(id))'
        );
        $this->addSql('CREATE UNIQUE INDEX UNIQ_67D5399DF5B7AF75 ON house (address_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_67D5399DFA49D0B ON house (geo_id)');
        $this->addSql('COMMENT ON COLUMN house.id IS \'(DC2Type:ulid)\'');
        $this->addSql(
            'CREATE TABLE postal_address (id INT NOT NULL, address_country TEXT DEFAULT NULL, address_locality TEXT DEFAULT NULL, address_region TEXT DEFAULT NULL, postal_code TEXT DEFAULT NULL, street_address TEXT DEFAULT NULL, PRIMARY KEY(id))'
        );
        $this->addSql(
            'ALTER TABLE house ADD CONSTRAINT FK_67D5399DF5B7AF75 FOREIGN KEY (address_id) REFERENCES postal_address (id) NOT DEFERRABLE INITIALLY IMMEDIATE'
        );
        $this->addSql(
            'ALTER TABLE house ADD CONSTRAINT FK_67D5399DFA49D0B FOREIGN KEY (geo_id) REFERENCES geo_coordinates (id) NOT DEFERRABLE INITIALLY IMMEDIATE'
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE geo_coordinates_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE postal_address_id_seq CASCADE');
        $this->addSql('ALTER TABLE house DROP CONSTRAINT FK_67D5399DF5B7AF75');
        $this->addSql('ALTER TABLE house DROP CONSTRAINT FK_67D5399DFA49D0B');
        $this->addSql('DROP TABLE geo_coordinates');
        $this->addSql('DROP TABLE house');
        $this->addSql('DROP TABLE postal_address');
    }
}
