<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230428113340 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Timestampable';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE geo_coordinates ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE geo_coordinates ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE house ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE house ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE house ALTER name SET NOT NULL');
        $this->addSql('ALTER TABLE postal_address ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE postal_address ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE house DROP created_at');
        $this->addSql('ALTER TABLE house DROP updated_at');
        $this->addSql('ALTER TABLE house ALTER name DROP NOT NULL');
        $this->addSql('ALTER TABLE postal_address DROP created_at');
        $this->addSql('ALTER TABLE postal_address DROP updated_at');
        $this->addSql('ALTER TABLE geo_coordinates DROP created_at');
        $this->addSql('ALTER TABLE geo_coordinates DROP updated_at');
    }
}
