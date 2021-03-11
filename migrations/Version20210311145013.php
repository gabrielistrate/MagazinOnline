<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210311145013 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product ADD order_list_id INT DEFAULT NULL, CHANGE news_id news_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADCBD4BFC0 FOREIGN KEY (order_list_id) REFERENCES order_list (id)');
        $this->addSql('CREATE INDEX IDX_D34A04ADCBD4BFC0 ON product (order_list_id)');
        $this->addSql('ALTER TABLE user CHANGE age age INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADCBD4BFC0');
        $this->addSql('DROP INDEX IDX_D34A04ADCBD4BFC0 ON product');
        $this->addSql('ALTER TABLE product DROP order_list_id, CHANGE news_id news_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE age age INT DEFAULT NULL');
    }
}