<?php
/* @var $this yii\web\View */
$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
	    <div style="height: 200px;">

		    <h1> Вы зашли на сайт Computers </h1>
	    </div>


        <p class="lead">Добро пожаловать на наш сайт</p>
        <p>Здесь вы можете выбрать технику, что представлена ниже</p>
    </div>

    <div class="row" style="padding-top: 30px;">
	<?php foreach($categories as $category): ?>
		<?php if($category->parent_id == null): ?>
				<div class="col-md-4">
					<a href="<?php echo Yii::$app->urlManager->createUrl(['category', 'id' => $category->id]); ?>"><h4><?php echo $category->name; ?></h4></a>
                    <a onClick="subcategory(<?php echo $category->id; ?>)"><h6>Отобразить подкатегории</h6></a>


                    <div style='display: none;' id="subcategory-<?php echo $category->id; ?>">
                        <?php foreach($category->subcategories as $subcategory): ?>
                            <div>
                                <a href="<?php echo Yii::$app->urlManager->createUrl(['category', 'id' => $subcategory->id]); ?>"><?php echo $subcategory->name; ?></a>
                            </div>
                        <?php endforeach; ?>
                    </div>

				</div>
		<?php endif;?>
	<?php endforeach; ?>
    </div>

</div>
