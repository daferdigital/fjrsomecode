package com.fjr.code.gui.operations;

import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

import javax.swing.JOptionPane;

import com.fjr.code.dao.EspecialidadDAO;
import com.fjr.code.dto.EspecialidadDTO;
import com.fjr.code.gui.EspecialidadDialog;

/**
 * 
 * Class: EspecialidadDialogOperations
 * Creation Date: 03/11/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class EspecialidadDialogOperations implements ActionListener{
	public static final String ACTION_COMMAND_BTN_GUARDAR = "btnGuardar";
	public static final String ACTION_COMMAND_BTN_CANCELAR = "btnCancelar";
	
	private EspecialidadDialog ventana;
	
	/**
	 * 
	 * @param ventana
	 */
	public EspecialidadDialogOperations(EspecialidadDialog ventana) {
		// TODO Auto-generated constructor stub
		this.ventana = ventana;
	}

	/**
	 * 
	 * @return
	 */
	private boolean validateWindow(){
		boolean isValid = true;
		
		String errors = "";
		
		if("".equals(ventana.getTextCodigo().getText())){
			errors += "Debe indicar el codigo de la especialidad.\n";
		}
		if("".equals(ventana.getTextNombre().getText())){
			errors += "Debe indicar el nombre de la especialidad.\n";
		}
		if("".equals(ventana.getTextDescripcion().getText())){
			errors += "Debe indicar la descripción de la especialidad.\n";
		}
		
		if(! "".equals(errors)){
			isValid = false;
			JOptionPane.showMessageDialog(ventana, 
					"Se han presentado los siguientes errores:\n" + errors, 
					"Faltan campos", 
					JOptionPane.ERROR_MESSAGE);
		}
		
		return isValid;
	}
	
	/**
	 * 
	 */
	private void cleanWindow(){
		ventana.getTextCodigo().setText("");
		ventana.getTextNombre().setText("");
		ventana.getTextDescripcion().setText("");
	}
	
	/**
	 * 
	 * @param especialidad
	 */
	private void buildDTOFromWindow(EspecialidadDTO especialidad){
		especialidad.setActivo(true);
		especialidad.setCodigo(ventana.getTextCodigo().getText());
		especialidad.setNombre(ventana.getTextNombre().getText());
		especialidad.setDescripcion(ventana.getTextDescripcion().getText());
	}
	
	@Override
	public void actionPerformed(ActionEvent e) {
		// TODO Auto-generated method stub
		if(ACTION_COMMAND_BTN_GUARDAR.equals(e.getActionCommand())){
			if(validateWindow()){
				EspecialidadDTO especialidad = new EspecialidadDTO();
				buildDTOFromWindow(especialidad);
				if(EspecialidadDAO.insert(especialidad) > -1){
					//se inserto bien el registro
					JOptionPane.showMessageDialog(ventana, 
							"Especialidad creada de manera exitosa", 
							"Especialidad creada", 
							JOptionPane.INFORMATION_MESSAGE);
					cleanWindow();
				} else {
					//error creando el registro en la base de datos
					JOptionPane.showMessageDialog(ventana, 
							"La especialidad no pudo ser creada", 
							"Error en la operación", 
							JOptionPane.ERROR_MESSAGE);
				}
			}
		} else if(ACTION_COMMAND_BTN_CANCELAR.equals(e.getActionCommand())){
			ventana.setVisible(false);
			ventana.dispose();
		}
	}
}
