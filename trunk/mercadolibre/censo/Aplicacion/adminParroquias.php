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
            if(!$db->qs("DELETE FROM `parroquias` WHERE id=%d;", array(intval($_GET['id'])))){
				echo "Database Error";
			}
        }
        exit;
    }
	
    if ($_GET['t'] == "list")
    {
        $list=$db->l("SELECT p.id, m.municipio, e.estado, p.parroquia FROM `municipios` m, estados e, parroquias p WHERE p.id_estado = e.id AND p.id_municipio = m.id order by e.estado, m.municipio, p.parroquia asc", false);
    ?>

	<a href="javascript:form_add('adminParroquias');"><img src="./images/add.png">Agregar un Parroquia</a><br />
	<br />
    <table width = "100%">
	
        <tr>
            <th>Estado</th><th>Municipio</th><th>Parroquia</th><th>Opciones</th>
        </tr>

        <?php
            for ($i=intval($_GET['ind']); $i < min(intval($_GET['ind']) + ITEMS_PAGE, count($list)); ++$i)
            {
                echo ("<tr " . (($i % 2 == 0) ? 'class="odd"' : 'class="even"')
                . "><td>{$list[$i]['estado']}</td>" 
                . "<td>{$list[$i]['municipio']}</td>" 
                . "<td>{$list[$i]['parroquia']}</td>" 
                . "<td><a href='javascript:form_update({$list[$i]['id']},\"adminParroquias\");'><img src='images/page_edit.png' alt='Editar' title='Editar'></a> | <a href='javascript:form_delete({$list[$i]['id']},\"{$list[$i]['name']}\",\"adminParroquias\");'><img src='images/delete.png' alt='Eliminar' title='Eliminar'></a></td></tr>");
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
                    echo "<a href='javascript:fn_listar_pg(" . ($i * ITEMS_PAGE) . ",\"adminParroquias\")'>{$i}</a>";
                else
                    echo " | <a href='javascript:fn_listar_pg(" . ($i * ITEMS_PAGE) . ",\"adminParroquias\")'>{$i}</a>";
        ?>
    </center>

    <?php
		}
        exit;
    }

    if ($_POST)
    {
		
		$pid=($_GET['t'] == 'add'?$db->pid("parroquias"):$_POST['id']);

		if(!isset($error)){
			$estado = $db->l("SELECT id_estado FROM `municipios` WHERE `id`=".intval($_POST['id_municipio'])."", true);
			if($_GET['t'] == 'add')
			{
				if($db->l("SELECT id FROM `parroquias` WHERE `id_estado`=".intval($estado['id_estado'])." AND `id_municipio`=".intval($_POST['id_municipio'])." AND parroquia='".secInjection($_POST['parroquia'])."'",true)){
					echo "El municipio ya existe";
				}else if (!$db->qs("INSERT INTO `parroquias` (`parroquia`,`id_estado`,`id_municipio`) VALUES ('%s', %d, %d)", array
				(
					secInjection($_POST['parroquia']),
					intval($estado['id_estado']),
					intval($_POST['id_municipio'])
				))){
					echo "Error en la Base de Datos";
				}
			}

			if($_GET['t'] == 'update')
			{		
				if (!$db->qs("UPDATE `parroquias` SET `parroquia`='%s', `id_estado`=%d, `id_municipio`=%d  WHERE id=%d;", array
				(
					secInjection($_POST['parroquia']),
					intval($estado['id_estado']),
					intval($_POST['id_municipio']),
					intval($_POST['id']) 
				))){
					echo "Error en la Base de Datos";
				}
			}
		}else echo $error; 
		exit;
    }
	
    if (intval($_GET['id'])>0){
        $data=$db->l("SELECT * FROM `parroquias` WHERE id='".intval($_GET['id'])."'",true);
	}
    
	$estados=$db->l("SELECT e.id id_estado, m.id id_municipio, e.estado, m.municipio FROM `estados` e, municipios m WHERE m.id_estado = e.id ORDER BY e.estado, m.municipio",false);
	
?>            
<form action = "<?php if($_GET['t']!='update') echo 'javascript:fn_agregar();'; else echo 'javascript:fn_update();'; ?>" method = "post" id = "form_adminParroquias">
<input type="hidden" value="<?php echo $data['id']; ?>" name="id" />
<table width = "100%">
    <tr>
        <td width = "150px">
			<label for = "id_estado">Estado/Municipio:</label>
		</td>
		<td align="left">
            <select id = "id_municipio" name = "id_municipio" class = "required">
				<option value="">Seleccione uno...</option>
				<?php
					for($i=0;$i<count($estados);++$i){
						if($id_estado_ant!=$estados[$i]['id_estado']){
							$id_estado_ant=$estados[$i]['id_estado'];
							if($i!=0)echo "</optgroup>";
							echo "<optgroup label='{$estados[$i]['estado']}'>";
						}
						echo "<option value = '{$estados[$i]['id_municipio']}' ".($data['id_municipio']==$estados[$i]['id_municipio']?"selected":"").">{$estados[$i]['municipio']}</option>";
						if($i==count($estados)-1) echo "</optgroup>";
					}
				?>
			</select>
		</td>
	</tr> 
    <tr>
        <td width = "150px">
			<label for = "parroquia">Parroquia:</label>
		</td>
		<td align="left">
            <input style = "width: 100%;" maxlength="150" id = "parroquia" name = "parroquia" type = "text" class = "required" value = "<?php echo $data['parroquia']; ?>" />
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
		var str = $("#form_adminParroquias").serializeArray();           
        ajaxLoading();
		$.ajaxFileUpload
		(
			{
				url:'adminParroquias.php?t=add',
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
						fn_listar('adminParroquias');
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
		var str = $("#form_adminParroquias").serializeArray();           
        ajaxLoading();
		$.ajaxFileUpload
		(
			{
				url:'adminParroquias.php?t=update',
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
						fn_listar('adminParroquias');
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