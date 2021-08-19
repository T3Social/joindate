<?php

use humhub\modules\space\controllers\MembershipController;

return [
    'id' => 'joindate',
    'class' => 'humhub\modules\joindate\Module',
    'namespace' => 'humhub\modules\joindate',
    'events' => [
        ['class' => MembershipController::class, 'event' => MembershipController::EVENT_BEFORE_ACTION, 'callback' => ['humhub\modules\joindate\Events', 'onBeforeAction']],
    ],
];
