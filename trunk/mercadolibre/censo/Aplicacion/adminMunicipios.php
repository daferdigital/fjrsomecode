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
            if(!$db->qs("DELETE FROM `municipios` WHERE id=%d;", array(intval($_GET['id'])))){
				echo "Database Error";
			}
        }
        exit;
    }
	
    if ($_GET['t'] == "list")
    {
        $list=$db->l("SELECT m.id, m.municipio, e.estado FROM `municipios` m, estados e WHERE m.id_estado = e.id order by municipio asc", false);
    ?>

	<a href="javascript:form_add('adminMunicipios');"><img src="./images/add.png">Agregar un municipio</a><br />
	<br />
    <table width = "100%">
	
        <tr>
            <th>Estado</th><th>Municipio</th><th>Opciones</th>
        </tr>

        <?php
            for ($i=intval($_GET['ind']); $i < min(intval($_GET['ind']) + ITEMS_PAGE, count($list)); ++$i)
            {
                echo ("<tr " . (($i % 2 == 0) ? 'class="odd"' : 'class="even"')
                . "><td>{$list[$i]['estado']}</td>" 
                . "<td>{$list[$i]['municipio']}</td>" 
                . "<td><a href='javascript:form_update({$list[$i]['id']},\"adminMunicipios\");'><img src='images/page_edit.png' alt='Editar' title='Editar'></a> | <a href='javascript:form_delete({$list[$i]['id']},\"{$list[$i]['name']}\",\"adminMunicipios\");'><img src='images/delete.png' alt='Eliminar' title='Eliminar'></a></td></tr>");
            }
        ?>
    </table>

        <?php 
			if(count($list) / ITEMS_PAGE >1){
		?>
    <center>
        Paginas:

        <?php
            for ($i=0; $i < count($list) / ITEMS_PAGE; ++$i)
                if ($i == 0)
                    echo "<a href='javascript:fn_listar_pg(" . ($i * ITEMS_PAGE) . ",\"adminMunicipios\")'>{$i}</a>";
                else
                    echo " | <a href='javascript:fn_listar_pg(" . ($i * ITEMS_PAGE) . ",\"adminMunicipios\")'>{$i}</a>";
        ?>
    </center>

    <?php
		}
        exit;
    }

    if ($_POST)
    {
		
		$pid=($_GET['t'] == 'add'?$db->pid("municipios"):$_POST['id']);

		if(!isset($error)){
			if($_GET['t'] == 'add')
			{
				if($db->l("SELECT id FROM `municipios` WHERE `id_estado`=".intval($_POST['id_estado'])." AND municipio='".secInjection($_POST['municipio'])."'",true)){
					echo "El municipio ya existe";
				}else if (!$db->qs("INSERT INTO `municipios` (`municipio`,`id_estado`) VALUES ('%s', %d)", array
				(
					secInjection($_POST['municipio']),
					intval($_POST['id_estado'])
				))){
					echo "Error en la Base de Datos";
				}
			}

			if($_GET['t'] == 'update')
			{		
				if (!$db->qs("UPDATE `municipios` SET `municipio`='%s', `id_estado`=%d  WHERE id=%d;", array
				(
					secInjection($_POST['municipio']),
					intval($_POST['id_estado']),
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
        $data=$db->l("SELECT * FROM `municipios` WHERE id='".intval($_GET['id'])."'",true);
	}
    
	$estados=$db->l("SELECT * FROM `estados` order by estado",false);
	
?>            
<form action = "<?php if($_GET['t']!='update') echo 'javascript:fn_agregar();'; else echo 'javascript:fn_update();'; ?>" method = "post" id = "form_adminMunicipios">
<input type="hidden" value="<?php echo $data['id']; ?>" name="id" />
<table width = "100%">
    <tr>
        <td width = "150px">
			<label for = "id_estado">Estado:</label>
		</td>
		<td align="left">
            <select id = "id_estado" name = "id_estado" class = "required">
				<option value="">Seleccione uno...</option>
				<?php
					for($i=0;$i<count($estados);++$i)
						echo "<option value = '{$estados[$i]['id']}' ".($data['id_estado']==$estados[$i]['id']?"selected":"").">{$estados[$i]['estado']}</option>";
				?>
			</select>
		</td>
	</tr> 
    <tr>
        <td width = "150px">
			<label for = "municipio">Municipio:</label>
		</td>
		<td align="left">
            <input style = "width: 100%;" maxlength="150" id = "municipio" name = "municipio" type = "text" class = "required" value = "<?php echo $data['municipio']; ?>" />
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
		var str = $("#form_adminMunicipios").serializeArray();           
        ajaxLoading();
		$.ajaxFileUpload
		(
			{
				url:'adminMunicipios.php?t=add',
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
						fn_listar('adminMunicipios');
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
		var str = $("#form_adminMunicipios").serializeArray();           
        ajaxLoading();
		$.ajaxFileUpload
		(
			{
				url:'adminMunicipios.php?t=update',
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
						fn_listar('adminMunicipios');
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