package com.fjr.code.gui.operations;

import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

import javax.swing.JOptionPane;

import com.fjr.code.dao.UsuarioDAO;
import com.fjr.code.dto.UsuarioDTO;
import com.fjr.code.gui.AppWindow;
import com.fjr.code.gui.LoginWindow;

/**
 * 
 * Class: LoginWindowOperations
 * Creation Date: 14/12/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class LoginWindowOperations implements ActionListener {
	public static final String ACTION_COMMAND_DO_LOGIN = "doLogin";
	public static final String ACTION_COMMAND_CANCEL = "cancel";
	public static final String ACTION_COMMAND_OPEN_HELP = "openHelp";
	
	private LoginWindow ventana;
	
	/**
	 * 
	 * @param ventana
	 */
	public LoginWindowOperations(LoginWindow ventana) {
		// TODO Auto-generated constructor stub
		this.ventana = ventana;
	}
	
	@Override
	public void actionPerformed(ActionEvent e) {
		// TODO Auto-generated method stub
		if(ACTION_COMMAND_DO_LOGIN.equals(e.getActionCommand())){
			//verificamos las credenciales del login
			if(validateWindowData()){
				//se tiene texto valido en los campos de login y clave
				//validamos los mismos
				UsuarioDTO usuario = UsuarioDAO.getByLogin(ventana.getLoginTxt().getText().trim());
				if(usuario == null){
					//no se encontro el login en la base de datos
					JOptionPane.showMessageDialog(ventana, 
							"El usuario indicado no está registrado en el sistema.", 
							"Usuario no existe", 
							JOptionPane.ERROR_MESSAGE);
				} else {
					//el usuario existe, confirmamos su clave y si esta activo o no
					if(! usuario.isActivo()){
						JOptionPane.showMessageDialog(ventana, 
								"La cuenta del usuario indicado no se encuentra activa.", 
								"La cuenta no está activa", 
								JOptionPane.ERROR_MESSAGE);
					} else {
						if(UsuarioDAO.checkPwdValidity(ventana.getLoginTxt().getText().trim(), 
								new String(ventana.getPwdField().getPassword()).trim())){
							//credenciales correctas
							ventana.setVisible(false);
							ventana.dispose();
							AppWindow.show();
						} else {
							JOptionPane.showMessageDialog(ventana, 
									"La clave indicada no es correcta, por favor intente de nuevo.", 
									"Clave incorrecta", 
									JOptionPane.ERROR_MESSAGE);
						}
					}
				}
			}
		}
	}
	
	/**
	 * 
	 * @return
	 */
	private boolean validateWindowData(){
		boolean isValid = true;
		
		String error = "";
		
		if("".equals(ventana.getLoginTxt().getText().trim())){
			error += "Disculpe, debe indicar un valor válido para el login.";
			isValid = false;
		}
		if("".equals(new String(ventana.getPwdField().getPassword()).trim())){
			error += "\nDisculpe, debe indicar un valor válido para la clave.";
			isValid = false;
		}	
		
		if(!isValid){
			JOptionPane.showMessageDialog(ventana, 
					error, 
					"Error al validar credenciales", 
					JOptionPane.WARNING_MESSAGE);
		}
		
		return isValid;
	}
}
