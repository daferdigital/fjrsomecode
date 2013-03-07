<?php
    include_once ("classDBAndUser.php");

    if (!User::isAdmin())
    {
        echo "Not is admin...";
        exit;
    }
         
    if ($_GET['t'] == "delete")
    {
        if(intval($_GET['id'])<=0) 
            echo "Invalid ID";
        else{
            $result=User::deleteUser(intval($_GET['id']));
            if(isError($result))
                echo dError($result);
        }
        exit;
    }
    if ($_GET['t'] == "list")
    {
        $list=$db->l("SELECT * FROM user", false);
    ?>

	<a href="javascript:form_add('adminUser');"><img src="./images/add.png">Agregar Usuario</a><br /><br />
    <table width = "100%">
        <tr>
            <th>Nombre</th><th>E-Mail</th><th>Usuario</th><th>Opciones</th>
        </tr>

        <?php
            for ($i=intval($_GET['ind']); $i < min(intval($_GET['ind']) + ITEMS_PAGE, count($list)); ++$i)
            {
                echo ("<tr " . (($i % 2 == 0) ? 'class="odd"' : 'class="even"'). ">"
				."<td>{$list[$i]['name']}</td><td>{$list[$i]['mail']}</td><td>{$list[$i]['user']}</td>"
                . "<td><a href='javascript:form_update({$list[$i]['id']},\"adminUser\");'><img src='images/page_edit.png' alt='Editar' title='Editar'></a> | <a href='javascript:form_delete({$list[$i]['id']},\"{$list[$i]['name']}\",\"adminUser\");'><img src='images/delete.png' alt='Eliminar' title='Eliminar'></a></td></tr>");
            }
        ?>
    </table>

        <?php 
			if(count($list) / ITEMS_PAGE >1){
		?>
    <center>
        Page:

        <?php
            for ($i=0; $i < count($list) / ITEMS_PAGE; ++$i)
                if ($i == 0)
                    echo "<a href='javascript:fn_listar_pg(" . ($i * ITEMS_PAGE) . ", \"adminUser\")'>{$i}</a>";
                else
                    echo " | <a href='javascript:fn_listar_pg(" . ($i * ITEMS_PAGE) . ", \"adminUser\")'>{$i}</a>";
        ?>
    </center>

    <?php
		}
        exit;
    }

    if ($_POST)
    {
        if ($_GET['t'] == 'add')
        {
            $us      =new CUser();
            $us->name=$_POST['name'];
            $us->user=$_POST['user'];
            $us->mail=$_POST['mail'];
            $us->pass=$_POST['pass'];
            $us->rol =$_POST['tipo'];
            $result  =User::addUser($us);

            if (isError($result))
                echo dError($result);

            exit;
        }

        if ($_GET['t'] == 'update')
        {
            if ($_POST['pass'] == "")
                $result=User::updateUser($_POST['idus'], $_POST['name'], $_POST['tipo'], $_POST['mail']);
            else
                $result=User::updateUser($_POST['idus'], $_POST['name'], $_POST['tipo'], $_POST['mail'], $_POST['pass']);

            if (isError($result))
                echo dError($result);

            exit;
        }
    }

    if ($_GET['id'])
        $us=User::getUserByID($_GET['id']);
?>            
<form action = "<?php if($_GET['t']!='update') echo 'javascript:fn_agregar();'; else echo 'javascript:fn_update();'; ?>" method = "post" id = "form_adminUser">
<input type="hidden" value="<?php echo $us->id; ?>" name="idus" />
<input type="hidden" name="tipo" value="1" />
<table width = "100%">
    <tr>
        <td width = "150px">
			<label for = "name">Nombre:</label>
		</td>
		<td>
            <input style = "width: 100%;" id = "name" name = "name" type = "text" class = "required" value = "<?php echo ($us->name); ?>" />
		</td>
	</tr>
    <tr>
        <td width = "150px">
			<label for = "mail">E-Mail:</label>
		</td>
		<td width = "150px">
            <input  style = "width: 100%;" id = "mail"   class = "required email" name = "mail" value = "<?php echo $us->mail; ?>" type = "text" />
		</td>
	</tr>
  <!--  <tr>
        <td width = "150px">
			<label for = "tipo">Nivel</label>
		</td>
		<td>
			<select style = "width: 100%;" id = "tipo" name = "tipo" tabindex = "1">
				<option  value = "0">Usuario</option>
				<option <?php if($us->rol==1) echo "selected";?> value = "1">Administrador</option>
			</select>
		</td>
	</tr> -->
    <tr>
        <td width = "150px">
			<label for = "user">Usuario:</label>
		</td>
		<td>
            <input  <?php
                            if ($_GET['t'] == 'update')
                                echo 'readonly="readonly"';
                        ?>
                        style = "width: 100%;" id = "user" class = "required" name = "user" value = "<?php echo $us->user; ?>" type = "text" />
		</td>
	</tr>
    <tr>
        <td width = "150px">
			<label for = "pass">Contraseña: <?php
                            if ($_GET['t'] == 'update') echo '(Opcional)';
                        ?></label>
		</td>
		<td>
            <input style = "width: 100%;" id = "pass" name = "pass"
                        <?php if($_GET['t']!='update') echo 'class="required"'; ?>   type = "password" />
		</td>
	</tr>
    <tr>
        <td width = "150px">
			<label for = "pass2">Confirmar Contraseña: <?php
                            if ($_GET['t'] == 'update')
                                echo '(Opcional)';
                    ?></label>
		</td>
		<td>
            <input style = "width: 100%;" name = "pass2"  id = "pass2"  equalTo = "#pass"
                        <?php if($_GET['t']!='update') echo 'class="required"'; ?>  type = "password" />
		</td>
	</tr>
    <tr>
        <td width = "150px">
		</td>
		<td>
            <p>
					<button type="submit">Enviar</button>
					<button type="button" onclick = "fn_cerrar();">Cancelar</button>
                </p>
		</td>
	</tr>
</table>
</form>

<script language = "javascript" type = "text/javascript">
	function onLoadForm(){}
    function fn_agregar()
    {
        var str = $("#form_adminUser").serialize();           
        ajaxLoading();
        $.ajax({ url: 'adminUser.php?t=add', data: str, type: 'post', success: function(data)
            {
                if(data != '')
				{
					alert(data);
					ajaxLoadingOut();
				}else{
                    alert("Usuario registrado correctamente");
                    fn_cerrar();
                    fn_listar('adminUser');
                }                
            }
        });
    }

    function fn_update()
    {
        var str = $("#form_adminUser").serialize();       
        ajaxLoading();
        $.ajax({ url: 'adminUser.php?t=update', data: str, type: 'post', success: function(data)
            {
                if(data != '')
				{
					alert(data);
					ajaxLoadingOut();
				}else{
                    alert("Usuario actualizado correctamente");
                    fn_cerrar();  
                    fn_listar('adminUser');
                }       
            }
        });
    }
</script>