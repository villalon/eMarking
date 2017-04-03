
<body>

	<!-- Slider -->
	<div id="myCarousel" class="carousel slide">

		<ol class="carousel-indicators">
			<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			<li data-target="#myCarousel" data-slide-to="1"></li>
		</ol>

		<div class="carousel-inner">

			<div class="item active">
				<img src="img/slide1.png" alt="01" class="img-responsive"
					style="min-width: 100%;">
				<div class="carousel-caption"></div>
			</div>

			<div class="item">
				<img src="img/slide02.png" alt="02" class="img-responsive"
					style="min-width: 100%;">
				<div class="carousel-caption"></div>
			</div>

		</div>

		<a class="carousel-control left" href="#myCarousel" data-slide="prev">
			<span class="icon-prev"></span>
		</a> <a class="carousel-control right" href="#myCarousel"
			data-slide="next"> <span class="icon-next"></span>
		</a>

	</div>
	<!-- Slider End -->



	<!-- Actividades -->
	<div class="row_activities" >
		<div class="container">
			<br>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 tit_actv"></div>
			</div>

			<div class="row">
				
				<div class="col-xs-12 col-sm-5 col-md-4 col-lg-4 col_height"
					style="background-color: #085B7F;">
					
					<h4 class="subtit_actv">Género: <?=$activityArray[0]['genre']?></h4>
					<h2 class="h2tit_actv">
						<a class="h2tit_actv" href="<?=$activityArray[0]['link']?>"> <?=$activityArray[0]['title']?></a>
					</h2>
					<hr>
					<br>
					<p class="text-justify text_actv"><?=$activityArray[0]['description']?></p>
				
				</div>
				
				<div class="col-xs-12 col-sm-2 col-md-4 col-lg-6 img1_actv"></div>
				<div class="col-xs-12 col-sm-5 col-md-4 col-lg-4 col_height"
					style="background-color: #097C5E;">
					<h4 class="subtit_actv">Género: <?=$activityArray[1]['genre']?></h4>
					<h2 class="h2tit_actv">
						<a class="h2tit_actv" href="<?=$activityArray[1]['link']?>"> <?=$activityArray[1]['title']?></a>
					</h2>
					<hr>
					<br>
					<p class="text-justify text_actv"><?=$activityArray[1]['description']?></p>
				</div>
			</div>

			<div class="row">
				<div class="col-xs-1 col-sm-1 col-md-2 col-lg-3 img2_actv"></div>
				<div class="col-xs-11 col-sm-4 col-md-4 col-lg-4 col_height"
					style="background-color: #7C3709;">
					<h4 class="subtit_actv">Género: <?=$activityArray[2]['genre']?></h4>
					<h2 class="h2tit_actv">
						<a class="h2tit_actv" href="<?=$activityArray[2]['link']?>"> <?=$activityArray[2]['title']?></a>
					</h2>
					<hr>
					<br>
					<p class="text-justify text_actv"><?=$activityArray[2]['description']?></p>
				</div>
				<div class="col-xs-11 col-sm-4 col-md-4 col-lg-4 col_height"
					style="background-color: #757A0A;">
					<h4 class="subtit_actv">Género: <?=$activityArray[3]['genre']?></h4>
					<h2 class="h2tit_actv">
						<a class="h2tit_actv" href="<?=$activityArray[3]['link']?>"> <?=$activityArray[3]['title']?></a>
					</h2>
					<hr>
					<br>
					<p class="text-justify text_actv"><?=$activityArray[3]['description']?></p>
				</div>
				<div class="col-xs-1 col-sm-3 col-md-2 col-lg-3 img2_actv"></div>
			</div>

			<br>
			<br>

		</div>
	</div>
	<!-- Actividades END -->

	<!-- Caracteristicas -->
	<div class="row_caract">
		<div class="container">
			<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3" align="center">
				<img src="img/caract_01_01.png">
				<h4>Crea tu Perfil</h4>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3" align="center">
				<img src="img/caract_01_03.png">
				<h4>Crea Actividades</h4>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3" align="center">
				<img src="img/caract_01_05.png">
				<h4>Participa en el Foro</h4>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3" align="center">
				<img src="img/caract_01_08.png">
				<h4>Conviértete en Corrector</h4>
			</div>
		</div>
	</div>
	<!-- Caracteristicas End -->

	<!-- Quienes Somos -->
	<div class="row_info">
		<div class="container">


			<div class="col-xs-12 col-sm-3 col-md-6 col-lg-6 tit_blue">
				<h2>Quiénes Somos</h2>
				<br>
				<p class="text_grey1" align="justify">Escribiendo.online es una comunidad de
					aprendizaje comprometida con la enseñanza de la escritura en las
					aulas chilenas. Sabemos que aprender a escribir es un proceso
					complejo en el que los estudiantes necesitan ser guiados por sus
					profesores. Pero también sabemos lo difícil y lento que puede
					resultar revisar y retroalimentar la escritura de los estudiantes.
				</p>
				<p class="text_grey1" align="justify">Por esto hemos creado esta plataforma
					colaborativa en línea que permite a los profesores compartir
					actividades, videos y pautas de evaluación de la escritura, así
					como corregir y retroalimentar en línea los textos de sus
					estudiantes o recibir una evaluación experta de los textos de sus
					alumnos.
				</p>
			</div>

			<div class="col-xs-12 col-sm-3 col-md-2 col-lg-2 tit_blue"
				align="center">
				<h4>Profesores</h4>
				<img src="img/index/img_profesor.jpg">
				<p class="text_grey" align="justify">Los profesores que participan de la comunidad
					pueden crear un perfil, inscribir sus cursos, crear actividades,
					videos y pautas de evaluación, y usar la corrección en línea o
					enviar los textos de sus estudiantes para evaluación experta.
					También pueden comentar y modificar las actividades de otros
					profesores y convertirse en correctores expertos.</p>
				<br>
			</div>

			<div class="col-xs-12 col-sm-3 col-md-2 col-lg-2 tit_blue"
				align="center">
				<h4>Correctores</h4>
				<img src="img/index/img_ayudante.png">
				<p class="text_grey" align="justify">Los correctores en línea son profesores que se
					han capacitado en las rúbricas y pautas de evaluación para llevar a
					cabo una evaluación experta de los textos subidos a la plataforma
					por otros profesores.</p>
			</div>

			<div class="col-xs-12 col-sm-3 col-md-2 col-lg-2 tit_blue"
				align="center">
				<h4>Estudiantes</h4>
				<img src="img/index/img_student.png">
				<p class="text_grey" align="justify">Los estudiantes pueden participar de la
					plataforma invitados por sus profesores. En esta pueden revisar la
					retroalimentación que su profesor les entregó, así como participar
					en evaluaciones entre pares con sus compañeros de curso.</p>
				<br>

			</div>
		</div>

	</div>
</body>
