<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180501195645 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE part ADD type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE part ADD CONSTRAINT FK_490F70C6C54C8C93 FOREIGN KEY (type_id) REFERENCES part_type (id)');
        $this->addSql('CREATE INDEX IDX_490F70C6C54C8C93 ON part (type_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE part DROP FOREIGN KEY FK_490F70C6C54C8C93');
        $this->addSql('DROP INDEX IDX_490F70C6C54C8C93 ON part');
        $this->addSql('ALTER TABLE part DROP type_id');
    }
}
