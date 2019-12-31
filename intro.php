
<?php

require_once('conector.php');

$stmt = $link->prepare('SELECT a.*,ad.*,p.* from albara a , albara_detall ad,producte p  where a.id_venta = ad.rid_venda and ad.rid_prod=p.id_producte');
$stmt->execute();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/ico" href="phpThumb_generated_thumbnailico"/>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css" />
    <script src="script/fancyTable.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#taulaResultats").fancyTable({
                pagination: true,
                globalSearchExcludeColumns: [2, 5],
                searchable: false
            });
        });
    </script>

    <title>ALBARANS</title>
</head>

<body>
    <div class="container-fluid">
        <h1>Llistat d'albarans</h1>
        <table id="taulaResultats" class="table table-responsive table-bordered table-striped">
            <thead>
                <th>Id</th>
                <th>Data</th>
                <th>Descripció</th>
                <th>Client</th>
                <th>Quantitat</th>
                <th>Preu unitari</th>
                <th>Preu total+IVA</th>
                <th>Informació</th>
                <th>opció</th>
            </thead>
            <tbody>
                <?php
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            echo "<form action='intro.php' method='post'>";
        
                  if($row['tipus_mov']=="V"){
                $info="venta";
            }else{
                $info="devolució";
            }
   
            $cliente=$row['rid_client'];
            $idVenta=$row['id_venta'];
            print("<tr>");
            print("<td>$idVenta</td>");
            print("<td>".$row['dia']."</td>");
            print("<td>".$row['nombre']."</td><td>$cliente</td>");
            print("<td>".$row['unitats']."</td><td>".$row['preu']."€</td><td>".$row['preu_total_iva']."€</td><td>$info</td><td>
            <input type='hidden' name='mov' value='".$row['tipus_mov']."'>
            <input type='hidden' name='idV' value='".$row['id_venta']."'>
            <input type='hidden' name='sto' value='".$row['stock_act']."'>
            <input type='hidden' name='un' value='".$row['unitats']."'>
            <input type='hidden' name='idP' value='".$row['id_producte']."'>
            <button id='deli' type='submit' class='btn' name='devol'>devolució</button></td><tr></form>");      
        }
        ?>
            </tbody>
        </table>

        <div class="container pull-left">
            <div class="panel-body">
                <form action="intro.php" method="post">
                    <input class="btn  btn-lg btn" type="submit" name="tornar" value="Inici">
                    <input class="btn  btn-lg btn" type="submit" name="insertar" value="Insertar producte" >
                    <input class="btn  btn-lg btn" type="submit" name="comprar" value="Comprar">
                    <input class="btn  btn-lg btn" type="submit" name="stock" value="Stock de productes" id="st">
                </form>
            </div>
        </div>

        <table class="table" id="mensaje"></table>

        <!--Gestión de albaranes-->
        <?php
    if(isset($_POST['tornar'])){// tornada al menu 
          echo "<script>location.href='index.php'</script>";
    }else if(isset($_POST['insertar'])){//form de afegir producte
        echo "<script>location.href='index.php?insertar'</script>";
    }else if(isset($_POST['devol'])){//torna el producte al stock
        $mo=$_POST['mov'];
        $sto=$_POST['sto'];    
        $uni=$_POST['un'];
        $idV= $_POST['idV'];
        $idProduc=$_POST['idP']; 
        $stockActual=$sto+$uni;
        if($mo=="D"){
            echo "<p><b>Ya s'ha fet la devolucio</b></p>";
        }else{
        $stmt = $link->prepare("UPDATE albara_detall SET tipus_mov='D' WHERE rid_venda=? and tipus_mov=?");
        $resultat = $stmt->execute([$idV,"V"]);
        $stmt = $link->prepare("UPDATE producte SET stock_act=? WHERE id_producte=?");
        $resultat = $stmt->execute([$stockActual,$idProduc]);
        echo "<script>location.href='intro.php?devolucio=$stockActual'</script>"; 
        }
       
    }else if(isset($_POST['stock'])){// llistat stock
        echo "<script>location.href='index.php?stock'</script>";
    }else if(isset($_POST['sumaStock'])){// +1 al stock seleccionat
        $idP=$_POST['idPr'];
        $stockActual=$_POST['stockA'];
        $stockActualSuma=$stockActual+1;
        $stmt = $link->prepare("UPDATE producte SET stock_act=? WHERE id_producte=?");
        $resultat = $stmt->execute([$stockActualSuma,$idP]);
        echo "<script>location.href='index.php?stock'</script>";
        }else if(isset($_POST['afegir'])){//afegir producte
        $stock=$_POST['canti'];
        $precio=$_POST['pr'];
        $descripcion=$_POST['produc'];
        $stmt = $link->prepare("INSERT INTO producte(stock_act,preu,nombre_producte) VALUES ( ?, ?, ?)");
        $resultat = $stmt->execute([$stock,$precio,$descripcion]);
         echo "<script>location.href='index.php?stock'</script>";
    }else if(isset($_POST['comprar'])){// comprar producte
        echo "<script>location.href='index.php?comprar'</script>";
    }else if(isset($_POST['comprarProducte'])){ //confirmar compra      
        $r= implode($_POST['producte']);
        $unidades=$_POST['cantidad'];
        $cliente=$_POST['cliente'];
        $stmt = $link->prepare("SELECT * from producte where nombre_producte=?");
        $stmt->execute([$r]); 
        $p= $stmt->fetch();
        $stock=$p['stock_act'];
        $id_producte=$p['id_producte'];
        $pre=$p['preu'];
        $total= $pre*$unidades; 
        $precioIva = ($total*21/100);
        $precioNormalizado = floatval(sprintf("%.2f",$precioIva));
        $precioTotal=$precioNormalizado+$total;
        
        ?>
        <form action="intro.php" method="post">
            <input type="hidden" name="stoc" value="<?php echo $stock;?>">
            <input type="hidden" name="idProducto" value="<?php echo $id_producte;?>">
            <input type="hidden" name="produ" value="<?php echo $r;?>">
            <input type="hidden" name="client" value="<?php echo $cliente;?>">
            <input type="hidden" name="uni" value="<?php echo $unidades;?>">
            <input type="hidden" name="preuUni" value="<?php echo $pre;?>">
            <input type="hidden" name="preuTotal" value="<?php echo $total;?>">
            <input type="hidden" name="preuTotalIva" value="<?php echo $precioTotal;?>">
            <input class="btn btn-primary" id="conf" type="submit" name="confir" value="Confirmació" style="display:none">
        </form>

        <?php
       
        print "<script>document.getElementById('mensaje').innerHTML=  '<thead><tr> <th>Producte</th><th>Client</th><th>Unitats</th><th>Preu Unitat</th><th>Preu Total</th><th>Preu Total + IVA</th></tr></thead><tbody><tr><td>$r</td><td>$cliente</td><td>$unidades</td><td>$pre €</td><td>$total €</td><td>$precioTotal €</td></tr></tbody> '
        document.getElementById('conf').style.display='block';
        document.getElementById('conf2').style.display='block';
        </script>";     
    }else if(isset($_POST['confir'])){
        $producto= $_POST['produ'];
        $cliente= $_POST['client'];
        $unidades= $_POST['uni'];
        $precioUnidad= $_POST['preuUni'];
        $precioTotal= $_POST['preuTotal'];
        $precio_Iva= $_POST['preuTotalIva'];
        $stockVenta=$_POST['stoc'];
        $idProducto=$_POST['idProducto'];
//        echo $producto."<br>".$cliente."<br>".$unidades."<br>".$precioUnidad."<br>".$precioTotal."<br>".$precio_Iva."<br>".$idProducto."<br>".$stockVenta;
        $stmt = $link->prepare("INSERT INTO albara(rid_client,nombre) VALUES ( ?, ?)");
        $resultat = $stmt->execute([$cliente, $producto]);
        $ids = $link->lastInsertId();
        $stmt = $link->prepare("INSERT INTO albara_detall(rid_venda,rid_prod,unitats,preu_total_iva,tipus_mov) VALUES ( ?, ?, ?, ?, ?)");
        $resultat = $stmt->execute([$ids, $idProducto, $unidades, $precio_Iva,"V"]);
        $totalStock=$stockVenta-$unidades;
        $stmt = $link->prepare("UPDATE producte  SET stock_act=? where id_producte=?");
        $resultat = $stmt->execute([$totalStock, $idProducto]);
        echo "<script>location.href='intro.php'</script>";
    }
?>
    </div>

</body>

</html>