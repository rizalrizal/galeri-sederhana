<?php 
	if(isset($_POST['upload'])){
		$allow = array("jpg", "jpeg", "gif", "png");

		$todir = 'uploads/';
		$URL="index.php";

		if ( !!$_FILES['file']['tmp_name'] ) // is the file uploaded yet?
		{
		    $info = explode('.', strtolower( $_FILES['file']['name']) ); // whats the extension of the file

		    if ( in_array( end($info), $allow) ) // is this file allowed
		    {
		        if ( move_uploaded_file( $_FILES['file']['tmp_name'], $todir . basename($_FILES['file']['name'] ) ) )
		        {
		        	

		            echo '<script language="javascript">';
					echo 'alert("Upload Berhasil")';
					echo '</script>';

					
		        }
		    }
		    else
		    {
		        	echo '<script language="javascript">';
					echo 'alert("Upload Gagal Karena Ekstensi Tidak Sesuai")';
					echo '</script>';
					
		    }
		}
		echo "<script>location.href='$URL'</script>";
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Galery</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<!-- Font -->
	 <link rel="stylesheet"  href="https://fonts.googleapis.com/css?family=Roboto">

	<!-- Add jQuery library -->
	<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>

	<!-- Add mousewheel plugin (this is optional) -->
	<script type="text/javascript" src="js/jquery.mousewheel.pack.js?v=3.1.3"></script>

	<!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="js/jquery.fancybox.pack.js?v=2.1.5"></script>
	<link rel="stylesheet" type="text/css" href="css/jquery.fancybox.css?v=2.1.5" media="screen" />

	<!-- Add Button helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="css/jquery.fancybox-buttons.css?v=1.0.5" />
	<script type="text/javascript" src="js/jquery.fancybox-buttons.js?v=1.0.5"></script>


	<script type="text/javascript">
		$(document).ready(function() {
			/*
			 *  Simple image gallery. Uses default settings
			 */

			$('.fancybox').fancybox();

			/*
			 *  Different effects
			 */

			// Change title type, overlay closing speed
			$(".fancybox-effects-a").fancybox({
				helpers: {
					title : {
						type : 'outside'
					},
					overlay : {
						speedOut : 0
					}
				}
			});

			// Disable opening and closing animations, change title type
			$(".fancybox-effects-b").fancybox({
				openEffect  : 'none',
				closeEffect	: 'none',

				helpers : {
					title : {
						type : 'over'
					}
				}
			});

			// Set custom style, close if clicked, change title type and overlay color
			$(".fancybox-effects-c").fancybox({
				wrapCSS    : 'fancybox-custom',
				closeClick : true,

				openEffect : 'none',

				helpers : {
					title : {
						type : 'inside'
					},
					overlay : {
						css : {
							'background' : 'rgba(238,238,238,0.85)'
						}
					}
				}
			});

			// Remove padding, set opening and closing animations, close if clicked and disable overlay
			$(".fancybox-effects-d").fancybox({
				padding: 0,

				openEffect : 'elastic',
				openSpeed  : 150,

				closeEffect : 'elastic',
				closeSpeed  : 150,

				closeClick : true,

				helpers : {
					overlay : null
				}
			});

			/*
			 *  Button helper. Disable animations, hide close button, change title type and content
			 */

			$('.fancybox-buttons').fancybox({
				openEffect  : 'none',
				closeEffect : 'none',

				prevEffect : 'none',
				nextEffect : 'none',

				closeBtn  : false,

				helpers : {
					title : {
						type : 'inside'
					},
					buttons	: {}
				},

				afterLoad : function() {
					this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
				}
			});




		});
	</script>
	<style type="text/css">

		.fancybox-custom .fancybox-skin {
			box-shadow: 0 0 150px #222;
		}

		body {
			font-family: 'Roboto','Arial', sans-serif;
			max-width: 700px;
			margin: 0 auto;
			background-color: #ffffee;
		}
		input, textarea, select,button{font-family:inherit;}
		.container{
			padding-bottom: 30px
		}
		.footer{

			position: fixed;
  			bottom: 0; 
  			width: 700px;
  			background-color: #ffffee;
		}
		
	</style>
</head>
<body>
<div class="container">
<h1>Image Gallery</h1>

<center>
<?php 
define('IMAGEPATH', 'uploads/');
$gambar=array();
foreach(glob(IMAGEPATH.'*') as $filename){
    $gambar[] = $filename;
}
$no=0;
foreach ($gambar as $key => $value) {
	$no++;
	if($no==1){ echo "<p>
		";	}
	echo '<a class="fancybox-buttons" data-fancybox-group="button" href="'.$value.'"><img src="'.$value.'" alt="" width="150px" height="150px" /></a>'."
	";
	if($no==3){ $no=0; echo "</p>
	";	}
}
 ?>
 
</center>

</div>
<div class="footer">
	<hr>
	<form action="" method="post" enctype="multipart/form-data">
		<input type="file" name="file" id="fileToUpload" required/>
		<button type="submit" name="upload" value="upload">Upload</button>
		<button type="reset" name="reset" value="reset">Reset</button>
	</form>
	<br>
</div>
</body>
</html>