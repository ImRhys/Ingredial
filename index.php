<!DOCTYPE HTML>

<html>
<head>
  <title>Ingredial</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/magicsuggest-min.css" rel="stylesheet">
  <link href="css/override.css" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>

  <link rel="shortcut icon" href="favicon.ico"/>
</head>
<body class="body-start">

<div id="splashscreen">
  <h1>Welcome to Ingredial!</h1>
  Throw in any ingredients you've got in your cupboard to find a tasty recipe!
  <br/>
  <br/>
  <a href="#" class="enter_link">Enter the website</a>
</div>

<div class="container blur ease" id="main-search">
  <div class="col-sm-6 col-centered offset-top">
    <img src="img/logo.png" class="img-responsive" id="main-logo" alt="Main logo"/>

    <div class="form-group">
      <form id="searchf" method="get" action="" onsubmit="return false;">
        <input class="form-control" id="ms-scrabble">

        <div class="center-block main-buttons-group">
          <button type="button" class="btn btn-default main-buttons" id="submit" style="margin-right: 5px">Search
          </button>
          <button type="button" class="btn btn-default main-buttons" id="randomr">Surprise Me</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Recipes -->
  <div id="recipes-main" style="display: none;">
    <div class="col-md-9 col-centered table-bordered recipes">
      <h3>Welcome text.</h3>

      <p class="maininfo">Lorem ipsum dolor sit amet, brute nonumes eum in, mea nibh debet phaedrum at. Sit perfecto
        oportere qualisque ex! Modus debet elitr cu vim, ei eripuit dignissim dissentias vix, vis eros similique eu! Has
        voluptatum accommodare ex. Impetus tritani labitur sed ad, mel id illud ridens dolorem.</p>
    </div>

    <div class="col-md-9 col-centered table-bordered recipes">
      <hr>

      <div class="media">
        <div class="media-left"> <!-- Food image -->
          <a href="#">
            <img class="media-object force-resize" src="" alt="">
          </a>
        </div>
        <div class="media-body">
          <h4 class="media-heading"></h4> <!-- Dish name -->
          <p class="text-justify"></p> <!-- Dish description -->
          <button type="button" class="btn btn-default body-buttons">Recipe</button>
          <button type="button" class="btn btn-default body-buttons">More Information</button>
          <div class="col-sm-12 table-bordered">

          </div>
        </div>
      </div>
    </div>

    <div class="col-md-9 col-centered">
      <hr>
      <p class="footer">Copyright &copy; 2016 ingredial.domain.bla - All Rights Reserved</p>
    </div>
  </div>
</div>

<script src="js/jquery-2.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/magicsuggest-min.js"></script>

<script>
  var apiKey = "";

  $(function () {

    var ms = $('#ms-scrabble').magicSuggest({
      placeholder: 'What do you have to hand?',
      data: [],
      required: true
    });

    function processRecipes(Data) {
      $("recipes-main").fadeIn(500);
    }

    function getRecipe(RecipeArr) {
      var url = "http://ingredial.azurewebsites.net/theprox.php?url=https://api2.bigoven.com/recipes/&any_kw=" + encodeURIComponent(RecipeArr.toString()) + "&api_key=" + apiKey;
      $.ajax({
        type: "GET",
        dataType: 'json',
        cache: false,
        url: url,
        success: function (data) {
          if (!data.Message) {
            console.log(data);
            processRecipes(data);
          } else {
            noAPIkeyPrompt();
          }
        }
      });
    }

    function getSuggestion(CurrentStr) {
      var url = "http://ingredial.azurewebsites.net/theprox.php?url=https://api2.bigoven.com/recipe/autocomplete&query=" + CurrentStr + "&limit=10&api_key=" + apiKey;
      $.ajax({
        type: "GET",
        dataType: 'json',
        cache: true,
        url: url,
        success: function (data) {
          if (!data.Message) {
            ms.setData(data);
          } else {
            noAPIkeyPrompt();
          }
        }
      });
    }

    function noAPIkeyPrompt() {
      alert("Please set the API key!");
    }

    function submitf() {
      if (JSON.stringify(ms.getValue()) < 3) {
        //TODO Get random recipe
      } else {
        getRecipe(ms.getValue());
      }
    }

    $('#submit').click(function () {
      submitf();
    });

    $('#randomr').click(function () {
      alert("Random recipe!") //todo
    });

    var counter = 3;
    $(ms).on('keyup', function (e, m, v) {
      if (ms.getRawValue().length > 2) { //BigOven won't accept query lower than three chars
        counter++;
        if (counter > 1) { //Cut our calls in half
          getSuggestion(ms.getRawValue());
          counter = 0;
        }
      }
    });

    $('.enter_link').click(function () {
      $(this).parent().fadeOut(500);
      $('#main-search').toggleClass('blur'); //Using CSS3
    });
  });
</script>
</body>
</html>