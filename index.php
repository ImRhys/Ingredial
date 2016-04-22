<!DOCTYPE HTML>

<html>
<head>
	<title>Ingredial</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/magicsuggest-min.css" rel="stylesheet">
	<link href="css/override.css" rel="stylesheet">

    <link rel="shortcut icon" href="favicon.ico" />
</head>


<body>

<div id="splashscreen">
    <h2>Welcome to Ingredial!</h2>
    Throw in any ingredients you've got in your cupboard to find a tasty recipe!

    <a href="#" class="enter_link">Enter on the website</a>
</div>

<a href="tempsecond.php">Example search.</a>

<div class="container">
	<div class="col-sm-6 col-centered offset-top">
		<img src="img/logo.png" class="img-responsive" id="main-logo" alt="Main logo" />
        <div class="form-group">
            <form id="searchf" method="get" action="">
                <input class="form-control" id="ms-scrabble">
                <div class="center-block main-buttons-group">
                    <button type="button" class="btn btn-default main-buttons" onclick="" style="margin-right: 5px">Search</button>
                    <button type="button" class="btn btn-default main-buttons" onclick="">Surprise Me</button>
                </div>
            </form>
        </div>
	</div>
</div>

<script src="js/jquery-2.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/magicsuggest-min.js"></script>

<script>
	$(function() {
		$('#ms-scrabble').magicSuggest({
			placeholder: 'What do you have to hand?',
			data: ['Banana', 'Apple', 'Orange', 'Lemon']
		});
	});

    function submitf() {
        $('#searchf').submit();
    }

    $('.enter_link').click(function() {
        $(this).parent().fadeOut(500);
    });
</script>
</body>
</html>