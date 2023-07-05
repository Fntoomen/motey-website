<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Motey - Emote Bot</title>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
		<link rel="icon" type="image/png" href='favicon.png'/>
	</head>
	<body>
<?php
session_start();
if(!isset($_SESSION["username"]))
{
	header('Location: login.php');
}
$login = $_SESSION["username"];
?>
		<!--"Header"-->
		<section class="hero is-black">
			<div class="hero-body is-fullheight">
				<p class="title">
				Motey
				</p>
				<p class="subtitle">
				Emote bot made by Mikołaj Lubiak
				</p>
			</div>
		</section>
		<!--Nav bar (te linki poniżej)-->
		<nav class="navbar has-text-black-bis" role="navigation" aria-label="main navigation"  style="background-color: rgb(8, 14, 9);">
			<div id="navbar" class="navbar-menu">
				<div class="navbar-start">
					<a class="navbar-item" href="list.php">
						Emote List
					</a>
					<a class="navbar-item" href="https://discord.com/api/oauth2/authorize?client_id=1108722454353948692&permissions=8&scope=bot">
						Bot Invite
					</a>
					<a class="navbar-item" href="https://discord.gg/pq9Jjg5Dfj">
						Discord Server
					</a>

				</div>
			</div>
		</nav>
		<!--Uploader-->
		<div class="container">
			<form action="upload.php" method="post" enctype="multipart/form-data">
				<div class="field">
					<label class="label" style="color: rgb(194, 14, 14);"><strong>Emote name:</strong></label>
					<div class="control" style="width: fit-content;">
						<strong>
							<input class="input" type="text" placeholder="Emote name..." name="emotename" id="emotename">
						</strong>
					</div>
				</div>
				<div class="field">
					<label class="file-label">
						<input class="file-input" type="file" name="emote" id="emote">
						<span class="file-cta">
							<span class="file-icon">
								<i class="fas fa-upload"></i>
							</span>
							<span class="file-label">
								Choose a file...
							</span>
						</span>
					</label>
				</div>
				<div class="field">
					<div class="control">
						<input class="button" type="submit" value="Submit">
					</div>
				</div>
			</form>
		</div>
	</body>
</html>
