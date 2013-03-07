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
            if(!$db->qs("DELETE FROM `estados` WHERE id=%d;", array(intval($_GET['id'])))){
				echo "Database Error";
			}
        }
        exit;
    }
	
    if ($_GET['t'] == "list")
    {
        $list=$db->l("SELECT id, estado FROM `estados` order by estado asc", false);
    ?>

	<a href="javascript:form_add('adminEstados');"><img src="./images/add.png">Agregar un Estado</a><br />
	<br />
    <table width = "100%">
	
        <tr>
            <th>Estado</th><th>Opciones</th>
        </tr>

        <?php
            for ($i=intval($_GET['ind']); $i < min(intval($_GET['ind']) + ITEMS_PAGE, count($list)); ++$i)
            {
                echo ("<tr " . (($i % 2 == 0) ? 'class="odd"' : 'class="even"')
                . "><td>{$list[$i]['estado']}</td>" 
                . "<td><a href='javascript:form_update({$list[$i]['id']},\"adminEstados\");'><img src='images/page_edit.png' alt='Editar' title='Editar'></a> | <a href='javascript:form_delete({$list[$i]['id']},\"{$list[$i]['name']}\",\"adminEstados\");'><img src='images/delete.png' alt='Eliminar' title='Eliminar'></a></td></tr>");
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
                    echo "<a href='javascript:fn_listar_pg(" . ($i * ITEMS_PAGE) . ",\"adminEstados\")'>{$i}</a>";
                else
                    echo " | <a href='javascript:fn_listar_pg(" . ($i * ITEMS_PAGE) . ",\"adminEstados\")'>{$i}</a>";
        ?>
    </center>

    <?php
		}
        exit;
    }

    if ($_POST)
    {
		
		$pid=($_GET['t'] == 'add'?$db->pid("estados"):$_POST['id']);

		if(!isset($error)){
			if($_GET['t'] == 'add')
			{
				if($db->l("SELECT id FROM `estados` WHERE estado='".secInjection($_POST['estado'])."'",true)){
					echo "El Estado ya existe";
				}else if (!$db->qs("INSERT INTO `estados` (`estado`) VALUES ('%s')", array
				(
					secInjection($_POST['estado'])
				))){
					echo "Error en la Base de Datos";
				}
			}

			if($_GET['t'] == 'update')
			{		
				if (!$db->qs("UPDATE `estados` SET `estado`='%s' WHERE id=%d;", array
				(
					secInjection($_POST['estado']),
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
        $data=$db->l("SELECT * FROM `estados` WHERE id='".intval($_GET['id'])."'",true);
	}
	
?>            
<form action = "<?php if($_GET['t']!='update') echo 'javascript:fn_agregar();'; else echo 'javascript:fn_update();'; ?>" method = "post" id = "form_adminEstados">
<input type="hidden" value="<?php echo $data['id']; ?>" name="id" />
<table width = "100%">
    <tr>
        <td width = "150px">
			<label for = "estado">Estado:</label>
		</td>
		<td>
            <input style = "width: 100%;" maxlength="150" id = "estado" name = "estado" type = "text" class = "required" value = "<?php echo $data['estado']; ?>" />
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
		var str = $("#form_adminEstados").serializeArray();           
        ajaxLoading();
		$.ajaxFileUpload
		(
			{
				url:'adminEstados.php?t=add',
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
						fn_listar('adminEstados');
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
		var str = $("#form_adminEstados").serializeArray();           
        ajaxLoading();
		$.ajaxFileUpload
		(
			{
				url:'adminEstados.php?t=update',
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
						fn_listar('adminEstados');
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
