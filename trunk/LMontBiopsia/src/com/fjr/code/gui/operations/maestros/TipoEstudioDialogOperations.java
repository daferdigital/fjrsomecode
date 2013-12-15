package com.fjr.code.gui.operations.maestros;

import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.util.List;

import javax.swing.JOptionPane;

import com.fjr.code.dao.TipoEstudioDAO;
import com.fjr.code.dto.TipoEstudioDTO;
import com.fjr.code.gui.AppWindow;
import com.fjr.code.gui.maestros.TipoEstudioDialog;
import com.fjr.code.gui.tables.maestros.JTableTiposDeEstudio;

/**
 * 
 * Class: TipoEstudioDialogOperations
 * Creation Date: 03/11/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class TipoEstudioDialogOperations implements ActionListener{
	public static final String ACTION_COMMAND_BTN_GUARDAR = "btnGuardar";
	public static final String ACTION_COMMAND_BTN_ELIMINAR = "btnEliminar";
	public static final String ACTION_COMMAND_BTN_CANCELAR = "btnCancelar";
	
	private TipoEstudioDialog ventana;
	
	/**
	 * 
	 * @param ventana
	 */
	public TipoEstudioDialogOperations(TipoEstudioDialog ventana) {
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
		
		if("".equals(ventana.getTxtNombre().getText().trim())){
			errors += "Debe indicar el nombre del Tipo de Estudio.\n";
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
	 * @param tipoEstudioDTO
	 */
	private void buildDTOFromWindow(TipoEstudioDTO tipoEstudioDTO){
		tipoEstudioDTO.setNombre(ventana.getTxtNombre().getText());
		tipoEstudioDTO.setAbreviatura(ventana.getTxtAbreviatura().getText());
	}
	
	@Override
	public void actionPerformed(ActionEvent e) {
		// TODO Auto-generated method stub
		if(ACTION_COMMAND_BTN_GUARDAR.equals(e.getActionCommand())){
			if(validateWindow()){
				TipoEstudioDTO tipoEstudioDTO = new TipoEstudioDTO();
				buildDTOFromWindow(tipoEstudioDTO);
				
				if(ventana.getIdTipoEstudio() == -1){
					int idInserted = TipoEstudioDAO.insert(tipoEstudioDTO);
					if(idInserted > -1){
						//se inserto bien el registro
						ventana.setIdTipoEstudio(idInserted);
						JOptionPane.showMessageDialog(ventana, 
								"Tipo de Estudio creado de manera exitosa", 
								"Registro guardado", 
								JOptionPane.INFORMATION_MESSAGE);
					} else {
						//error creando el registro en la base de datos
						JOptionPane.showMessageDialog(ventana, 
								"El Tipo de Estudio no pudo ser creado", 
								"Error en la operación", 
								JOptionPane.ERROR_MESSAGE);
					}
				} else {
					tipoEstudioDTO.setId(ventana.getIdTipoEstudio());
					if(TipoEstudioDAO.update(tipoEstudioDTO)){
						JOptionPane.showMessageDialog(ventana, 
								"Tipo de Estudio actualizado de manera exitosa", 
								"Registro actualizado", 
								JOptionPane.INFORMATION_MESSAGE);
					} else {
						JOptionPane.showMessageDialog(ventana, 
								"El Tipo de Estudio no pudo ser actualizado", 
								"Error en la operación", 
								JOptionPane.ERROR_MESSAGE);
					}
				}
			}
		} else if(ACTION_COMMAND_BTN_ELIMINAR.equals(e.getActionCommand())){
			int option = JOptionPane.showConfirmDialog(ventana, "Está seguro que desea eliminar este registro del Sistema?", 
					"Desea eliminar el registro?", 
					JOptionPane.YES_NO_OPTION);
			if(option == JOptionPane.YES_OPTION){
				if(TipoEstudioDAO.delete(ventana.getIdTipoEstudio())){
					JOptionPane.showMessageDialog(ventana, "El registro fue eliminado de manera exitosa", 
							"Registro eliminado", 
							JOptionPane.INFORMATION_MESSAGE);
					ventana.setVisible(false);
					ventana.dispose();
				} else {
					JOptionPane.showMessageDialog(ventana, "El registro no pudo ser eliminado", 
							"Registro No Eliminado", 
							JOptionPane.ERROR_MESSAGE);
				}
			}
		} else if(ACTION_COMMAND_BTN_CANCELAR.equals(e.getActionCommand())){
			ventana.setVisible(false);
			ventana.dispose();
		}
		
		List<TipoEstudioDTO> results = TipoEstudioDAO.searchAllByCriteria(null);
		if(results != null){
			AppWindow.getInstance().setPanelContenido(null, 
					JTableTiposDeEstudio.getNewInstance(results).getJTable());
		}
	}
}
