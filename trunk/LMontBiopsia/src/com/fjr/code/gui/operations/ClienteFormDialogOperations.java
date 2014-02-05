package com.fjr.code.gui.operations;

import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.KeyEvent;
import java.awt.event.KeyListener;

import javax.swing.JOptionPane;
import javax.swing.JTextField;

import org.apache.log4j.Logger;

import com.fjr.code.dao.ClienteDAO;
import com.fjr.code.dao.definitions.TipoEdadEnum;
import com.fjr.code.dto.ClienteDTO;
import com.fjr.code.dto.TipoCedulaDTO;
import com.fjr.code.gui.ClienteFormDialog;
import com.fjr.code.gui.IngresoPanel;
import com.fjr.code.util.KeyEventsUtil;

/**
 * 
 * Class: ClienteFormDialogOperations
 * Creation Date: 31/08/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class ClienteFormDialogOperations implements KeyListener, ActionListener{
	private static final Logger log = Logger.getLogger(ClienteFormDialogOperations.class);
	public static final String ACTION_COMMAND_BUTTON_OK = "ok";
	public static final String ACTION_COMMAND_BUTTON_CANCEL = "cancel";
	public static final String ACTION_COMMAND_TEXT_CEDULA = "nroCedula";
	public static final String ACTION_COMMAND_TEXT_CORREO = "textCorreo";
	
	
	private ClienteFormDialog ventana;
	
	/**
	 * 
	 * @param ventana
	 */
	public ClienteFormDialogOperations(ClienteFormDialog ventana) {
		// TODO Auto-generated constructor stub
		this.ventana = ventana;
	}

	@Override
	public void actionPerformed(ActionEvent e) {
		// TODO Auto-generated method stub
		if(ACTION_COMMAND_BUTTON_CANCEL.equals(e.getActionCommand())){
			//se desea cerrar la ventana
			ventana.setVisible(false);
			ventana.dispose();
		} else if(ACTION_COMMAND_BUTTON_OK.equals(e.getActionCommand())){
			//se desea guardar los datos de la ventana
			//debemos validarlos
			String errors = "";
			/*
			if("".equals(ventana.getTextNroCedula().getText().trim())){
				errors += "La cédula es obligatoria.\n";
			}
			if("".equals(ventana.getTextNombre().getText().trim())){
				errors += "El nombre es obligatorio.\n";
			}
			if("".equals(ventana.getTextApellido().getText().trim())){
				errors += "El apellido es obligatorio.\n";
			}
			if("".equals(ventana.getTextTelefono().getText().trim())){
				errors += "El teléfono es obligatorio.\n";
			}
			*/
			if(! "".equals(ventana.getTextCorreo().getText())){
				if(! KeyEventsUtil.isAValidEmailAddress(ventana.getTextCorreo().getText())){
					errors += "La dirección de correo no es válida.\n";
				}
			}
			
			if("".equals(errors)){
				//verifico si es un insert o una actualizacion
				if(ventana.getCliente() == null){
					log.in
				} else {
					
				}
				//procedo a insertar
				int newId = ClienteDAO.insertRecord(new ClienteDTO(0, 
						"", 
						((TipoCedulaDTO) ventana.getComboTipoCedula().getSelectedItem()).getKeyCedula() + ventana.getTextNroCedula().getText(), 
						ventana.getTextNombre().getText(), 
						ventana.getTextApellido().getText(), 
						ventana.getComboEdad().getSelectedIndex(),
						(TipoEdadEnum) ventana.getcBoxTipoEdad().getSelectedItem(),
						ventana.getTextTelefono().getText(), 
						ventana.getTextCorreo().getText(), 
						ventana.getTextAreaDireccion().getText(), 
						true));
				if(newId > 0){
					//operacion exitosa
					JOptionPane.showMessageDialog(ventana, "Cliente agregado con éxito", 
							"Operación realizada", 
							JOptionPane.INFORMATION_MESSAGE);
					//coloco la info de vuelta si aplica
					if(ventana.getVentanaReferencia() instanceof IngresoPanel){
						IngresoPanel ref = (IngresoPanel) ventana.getVentanaReferencia();
						ref.getComboTipoCedula().setSelectedIndex(ventana.getComboTipoCedula().getSelectedIndex());
						ref.getTextNombrePaciente().setText(ventana.getTextNombre().getText());
						ref.getTextApellido().setText(ventana.getTextApellido().getText());
						ref.getTextEdad().setText(ventana.getComboEdad().getSelectedItem().toString());
					}
					
					ventana.setVisible(false);
					ventana.dispose();
				} else {
					//la operacion en base de datos fallo
					JOptionPane.showMessageDialog(ventana, 
							"La operación de registro ha fallado.\nPor favor intente de nuevo.", 
							"Registro fallido", 
							JOptionPane.ERROR_MESSAGE);
				}
			} else {
				//faltan campos
				JOptionPane.showMessageDialog(ventana,
						"Disculpe, han ocurrido los siguientes errores:\n" + errors, 
						"Se ha presentado un error", 
						JOptionPane.ERROR_MESSAGE);
			}
		}
	}

	@Override
	public void keyTyped(KeyEvent e) {
		// TODO Auto-generated method stub
		if(e.getSource() instanceof JTextField){
			JTextField field = (JTextField) e.getComponent();
			
			if(ACTION_COMMAND_TEXT_CEDULA.equals(field.getName())){
				//se tipeo un caracter en la cedula, verifico si es permitido
				if(! KeyEventsUtil.wasTypedANumber(e)){
					e.consume();
				}
			}
		}
	}

	@Override
	public void keyPressed(KeyEvent e) {
		// TODO Auto-generated method stub
		
	}

	@Override
	public void keyReleased(KeyEvent e) {
		// TODO Auto-generated method stub
		
	}
}
