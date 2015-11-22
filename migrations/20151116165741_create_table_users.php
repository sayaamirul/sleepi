<?php

use Phinx\Migration\AbstractMigration;

class CreateTableUsers extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $table = $this->table('users');
        $table->addColumn('username', 'string', ['limit' => 50, 'null' => false])
            ->addColumn('password', 'string', ['limit' => 200, 'null' =>false])
            ->addColumn('api_key', 'string', ['limit' => 255, 'null' => false])
            ->addColumn('user_level', 'integer', ['limit' => 1, 'null' => false, 'default' => 1])
            ->addColumn('fullname', 'string', ['limit' => 150, 'null' => true])
            ->addColumn('gender', 'string', ['limit' => 1, 'null' => true])
            ->addColumn('address', 'string', ['limit' => 100, 'null' => true ])
            ->addColumn('phone_number', 'string', ['limit' => 15,'null' => true])
            ->addColumn('created_date', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_date', 'datetime', ['default' => null , 'null' => true])
            ->addColumn('deleted', 'boolean', ['default' => false])
            ->addColumn('deleted_date', 'datetime', ['default' => null, 'null' => true])
            ->addIndex('username', ['unique' => true])
            ->save();
    }
}
