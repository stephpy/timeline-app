<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20130127234610 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");

        $this->addSql("INSERT INTO `user` (`id`, `username`, `firstname`, `lastname`) VALUES
            (1, 'chuck', 'Chuck', 'Norris'),
            (2, 'vic', 'Vic', 'Mac Key'),
            (3, 'walter', 'Walter', 'White');
        ");
        $this->addSql("INSERT INTO `car` (`brand`, `model`) VALUES
            ('alfaromeo', '159'),
            ('bugatti', 'veyron');
        ");
    }

    public function down(Schema $schema)
    {
        $this->abortIf(true, "Check rewrite branch of migrations, this does not make any sense.");
    }
}
