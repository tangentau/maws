<script type='text/javascript'>
$(function(){
	$('.ddmenu').singleDropMenu({parentMO: 'ddmenu-hover', childMO: 'ddchildhover', timer: 1500})
});
</script>
<div class="header_menu">
<ul class='ddmenu'>
	<li>
		<?php echo link_to('Главная', 'main/index') ?>
		<ul>
			<li><?php echo link_to('Регистрация', 'user/new') ?></li>
			<li><?php echo link_to('Список пользователей', 'user/index') ?></li>
			<?php if (!$isAnonymous): ?>
			<li><?php echo link_to('Настройки', 'user/edit?id='.$UserId) ?></li>
			<?php endif; ?>
		</ul>
	</li>
	<li>
		<?php echo link_to('Фильтры', 'parser/index') ?>
		<ul>
			<li><?php echo link_to('Мои фильтры', 'parser/index') ?></li>
			<li><?php echo link_to('Не мои фильтры', 'parser/foreign') ?></li>
			<li><?php echo link_to('Добавить фильтр', 'parser/new') ?></li>
		</ul>
	</li>
	<li>
		<?php echo link_to('Ленты', 'thread/index') ?>
		<ul>
			<li><?php echo link_to('Мои ленты', 'thread/index') ?></li>
			<li><?php echo link_to('Не мои ленты', 'thread/foreign') ?></li>
			<li><?php echo link_to('Добавить ленту', 'thread/new') ?></li>
		</ul>
	</li>
	<li>
		<?php echo link_to('Сводки', 'page/index') ?>
		<ul>
			<li><?php echo link_to('Мои сводки', 'page/index') ?></li>
			<li><?php echo link_to('Не мои сводки', 'page/foreign') ?></li>
			<li><?php echo link_to('Добавить сводку', 'page/new') ?></li>
		</ul>
	</li>
	<li>
		<?php echo link_to('Справка', 'main/help') ?>
	</li>
</ul>
</div>