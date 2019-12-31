
<!--Formulario de compra-->
<div class="container" id="compra">
<form  method="post" action="intro.php"  >
    <div class="form-row">
        <div class="form-group col-md-6"> 
            <label for="inputEmail4">Nº client</label>
                     
            <input type="text" class="form-control" id="client" name="cliente" placeholder="Introdueix nombre de client">
   
        </div>
    </div>
    
    <div class="form-row" >

        <div class="form-group col-md-4">
            <label for="inputState">Producte</label>     

            <select class="form-control" name="producte[]">
                <?php
         require_once('conector.php');
          $consulta = $link->prepare('SELECT * FROM producte');
          $consulta->execute();
        
          while($row2 = $consulta->fetch(PDO::FETCH_ASSOC)){        
                ?>
                <option value="<?php echo $row2['nombre_producte']; ?>">
                    <?php echo "<b>".$row2['nombre_producte']."</b>"; ?>
                </option>
                <?php    
          }
          ?>
            </select>
        </div>
        <div class="form-group col-md-2">
            <label for="inputZip">Unitats</label>
            <input type="text" class="form-control" id="inputZip" name="cantidad" placeholder="introduix cuantitat">
        </div>
    </div>
    <button type="submit" class="btn btn-primary" name="comprarProducte">Comprar</button><br><br><a id='m'> </a>
</form>
</div>

<!-- formulario de stock-->

<div class="container" id="stock">
   <?php
   $stmt = $link->prepare('SELECT * from producte');
$stmt->execute();?>
  <h1>Stock</h1>
   <div class="table-responsive">
       <table id="taulaResultat" class="table table-responsive table-bordered table-striped">
        <thead>
        <th>Id</th>
        <th>Stock</th>
        <th>Preu Unitat</th>
        <th>Producte</th>
        </thead>
        <tbody>
        <?php
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            
            echo "<form  method='post' action='intro.php'>";         
            $stockActual=$row['stock_act'];
            $idP=$row['id_producte']; 
            print("<tr>");
            print("<td>$idP</td>");
            print("<td>
            <input type='hidden' name='stockA' value='$stockActual'>
            <input type='hidden' name='idPr' value='$idP'>
            <button class='btn' type='submit' name='sumaStock'>+1</button>  $stockActual</td>");
            print("<td>".$row['preu']."</td><td>".$row['nombre_producte']."</td><tr>");    
            echo "</form>";
        }
            if(isset($_POST['torn'])){
                header("Location:intro.php");
            }
   
        ?>
        </tbody>
    </table>
</div>   
    <form  method="post" action="intro.php">
    <button type="submit" class="btn btn-primary" name="torn">Torna</button>
    </form>
</div>


<!-- formulario de insertar-->


<div class="container" id="insert">
   <h1>Afegir nou producte</h1>
<form method="post" action="intro.php">
       <div class="form-row" >
    <div class="form-group col-md-4">
        <label for="producto">Producte</label>
        <input type="text" class="form-control" id="product" name="produc" placeholder="Descripció del producte">
    </div>
    <div class="form-group col-md-2">
        <label for="unitats">Unitats</label> 
        <input type="text" name="canti" class="form-control" id="unitats" placeholder="nº de unitats"></div>
    <div class="form-group col-md-2">
        <label for="preu">Preu</label>
        <input type="text" name="pr" class="form-control" id="preu" placeholder="€"></div>
    </div>
    <div class="form-group col-md-12">
    <input type="submit" class="btn btn-primary" name="afegir" value="Insertar">
    </div>
</form>
</div>








