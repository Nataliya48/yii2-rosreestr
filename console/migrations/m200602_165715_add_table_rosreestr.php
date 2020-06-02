<?php

use yii\db\Migration;

/**
 * Class m200602_165715_add_table_rosreestr
 */
class m200602_165715_add_table_rosreestr extends Migration
{
    /**
     * @return bool|void|null
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%rosreestr}}', [
            'id' => $this->primaryKey(),
            'cadastralNumber' => $this->string(255)->notNull()->unique(),
            'address' => $this->string(255)->notNull(),
            'price' => $this->string(255)->notNull(),
            'area' => $this->string(255)->notNull(),
        ], $tableOptions);
    }

    /**
     * @return bool|void|null
     */
    public function down()
    {
        $this->dropTable('{{%rosreestr}}');
    }
}
