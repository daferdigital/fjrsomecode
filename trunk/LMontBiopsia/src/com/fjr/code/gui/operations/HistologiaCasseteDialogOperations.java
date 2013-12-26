package com.fjr.code.gui.operations;

import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

import com.fjr.code.gui.CustomHistologiaPrintDialog;
import com.fjr.code.gui.HistologiaCasseteDialog;

/**
 * 
 * Class: HistologiaCasseteDialogOperations
 * Creation Date: 10/09/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class HistologiaCasseteDialogOperations implements ActionListener{
	public static final String ACTION_COMMAND_BTN_ACEPTAR = "btnAceptar";
	public static final String ACTION_COMMAND_BTN_PRINT_LABEL = "btnPrintLabel";
	public static final String ACTION_COMMAND_BTN_CANCELAR = "btnCancelar";
	
	private HistologiaCasseteDialog ventana;
	
	/**
	 * 
	 * @param ventana
	 */
	public HistologiaCasseteDialogOperations(HistologiaCasseteDialog ventana) {
		// TODO Auto-generated constructor stub
		this.ventana = ventana;
	}

	@Override
	public void actionPerformed(ActionEvent e) {
		// TODO Auto-generated method stub
		if(ACTION_COMMAND_BTN_ACEPTAR.equals(e.getActionCommand())
				|| ACTION_COMMAND_BTN_CANCELAR.equals(e.getActionCommand())){
			
			if(ACTION_COMMAND_BTN_ACEPTAR.equals(e.getActionCommand())){
				//se desea guardar
				//si esta vacio colocamos N/A por defecto
				if("".equals(ventana.getTextADescCassete().getText())){
					ventana.getTextADescCassete().setText("N/A");
				}
				
				//actualizamos la tabla padre con este registro
				ventana.getRelatedTable().updateRow(ventana.getRowOrigin(),
						Integer.parseInt(ventana.getcBoxNumBloques().getSelectedItem().toString()),
						Integer.parseInt(ventana.getcBoxNumLaminas().getSelectedItem().toString()));
			}
			
			ventana.dispose();
		} else if(ACTION_COMMAND_BTN_PRINT_LABEL.equals(e.getActionCommand())){
			new CustomHistologiaPrintDialog(codigoBiopsia, cassete, bloques, maxLaminas);
		}
	}
}
