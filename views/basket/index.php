<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
$this->title = 'Корзина';
?>
<div class="category-index">

	<h1>Корзина</h1>

	<?php foreach($basketProducts as $basketProduct): ?>
		<div class="row">
			<div class="col-md-12">
				<div class="alert alert-success">
					<h2><?php echo $basketProduct->product->name; ?></h2>
                    <img src="<?php echo $basketProduct->product->img; ?>" />
					<div class="badge badge-inverse">Стоимость итого: <?php echo $basketProduct->product->price * $basketProduct->count; ?></div>
					<?php echo $basketProduct->product->description; ?>
					<div>Количество: <?php echo $basketProduct->count; ?></div>
                    <?= Html::a('Добавить', ['basket/add', 'id' => $basketProduct->id], ['class' => 'btn btn-success']) ?>
                    <?= Html::a('Убрать', ['basket/remove', 'id' => $basketProduct->id], ['class' => 'btn btn-danger']) ?>
				</div>
			</div>
		</div>
	<?php endforeach; ?>




	<?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

		<div class="alert alert-success">
			Спасибо за заказ. Мы постараемся ответить вам как можно скорее.
		</div>

		<p>

		</p>

	<?php else: ?>

		<p>
			Создать заказ
		</p>

		<div class="row">
			<div class="col-lg-5">
				<?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
				<?= $form->field($model, 'name') ?>
				<?= $form->field($model, 'email') ?>
				<?= $form->field($model, 'body')->textArea(['rows' => 6]) ?>
				<div class="form-group">
					<?= Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
				</div>
				<?php ActiveForm::end(); ?>
			</div>
		</div>

	<?php endif; ?>

</div>
