<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/ico" href="phpThumb_generated_thumbnailico"/>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 

    <title>ALBARANS</title>

</head>

<body>
    <!-- Capçelera de la página -->
    <div class="container-fluid jumbotron">
        <div class="container">
            <div class="text-center">
                <h2> GESTIÓ D'ALBARANS</h2>
                <i class="fas fa-fingerprint fa-5x"></i>
                <br>
            </div>
            <form action="intro.php" method="post">
                <div class="text-center">
                    <input class="btn btn-primary" type="submit" name="login" value="ACCEDIR" id="btnA">
                </div>
            </form>
        </div>

    </div>
   
    <div class="container-fluid">
        <?php
        if(isset($_GET['insertar'])){

            include("function.php");
             echo "<script>
document.getElementById('stock').style.display='none';
document.getElementById('insert').style.display='block';
document.getElementById('compra').style.display='none';
document.getElementById('btnA').setAttribute('value', 'tornar');
</script>";
        }
            if(isset($_GET['comprar'])){

            include("function.php");
                           echo "<script>
document.getElementById('btnA').setAttribute('value', 'tornar');                          
document.getElementById('stock').style.display='none';
document.getElementById('insert').style.display='none';
document.getElementById('compra').style.display='block';
</script>";
            }
          if(isset($_GET['stock'])){
              
           include("function.php");
              echo "<script>
document.getElementById('stock').style.display='block';
document.getElementById('compra').style.display='none';
document.getElementById('insert').style.display='none';
document.getElementById('btnA').style.display='none';
</script>";
        }
        ?>
    </div>
     <div class="container">
        
        <img class="image-responsive" alt="albaran" src="albaran.jpg" style="width:40%" id="alb">
    </div>
</body>

</html>


   <script>
        $(document).ready(function() {
$("#client").keyup(function(){
if ($("#client").val().length < 1) { document.getElementById('m').innerHTML="introdueix nombre" }else if(isNaN($("#client").val())) { document.getElementById('m').innerHTML="No lletres" } })         
        setTimeout(function(){
					$('#alb').animate({width: "-=100px"}),
					$('#alb').animate({height: "-=150px"}),
					$('#alb').animate("float", "left"),
					$('#alb').css("transform", "rotateZ(0deg)")
					}, 500);
             setTimeout(function(){
					$('#alb').css("float", "right"),
                    $('#alb').css("margin-right", "30%"),
					$('#alb').css("transform", "rotateZ(2deg)")
					}, 1000);  

        });

    </script>