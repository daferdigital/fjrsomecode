package com.fjr.code.gui.operations.maestros;

import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.util.List;

import javax.swing.JOptionPane;

import com.fjr.code.dao.PatologoDAO;
import com.fjr.code.dto.PatologoDTO;
import com.fjr.code.gui.AppWindow;
import com.fjr.code.gui.maestros.PatologoDialog;
import com.fjr.code.gui.tables.maestros.JTablePatologos;

/**
 * 
 * Class: TipoEstudioDialogOperations
 * Creation Date: 03/11/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class PatologoDialogOperations implements ActionListener{
	public static final String ACTION_COMMAND_BTN_GUARDAR = "btnGuardar";
	public static final String ACTION_COMMAND_BTN_ELIMINAR = "btnEliminar";
	public static final String ACTION_COMMAND_BTN_CANCELAR = "btnCancelar";
	
	private PatologoDialog ventana;
	
	/**
	 * 
	 * @param ventana
	 */
	public PatologoDialogOperations(PatologoDialog ventana) {
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
		
		if("".equals(ventana.getTextNombre().getText().trim())){
			errors += "Debe indicar el nombre del Patologo.\n";
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
	 * @param patologoDTO
	 */
	private void buildDTOFromWindow(PatologoDTO patologoDTO){
		patologoDTO.setNombre(ventana.getTextNombre().getText());
		patologoDTO.setActivo(true);
		patologoDTO.setGenero((String) ventana.getcBoxGenero().getSelectedItem());
	}
	
	@Override
	public void actionPerformed(ActionEvent e) {
		// TODO Auto-generated method stub
		if(ACTION_COMMAND_BTN_GUARDAR.equals(e.getActionCommand())){
			if(validateWindow()){
				PatologoDTO patologoDTO = new PatologoDTO();
				buildDTOFromWindow(patologoDTO);
				
				if(ventana.getIdPatologo() == -1){
					int idInserted = PatologoDAO.insert(patologoDTO);
					if(idInserted > -1){
						//se inserto bien el registro
						ventana.setIdPatologo(idInserted);
						JOptionPane.showMessageDialog(ventana, 
								"Patologo creado de manera exitosa", 
								"Registro guardado", 
								JOptionPane.INFORMATION_MESSAGE);
					} else {
						//error creando el registro en la base de datos
						JOptionPane.showMessageDialog(ventana, 
								"El Patologo no pudo ser creado", 
								"Error en la operación", 
								JOptionPane.ERROR_MESSAGE);
					}
				} else {
					patologoDTO.setId(ventana.getIdPatologo());
					if(PatologoDAO.update(patologoDTO)){
						JOptionPane.showMessageDialog(ventana, 
								"Patologo actualizado de manera exitosa", 
								"Registro actualizado", 
								JOptionPane.INFORMATION_MESSAGE);
					} else {
						JOptionPane.showMessageDialog(ventana, 
								"El Patologo no pudo ser actualizado", 
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
				if(PatologoDAO.delete(ventana.getIdPatologo())){
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
		
		List<PatologoDTO> results = PatologoDAO.searchAllByCriteria(null);
		if(results != null){
			AppWindow.getInstance().setPanelContenido(null, 
					JTablePatologos.getNewInstance(results, ventana.getBusquedaPatologosPanel()).getJTable());
		}
	}
}
