<h1>Rellena tu CV</h1>
      <form action="index.php" method="post" enctype="multipart/form-data">
         <p>
            <label for="nombre">Nombre</label><br/>
            <input type="text" name="nombre" id="nombre" maxlength="9" value="<?php if(isset($_POST["nombre"])) echo $_POST["nombre"];?>" placeholder="Teclee su Nombre"/>
            <?php
            if(isset($_POST["btnEnviar"])&& $error_nombre)
               echo "<span class='error'> * Campo Vacío *</span>";
            ?>
         </p>
         <p>
            <label for="apellidos">Apellidos</label><br/>
            <input type="text" name="apellidos" id="apellidos" value="<?php if(isset($_POST["apellidos"])) echo $_POST["apellidos"];?>" size="40"/>
            <?php
            if(isset($_POST["btnEnviar"])&& $error_apellidos)
               echo "<span class='error'> * Campo Vacío *</span>";
            ?>
         </p>
         <p>
            <label for="clave">Contraseña</label><br/>
            <input type="password" name="clave" id="clave" value="" />
            <?php
            if(isset($_POST["btnEnviar"])&& $error_clave)
               echo "<span class='error'> * Campo Vacío *</span>";
            ?>
         </p>
         <p>
            <label for="dni">DNI</label><br/>
            <input type="text" name="dni" id="dni" maxlength="9" value="<?php if(isset($_POST["dni"])) echo $_POST["dni"];?>" size="9"/>
            <?php
            if(isset($_POST["btnEnviar"])&& $error_dni)
               echo "<span class='error'> * Campo Vacío *</span>";
            ?>
         </p>

         <p>
            Sexo<br/>
            <input type="radio" name="sexo" id="hombre" <?php if(isset($_POST["sexo"]) && $_POST["sexo"]=="hombre") echo "checked";?> value="hombre"/><label for="hombre">Hombre</label>
            <input type="radio" name="sexo" id="mujer" <?php if(isset($_POST["sexo"]) && $_POST["sexo"]=="mujer") echo "checked";?> value="mujer"/><label for="mujer">Mujer</label>
            <?php
            if(isset($_POST["btnEnviar"])&& $error_sexo)
               echo "<span class='error'> * Debes elegir un sexo *</span>";
            ?>
         </p>
         <p>
            <label for="foto">Incluir mi foto</label>
            <input type="file" name="foto" id="foto" accept="image/*"/>
         </p>
         <p>
            <label for="nacido">Nacido en: </label>
            <select name="nacido" id="nacido">
               <option <?php if(isset($_POST["nacido"]) && $_POST["nacido"]=="Málaga") echo "selected";?> value="Málaga">Málaga</option>
               <option <?php if(isset($_POST["nacido"]) && $_POST["nacido"]=="Almería") echo "selected";?> value="Almería">Almería</option>
               <option <?php if(isset($_POST["nacido"]) && $_POST["nacido"]=="Granada") echo "selected";?> value="Granada">Granada</option>
            </select>
         </p>
         <p>
            <label for="comentarios">Comentarios</label>
            <textarea name="comentarios" id="comentarios" cols="40" rows="5"><?php if(isset($_POST["comentarios"])) echo $_POST["comentarios"];?></textarea>
            <?php
            if(isset($_POST["btnEnviar"])&& $error_comentarios)
               echo "<span class='error'> * Campo Vacío *</span>";
            ?>
         </p>
         <p>
            <label for="sub">Subcribirse al Boletín de Novedades</label>
            <input type="checkbox" name="subcripcion" <?php if(isset($_POST["subcripcion"])) echo "checked";?> id="sub"/>
         </p>
         <p>
            <input type="submit" value="Guardar Cambios" name="btnEnviar"/>  
            <input type="submit" value="Borrar los datos introducidos" name="btnBorrar"/> 
         </p>
      </form>