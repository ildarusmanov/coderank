<?php

use yii\db\Migration;

/**
 * Handles the creation of table `rating_contest`.
 */
class m180121_070445_create_rating_contest_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('rating_contest', [
            'id' => $this->primaryKey(),
            'rating_id' => $this->integer()->notNull(),
            'title' => $this->string()->notNull(),
            'date_timestamp' => $this->integer()->notNull(),
            'link' => $this->string(),
        ]);

        $this->addForeignKey(
            'fk-rating_contest_rating_id',
            'rating_contest',
            'rating_id',
            'rating',
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
        $this->dropTable('rating_contest');
    }
}
