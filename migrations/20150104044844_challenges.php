<?php

use Phinx\Migration\AbstractMigration;

class Challenges extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     *
     * Uncomment this method if you would like to use it.
     *
     */
    public function change()
    {
        // create the table
        $table = $this->table('challenges');
        $table->addColumn('created', 'datetime')
            ->addColumn('deadline', 'datetime')
            ->addColumn('title', 'string', array('limit' => 100))
            ->addColumn('description', 'string', array('limit' => 500))
            ->create();
    }

    
    /**
     * Migrate Up.
     */
    public function up()
    {
    
    }

    /**
     * Migrate Down.
     */
    public function down()
    {

    }
}