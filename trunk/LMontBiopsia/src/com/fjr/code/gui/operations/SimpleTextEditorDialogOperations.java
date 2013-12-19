package com.fjr.code.gui.operations;

import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

import javax.swing.JOptionPane;

import org.apache.log4j.Logger;

import com.fjr.code.dao.TextoInteligenteDAO;
import com.fjr.code.dto.TextoInteligenteDTO;
import com.fjr.code.gui.BusquedaTextoInteligenteDialog;
import com.fjr.code.gui.SimpleTextEditorDialog;

/**
 * 
 * Class: SimpleTextEditorDialogOperations
 * Creation Date: 17/12/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class SimpleTextEditorDialogOperations implements ActionListener{
	private static final Logger log = Logger.getLogger(SimpleTextEditorDialogOperations.class);
	public static final String ACTION_COMMAND_OK = "Ok";
	public static final String ACTION_COMMAND_GUARDAR = "Guardar";
	public static final String ACTION_COMMAND_BUSCAR = "Buscar";
	public static final String ACTION_COMMAND_CANCEL = "Cancel";
	
	private SimpleTextEditorDialog ventana;
	
	/**
	 * 
	 * @param ventana
	 */
	public SimpleTextEditorDialogOperations(SimpleTextEditorDialog ventana) {
		// TODO Auto-generated constructor stub
		this.ventana = ventana;
	}

	@Override
	public void actionPerformed(ActionEvent arg0) {
		// TODO Auto-generated method stub
		if(ACTION_COMMAND_OK.equals(arg0.getActionCommand())
				|| ACTION_COMMAND_CANCEL.equals(arg0.getActionCommand())){
			
			if(ACTION_COMMAND_OK.equals(arg0.getActionCommand())){
				ventana.getReferencia().setText(ventana.getTxtArea().getText());
			}

			ventana.setVisible(false);
			ventana.dispose();
		}else if(ACTION_COMMAND_GUARDAR.equals(arg0.getActionCommand())){
			//validamos la ventana para guardar el valor
			if(validateWindow()){
				TextoInteligenteDTO registro = new TextoInteligenteDTO();
				registro.setAbreviatura(ventana.getTextAbreviatura().getText());
				registro.setKeyCode(ventana.getTextCodigo().getText());
				registro.setTexto(ventana.getTxtArea().getText());
				
				boolean recordExists = false;
				boolean wantUpdate = false;
				if(TextoInteligenteDAO.getByKeyCode(registro.getKeyCode().trim()) != null){
					//el registro existe, preguntamos si desea modificarlo
					recordExists = true;
					
					int response = JOptionPane.showConfirmDialog(ventana,
							"El codigo indicado ya existe, desea modificarlo?",
							"Registro ya existe.",
							JOptionPane.YES_NO_OPTION);
					
					if(response == JOptionPane.YES_OPTION){
						wantUpdate = true;
					}
				}
				
				if(!recordExists){
					if(TextoInteligenteDAO.insert(registro)){
						// se guardo el registro correctamente
					} else {
						//error al almacenar el registro de texto inteligente
					}
				} else {
					if(wantUpdate){
						if(TextoInteligenteDAO.update(registro)){
							//se modifico el registro
						} else {
							//el registro no pudo ser modificado
						}
					}
				}
				
			}
		}else if(ACTION_COMMAND_BUSCAR.equals(arg0.getActionCommand())){
			new BusquedaTextoInteligenteDialog(ventana).setVisible(true);
		}
		
	}
	
	/**
	 * 
	 * @return
	 */
	private boolean validateWindow(){
		boolean hadError = false;
		
		String error = "";
		
		if("".equals(ventana.getTextCodigo().getText().trim())){
			error += "Debe indicar el codigo.\n";
		}
		if("".equals(ventana.getTextAbreviatura().getText().trim())){
			error += "Debe indicar la abreviatura.\n";
		}
		if("".equals(ventana.getTxtArea().getText().trim())){
			error += "Debe indicar el texto a ser almacenado.\n";
		}
		
		if(! "".equals(error)){
			JOptionPane.showMessageDialog(ventana, 
					"Se han presentado los siguientes detalles:\n" + error, 
					"Faltan campos", 
					JOptionPane.ERROR_MESSAGE);
			hadError = true;
		}
		
		return !hadError;
	}
}
