<?=doctype('html5')."\n"?>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?=meta('Content-type', 'text/html; charset=utf-8', 'equiv')."\n"?>
		<?//=link_tag('assets/css/user.css')."\n"?>
		<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> -->
		<!-- <script src="//ajax.googleapis.com/ajax/libs/mootools/1.4.5/mootools-yui-compressed.js"></script> -->
		<script src="<?=base_url('assets/js/mootools-core-1.4.5-full-compat.js')?>"></script>
		<script src="<?=base_url('assets/js/mootools-more-1.4.0.1.js')?>"></script>
		<script src="<?=base_url('assets/js/test.js')?>"></script>
		<title><?=$title?></title>
	</head>
	<body>
	<table id="sort">
	<thead>
	<tr>
		<th>Обложка&nbsp;</th>
		<th>Название книги&nbsp;</th>
		<th>Автор&nbsp;</th>
		<th>Описание&nbsp;</th>
		<th>Рейтинг</th>
	</tr>
	</thead>
	<tr>
		<td>1</td>
		<td>5</td>
		<td>9</td>
		<td>13</td>
		<td>16</td>
	</tr>
	<tr>
		<td>2</td>
		<td>6</td>
		<td>10</td>
		<td>14</td>
		<td>17</td>
	</tr>
	<tr>
		<td>3</td>
		<td>7</td>
		<td>15</td>
		<td>14</td>
		<td>18</td>
	</tr>
	<tr>
		<td>4</td>
	 	<td>8</td>
		<td>12</td>
		<td>15</td>
		<td>19</td>
	</tr>
</table>
	</body>
</html>