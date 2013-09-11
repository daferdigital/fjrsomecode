package com.fjr.code.gui.operations;

import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

import com.fjr.code.gui.MacroCasseteDialog;

/**
 * 
 * Class: MacroCasseteDialogOperations
 * Creation Date: 10/09/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class MacroCasseteDialogOperations implements ActionListener{
	public static final String ACTION_COMMAND_BTN_ACEPTAR = "btnAceptar";
	public static final String ACTION_COMMAND_BTN_CANCELAR = "btnCancelar";
	
	private MacroCasseteDialog ventana;
	
	/**
	 * 
	 * @param ventana
	 */
	public MacroCasseteDialogOperations(MacroCasseteDialog ventana) {
		// TODO Auto-generated constructor stub
		this.ventana = ventana;
	}

	@Override
	public void actionPerformed(ActionEvent e) {
		// TODO Auto-generated method stub
		if(ACTION_COMMAND_BTN_ACEPTAR.equals(e.getActionCommand())){
			//se desea guardar
			//si esta vacio colocamos N/A por defecto
			if("".equals(ventana.getTextADescCassete().getText())){
				ventana.getTextADescCassete().setText("N/A");
			}
			
			//actualizamos la tabla padre con este registro
			if(ventana.getRowOrigin() > -1){
				ventana.getRelatedTable().updateRow(ventana.getRowOrigin(),
						ventana.getTextADescCassete().getText());
			}else {
				ventana.getRelatedTable().addRow(ventana.getTextADescCassete().getText());
			}
		}
		
		ventana.dispose();
	}
}
