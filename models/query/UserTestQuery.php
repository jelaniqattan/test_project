<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\UserTest]].
 *
 * @see \app\models\UserTest
 */
class UserTestQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \app\models\UserTest[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\UserTest|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
