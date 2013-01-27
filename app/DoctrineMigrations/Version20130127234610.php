<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20130127234610 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");

        $this->addSql("CREATE TABLE spy_timeline_action (id INT AUTO_INCREMENT NOT NULL, verb VARCHAR(255) NOT NULL, status_current VARCHAR(255) NOT NULL, status_wanted VARCHAR(255) NOT NULL, duplicate_key VARCHAR(255) DEFAULT NULL, duplicate_priority INT DEFAULT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE spy_timeline_action_component (id INT AUTO_INCREMENT NOT NULL, action_id INT DEFAULT NULL, component_id INT DEFAULT NULL, type VARCHAR(255) NOT NULL, text VARCHAR(255) DEFAULT NULL, INDEX IDX_83EE10BB9D32F035 (action_id), INDEX IDX_83EE10BBE2ABAFFF (component_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE car (brand VARCHAR(255) NOT NULL, model VARCHAR(255) NOT NULL, PRIMARY KEY(brand, model)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE spy_timeline_component (id INT AUTO_INCREMENT NOT NULL, model VARCHAR(255) NOT NULL, identifier LONGTEXT NOT NULL COMMENT '(DC2Type:array)', hash VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_C176EDC9D1B862B8 (hash), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE spy_timeline (id INT AUTO_INCREMENT NOT NULL, action_id INT DEFAULT NULL, subject_id INT DEFAULT NULL, context VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_5248FE629D32F035 (action_id), INDEX IDX_5248FE6223EDC87 (subject_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE spy_timeline_action_component ADD CONSTRAINT FK_83EE10BB9D32F035 FOREIGN KEY (action_id) REFERENCES spy_timeline_action (id) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE spy_timeline_action_component ADD CONSTRAINT FK_83EE10BBE2ABAFFF FOREIGN KEY (component_id) REFERENCES spy_timeline_component (id) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE spy_timeline ADD CONSTRAINT FK_5248FE629D32F035 FOREIGN KEY (action_id) REFERENCES spy_timeline_action (id)");
        $this->addSql("ALTER TABLE spy_timeline ADD CONSTRAINT FK_5248FE6223EDC87 FOREIGN KEY (subject_id) REFERENCES spy_timeline_component (id) ON DELETE CASCADE");
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
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");

        $this->addSql("ALTER TABLE spy_timeline_action_component DROP FOREIGN KEY FK_83EE10BB9D32F035");
        $this->addSql("ALTER TABLE spy_timeline DROP FOREIGN KEY FK_5248FE629D32F035");
        $this->addSql("ALTER TABLE spy_timeline_action_component DROP FOREIGN KEY FK_83EE10BBE2ABAFFF");
        $this->addSql("ALTER TABLE spy_timeline DROP FOREIGN KEY FK_5248FE6223EDC87");
        $this->addSql("DROP TABLE spy_timeline_action");
        $this->addSql("DROP TABLE spy_timeline_action_component");
        $this->addSql("DROP TABLE car");
        $this->addSql("DROP TABLE spy_timeline_component");
        $this->addSql("DROP TABLE spy_timeline");
        $this->addSql("DROP TABLE user");
    }
}
