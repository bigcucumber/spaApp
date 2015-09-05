<?php

namespace app\modules\spa\models;

/**
 * This is the ActiveQuery class for [[SpaUsers]].
 *
 * @see SpaUsers
 */
class SpaUsersQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return SpaUsers[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return SpaUsers|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}