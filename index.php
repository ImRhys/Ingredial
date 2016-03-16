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
    <h1>Hello world.</h1>
         <div class="form-group">
            <label>Scrabble box</label>
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