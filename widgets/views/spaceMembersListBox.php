<?php

use humhub\widgets\ModalButton;
use humhub\widgets\ModalDialog;
use humhub\widgets\AjaxLinkPager;
use humhub\widgets\TimeAgo;
use yii\helpers\Html;

/* @var $data yii\db\ActiveQuery; */
?>

<?php ModalDialog::begin(['header' => $title]) ?>

<?php if (count($data) === 0): ?>
    <div class="modal-body">
        <p><?= Yii::t('UserModule.base', 'No users found.'); ?></p>
    </div>
<?php endif; ?>

<div id="userlist-content">

    <ul class="media-list">
        <?php foreach ($data as $space) : ?>
            <li>
                <a href="<?= $space->user->getUrl(); ?>"  data-modal-close="1">
                    <div class="media">
                        <img class="media-object img-rounded pull-left"
                             src="<?= $space->user->getProfileImage()->getUrl(); ?>" width="50"
                             height="50" alt="50x50" data-src="holder.js/50x50"
                             style="width: 50px; height: 50px;">

                        <div class="media-body">
                            <h4 class="media-heading"><?= Html::encode($space->user->displayName); ?></h4>
                            <div class="tt time timeago"><?= Yii::t('JoindateModule.base', 'Joined')?> <?= TimeAgo::widget(['timestamp' => $space->created_at]);?></div>
                        </div>
                    </div>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

    <div class="pagination-container">
        <?= AjaxLinkPager::widget(['pagination' => $pagination]); ?>
    </div>
</div>

<div class="modal-footer">
    <?= ModalButton::cancel(Yii::t('base', 'Close'))?>
</div>

<script <?= \humhub\libs\Html::nonce() ?>>

    // scroll to top of list
    $(".modal-body").animate({scrollTop: 0}, 200);

</script>

<?php ModalDialog::end() ?>


