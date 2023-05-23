<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- bootstrap links for css and js -->
  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <link rel="stylesheet" href="./js/bootstrap.min.js">

  <!-- font awesome link -->
  <link rel="stylesheet" href="./css/all.css">

  <!-- sweet alert js -->
  <script src="./js/SweetAlert.js"></script>

  <!-- custom css files -->
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./css/utility_classes.css">
  <link rel="stylesheet" href="./css/Navbar.css">
  <link rel="stylesheet" href="./css/LoginAndSignupForm.css">
  <link rel="stylesheet" href="./css/ErrorPage.css">

  <!-- custom js files -->
  <script src="./js/Navbar.js" defer></script>
  <script src="./js/LoginAndSignupForm.js" defer></script>
  <script src="./js/LoginFormValidation.js" defer></script>

  <style>
    .page_404{ padding:40px 0; background:#fff; font-family: 'Arvo', serif;
}

.page_404  img{ width:100%;}

.four_zero_four_bg{
 
    background-image: url('./img/errorPageImg.gif');
    height: 400px;
    background-position: center;
 }
 
 
 .four_zero_four_bg h1{
 font-size:80px;
 }
 
  .four_zero_four_bg h3{
			 font-size:80px;
			 }
			 
			 .link_404{			 
	color: #fff!important;
    padding: 10px 20px;
    background: #39ac31;
    margin: 20px 0;
    display: inline-block;}
	.contant_box_404{ margin-top:-50px;}
  </style>

  <title>Client side</title>
</head>

<body>

  <div>
    <section class="page_404 vh-100">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="col-sm-10 mx-auto col-sm-offset-1 text-center">
              <div class="four_zero_four_bg">
                <h1 class="text-center ">404</h1>
              </div>
              <div class="contant_box_404">
                <h3 class="h2">
                  Look like you're lost
                </h3>
                <p>the page you are looking for not avaible!</p>
                <a class="link_404 btn btn-success" href='index.php'>Go to Home</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <div id="footer" class="bg-grey-333 py-5 w-100 text-white text-center">
    <p class="text-grey-ddd mb-0">&copy; 2023 <a href="" class="link font-weight-500 footer-link">BMCC | Designed and
        Developed by Tybca</a></p>
  </div>
  </div>

</body>

</html>