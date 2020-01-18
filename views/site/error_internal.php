<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;
?>
<section class="content">

    <div class="error-page">
        <h2 class="headline text-info"><i class="fa fa-warning text-yellow"></i></h2>

        <div class="error-content">
            
			
			<div class="callout callout-danger">
                <h4><?= $name ?></h4>

                <p><?= nl2br(Html::encode($message)) ?></p>
            </div>

            <p style="font-size:12px">
                Peringatan ini muncul karena ada beberapa kondisi yang tidak dipenuhi.<br>
				Silakan kontak administrator jika anda masih mengalami kondisi ini
            </p>
            <!--
            <form class='search-form'>
                           <div class='input-group'>
                               <input type="text" name="search" class='form-control' placeholder="Search"/>

                               <div class="input-group-btn">
                                   <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-search"></i>
                                   </button>
                               </div>
                           </div>
                       </form>
                       -->
        </div>
    </div>

</section>
