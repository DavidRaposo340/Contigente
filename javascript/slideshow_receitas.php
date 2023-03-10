<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
      * {box-sizing: border-box}
      .mySlides {display: none}
      img {vertical-align: middle;
        width: 100%;
        max-height: 750px;
        object-fit: contain;}

      /* Slideshow container */
      .slideshow-container {
        max-width: 1000px;
        position: relative;
        margin: auto;
        padding: 30px;
      }

      /* Next & previous buttons */
      .prev, .next {
        cursor: pointer;
        position: absolute;
        top: 50%;
        width: auto;
        padding: 16px;
        margin-top: -22px;
        color: white;
        font-weight: bold;
        font-size: 18px;
        transition: 0.6s ease;
        border-radius: 0 3px 3px 0;
        background-color: #ff8e2b;
        user-select: none;
        
      }

      /* Position the "next button" to the right */
      .next {
        right: 30px;
        border-radius: 3px 0 0 3px;
      }

      /* On hover, add a black background color with a little bit see-through */
      .prev:hover, .next:hover {
        background-color: rgba(0,0,0,0.8);
      }

      /* Caption text */
      .text {
        color: #f2f2f2;
        font-size: 15px;
        padding: 8px 12px;
        position: absolute;
        bottom: 8px;
        width: 100%;
        text-align: center;
      }

      /* Number text (1/3 etc) */
      .numbertext {
        color: #f2f2f2;
        font-size: 12px;
        padding: 8px 12px;
        position: absolute;
        top: 0;
      }

      /* The dots/bullets/indicators */
      .dot {
        cursor: pointer;
        height: 15px;
        width: 15px;
        margin: 0 2px;
        background-color: #bbb;
        border-radius: 50%;
        display: inline-block;
        transition: background-color 0.6s ease;
      }

      .dot:hover {
        background-color: #e0eaf5; 
        color: rgb(0, 0, 0);
      }

      /* Fading animation */
      .fade {
        animation-name: fade;
        animation-duration: 1.5s;
      }

      @keyframes fade {
        from {opacity: .4} 
        to {opacity: 1}
      }

    </style>
  </head>
  <body>

    <div class="slideshow-container">

    <div class="mySlides fade">
      <div class="numbertext">1 / 4</div>
      <a href="paginas_form/receita/listar_receita_info.php?id=3" >
        <img src="images/receitas/bolo.png">
      </a>
      <div class="text">Caption 1</div>
    </div>

    <div class="mySlides fade">
      <div class="numbertext">2 / 4</div>
      <a href="paginas_form/receita/listar_receita_info.php?id=4" >
       <img src="images/receitas/muffins.png">
      </a>
      <div class="text">Caption 2</div>
    </div>

    <div class="mySlides fade">
      <div class="numbertext">3 / 4</div>
      <a href="paginas_form/receita/listar_receita_info.php?id=2" >
        <img src="images/receitas/onepot.png">
      </a>
      <div class="text">Caption 3</div>
    </div>
    <div class="mySlides fade">
      <div class="numbertext">4 / 4</div>
      <a href="paginas_form/receita/listar_receita_info.php?id=1" >
        <img src="images/receitas/bolonhesa.png">
      </a>
      <div class="text">Caption 4</div>
    </div>

    <a class="prev" onclick="plusSlides(-1)">???</a>
    <a class="next" onclick="plusSlides(1)">???</a>

    </div>
    <br>

    <div style="text-align:center">
      <span class="dot" onclick="currentSlide(1)"></span> 
      <span class="dot" onclick="currentSlide(2)"></span> 
      <span class="dot" onclick="currentSlide(3)"></span> 
      <span class="dot" onclick="currentSlide(4)"></span> 
    </div>

    <script>
    let slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
      showSlides(slideIndex += n);
    }

    function currentSlide(n) {
      showSlides(slideIndex = n);
    }

    function showSlides(n) {
      let i;
      let slides = document.getElementsByClassName("mySlides");
      let dots = document.getElementsByClassName("dot");
      if (n > slides.length) {slideIndex = 1}    
      if (n < 1) {slideIndex = slides.length}
      for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";  
      }
      for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
      }
      slides[slideIndex-1].style.display = "block";  
      dots[slideIndex-1].className += " active";
    }
    </script>

  </body>
</html> 