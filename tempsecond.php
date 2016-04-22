<html>
<head>
    <title>Ingredial - Search</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/magicsuggest-min.css" rel="stylesheet">
    <link href="css/override.css" rel="stylesheet">

    <link rel="shortcut icon" href="favicon.ico" />
</head>
<body>

<div class="recipescontainer">
    <div class="col-sm-6 col-centered offset-top">
        <img src="img/logo.png" class="img-responsive" id="main-logo" alt="Main logo" />
        <div class="form-group">
            <form id="searchf" method="get" action="">
                <input class="form-control" id="ms-scrabble">
                <div class="center-block main-buttons-group">
                    <button type="button" class="btn btn-default main-buttons" onclick="">Search</button>
                    <button type="button" class="btn btn-default main-buttons" onclick="">Surprise Me</button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-9 col-centered table-bordered">
        <h3>Welcome text.</h3>
        <p class="maininfo">Lorem ipsum dolor sit amet, brute nonumes eum in, mea nibh debet phaedrum at. Sit perfecto oportere qualisque ex! Modus debet elitr cu vim, ei eripuit dignissim dissentias vix, vis eros similique eu! Has voluptatum accommodare ex. Impetus tritani labitur sed ad, mel id illud ridens dolorem.</p>
    </div>

    <div class="col-md-9 col-centered table-bordered">
        <hr>
        <div class="media">
            <div class="media-left">
                <a href="#">
                    <img class="media-object force-resize" src="http://foodnetwork.sndimg.com/content/dam/images/food/fullset/2006/9/22/0/ig0707_potato_salad1.jpg" alt="...">
                </a>
            </div>
            <div class="media-body">
                <h4 class="media-heading">Potato Salad</h4>
                <p class="text-justify">Dish information, Lorem ipsum dolor sit amet, brute nonumes eum in, mea nibh debet phaedrum at. Sit perfecto oportere qualisque ex! Modus debet elitr cu vim, ei eripuit dignissim dissentias vix, vis eros similique eu! Has voluptatum accommodare ex. Impetus tritani labitur sed ad, mel id illud ridens dolorem.</p>
                <button type="button" class="btn btn-default body-buttons">Recipe</button>
                <button type="button" class="btn btn-default body-buttons">More Information</button>
            </div>
        </div>

        <div class="media">
            <div class="media-left">
                <a href="#">
                    <img class="media-object force-resize" src="http://www.nodietsallowed.com/wp-content/uploads/2015/04/sausage-stew-recipe-No-Diets-Allowed.jpg" alt="...">
                </a>
            </div>
            <div class="media-body">
                <h4 class="media-heading">Carrot Stew</h4>
                <p class="text-justify">Dish information, Lorem ipsum dolor sit amet, brute nonumes eum in, mea nibh debet phaedrum at. Sit perfecto oportere qualisque ex! Modus debet elitr cu vim, ei eripuit dignissim dissentias vix, vis eros similique eu! Has voluptatum accommodare ex. Impetus tritani labitur sed ad, mel id illud ridens dolorem.</p>
                <button type="button" class="btn btn-default body-buttons">Recipe</button>
                <button type="button" class="btn btn-default body-buttons">More Information</button>
                <div class="col-sm-12 table-bordered">
                    <h4>Ingredients</h4>
                    <ul>
                        <li>Carrots</li>
                        <li>More Carrots</li>
                        <li>Even More Carrots</li>
                        <li>Extra Line</li>
                        <li>Extra Line</li>
                        <li>Extra Line</li>
                    </ul>

                    <h4>Preparation</h4>
                    <ol>
                        <li>Blow carrots up with high explosives.</li>
                        <li>Put remains in pot.</li>
                        <li>Boil.</li>
                        <li>Hope for the best.</li>
                        <li>Eat.</li>
                    </ol>

                    <h4>Nutrition</h4>
                    <ol>
                        <li>Contains 1000000 calories</li>
                        <li>Contains carrots</li>
                        <li><b>May contain nuts</b></li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="media">
            <div class="media-left">
                <a href="#">
                    <img class="media-object force-resize" src="http://www.globalmeatnews.com/var/plain_site/storage/images/publications/food-beverage-nutrition/globalmeatnews.com/industry-markets/first-test-tube-burger-to-be-unveiled/8308222-1-eng-GB/First-test-tube-burger-to-be-unveiled.jpg" alt="...">
                </a>
            </div>
            <div class="media-body">
                <h4 class="media-heading">Simple Burger</h4>
                <p class="text-justify">Dish information, Lorem ipsum dolor sit amet, brute nonumes eum in, mea nibh debet phaedrum at. Sit perfecto oportere qualisque ex! Modus debet elitr cu vim, ei eripuit dignissim dissentias vix, vis eros similique eu! Has voluptatum accommodare ex. Impetus tritani labitur sed ad, mel id illud ridens dolorem.</p>
                <button type="button" class="btn btn-default body-buttons">Recipe</button>
                <button type="button" class="btn btn-default body-buttons">More Information</button>
            </div>
        </div>
    </div>

    <div class="col-md-9 col-centered">
        <hr>
        <p class="footer">Copyright &copy; 2016 ingredial.domain.bla - All Rights Reserved</p>
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
</script>
</body>
</html>