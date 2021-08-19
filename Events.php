<?php

namespace humhub\modules\joindate;

use humhub\modules\joindate\widgets\SpaceMembersListBox;
use humhub\modules\joindate\Module as JoinDate;
use Yii;

/**
 * Description of Events
 *
 * @author Victor Nekrasov
 */
class Events
{

    public static function onBeforeAction($event)
    {
        if ($event->action->id == 'members-list') {
            print $event->sender->renderAjaxContent(SpaceMembersListBox::widget([
                'query' => JoinDate::getSpaceMembersQuery($event->sender->getSpace()),
                'title' => Yii::t('SpaceModule.manage', "<strong>Members</strong>"),
            ]));
            $event->isValid = false;
        }
    }
}
