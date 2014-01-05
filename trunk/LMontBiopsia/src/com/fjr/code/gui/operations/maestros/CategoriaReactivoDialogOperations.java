package com.fjr.code.gui.operations.maestros;

import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.util.List;

import javax.swing.JOptionPane;

import com.fjr.code.dao.CategoriaReactivoDAO;
import com.fjr.code.dto.CategoriaReactivoDTO;
import com.fjr.code.gui.AppWindow;
import com.fjr.code.gui.maestros.CategoriaReactivoDialog;
import com.fjr.code.gui.tables.maestros.JTableCategoriaReactivo;

/**
 * 
 * Class: TipoEstudioDialogOperations
 * Creation Date: 03/11/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class CategoriaReactivoDialogOperations implements ActionListener{
	public static final String ACTION_COMMAND_BTN_GUARDAR = "btnGuardar";
	public static final String ACTION_COMMAND_BTN_CANCELAR = "btnCancelar";
	
	private CategoriaReactivoDialog ventana;
	
	/**
	 * 
	 * @param ventana
	 */
	public CategoriaReactivoDialogOperations(CategoriaReactivoDialog ventana) {
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
			errors += "Debe indicar el nombre de la Categoria del Reactivo.\n";
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
	 * @param categoriaReactivoDTO
	 */
	private void buildDTOFromWindow(CategoriaReactivoDTO categoriaReactivoDTO){
		categoriaReactivoDTO.setNombre(ventana.getTxtNombre().getText());
	}
	
	@Override
	public void actionPerformed(ActionEvent e) {
		// TODO Auto-generated method stub
		if(ACTION_COMMAND_BTN_GUARDAR.equals(e.getActionCommand())){
			if(validateWindow()){
				CategoriaReactivoDTO categoriaReactivoDTO = new CategoriaReactivoDTO();
				buildDTOFromWindow(categoriaReactivoDTO);
				
				if(ventana.getIdCategoriaReactivo() == -1){
					int idInserted = CategoriaReactivoDAO.insert(categoriaReactivoDTO);
					if(idInserted > -1){
						//se inserto bien el registro
						ventana.setIdCategoriaReactivo(idInserted);
						JOptionPane.showMessageDialog(ventana, 
								"Categoria de Reactivo creada de manera exitosa", 
								"Registro guardado", 
								JOptionPane.INFORMATION_MESSAGE);
					} else {
						//error creando el registro en la base de datos
						JOptionPane.showMessageDialog(ventana, 
								"La Categoria de Reactivo no pudo ser creada", 
								"Error en la operación", 
								JOptionPane.ERROR_MESSAGE);
					}
				} else {
					categoriaReactivoDTO.setId(ventana.getIdCategoriaReactivo());
					if(CategoriaReactivoDAO.update(categoriaReactivoDTO)){
						JOptionPane.showMessageDialog(ventana, 
								"Categoria de Reactivo actualizada de manera exitosa", 
								"Registro actualizado", 
								JOptionPane.INFORMATION_MESSAGE);
					} else {
						JOptionPane.showMessageDialog(ventana, 
								"La Categoria de Reactivo no pudo ser actualizada", 
								"Error en la operación", 
								JOptionPane.ERROR_MESSAGE);
					}
				}
			}
		} else if(ACTION_COMMAND_BTN_CANCELAR.equals(e.getActionCommand())){
			ventana.setVisible(false);
			ventana.dispose();
		}
		
		List<CategoriaReactivoDTO> results = CategoriaReactivoDAO.searchAllByCriteria(null);
		if(results != null){
			AppWindow.getInstance().setPanelContenido(null, 
					JTableCategoriaReactivo.getNewInstance(results).getJTable());
		}
	}
}
