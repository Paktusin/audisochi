<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180502160515 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, part_id INT DEFAULT NULL, ticket_id INT DEFAULT NULL, cnt INT NOT NULL, INDEX IDX_F52993984CE34BEC (part_id), INDEX IDX_F5299398700047D2 (ticket_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ticket_service (id INT AUTO_INCREMENT NOT NULL, brand VARCHAR(255) NOT NULL, phone VARCHAR(10) NOT NULL, name VARCHAR(255) NOT NULL, comment LONGTEXT DEFAULT NULL, type VARCHAR(255) NOT NULL, miles INT NOT NULL, model VARCHAR(255) NOT NULL, reg_number VARCHAR(9) NOT NULL, year INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE part (id INT AUTO_INCREMENT NOT NULL, type_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, cnt INT NOT NULL, price NUMERIC(10, 2) NOT NULL, image LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', INDEX IDX_490F70C6C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE part_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ticket_part (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, phone VARCHAR(10) NOT NULL, comment LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993984CE34BEC FOREIGN KEY (part_id) REFERENCES part (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398700047D2 FOREIGN KEY (ticket_id) REFERENCES ticket_part (id)');
        $this->addSql('ALTER TABLE part ADD CONSTRAINT FK_490F70C6C54C8C93 FOREIGN KEY (type_id) REFERENCES part_type (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993984CE34BEC');
        $this->addSql('ALTER TABLE part DROP FOREIGN KEY FK_490F70C6C54C8C93');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398700047D2');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE ticket_service');
        $this->addSql('DROP TABLE part');
        $this->addSql('DROP TABLE part_type');
        $this->addSql('DROP TABLE ticket_part');
    }
}
