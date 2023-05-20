<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230513071647 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'House';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(
            'CREATE TABLE address (id UUID NOT NULL, street_name VARCHAR(255) NOT NULL, street_number VARCHAR(8) DEFAULT NULL, postal_code VARCHAR(5) NOT NULL, locality VARCHAR(255) NOT NULL, sub_locality VARCHAR(255) DEFAULT NULL, country VARCHAR(255) NOT NULL, country_code VARCHAR(2) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))'
        );
        $this->addSql('COMMENT ON COLUMN address.id IS \'(DC2Type:uuid)\'');
        $this->addSql(
            'CREATE TABLE coordinates (id UUID NOT NULL, latitude TEXT DEFAULT NULL, longitude TEXT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))'
        );
        $this->addSql('COMMENT ON COLUMN coordinates.id IS \'(DC2Type:uuid)\'');
        $this->addSql(
            'CREATE TABLE house (id UUID NOT NULL, address_id UUID DEFAULT NULL, geo_id UUID DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))'
        );
        $this->addSql('CREATE UNIQUE INDEX UNIQ_67D5399DF5B7AF75 ON house (address_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_67D5399DFA49D0B ON house (geo_id)');
        $this->addSql('COMMENT ON COLUMN house.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN house.address_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN house.geo_id IS \'(DC2Type:uuid)\'');
        $this->addSql(
            'ALTER TABLE house ADD CONSTRAINT FK_67D5399DF5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id) NOT DEFERRABLE INITIALLY IMMEDIATE'
        );
        $this->addSql(
            'ALTER TABLE house ADD CONSTRAINT FK_67D5399DFA49D0B FOREIGN KEY (geo_id) REFERENCES coordinates (id) NOT DEFERRABLE INITIALLY IMMEDIATE'
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE house DROP CONSTRAINT FK_67D5399DF5B7AF75');
        $this->addSql('ALTER TABLE house DROP CONSTRAINT FK_67D5399DFA49D0B');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE coordinates');
        $this->addSql('DROP TABLE house');
    }
}
