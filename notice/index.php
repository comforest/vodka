<!-- 공지사항 페이지 -->
<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>VoDKa</title>
	<link rel="stylesheet" type="text/css" href="/static/css/header.css">
	<link rel="stylesheet" type="text/css" href="/static/css/board.css">
</head>
<body>
	<?php
		include $_SERVER["DOCUMENT_ROOT"]."/include/header.inc";
	?>

	
	<section class ="board">
		<table>
			<thead>
				<tr>
					<th>
						제목
					</th>
					<th>
						글쓴이
					</th>
					<th>
						날짜
					</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="align-left">
						공지사항 입니다. 하잇 하잇 하잇
					</td>
					<td>
						저에ㅛ
					</td>
					<td>
						2015.11.22
					</td>	
				</tr>
			</tbody>
		</table>
	</section>
</body>
</html>