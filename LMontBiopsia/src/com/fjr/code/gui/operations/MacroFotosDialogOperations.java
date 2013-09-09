package com.fjr.code.gui.operations;

import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

import org.apache.log4j.Logger;

import com.fjr.code.gui.MacroFotosDialog;

/**
 * 
 * Class: MacroFotosDialogOperations
 * Creation Date: 08/09/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class MacroFotosDialogOperations implements ActionListener{
	/**
	 * 
	 */
	private static final Logger log = Logger.getLogger(MacroFotosDialogOperations.class);
	
	public static final String ACTION_COMMAND_BTN_SUBIR_FOTO = "btnSubirFoto";
	public static final String ACTION_COMMAND_BTN_GUARDAR = "btnGuardar";
	public static final String ACTION_COMMAND_BTN_CANCELAR = "btnCancelar";
	
	private MacroFotosDialog ventana;
	
	/**
	 * 
	 * @param ventana
	 */
	public MacroFotosDialogOperations(MacroFotosDialog ventana) {
		// TODO Auto-generated constructor stub
		this.ventana = ventana;
	}
	
	@Override
	public void actionPerformed(ActionEvent e) {
		// TODO Auto-generated method stub
		if(ACTION_COMMAND_BTN_SUBIR_FOTO.equals(e.getActionCommand())){
			//debemos subir la foto
			ventana.getFileChooser().showOpenDialog(ventana);
		}
	}
}
