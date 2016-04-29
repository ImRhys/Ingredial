<!DOCTYPE HTML>
<!-- If dolphins could fly would they fly into space on a majestic rocketship? -->
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
  Throw any ingredients you've got in your cupboard into the search bar to find a tasty recipe!
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

    <div class="col-md-9 col-centered table-bordered recipes" id="recipes-data"><!-- Auto generated --></div>

    <div class="col-md-9 col-centered">
      <hr>
      <p class="footer">Copyright &copy; 2016 ingredial.azurewebsites.net - All Rights Reserved</p>
    </div>
  </div>
</div>

<!-- I bet Dr Isaacs 5-3 with Derry City whilst he was playing with Bayern Munich on FIFA 15 -->

<script src="js/jquery-2.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/magicsuggest-min.js"></script>

<script>
  var apiKey = "VHSkzCuPFNh8WLb3Rc9UHy7pP1vLI5dI";

  $(function () {

    var ms = $('#ms-scrabble').magicSuggest({
      placeholder: 'What do you have to hand?',
      data: [],
      required: true
    });

    function generateRecipeHTML(Data) {
      var imageURL = Data.PhotoUrl;
      var title = Data.Title;
      var recipeID = Data.RecipeID;
      var webURL = Data.WebURL;

      //Written horribly due to some browsers adding unneeded whitespace.. you know who you are *cough* IE *cough*.
      return ""
        + "<div class='media'>"
        + "<div class='media-left'> <!-- Food image --><a href='#'><img class='media-object force-resize' src='" + imageURL + "' alt='" + title + "'></a></div>"
        + "<div class='media-body'>"
        + "<h4 class='media-heading'>" + title + "</h4> <!-- Dish name -->"
        + "<button type='button' class='btn btn-default body-buttons button-r' recipeid='" + recipeID + "'>Recipe</button>"
        + "<button type='button' class='btn btn-default body-buttons button-mi' recipeid='" + recipeID + "' weburl='" + webURL + "'>More Information</button>"
        + "<div class='col-sm-12 table-bordered' id='" + recipeID + "'></div></div></div>"
        ;
    }

    function processRecipes(Data) {
      $("#recipes-data").html(""); //Clear it out

      if (Data.Results.length > 0) {
        $("#recipes-main-header").html("Hurray!");
        $("#recipes-main-description").html("We found something! Take a look below!");
        $("#recipes-data").html("<hr>"); //Add a nice line!
        var i;
        for (i = 0; i < Data.Results.length; ++i) {
          $("#recipes-data").append(generateRecipeHTML(Data.Results[i]));
        }
      } else {
        $("#recipes-main-header").html("Boo..");
        $("#recipes-main-description").html("We didn't managed to find anything that matches your selections.. we're sorry.");
      }
      registerBClicks();
    }

    function generateRecipeDetails(Data) {
      //Generate Ingredients list
      var Ingredients = "<ul>";
      var i;
      for (i = 0; i < Data.Ingredients.length; ++i) {
        Ingredients += "<li>" + Data.Ingredients[i].Name + " (" + Data.Ingredients[i].DisplayQuantity + " " + Data.Ingredients[i].Unit + ")</li>";
      }
      Ingredients += "</ul>";

      //Return template string
      return ""
      + "<p class='text-justify'><i>" + Data.Description + "</i></p>"
      + "<h4>Cuisine</h4>" + Data.Cuisine
      + "<h4>Category</h4>" + Data.Category
      + "<h4>Ingredients</h4>" + Ingredients
      + "<h4>Instructions</h4><p>" + Data.Instructions.replace(/(?:\r\n|\r|\n)/g, '<br />') + "</p>"
      + "<br /><p><b>" + Data.FavoriteCount + " people favourited this recipe.</b></p>"
      ;
    }

    function processRecipe(Data, RecipeID) {
      $("#" + RecipeID).html(generateRecipeDetails(Data));
    }

    // Getting all the recipe data
    function getRecipeData(RecipeID, Target) {
      var url = "http://ingredial.azurewebsites.net/theprox.php?url=https://api2.bigoven.com/recipe/" + RecipeID + "&api_key=" + apiKey;
      $.ajax({
        type: "GET",
        dataType: 'json',
        cache: true,
        url: url,
        success: function (data) {
          processRecipe(data, RecipeID);
          Target.attr("retrieved", "true");
          Target.html("Minimize");
        }
      });
    }

    function getRecipes(RecipeArr) {
      var url = "http://ingredial.azurewebsites.net/theprox.php?url=https://api2.bigoven.com/recipes/&any_kw=" + encodeURIComponent(RecipeArr.toString()) + "&api_key=" + apiKey;
      $.ajax({
        type: "GET",
        dataType: 'json',
        cache: true,
        url: url,
        success: function (data) {
          if (!data.Message) {
            processRecipes(data);
          } else {
            noAPIkeyPrompt();
          }
        }
      });
    }

    function getSuggestions(CurrentStr) {
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

    // To get Random Recipe when button is pressed
    function randomRecipe() {
      fRecipePrompt();
      var url = "http://ingredial.azurewebsites.net/theprox.php?url=https://api2.bigoven.com/recipes/random&api_key=" + apiKey;
      $.ajax({
        type: "GET",
        dataType: 'json',
        cache: true,
        url: url,
        success: function (data) {
          if (!data.Message) {
            getRecipes([data.Title.replace( /(?!\s+$)\s+/g, ", " )]);
          } else {
            noAPIkeyPrompt();
          }
        }
      });
    }

    // If no API key is found, prompt for API Key
    function noAPIkeyPrompt() {
      alert("Please set the API key!");
    }

    function fRecipePrompt() {
      $("#recipes-main").fadeIn(500);
      $("#recipes-main-header").html("Processing...");
      $("#recipes-main-description").html("Please wait whilst we try and find you some tasty dishes!");
    }

    function submitf() {
      fRecipePrompt();
      getRecipes(ms.getValue());
    }

    //Submit button
    $('#submit').click(function () {
      submitf();
    });

    //Random recipe button
    $('#randomr').click(function () {
      randomRecipe();
    });

    //Recipe and more info buttons
    function registerBClicks() {
      $('.button-r').click(function (e) {
        if ($(e.target).attr("retrieved") && $(e.target).attr("retrieved") == "true") {
          $("#" + $(e.target).attr("recipeid")).fadeToggle(500); //Already there so no need to get it again
          if ($(e.target).html() == "Minimize") {
            $(e.target).html("Maximize");
          } else {
            $(e.target).html("Minimize");
          }
        } else {
          $(e.target).html("Loading...");
          getRecipeData($(e.target).attr("recipeid"), $(e.target)); //Populate the data
        }
      });

      $('.button-mi').click(function (e) {
        window.open($(e.target).attr("weburl"), '_blank');
      });
    }

    var counter = 3;
    $(ms).on('keyup', function (e, m, v) {
      if (ms.getRawValue().length > 2) { //BigOven won't accept query lower than three chars
        counter++;
        if (counter > 1) { //Cut our calls in half
          getSuggestions(ms.getRawValue());
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
