<?php
session_name("Actividad2_SW_24_25");
session_start();
require "src/funciones_ctes.php";

if(isset($_POST["btnContNuevo"]))
{
    $error_cod=$_POST["cod"]=="" || strlen($_POST["cod"])>12;
    if(!$error_cod)
    {

        $url=DIR_SERV."/repetido/producto/cod/".urlencode($_POST["cod"]);
        $respuesta=consumir_servicios_REST($url,"GET");
        $json_repetido=json_decode($respuesta,true);
        if(!$json_repetido)
        {
            session_destroy();
            die(error_page("Actividad 2","<p>Error consumiendo el servico rest: <strong>".$url."</strong></p>"));
        }

        if(isset($json_repetido["error"]))
        {
            session_destroy();
            die(error_page("Actividad 2","<p>".$json_repetido["error"]."</p>"));
        }

        $error_cod=$json_repetido["repetido"];
    }

    $error_nombre_corto=$_POST["nombre_corto"]=="";
    if(!$error_nombre_corto)
    {
        $url=DIR_SERV."/repetido/producto/nombre_corto/".urlencode($_POST["nombre_corto"]);
        $respuesta=consumir_servicios_REST($url,"GET");
        $json_repetido=json_decode($respuesta,true);
        if(!$json_repetido)
        {
            session_destroy();
            die(error_page("Actividad 2","<p>Error consumiendo el servico rest: <strong>".$url."</strong></p>"));
        }

        if(isset($json_repetido["error"]))
        {
            session_destroy();
            die(error_page("Actividad 2","<p>".$json_repetido["error"]."</p>"));
        }

        $error_nombre_corto=$json_repetido["repetido"];
    }
    $error_descripcion=$_POST["descripcion"]=="";
    $error_PVP=$_POST["PVP"]=="" || !is_numeric($_POST["PVP"]) || $_POST["PVP"]<=0;

    $error_form=$error_cod || $error_nombre_corto || $error_descripcion || $error_PVP;

    if(!$error_form)
    {
        //inserto y salto con mensaje

        $url=DIR_SERV."/producto/insertar";
        unset($_POST["btnContNuevo"]);
        $respuesta=consumir_servicios_REST($url,"POST",$_POST);
        $json_insertar=json_decode($respuesta,true);
        if(!$json_insertar)
        {
            session_destroy();
            die(error_page("Actividad 2","<p>Error consumiendo el servico rest: <strong>".$url."</strong></p>"));
        }

        if(isset($json_insertar["error"]))
        {
            session_destroy();
            die(error_page("Actividad 2","<p>".$json_insertar["error"]."</p>"));
        }

        $_SESSION["mensaje"]="¡¡ Producto insertado con éxito !!";
        header("Location:index.php");
        exit;

    }

}

if(isset($_POST["btnContEditar"]))
{
   

    $error_nombre_corto=$_POST["nombre_corto"]=="";
    if(!$error_nombre_corto)
    {
        $url=DIR_SERV."/repetido/producto/nombre_corto/".urlencode($_POST["nombre_corto"])."/cod/".urlencode($_POST["cod"]);
        $respuesta=consumir_servicios_REST($url,"GET");
        $json_repetido=json_decode($respuesta,true);
        if(!$json_repetido)
        {
            session_destroy();
            die(error_page("Actividad 2","<p>Error consumiendo el servico rest: <strong>".$url."</strong></p>"));
        }

        if(isset($json_repetido["error"]))
        {
            session_destroy();
            die(error_page("Actividad 2","<p>".$json_repetido["error"]."</p>"));
        }

        $error_nombre_corto=$json_repetido["repetido"];
    }
    $error_descripcion=$_POST["descripcion"]=="";
    $error_PVP=$_POST["PVP"]=="" || !is_numeric($_POST["PVP"]) || $_POST["PVP"]<=0;

    $error_form=$error_nombre_corto || $error_descripcion || $error_PVP;

    if(!$error_form)
    {
        //edito y salto con mensaje

        $url=DIR_SERV."/producto/actualizar/".urlencode($_POST["cod"]);
        unset($_POST["btnContEditar"]);
        unset($_POST["cod"]);
        $respuesta=consumir_servicios_REST($url,"PUT",$_POST);
        $json_actualizar=json_decode($respuesta,true);
        if(!$json_actualizar)
        {
            session_destroy();
            die(error_page("Actividad 2","<p>Error consumiendo el servico rest: <strong>".$url."</strong></p>"));
        }

        if(isset($json_actualizar["error"]))
        {
            session_destroy();
            die(error_page("Actividad 2","<p>".$json_actualizar["error"]."</p>"));
        }

        $_SESSION["mensaje"]="¡¡ Producto actualizado con éxito !!";
        header("Location:index.php");
        exit;

    }

}

if(isset($_POST["btnDetalles"]) || isset($_POST["btnEditar"]))
{
    if(isset($_POST["btnDetalles"]))
        $cod=$_POST["btnDetalles"];
    else
        $cod=$_POST["btnEditar"];

    $url=DIR_SERV."/producto/".urlencode($cod);
    $respuesta=consumir_servicios_REST($url,"GET");
    $json_detalles=json_decode($respuesta,true);
    if(!$json_detalles)
    {
        session_destroy();
        die(error_page("Actividad 2","<p>Error consumiendo el servico rest: <strong>".$url."</strong></p>"));
    }

    if(isset($json_detalles["error"]))
    {
        session_destroy();
        die(error_page("Actividad 2","<p>".$json_detalles["error"]."</p>"));
    }
}

if(isset($_POST["btnContBorrar"]))
{
    $url=DIR_SERV."/producto/borrar/".urlencode($_POST["btnContBorrar"]);
    $respuesta=consumir_servicios_REST($url,"DELETE");
    $json_borrar=json_decode($respuesta,true);
    if(!$json_borrar)
    {
        session_destroy();
        die(error_page("Actividad 2","<p>Error consumiendo el servico rest: <strong>".$url."</strong></p>"));
    }

    if(isset($json_borrar["error"]))
    {
        session_destroy();
        die(error_page("Actividad 2","<p>".$json_borrar["error"]."</p>"));
    }

    $_SESSION["mensaje"]="¡¡ Producto borrado con éxito !!";
    header("Location:index.php");
    exit;
        
}

if(isset($_POST["btnNuevo"])||isset($_POST["btnContNuevo"])||isset($_POST["btnEditar"])||isset($_POST["btnContEditar"]))
{
    $url=DIR_SERV."/familias";
    $respuesta=consumir_servicios_REST($url,"GET");
    $json_familias=json_decode($respuesta,true);
    if(!$json_familias)
    {
        session_destroy();
        die(error_page("Actividad 2","<p>Error consumiendo el servico rest: <strong>".$url."</strong></p>"));
    }

    if(isset($json_familias["error"]))
    {
        session_destroy();
        die(error_page("Actividad 2","<p>".$json_familias["error"]."</p>"));
    }
}

//Esto se va a hacer siempre
$url=DIR_SERV."/productos";
$respuesta=consumir_servicios_REST($url,"GET");
$json_productos=json_decode($respuesta,true);
if(!$json_productos)
{
    session_destroy();
    die(error_page("Actividad 2","<p>Error consumiendo el servico rest: <strong>".$url."</strong></p>"));
}

if(isset($json_productos["error"]))
{
    session_destroy();
    die(error_page("Actividad 2","<p>".$json_productos["error"]."</p>"));
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad 2</title>
    <style>
        .centrado{width:85%;margin:1em auto}
        .txt_centrado{text-align:center}
        table,th,td{border:1px solid black}
        table{border-collapse:collapse}
        th{background-color:#CCC}
        .enlace{border:none;background:none;text-decoration: underline;color:blue;cursor:pointer}
        .mensaje{font-size:1.25em; color:blue}
        .error{color:red}
    </style>
</head>
<body>
    <h1 class="centrado txt_centrado">Listado de los productos</h1>
    <?php

    if(isset($_POST["btnDetalles"]))
    {
        echo "<div class='centrado'>";
        echo "<h2>Información del Producto: ".$_POST["btnDetalles"]."</h2>";
        if(isset($json_detalles["mensaje"]))
            echo "<p>El producto seleccionado ya no se encuentra en la BD</p>";
        else
        {
            echo "<p>";
            echo "<strong>Nombre: </strong>".$json_detalles["producto"]["nombre"]."<br/>";
            echo "<strong>Nombre corto: </strong>".$json_detalles["producto"]["nombre_corto"]."<br/>";
            echo "<strong>Descripción: </strong>".$json_detalles["producto"]["descripcion"]."<br/>";
            echo "<strong>PVP: </strong>".$json_detalles["producto"]["PVP"]." €<br/>";
            echo "<strong>Familia: </strong>".$json_detalles["producto"]["nombre_familia"];
            echo "</p>";
        }
        echo "<form action='index.php' method='post'><button>Volver</button></form>";
        echo "</div>";
    }

    if(isset($_POST["btnBorrar"]))
    {
        echo "<div class='centrado'>";
        echo "<p class='txt_centrado'>Se dispone usted a borrar el producto: <strong>".$_POST["btnBorrar"]."</strong></p>";
        echo "<p class='txt_centrado'>¿ Estás seguro ?</p>";
        echo "<form action='index.php' method='post'>";
        echo "<p class='txt_centrado'><button>Cancelar</button><button  name='btnContBorrar' value='".$_POST["btnBorrar"]."' type='submit'>Continuar</button></p>";
        echo "</form>";
        echo "</div>";
    }



    if(isset($_SESSION["mensaje"]))
    {
        echo "<p class='centrado txt_centrado mensaje'>".$_SESSION["mensaje"]."</p>";
        session_destroy();
    }


    if(isset($_POST["btnNuevo"]) || (isset($_POST["btnContNuevo"]) && $error_form))
    {
    ?>
        <form class="centrado" action="index.php" method="post">
            <h2>Creando un producto</h2>
            <p>
                <label for="cod">Código:</label>
                <input type="text" name="cod" id="cod" value="<?php if(isset($_POST["cod"])) echo $_POST["cod"];?>"/>
                <?php
                if(isset($_POST["btnContNuevo"]) && $error_cod)
                {
                    if($_POST["cod"]=="")
                        echo "<span class='error'> * Campo vacío *</span>";
                    elseif(strlen($_POST["cod"])>12)
                        echo "<span class='error'> * La longitud Máxima del Código debe ser 12*</span>";
                    else
                        echo "<span class='error'> * Código repetido *</span>";
                }
                ?>
            </p>
            <p>
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" value="<?php if(isset($_POST["nombre"])) echo $_POST["nombre"];?>"/>
            </p>
            <p>
                <label for="nombre_corto">Nombre corto:</label>
                <input type="text" name="nombre_corto" id="nombre_corto" value="<?php if(isset($_POST["nombre_corto"])) echo $_POST["nombre_corto"];?>"/>
                <?php
                if(isset($_POST["btnContNuevo"])&& $error_nombre_corto)
                {
                    if($_POST["nombre_corto"]=="")
                        echo "<span class='error'> * Campo vacío *</span>";
                    else
                        echo "<span class='error'> * Código repetido *</span>";
                }
                ?>
            </p>
            <p>
                <label for="descripcion">Descripción:</label>
                <textarea name="descripcion" id="descripcion"><?php if(isset($_POST["descripcion"])) echo $_POST["descripcion"];?></textarea>
                <?php
                if(isset($_POST["btnContNuevo"])&& $error_descripcion)
                    echo "<span class='error'> * Campo vacío *</span>";
                
                ?>
            </p>
            <p>
                <label for="PVP">PVP:</label>
                <input type="text" name="PVP" id="PVP" value="<?php if(isset($_POST["PVP"])) echo $_POST["PVP"];?>"/>
                <?php
                if(isset($_POST["btnContNuevo"])&& $error_PVP)
                {
                    if($_POST["PVP"]=="")
                        echo "<span class='error'> * Campo vacío *</span>";
                    else
                        echo "<span class='error'> * Valor incorrecto para PVP *</span>";
                }
                ?>
            </p>
            <p>
                <label for="familia">Seleccione una familia:</label>
                <select name="familia" id="familia">
                <?php
                foreach($json_familias["familias"] as $tupla)
                {
                    if(isset($_POST["familia"])&& $_POST["familia"]==$tupla["cod"])
                        echo "<option selected value='".$tupla["cod"]."'>".$tupla["nombre"]."</option>";
                    else
                        echo "<option value='".$tupla["cod"]."'>".$tupla["nombre"]."</option>";
                }
                ?>
                </select>
            </p>
            <p>
                <button type="submit">Volver</button> <button type="submit" name="btnContNuevo">Continuar</button></p>
            </p>
        </form>
    <?php
    }

    if(isset($_POST["btnEditar"]) || (isset($_POST["btnContEditar"]) && $error_form))
    {
        if(isset($json_detalles))
        {
            if($json_detalles["producto"])
            {
                $cod=$json_detalles["producto"]["cod"];
                $nombre=$json_detalles["producto"]["nombre"];
                $nombre_corto=$json_detalles["producto"]["nombre_corto"];
                $descripcion=$json_detalles["producto"]["descripcion"];
                $PVP=$json_detalles["producto"]["PVP"];
                $familia=$json_detalles["producto"]["familia"];

            }
            else
            {
                session_destroy();
                die("<p>El producto ya no se encuentra en la BD</p></body></html>");

            }
        }
        else
        {
            $cod=$_POST["cod"];
            $nombre=$_POST["nombre"];
            $nombre_corto=$_POST["nombre_corto"];
            $descripcion=$_POST["descripcion"];
            $PVP=$_POST["PVP"];
            $familia=$_POST["familia"];
        }

        ?>
        <form class="centrado" action="index.php" method="post">
            <h2>Editando el producto con código: <?php echo $cod;?></h2>
         
            <p>
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" value="<?php echo $nombre;?>"/>
            </p>
            <p>
                <label for="nombre_corto">Nombre corto:</label>
                <input type="text" name="nombre_corto" id="nombre_corto" value="<?php echo $nombre_corto;?>"/>
                <?php
                if(isset($_POST["btnContEditar"])&& $error_nombre_corto)
                {
                    if($_POST["nombre_corto"]=="")
                        echo "<span class='error'> * Campo vacío *</span>";
                    else
                        echo "<span class='error'> * Código repetido *</span>";
                }
                ?>
            </p>
            <p>
                <label for="descripcion">Descripción:</label>
                <textarea name="descripcion" id="descripcion"><?php echo $descripcion;?></textarea>
                <?php
                if(isset($_POST["btnContEditar"])&& $error_descripcion)
                    echo "<span class='error'> * Campo vacío *</span>";
                
                ?>
            </p>
            <p>
                <label for="PVP">PVP:</label>
                <input type="text" name="PVP" id="PVP" value="<?php echo $PVP;?>"/>
                <?php
                if(isset($_POST["btnContEditar"])&& $error_PVP)
                {
                    if($_POST["PVP"]=="")
                        echo "<span class='error'> * Campo vacío *</span>";
                    else
                        echo "<span class='error'> * Valor incorrecto para PVP *</span>";
                }
                ?>
            </p>
            <p>
                <label for="familia">Seleccione una familia:</label>
                <select name="familia" id="familia">
                <?php
                foreach($json_familias["familias"] as $tupla)
                {
                    if($familia==$tupla["cod"])
                        echo "<option selected value='".$tupla["cod"]."'>".$tupla["nombre"]."</option>";
                    else
                        echo "<option value='".$tupla["cod"]."'>".$tupla["nombre"]."</option>";
                }
                ?>
                </select>
            </p>
            <p>
                <button type="submit">Volver</button> <button type="submit" name="btnContEditar">Cambiar</button></p>
            </p>
            <input type="hidden" name="cod" value="<?php echo $cod;?>"/>
        </form>
        <?php

    }

    //Esto se "dibuja siempre"
    echo "<table class='centrado txt_centrado'>";
    echo "<tr><th>COD</th><th>Nombre</th><th>PVP (€)</th><th><form action='index.php' method='post'><button class='enlace' name='btnNuevo' type='submit'>Producto+</button></form></th></tr>";
    foreach($json_productos["productos"] as $tupla)
    {
        echo "<tr>";
        echo "<td><form action='index.php' method='post'><button class='enlace' name='btnDetalles' value='".$tupla["cod"]."' type='submit'>".$tupla["cod"]."</button></form></td>";
        echo "<td>".$tupla["nombre_corto"]."</td>";
        echo "<td>".$tupla["PVP"]."</td>";
        echo "<td><form action='index.php' method='post'><button class='enlace' name='btnBorrar' value='".$tupla["cod"]."' type='submit'>Borrar</button> - <button class='enlace' name='btnEditar' value='".$tupla["cod"]."' type='submit'>Editar</button></form></td>";
        echo "</tr>";
    }
    echo "</table>"
    ?>
</body>
</html>