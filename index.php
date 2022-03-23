<?php include('include/functions.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health application</title>

    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/customscrollbar.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function () {
				$("#sidebar").mCustomScrollbar({
					theme: "minimal"
				});

				$('#sidebarCollapse').on('click', function () {
					$('#sidebar, #content').toggleClass('active');
					$('.collapse.in').toggleClass('in');
					$('a[aria-expanded=true]').attr('aria-expanded', 'false');
				});
			});
		</script>
</head>

<body>
	<?php
		/* Array to build the side bar menu. Support section title, menu items and sub menus
		 * Main page is fetch from pages/<pagename>.php
		 *   array('title' => 'Menu text', 'page' => 'pagename')
		 *
		 * Insert a section title in the menu.
		 *   array('title' => 'Text', 'page' => '_head'),
		 *
		 * Build a collapsible menu.
		 *   array('title' => 'Sub menu title', 'submenu' => array(
		 *     array('title' => 'Sub menu text', 'page' => 'pagename'), ... )
		 */
		$menuStructure=array(
			array('title' => 'Section title', 'page' => '_head'),
			array('title' => 'Home', 'page' => 'home'),
			array('title' => 'Pages', 'page' => 'submenu1','submenu' => array(
				array('title' => 'Page 1', 'page' => 'page1'),
				array('title' => 'Page 2', 'page' => 'page2'),
				array('title' => 'Page 3', 'page' => 'page3')
			)),
			array('title' => 'Section title', 'page' => '_head'),
			array('title' => 'About', 'page' => 'about'),
			array('title' => 'Reigster', 'page' => 'register'),
			array('title' => 'Login', 'page' => 'login')
		);
	?>
	<div class="wrapper">
		<!-- Sidebar  -->
		<nav id="sidebar">
			<div class="sidebar-header">
				<h3>My health application</h3>
			</div>
			<ul class="list-unstyled components"> <?php
				$page = isset($_GET['page']) ? $_GET['page'] : "main";
				foreach ($menuStructure as $item) {
						if (!isset($item['submenu'])) {
							if ($item['page'] == '_head') {
								echo '<p>'.$item['title'].'</p>';
							} else {
								echo '<li class="'.($item['page']==$page?'active':'').'"><a href="?page='.$item['page'].'">'.$item['title'].'</a></li>';
							}
						} else {
							$sublist = '';
							$active = false;
							foreach ($item['submenu'] as $subitem) {
								if ($subitem['page']==$page) {$active=true;}
								$sublist .= '<li class="'.($subitem['page']==$page?'active':NULL).'"><a href="?page='.$subitem['page'].'">'.$subitem['title'].'</a></li>';
							}
							echo '<li>';
							echo '<a href="#'.$item['page'].'Submenu" class="dropdown-toggle" data-bs-toggle="collapse" aria-expanded="'.($active?'true':'false').'">'.$item['title'].'</a>';
							echo '<ul class="collapse '.($active?'show':'').' list-unstyled" id="'.$item['page'].'Submenu">';
							echo $sublist;
							echo '</ul></li>';
						}
					}
				?>
			</ul>
		</nav>

		<!-- Page Content  -->
		<div id="content">
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
				<div class="container-fluid">
					<button type="button" id="sidebarCollapse" class="btn btn-light">
						<i class="bi bi-menu-button-fill"></i>
						<span></span>
					</button>
					<button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<i class="fas fa-align-justify"></i>
					</button>

					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="nav navbar-nav ms-auto">
							<li class="nav-item">
								<a class="nav-link active" href="#">Page</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">Page</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">Page</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">Page</a>
							</li>
						</ul>
					</div>
				</div>
			</nav>

			<?php

			var_dump($menuStructure);
				$page = verify_data(isset($_GET['page'])?$_GET['page']:'home',"page");
				include('pages/'.$page.'.php');
			?>

		</div>
	</div>
</body>
</html>