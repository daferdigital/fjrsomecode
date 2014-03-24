package com.fjr.code.gui.operations.maestros;

import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

import javax.swing.JOptionPane;

import org.apache.log4j.Logger;

import com.fjr.code.dao.UsuarioDAO;
import com.fjr.code.dto.UsuarioDTO;
import com.fjr.code.gui.maestros.UsuarioDialog;

/**
 * 
 * Class: UsuarioDialogOperations
 * Creation Date: 22/03/2014
 * (c) 2014
 *
 * @author T&T
 *
 */
public class UsuarioDialogOperations implements ActionListener{
	private static final Logger log = Logger.getLogger(UsuarioDialogOperations.class);
	public static final String ACTION_COMMAND_OK = "guardar";
	public static final String ACTION_COMMAND_CANCEL = "cancelar";
	public static final String ACTION_COMMAND_MODIFY_PERMISSIONS = "modifyAllPermisions";
	
	private UsuarioDialog ventana;
	
	/**
	 * 
	 * @param ventana
	 */
	public UsuarioDialogOperations(UsuarioDialog ventana) {
		// TODO Auto-generated constructor stub
		this.ventana = ventana;
	}
	
	@Override
	public void actionPerformed(ActionEvent e) {
		// TODO Auto-generated method stub
		if(ACTION_COMMAND_MODIFY_PERMISSIONS.equals(e.getActionCommand())){
			ventana.markAllPermissions(ventana.getRbtnAllPermissions().isSelected());
		} else if(ACTION_COMMAND_OK.equals(e.getActionCommand())){
			UsuarioDTO usuario = buildDTOFromWindow();
			
			if(ventana.getIdUsuario() < 0){
				//se esta creando un usuario
				//verificamos que el login no exista
				if(UsuarioDAO.getByLogin(usuario.getLogin()) == null){
					int newId = UsuarioDAO.createUsuario(usuario);
					if(newId > 0){
						ventana.setIdUsuario(newId);
						usuario.setId(newId);
						log.info("Creado el usuario '" + usuario.getLogin() + "' con el id " + newId);
						
						UsuarioDAO.setPermisosToUsuario(usuario.getId(),
								ventana.getPermisosList());
						
						JOptionPane.showMessageDialog(ventana, 
								"La información y permisos del usuario fueron creadas.", 
								"Actualición Realizada", 
								JOptionPane.INFORMATION_MESSAGE);
					} else {
						JOptionPane.showMessageDialog(ventana, 
								"La actualización solicitada no pudo ser completada.", 
								"Error", 
								JOptionPane.ERROR_MESSAGE);
					}
				} else {
					JOptionPane.showMessageDialog(ventana, 
							"El login indicado ya existe.", 
							"Error", 
							JOptionPane.ERROR_MESSAGE);
				}
			} else {
				//se esta editando un usuario
				if(UsuarioDAO.updateUsuario(usuario)){
					log.info("Actualizado el usuario '" + usuario.getLogin() + "' de id " + usuario.getId());
					UsuarioDAO.setPermisosToUsuario(usuario.getId(),
							ventana.getPermisosList());
					
					JOptionPane.showMessageDialog(ventana, 
							"La información y permisos del usuario fueron actualizadas.", 
							"Actualición Realizada", 
							JOptionPane.INFORMATION_MESSAGE);
				} else {
					JOptionPane.showMessageDialog(ventana, 
							"La actualización solicitada no pudo ser completada.", 
							"Error", 
							JOptionPane.ERROR_MESSAGE);
				}
			}
		} else if(ACTION_COMMAND_CANCEL.equals(e.getActionCommand())){
			ventana.setVisible(false);
			ventana.dispose();
		}
	}
	
	/**
	 * 
	 * @return
	 */
	private UsuarioDTO buildDTOFromWindow(){
		UsuarioDTO usuario = new UsuarioDTO();
		usuario.setId(ventana.getIdUsuario());
		usuario.setNombre(ventana.getTxtNombre().getText());
		usuario.setLogin(ventana.getTxtLogin().getText());
		usuario.setClave(new String(ventana.getTxtPassword().getPassword()));
		return usuario;
	}
}
