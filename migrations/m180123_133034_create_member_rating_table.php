<?php

use yii\db\Migration;

/**
 * Handles the creation of table `member_rating`.
 */
class m180123_133034_create_member_rating_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('member_rating', [
            'id' => $this->primaryKey(),
            'member_id' => $this->integer()->notNull(),
            'rating_id' => $this->integer()->notNull(),
            'rating_handle' => $this->string()->notNull(),
            'rating_member_id' => $this->string(),
            'link' => $this->string(),
            'rank' => $this->integer(),
            'rating' => $this->integer(),
            'rating_data' => $this->text(),
        ]);

        $this->addForeignKey(
            'fk-member_rating_rating_id',
            'member_rating',
            'rating_id',
            'rating',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-member_rating_member_id',
            'member_rating',
            'member_id',
            'member',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('member_rating');
    }
}
