<?php

    include_once ("classDBAndUser.php");

    if (!User::isAdmin()){
        echo "Not is admin...";
        exit;
    }
    
    if ($_GET['t'] == "delete"){
        if(intval($_GET['id'])<=0) 
            echo "Invalid ID";
        else{
        	//verificamos si no existen items activos para esa seccion de la encuesta
        	$list=$db->l("SELECT COUNT(*) AS cuenta FROM items_encuesta WHERE id_item_categoria=".$_GET['id']." AND active='1'", false);
        	
        	if($list[0]["cuenta"] > 0){
        		//no podemos eliminar esta seccion ya que tiene items activos
        		echo "Esta sección aún posee items activos, por lo tanto no puede ser eliminada todavía";
        	}else {
        		if(!$db->qs("UPDATE categoria_item_encuesta SET active='0'WHERE id=%d;", array(intval($_GET['id'])))){
        			echo "Database Error";
        		}
        	}
        }
        exit;
    }
	
    if ($_GET['t'] == "list"){
        $list=$db->l("SELECT id, texto FROM categoria_item_encuesta WHERE active='1' ORDER BY orden, texto", false);
    ?>

	<a href="javascript:form_add('adminSeccionesEncuesta');"><img src="./images/add.png">Agregar una Secci&oacute;n a la encuesta</a><br />
	<br />
    <table width = "100%">
        <tr>
            <th>Secci&oacute;n</th><th>Opciones</th>
        </tr>

        <?php
            for ($i=intval($_GET['ind']); $i < min(intval($_GET['ind']) + ITEMS_PAGE, count($list)); ++$i)
            {
                echo ("<tr " . (($i % 2 == 0) ? 'class="odd"' : 'class="even"')
                . "><td>{$list[$i]['texto']}</td>" 
                . "<td><a href='javascript:form_update({$list[$i]['id']},\"adminSeccionesEncuesta\");'><img src='images/page_edit.png' alt='Editar' title='Editar'></a> | <a href='javascript:form_delete({$list[$i]['id']},\"{$list[$i]['texto']}\",\"adminSeccionesEncuesta\");'><img src='images/delete.png' alt='Eliminar' title='Eliminar'></a></td></tr>");
            }
        ?>
    </table>

        <?php 
			if(count($list) / ITEMS_PAGE >1){
		?>
    <center>
        P&aacute;ginas:

        <?php
            for ($i=0; $i < count($list) / ITEMS_PAGE; ++$i)
                if ($i == 0)
                    echo "<a href='javascript:fn_listar_pg(" . ($i * ITEMS_PAGE) . ",\"adminSeccionesEncuesta\")'>{$i}</a>";
                else
                    echo " | <a href='javascript:fn_listar_pg(" . ($i * ITEMS_PAGE) . ",\"adminSeccionesEncuesta\")'>{$i}</a>";
        ?>
    </center>

    <?php
		}
        exit;
    }

    if ($_POST){
		
		$pid=($_GET['t'] == 'add'?$db->pid("categoria_item_encuesta"):$_POST['id']);

		if(!isset($error)){
			if($_GET['t'] == 'add')
			{
				if($db->l("SELECT id FROM categoria_item_encuesta WHERE LOWER(texto)=LOWER('".secInjection($_POST['texto'])."') AND active='1'",true)){
					echo "La seccion '".$_POST["texto"]."' ya existe";
				}else if (!$db->qs("INSERT INTO categoria_item_encuesta (texto, orden) VALUES ('%s',%d)", array
				(
					secInjection($_POST['texto']),
					intval($_POST["orden"])
				))){
					echo "Error en la Base de Datos";
				}
			}

			if($_GET['t'] == 'update')
			{		
				if (!$db->qs("UPDATE categoria_item_encuesta SET texto='%s', orden=%d WHERE id=%d;", array
				(
					secInjection($_POST['texto']),
					intval($_POST["orden"]),
					intval($_POST['id']) 
				))){
					echo "Error en la Base de Datos";
				}
			}
		}else echo $error; 
		exit;
    }
	$dCat=array();
    if (intval($_GET['id'])>0){
        $data=$db->l("SELECT * FROM categoria_item_encuesta WHERE id='".intval($_GET['id'])."'",true);
	}
	
?>            
<form action = "<?php if($_GET['t']!='update') echo 'javascript:fn_agregar();'; else echo 'javascript:fn_update();'; ?>" method = "post" id = "form_adminSeccionesEncuesta">
<input type="hidden" value="<?php echo $data['id']; ?>" name="id" />
<table width = "100%">
    <tr>
        <td width = "150px">
			<label for = "estado">Secci&oacute;n:</label>
		</td>
		<td>
            <input style = "width: 100%;" maxlength="150" id = "estado" name = "texto" type = "text" class = "required" value = "<?php echo $data['texto']; ?>" />
		</td>
	</tr>
	<tr>
        <td width="150px">
			<label>Orden:</label>
		</td>
		<td align="left">
            <select id="orden" name="orden">
            <?php 
            	for ($i=1; $i < 101; $i++){
            ?>
            	<option value="<?php echo $i;?>" <?php echo $i == $data["orden"] ? "selected" : "";?>><?php echo $i;?></option>
            <?php
            	}
            ?>
            </select>
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
	function onLoadForm(){
		//$("textarea").htmlarea({toolbar: [["bold", "italic", "underline", "|", "orderedlist", "unorderedlist","|", "indent","outdent"]]});
	}
    function fn_agregar()
    {      
		var str = $("#form_adminSeccionesEncuesta").serializeArray();           
        ajaxLoading();
		$.ajaxFileUpload
		(
			{
				url:'adminSeccionesEncuesta.php?t=add',
				secureuri:false,
				fileElementId:'imagen',
				dataType: 'text',
				data:str,
				success: function (data, status)
				{
					if(data != '')
					{
						alert(data.replace(/<\/?[^>]+(>|$)/g, ""));
						ajaxLoadingOut();
					}else{
						alert("Agregado correctamente");
						fn_cerrar();
						fn_listar('adminSeccionesEncuesta');
					}
				},
				error: function (data, status, e)
				{
					alert(e);
				}
			}
		);
    }

    function fn_update()
    {
		var str = $("#form_adminSeccionesEncuesta").serializeArray();           
        ajaxLoading();
		$.ajaxFileUpload
		(
			{
				url:'adminSeccionesEncuesta.php?t=update',
				secureuri:false,
				fileElementId:'imagen',
				dataType: 'text',
				data:str,
				success: function (data, status)
				{
					if(data != '')
					{
						alert(data.replace(/<\/?[^>]+(>|$)/g, ""));
						ajaxLoadingOut();
					}else{
						alert("Actualizado correctamente");
						fn_cerrar();
						fn_listar('adminSeccionesEncuesta');
					}
				},
				error: function (data, status, e)
				{
					alert(e);
				}
			}
		);
    }
</script>
