<?php

use yii\db\Migration;

/**
 * Handles the creation of table `member_contest`.
 */
class m180123_133302_create_member_contest_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('member_rating_contest', [
            'id' => $this->primaryKey(),
            'member_id' => $this->integer()->notNull(),
            'rating_contest_id' => $this->integer()->notNull(),
            'rank' => $this->integer(),
            'rating' => $this->integer(),
            'results' => $this->text(),
        ]);


        $this->addForeignKey(
            'fk-member_rating_contest_member_id',
            'member_rating_contest',
            'member_id',
            'member',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-member_rating_contest_rcontest_id',
            'member_rating_contest',
            'rating_contest_id',
            'rating_contest',
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
        $this->dropTable('member_contest');
    }
}
