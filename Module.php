<?php

namespace humhub\modules\joindate;


use humhub\modules\content\components\ContentContainerModule;
use humhub\modules\space\models\Membership;
use humhub\modules\space\models\Space;
use humhub\modules\user\models\User;
use Yii;

/**
 * The JoinDate Module extends the functionality of UserListBox widget
 * to provide it with the date of joining the space by user.
 *
 * @package humhub.modules.joindate
 * @author Victor Nekrasov
 */

class Module extends ContentContainerModule {

    /**
     * @return \yii\base\Module
     */
    public static function getModuleInstance()
    {
        return Yii::$app->getModule('joindate');
    }

    /**
     * @inheritDoc
     */
    public function getContentContainerTypes()
    {
        return [Space::class];
    }

    /**
     * Returns the query with the information of space members
     *
     * @param Space $space
     * @param bool $membersOnly
     * @param null $withNotifications
     * @return \yii\db\ActiveQuery
     */
    public static function getSpaceMembersQuery(Space $space, $membersOnly = true, $withNotifications = null)
    {
        $query = Membership::find();
        $query->andWhere(['space_membership.space_id' => $space->id]);
        $query->joinWith([
            'user',
            'user.profile',
            'originator' => function ($q) {
                $q->from('user originator');
            }
        ]);

        if ($membersOnly) {
            $query->andWhere(['space_membership.status' => Membership::STATUS_MEMBER]);
        }

        if ($withNotifications === true) {
            $query->andWhere(['space_membership.send_notifications' => 1]);
        } elseif ($withNotifications === false) {
            $query->andWhere(['space_membership.send_notifications' => 0]);
        }

        $query->andWhere(['space_membership.space_id' => $space->id]);

        return $query;
    }
}
