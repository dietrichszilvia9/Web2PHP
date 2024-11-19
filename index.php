<?php
require_once 'menu.php';
require_once 'build_menu.php';
?>

<!DOCTYPE HTML>
<!--
	Spectral by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Operett adatbázis</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	<body class="landing is-preload">

		<!-- Page Wrapper -->
			<div id="page-wrapper">

				<!-- Header -->
					<header id="header" class="alt">
						<h1><a href="index.html">Operett adatbázis</a></h1>
						<nav id="nav">
							<ul>
								<li class="special">
									<a href="#menu" class="menuToggle"><span>Menu</span></a>
									<div id="menu">
										<?php
										echo buildMenu($menuItems);
										?>
									</div>
								</li>
							</ul>
						</nav>					
					</header>

				<!-- Banner -->
					<section id="banner">
						<div class="inner">
							<h2>Operett adatbázis</h2>
							<p>Minden infó egyhelyen</p>
						</div>
						<a href="#one" class="more scrolly">Az adatbázisról</a>
					</section>

				<!-- One -->
					<section id="one" class="wrapper style1 special">
						<div class="inner">
							<header class="major">
								<h2>Mi is az Operett?</h2>
								<p>Az operett egy színpadi, zenei műfaj. Mozart nevezte el operettnek. <br>Szó szerinti jelentése: „kis opera” vagy „operácska”.</p>
							</header>
						</div>
					</section>

				<!-- Two -->
					<section id="two" class="wrapper alt style2">
						<section class="spotlight">
							<div class="image"><img src="images/pic01.jpg" alt="" /></div><div class="content">
								<h2>Jellemzői</h2>
								<p>Könnyed dallamvilággal átszőtt (szerelmi) történet, sok humorral fűszerezve.<br><br>
									Témája vígjátéki, vidám, komikus, gúnyos elemeket egyaránt tartalmazhat. A cselekmény fonala prózai monológokban és párbeszédekben bontakozik ki, ezekhez kapcsolódnak a zenei tételek (zenekari nyitány, közjátékok, egyszerűbb formálású áriák, dalok, kuplék, együttesek a duettektől a kórusig) és a táncjelenetek, amelyek általában kortárs táncokra épülnek.</p>
							</div>
						</section>
						<section class="spotlight">
							<div class="image"><img src="images/pic02.jpg" alt="" /></div><div class="content">
								<h2>Kezdetek</h2>
								<p>1840-ben Donizetti Az ezred lánya című operájával lázba hozta Párizst, de az első operettnek Hervé[1] Don Quijote és Sancho Panza című művét tekintik. Az első nagy operettkomponista Offenbach volt, aki előbb egyfelvonásos, később egész estét betöltő parodisztikus darabjaival aratott sikert. Az első egész estés darabja, sőt a mai fogalmaink szerinti első igazi operett az Orfeusz az alvilágban volt. Munkássága, hatása a zenés műfaj vizsgálatánál megkerülhetetlen. Művei közül több (Szép Heléna, Hoffmann meséi) az operaházak kedvelt repertoár-darabjai. Franciaországban a 19. század 50-es éveiben tűntek fel a színpadokon az első hamisítatlan operettek, jelentős francia szerző volt Offenbach mellett Hervé, Robert Planquette, Charles Lecocq.</p>
							</div>
						</section>
						<section class="spotlight">
							<div class="image"><img src="images/pic03.jpg" alt="" /></div><div class="content">
								<h2>Dramaturgia</h2>
								<p>A 18. században és a 19. század kezdetén daljáték jellegű mű; a 19. században váltott irányt és lett a zene nagyvárosi, szórakoztató színpadi műfajává. Már Mozart is szorgalmazta, hogy a zene ne csak a paloták gazdáihoz, hanem mindenkihez jusson el. A forradalom után ezek az elképzelések megvalósíthatóvá váltak. Ekkor kap új nevet: „opéra comique" az egyik régi párizsi zenés színház. Az operettben a párbeszéd és a zárt formájú zene arányosan oszlik meg, szerephez jut a játékban a tánc, a finálék nagyvonalúak. A klasszikus operett szereplőgárdája általában a híres „négyesfogatra” épül. Ezek a primadonna, a bonviván, a szubrett és a táncoskomikus. A „primadonna” az első hölgy, akinek szerelme megingathatatlan, és a története a „bonvivánnal” a harmadik felvonásra, minden akadályt legyőzve happy enddel végződik.</p>
							</div>
						</section>
					</section>

				<!-- CTA -->
					<section id="cta" class="wrapper style4">
						<div class="inner">
							<header>
								<h2>Operett alkotók és művek</h2>
								<p>Adatbázisunk megtekintése</p>
							</header>
							<ul class="actions stacked">
								<li><a href="rest_kliens.php" class="button fit primary">REST</a></li>
								<li><a href="soap_kliens.php" class="button fit">SOAP</a></li>
							</ul>
						</div>
					</section>

				<!-- Footer -->
					<footer id="footer">
						<ul class="icons">
							<li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
							<li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
							<li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
							<li><a href="#" class="icon brands fa-dribbble"><span class="label">Dribbble</span></a></li>
							<li><a href="#" class="icon solid fa-envelope"><span class="label">Email</span></a></li>
						</ul>
						<ul class="copyright">
							<li>&copy; Operett adatbázis</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
						</ul>
					</footer>

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>