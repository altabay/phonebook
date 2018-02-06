<?php


use Phinx\Migration\AbstractMigration;

class MyNewMigration extends AbstractMigration
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
    public function change() {
        $table = $this->table('users', ['id' => 'ID', 'primary_key' => 'ID']);
        $table->addColumn('username', 'string', ['limit' => 100])
            ->addColumn('password', 'string', ['limit' => 100])
            ->addIndex(['ID'], ['type' => 'PRIMARY'])
            ->create();

        $table->insert(['username' => 'admin', 'password' => password_hash('admin', PASSWORD_BCRYPT)]);
        $table->saveData();

        $table = $this->table('phones', ['id' => 'ID', 'primary_key' => 'ID']);
        $table->addColumn('name', 'string', ['limit' => 100])
            ->addColumn('phone', 'string', ['limit' => 100])
            ->addColumn('date', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('note', 'text')
            ->addIndex(['ID'], ['type' => 'PRIMARY'])
            ->create();
    }
}
