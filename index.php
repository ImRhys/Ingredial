<html>
<head>
    <title>Ingredial</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/magicsuggest-min.css" rel="stylesheet">
    <link href="css/override.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <div class="col-sm-6 col-centered offset-top">
        <img src="img/logo.png" class="img-responsive" id="main-logo" alt="Main logo" />
         <div class="form-group">
            <input class="form-control" id="ms-scrabble">
        </div>
    </div>
</div>

<script src="js/jquery-2.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/magicsuggest-min.js"></script>

<script>
    $(function() {
        $('#ms-scrabble').magicSuggest({
            placeholder: 'Type some real or fake fruits',
            data: ['Banana', 'Apple', 'Orange', 'Lemon']
        });
    });
</script>
</body>
</html>