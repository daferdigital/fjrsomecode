package com.fjr.code.gui.operations.maestros;

import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.util.List;

import javax.swing.JOptionPane;

import com.fjr.code.dao.ExamenesDAO;
import com.fjr.code.dto.EspecialidadDTO;
import com.fjr.code.dto.ExamenBiopsiaDTO;
import com.fjr.code.gui.AppWindow;
import com.fjr.code.gui.maestros.ExamenDialog;
import com.fjr.code.gui.tables.maestros.JTableExamenBiopsia;

/**
 * 
 * Class: ExamenDialogOperations
 * Creation Date: 03/11/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class ExamenDialogOperations implements ActionListener{
	public static final String ACTION_COMMAND_BTN_GUARDAR = "btnGuardar";
	public static final String ACTION_COMMAND_BTN_ELIMINAR = "btnEliminar";
	public static final String ACTION_COMMAND_BTN_CANCELAR = "btnCancelar";
	
	private ExamenDialog ventana;
	
	/**
	 * 
	 * @param ventana
	 */
	public ExamenDialogOperations(ExamenDialog ventana) {
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
		
		if("".equals(ventana.getTxtCodigo().getText())){
			errors += "Debe indicar el codigo del examen.\n";
		}
		if("".equals(ventana.getTxtNombre().getText())){
			errors += "Debe indicar el nombre del examen.\n";
		}
		/*
		if("".equals(ventana.getTxtCodigoPremium().getText())){
			errors += "Debe indicar el codigo Premium del examen.\n";
		}
		*/
		
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
	 * @param especialidad
	 */
	private void buildDTOFromWindow(ExamenBiopsiaDTO examenDTO){
		examenDTO.setCodigoExamen(ventana.getTxtCodigo().getText());
		examenDTO.setNombreExamen(ventana.getTxtNombre().getText());
		examenDTO.setDiasParaResultado(ventana.getComboDias().getSelectedIndex() + 1);
		examenDTO.setIdTipoExamen(((EspecialidadDTO) ventana.getComboEspecialidad().getSelectedItem()).getId());
		examenDTO.setCodigoPremium("");
	}
	
	@Override
	public void actionPerformed(ActionEvent e) {
		// TODO Auto-generated method stub
		if(ACTION_COMMAND_BTN_GUARDAR.equals(e.getActionCommand())){
			if(validateWindow()){
				ExamenBiopsiaDTO examenDTO = new ExamenBiopsiaDTO();
				buildDTOFromWindow(examenDTO);
				
				if(ventana.getIdExamen() == -1){
					int idCreated = ExamenesDAO.insert(examenDTO);
					if(idCreated > -1){
						//se inserto bien el registro
						ventana.setIdExamen(idCreated);
						JOptionPane.showMessageDialog(ventana, 
								"Examen creado de manera exitosa", 
								"Examen creada", 
								JOptionPane.INFORMATION_MESSAGE);
					} else {
						//error creando el registro en la base de datos
						JOptionPane.showMessageDialog(ventana, 
								"El examen no pudo ser creado", 
								"Error en la operación", 
								JOptionPane.ERROR_MESSAGE);
					}
				} else {
					examenDTO.setId(ventana.getIdExamen());
					if(ExamenesDAO.update(examenDTO)){
						//se actualizo bien el registro
						JOptionPane.showMessageDialog(ventana, 
								"Examen actualizado de manera exitosa", 
								"Examen actualizado", 
								JOptionPane.INFORMATION_MESSAGE);
					} else {
						//error actualizando el registro en la base de datos
						JOptionPane.showMessageDialog(ventana, 
								"El Examen no pudo ser actualizado", 
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
				if(ExamenesDAO.delete(ventana.getIdExamen())){
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
		
		List<ExamenBiopsiaDTO> results = ExamenesDAO.searchAllByCriteria(null);
		if(results != null){
			AppWindow.getInstance().setPanelContenido(null, 
					JTableExamenBiopsia.getNewInstance(results).getJTable());
		}
	}
}
