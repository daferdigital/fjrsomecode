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
            if(!$db->qs("UPDATE items_encuesta SET active='0' WHERE id=%d;", array(intval($_GET['id'])))){
				echo "Database Error";
			}
        }
        exit;
    }
	
    if ($_GET['t'] == "list") {
    	$query = "SELECT ie.id AS itemId, ie.texto AS itemTexto, ie.is_check, ie.require_number, ie.is_text, ie.orden, cie.texto AS seccion "
    	."FROM categoria_item_encuesta cie, items_encuesta ie "
    	."WHERE ie.active='1' "
    	."AND ie.id_item_categoria = cie.id "
    	."ORDER BY cie.orden, cie.texto, ie.orden, ie.texto";
        $list=$db->l($query, false);
    ?>

	<a href="javascript:form_add('adminItemsEncuesta');"><img src="./images/add.png">Agregar un Item a la encuesta</a><br />
	<br />
    <table width = "100%">
	
        <tr>
            <th>Secci&oacute;n</th>
            <th>Item</th>
            <th>Opciones</th>
        </tr>

        <?php
            for ($i=intval($_GET['ind']); $i < min(intval($_GET['ind']) + ITEMS_PAGE, count($list)); ++$i){
        ?>
        	<tr <?php echo (($i % 2 == 0) ? 'class="odd"' : 'class="even"');?>>
        		<td><?php echo $list[$i]['seccion'];?></td>
        		<td><?php echo $list[$i]['itemTexto'];?></td> 
                <td>
                	<a href="javascript:form_update(<?php echo $list[$i]['itemId'];?>,'adminItemsEncuesta')">
                		<img src='images/page_edit.png' alt='Editar' title='Editar'>
                	</a> 
                	| 
                	<a href="javascript:form_delete(<?php echo $list[$i]['itemId'];?>,'<?php echo $list[$i]['itemTexto'];?>','adminItemsEncuesta');">
                		<img src='images/delete.png' alt='Eliminar' title='Eliminar'>
                	</a>
                </td>
            </tr>
        <?php
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
                    echo "<a href='javascript:fn_listar_pg(" . ($i * ITEMS_PAGE) . ",\"adminItemsEncuesta\")'>{$i}</a>";
                else
                    echo " | <a href='javascript:fn_listar_pg(" . ($i * ITEMS_PAGE) . ",\"adminItemsEncuesta\")'>{$i}</a>";
        ?>
    </center>

    <?php
		}
        exit;
    }

    if ($_POST)
    {
		
		$pid=($_GET['t'] == 'add'?$db->pid("items_encuesta"):$_POST['id']);

		if(!isset($error)){
			if($_GET['t'] == 'add')
			{
				if($db->l("SELECT id FROM items_encuesta WHERE LOWER(texto)=LOWER('".secInjection($_POST['itemTexto'])."') AND active='1' AND id_item_categoria=".$_POST["seccionId"],true)){
					echo "El item '".$_POST["itemTexto"]."'ya existe";
				}else if (!$db->qs("INSERT INTO items_encuesta (texto, is_check, require_number, is_text, orden, id_item_categoria) VALUES ('%s','%s','%s','%s',%d,%d)", array
				(
					secInjection($_POST['itemTexto']),
					$_POST["itemType"] == "0" ? "1" : "0",
					$_POST["itemType"] == "0" ? (isset($_POST["requireNumber"]) ? $_POST["requireNumber"] : "0") : "0",
					$_POST["itemType"] == "1" ? "1" : "0",
					$_POST["orden"],
					$_POST['seccionId']
				))){
					echo "Error en la Base de Datos";
				}
			}

			if($_GET['t'] == 'update')
			{		
				if (!$db->qs("UPDATE items_encuesta SET texto='%s', is_check='%s', require_number='%s', is_text='%s', orden=%d, id_item_categoria=%d WHERE id=%d;", array
				(
					secInjection($_POST['itemTexto']),
					$_POST["itemType"] == "0" ? "1" : "0",
					$_POST["itemType"] == "0" ? (isset($_POST["requireNumber"]) ? $_POST["requireNumber"] : "0") : "0",
					$_POST["itemType"] == "1" ? "1" : "0",
					$_POST["orden"],
					$_POST['seccionId'],
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
    	$query = "SELECT ie.id AS itemId, ie.texto AS itemTexto, ie.is_check, ie.require_number, ie.is_text, ie.orden, cie.id AS seccionId, cie.texto AS seccion "
    	."FROM categoria_item_encuesta cie, items_encuesta ie "
    	."WHERE ie.active='1' "
    	."AND ie.id_item_categoria = cie.id "
    	."AND ie.id=".$_GET['id'];
        $data=$db->l($query,true);
	}
	
?>            
<form action = "<?php if($_GET['t']!='update') echo 'javascript:fn_agregar();'; else echo 'javascript:fn_update();'; ?>" method = "post" id = "form_adminItemsEncuesta">
<input type="hidden" value="<?php echo $data['itemId']; ?>" name="id" />
<table width = "100%">
    <tr>
        <td width = "150px">
			<label>Secci&oacute;n:</label>
		</td>
		<td align="left">
            <select id="seccionId" name="seccionId">
            <?php 
            	$list1 = $db->l("SELECT id, texto FROM categoria_item_encuesta WHERE active='1' ORDER BY texto",false);
            	for ($i=0; $i < count($list1); $i++){
            ?>
            	<option value="<?php echo $list1[$i]["id"];?>" <?php echo $list1[$i]["id"] == $data["seccionId"] ? "selected" : "";?>><?php echo $list1[$i]["texto"];?></option>
            <?php
            	}
            ?>
            </select>
		</td>
	</tr>
	<tr>
        <td width = "150px">
			<label>Item:</label>
		</td>
		<td>
            <input style = "width: 100%;" maxlength="150" id = "itemTexto" name = "itemTexto" type = "text" class = "required" value = "<?php echo $data['itemTexto']; ?>" />
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
        <td width="150px">
			<label>Condiciones del Item:</label>
		</td>
		<td align="left">
            <input type="radio" id="itemType_0" name="itemType" value="0" onclick="javascript: document.getElementById('spanRequireNumber').style.display = 'inline';" <?php echo $data["is_check"] == "1" ? "checked" : ""?>> Es un campo tipo check? 
            &nbsp;&nbsp;&nbsp;&nbsp;
            <span id="spanRequireNumber">
            	<input type="checkbox" name="requireNumber" value="1" <?php echo $data["require_number"] == "1" ? "checked" : ""?>> Requiere texto Adicional?
            </span>
            <br />
            <input type="radio" name="itemType" value="1" onclick="javascript: document.getElementById('spanRequireNumber').style.display = 'none';" <?php echo $data["is_text"] == "1" ? "checked" : ""?>>Es un campo tipo Texto?
			<br />
			<?php 
				if($data["is_check"] == "1"){
			?>
				<script>
					document.getElementById('spanRequireNumber').style.display = 'inline';
				</script>
			<?php
				} else if($data["is_text"] == "1"){
			?>
				<script>
					document.getElementById('spanRequireNumber').style.display = 'none';
				</script>
			<?php	
				} else {
			?>
				<script>
					document.getElementById('itemType_0').checked = true;
				</script>
			<?php
				}
			?>
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
		var str = $("#form_adminItemsEncuesta").serializeArray();           
        ajaxLoading();
		$.ajaxFileUpload
		(
			{
				url:'adminItemsEncuesta.php?t=add',
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
						fn_listar('adminItemsEncuesta');
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
		var str = $("#form_adminItemsEncuesta").serializeArray();           
        ajaxLoading();
		$.ajaxFileUpload
		(
			{
				url:'adminItemsEncuesta.php?t=update',
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
						fn_listar('adminItemsEncuesta');
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
