package com.fjr.code.gui.operations.maestros;

import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.util.List;

import javax.swing.JOptionPane;

import com.fjr.code.dao.ReactivoDAO;
import com.fjr.code.dto.CategoriaReactivoDTO;
import com.fjr.code.dto.ReactivoDTO;
import com.fjr.code.gui.AppWindow;
import com.fjr.code.gui.maestros.ReactivoDialog;
import com.fjr.code.gui.tables.maestros.JTableReactivo;

/**
 * 
 * Class: ReactivoDialogOperations
 * Creation Date: 03/11/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class ReactivoDialogOperations implements ActionListener{
	public static final String ACTION_COMMAND_BTN_GUARDAR = "btnGuardar";
	public static final String ACTION_COMMAND_BTN_ELIMINAR = "btnEliminar";
	public static final String ACTION_COMMAND_BTN_CANCELAR = "btnCancelar";
	
	private ReactivoDialog ventana;
	
	/**
	 * 
	 * @param ventana
	 */
	public ReactivoDialogOperations(ReactivoDialog ventana) {
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
			errors += "Debe indicar el nombre del Reactivo.\n";
		}
		if("".equals(ventana.getTxtAbreviatura().getText().trim())){
			errors += "Debe indicar la abreviatura del Reactivo.\n";
		}
		if(0 == ventana.getcBoxCategoria().getSelectedIndex()){
			errors += "Debe indicar la Categoria del Reactivo.\n";
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
	private void buildDTOFromWindow(ReactivoDTO reactivoDTO){
		reactivoDTO.setNombre(ventana.getTxtNombre().getText());
		reactivoDTO.setAbreviatura(ventana.getTxtAbreviatura().getText());
		reactivoDTO.setCategoriaReactivoDTO(
				(CategoriaReactivoDTO) ventana.getcBoxCategoria().getSelectedItem());
	}
	
	@Override
	public void actionPerformed(ActionEvent e) {
		// TODO Auto-generated method stub
		if(ACTION_COMMAND_BTN_GUARDAR.equals(e.getActionCommand())){
			if(validateWindow()){
				ReactivoDTO reactivoDTO = new ReactivoDTO();
				buildDTOFromWindow(reactivoDTO);
				
				if(ventana.getIdReactivo() == -1){
					int idInserted = ReactivoDAO.insert(reactivoDTO);
					if(idInserted > -1){
						//se inserto bien el registro
						ventana.setIdReactivo(idInserted);
						JOptionPane.showMessageDialog(ventana, 
								"Reactivo creado de manera exitosa", 
								"Registro guardado", 
								JOptionPane.INFORMATION_MESSAGE);
					} else {
						//error creando el registro en la base de datos
						JOptionPane.showMessageDialog(ventana, 
								"El Reactivo no pudo ser creado", 
								"Error en la operación", 
								JOptionPane.ERROR_MESSAGE);
					}
				} else {
					reactivoDTO.setId(ventana.getIdReactivo());
					if(ReactivoDAO.update(reactivoDTO)){
						JOptionPane.showMessageDialog(ventana, 
								"Reactivo actualizado de manera exitosa", 
								"Registro actualizado", 
								JOptionPane.INFORMATION_MESSAGE);
					} else {
						JOptionPane.showMessageDialog(ventana, 
								"El Reactivo no pudo ser actualizado", 
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
				if(ReactivoDAO.delete(ventana.getIdReactivo())){
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
		
		List<ReactivoDTO> results = ReactivoDAO.searchAllByCriteria(null);
		if(results != null){
			AppWindow.getInstance().setPanelContenido(null, 
					JTableReactivo.getNewInstance(results).getJTable());
		}
	}
}
