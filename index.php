<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ペット詳細</title>
<link rel="stylesheet" href="/css/bulma.css">
<script src="/js/Util.js"></script>
</head>
	<nav class="navbar">
		<div class="navbar has-shadow is-spaced">
			<div class="container">
				<div class="navbar-brand">
					<div class="navbar-item">
						<h4 class="title is-4" style="padding-left: 1em;">ぺット体調管理</h4>
					</div>
					<div class="navbar-burger burger" data-target="navMenu" aria-label="menu" aria-expanded="false">
						<span aria-hidden="true"></span>
						<span aria-hidden="true"></span>
						<span aria-hidden="true"></span>
					</div>
				</div>
				<div class="navbar-menu" id="navMenu">
					<a href="php/Select" class="navbar-item">ペット一覧</a>
					<a href="php/InsertPetInfo" class="navbar-item">ペット情報登録</a>
				</div>
			</div>
		</div>
	</nav>
<?php	echo $_SERVER["REMOTE_ADDR"] ; ?>
</body>
</html>