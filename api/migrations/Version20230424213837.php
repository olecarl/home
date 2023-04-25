<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230424213837 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'House';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(
            'CREATE TABLE geo_coordinates (id UUID NOT NULL, name TEXT DEFAULT NULL, latitude TEXT DEFAULT NULL, longitude TEXT DEFAULT NULL, PRIMARY KEY(id))'
        );
        $this->addSql('COMMENT ON COLUMN geo_coordinates.id IS \'(DC2Type:ulid)\'');
        $this->addSql(
            'CREATE TABLE house (id UUID NOT NULL, address_id UUID DEFAULT NULL, geo_id UUID DEFAULT NULL, name TEXT DEFAULT NULL, PRIMARY KEY(id))'
        );
        $this->addSql('CREATE UNIQUE INDEX UNIQ_67D5399DF5B7AF75 ON house (address_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_67D5399DFA49D0B ON house (geo_id)');
        $this->addSql('COMMENT ON COLUMN house.id IS \'(DC2Type:ulid)\'');
        $this->addSql('COMMENT ON COLUMN house.address_id IS \'(DC2Type:ulid)\'');
        $this->addSql('COMMENT ON COLUMN house.geo_id IS \'(DC2Type:ulid)\'');
        $this->addSql(
            'CREATE TABLE postal_address (id UUID NOT NULL, name TEXT DEFAULT NULL, address_country TEXT DEFAULT NULL, address_locality TEXT DEFAULT NULL, address_region TEXT DEFAULT NULL, postal_code TEXT DEFAULT NULL, street_address TEXT DEFAULT NULL, PRIMARY KEY(id))'
        );
        $this->addSql('COMMENT ON COLUMN postal_address.id IS \'(DC2Type:ulid)\'');
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
        $this->addSql('ALTER TABLE house DROP CONSTRAINT FK_67D5399DF5B7AF75');
        $this->addSql('ALTER TABLE house DROP CONSTRAINT FK_67D5399DFA49D0B');
        $this->addSql('DROP TABLE geo_coordinates');
        $this->addSql('DROP TABLE house');
        $this->addSql('DROP TABLE postal_address');
    }
}
