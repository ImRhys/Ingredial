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
      <h3 id="recipes-main-header">Welcome text.</h3>
      <p id="recipes-main-description" class="maininfo"></p>
    </div>

    <div class="col-md-9 col-centered table-bordered recipes" id="recipes-data"> <!-- Auto generated -->
      <hr>
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

    function generateRecipeHTML(Data) {
      var imageURL = Data.PhotoUrl;
      var title = Data.Title;
      var description = Data.Title;
      var recipeID = Data.RecipeID;

      //Written horribly due to some browsers adding unneeded whitespace.. you know who you are *cough* IE *cough*.
      return ""
        + "<div class='media'>"
        + "<div class='media-left'> <!-- Food image --><a href='#'><img class='media-object force-resize' src='" + imageURL + "' alt='" + title + "'></a></div>"
        + "<div class='media-body'>"
        + "<h4 class='media-heading'>" + title + "</h4> <!-- Dish name -->"
        + "<p class='text-justify'>" + description + "</p> <!-- Dish description -->"
        + "<button type='button' class='btn btn-default body-buttons' recipeid='" + recipeID + "'>Recipe</button>"
        + "<button type='button' class='btn btn-default body-buttons' recipeid='" + recipeID + "'>More Information</button>"
        + "<div class='col-sm-12 table-bordered'>"
        + "</div></div></div>"
        ;
    }

    function processRecipes(Data) {
      //$("#recipes-main").fadeOut(500).fadeIn(500);
      $("#recipes-main-header").html("Hurray!");
      $("#recipes-main-description").html("We found you some dishes for your selection...");
      if (Data.Results.length > 0) {
        $("#recipes-data").html("<hr>"); //Clear it out before repopulating

        var i;
        for (i = 0; i < Data.Results.length; ++i) {
          $("#recipes-data").append(generateRecipeHTML(Data.Results[i]));
        }
      }
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
        $("#recipes-main").fadeIn(500);
        $("#recipes-main-header").html("Processing...");
        $("#recipes-main-description").html("Please wait whilst we try and find you some tasty dishes!");
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