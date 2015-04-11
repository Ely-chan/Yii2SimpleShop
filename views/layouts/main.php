<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body background="../images/12.jpg" onload="window.setTimeout('getSecs()',1)">

<script language="JavaScript">
    startday = new Date();
    clockStart = startday.getTime();

    function initStopwatch() {
        var myTime = new Date();
        var timeNow = myTime.getTime();
        var timeDiff = timeNow - clockStart;
        this.diffSecs = timeDiff/1000;
        return(this.diffSecs); }

    function getSecs() {
        var mySecs = initStopwatch();
        var mySecs1 = ""+mySecs;
        mySecs1= mySecs1.substring(0,mySecs1.indexOf(".")) + " сек.";
        document.forms[0].timespent.value = mySecs1
        window.setTimeout('getSecs()',1000); }

</script>

<form>
    <p align="center"><strong>
            Вы находитесь на этой странице уже:</strong></font>
        <input type="text" size="9" name="timespent"></p>
</form>




<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([

                'brandLabel' => 'Электронная техника Computers',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'myimage',
                ],
            ]);

	        $items = [
		        ['label' => 'Главная', 'url' => ['/site/index']],
		        ['label' => 'Контакты', 'url' => ['/site/about']],
		        ['label' => 'Отзыв', 'url' => ['/site/contact']],
		        Yii::$app->user->isGuest ?
			        ['label' => 'Войти', 'url' => ['/site/login']] :
			        ['label' => 'Выход (' . Yii::$app->user->identity->username . ')',
				        'url' => ['/site/logout'],
				        'linkOptions' => ['data-method' => 'post']],
	        ];

            if(!Yii::$app->user->isGuest && Yii::$app->user->identity->is_admin)
            {
                $items[] = ['label' => 'Заказы', 'url' => ['/orders']];
                $items[] = ['label' => 'Редактирование пользователя', 'url' => ['/admin-user']];
                $items[] = ['label' => 'Редактирование корзины', 'url' => ['/admin-basket-product']];
                $items[] = ['label' => 'Редактирование категории', 'url' => ['/admin-category']];
                $items[] = ['label' => 'Редактирование товаров', 'url' => ['/admin-product']];
                $items[] = ['label' => 'Редактирование атрибутов товара', 'url' => ['/admin-product-attribute']];
                $items[] = ['label' => 'Редактирование типов атрибута', 'url' => ['/admin-product-attribute-type']];
            }

            if(!Yii::$app->user->isGuest)
            {
                $items[] = ['label' => 'Корзина', 'url' => ['/basket']];
            }
        else
        {
            $items[] = ['label' => 'Регистрация', 'url' => ['/site/register']];
        }

            echo Nav::widget([
                'options' => ['class' => 'navbar-nav'],
                'items' => $items,
            ]);
            NavBar::end();
        ?>

        <div class="container">

            <?= Breadcrumbs::widget([
                'homeLink' => [
                    'url' => '/',
                    'label' => 'Главная страница',
                ],
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; Компьютер <?= date('Y') ?></p>
            <p class="pull-right"><?= 'Computers' ?></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
