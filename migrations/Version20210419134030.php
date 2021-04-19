<?php
declare(strict_types=1);
/**
 * Description:
 * create database and put initial configs
 *
 * @package App\Entity
 *
 * @copyright 2021 Md Fahim Uddin
 */

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210419134030 extends AbstractMigration
{
    /**
     * @return string
     */
    public function getDescription() : string
    {
        return 'create database and put initial configs';
    }

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema) : void
    {
        $this->abortIf(
            $this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.'
        );

        $this->addSql('CREATE TABLE currency (id INT AUTO_INCREMENT NOT NULL, status_id INT NOT NULL, code VARCHAR(3) NOT NULL, name VARCHAR(45) NOT NULL, date_created DATETIME NOT NULL, date_updated DATETIME DEFAULT NULL, INDEX IDX_6956883F6BF700BD (status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE exchange_rate (id INT AUTO_INCREMENT NOT NULL, from_currency INT NOT NULL, to_currency INT NOT NULL, status_id INT NOT NULL, rate NUMERIC(7, 2) NOT NULL, date_created DATETIME NOT NULL, date_updated DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_E9521FAB2FB968A5 (from_currency), UNIQUE INDEX UNIQ_E9521FABA40F1691 (to_currency), INDEX IDX_E9521FAB6BF700BD (status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE status (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(15) NOT NULL, UNIQUE INDEX UNIQ_7B00651C5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE currency ADD CONSTRAINT FK_6956883F6BF700BD FOREIGN KEY (status_id) REFERENCES status (id)');
        $this->addSql('ALTER TABLE exchange_rate ADD CONSTRAINT FK_E9521FAB2FB968A5 FOREIGN KEY (from_currency) REFERENCES currency (id)');
        $this->addSql('ALTER TABLE exchange_rate ADD CONSTRAINT FK_E9521FABA40F1691 FOREIGN KEY (to_currency) REFERENCES currency (id)');
        $this->addSql('ALTER TABLE exchange_rate ADD CONSTRAINT FK_E9521FAB6BF700BD FOREIGN KEY (status_id) REFERENCES status (id)');
        $this->addSql('CREATE UNIQUE INDEX unique_exchange ON exchange_rate (from_currency, to_currency)');

        $sql = "INSERT INTO status (id, name) 
                VALUES 
                    (1, 'active'),
                    (2, 'inactive'),
                    (3, 'deleted')";
        $this->addSql($sql);

        $sql = "INSERT INTO currency (id, status_id, code, name, date_created) 
                VALUES 
                       (1, 1, 'GBP', 'British pound', NOW()),
                       (2, 1, 'BDT', 'Bangladeshi taka', NOW())";
        $this->addSql($sql);

        $sql = "INSERT INTO exchange_rate
                    (id, from_currency, to_currency, status_id, rate, date_created, date_updated)
                VALUES 
                    (1, 1, 2, 1, '115.20', NOW(), NOW())";
        $this->addSql($sql);
    }

    public function down(Schema $schema) : void
    {
        $this->abortIf(
            $this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.'
        );

        $this->addSql('ALTER TABLE exchange_rate DROP FOREIGN KEY FK_E9521FAB2FB968A5');
        $this->addSql('ALTER TABLE exchange_rate DROP FOREIGN KEY FK_E9521FABA40F1691');
        $this->addSql('ALTER TABLE currency DROP FOREIGN KEY FK_6956883F6BF700BD');
        $this->addSql('ALTER TABLE exchange_rate DROP FOREIGN KEY FK_E9521FAB6BF700BD');
        $this->addSql('DROP TABLE currency');
        $this->addSql('DROP TABLE exchange_rate');
        $this->addSql('DROP TABLE status');
        $this->addSql("DELETE FROM exchange_rate");
        $this->addSql("DELETE FROM currency");
        $this->addSql("DELETE FROM status");
    }
}
