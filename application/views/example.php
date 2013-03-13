<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
<?php 
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
<style type='text/css'>
body
{
	font-family: Arial;
	font-size: 14px;
}
a {
    color: blue;
    text-decoration: none;
    font-size: 14px;
}
a:hover
{
	text-decoration: underline;
}
</style>
</head>
<body>
	<div>
		<a href='<?php echo site_url('examples/dictionaries_management')?>'>字典</a> |
		<a href='<?php echo site_url('examples/material_name_management')?>'>材料</a> |
		<a href='<?php echo site_url('examples/factory_management')?>'>工厂</a> |
		<a href='<?php echo site_url('examples/no_management')?>'>牌号</a> | 
		<a href='<?php echo site_url('examples/type_management')?>'>种类</a>
	</div>
	<div style='height:20px;'></div>  
    <div>
		<?php echo $output; ?>
    </div>
</body>
</html>
