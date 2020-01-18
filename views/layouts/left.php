<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\common\uicomponent\CpanelLeftmenuDB;

?>

<aside class="main-sidebar">

    <section class="sidebar">

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
                'items' => CpanelLeftmenuDB::getListLeftMenu(),

                //                'items' => CpanelLeftmenuDB::getHardCodedLeftMenu(), // for harcoded menu
            ]
        ) ?>

    </section>

</aside>
