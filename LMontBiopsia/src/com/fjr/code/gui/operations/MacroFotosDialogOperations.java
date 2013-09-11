package com.fjr.code.gui.operations;

import java.awt.Image;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

import javax.swing.Icon;
import javax.swing.ImageIcon;
import javax.swing.JFileChooser;
import javax.swing.JOptionPane;

import org.apache.log4j.Logger;

import com.fjr.code.gui.MacroFotosDialog;

/**
 * 
 * Class: MacroFotosDialogOperations
 * Creation Date: 08/09/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class MacroFotosDialogOperations implements ActionListener{
	/**
	 * 
	 */
	private static final Logger log = Logger.getLogger(MacroFotosDialogOperations.class);
	
	public static final String ACTION_COMMAND_BTN_SUBIR_FOTO = "btnSubirFoto";
	public static final String ACTION_COMMAND_BTN_GUARDAR = "btnGuardar";
	public static final String ACTION_COMMAND_BTN_CANCELAR = "btnCancelar";
	
	private MacroFotosDialog ventana;
	
	/**
	 * 
	 * @param ventana
	 */
	public MacroFotosDialogOperations(MacroFotosDialog ventana) {
		// TODO Auto-generated constructor stub
		this.ventana = ventana;
	}
	
	@Override
	public void actionPerformed(ActionEvent e) {
		// TODO Auto-generated method stub
		if(ACTION_COMMAND_BTN_SUBIR_FOTO.equals(e.getActionCommand())){
			//debemos subir la foto
			if(JFileChooser.APPROVE_OPTION == ventana.getFileChooser().showOpenDialog(ventana)){
				String fileName = ventana.getFileChooser().getSelectedFile().getAbsolutePath();
				log.info(fileName);
				
				Icon icon = new ImageIcon(new ImageIcon(fileName).getImage().getScaledInstance(ventana.getLblFoto().getWidth(),
						ventana.getLblFoto().getHeight(),
						Image.SCALE_AREA_AVERAGING));
				//debo colocarla como icono en la etiqueta respectiva
				ventana.getLblFoto().setIcon(icon);
			}
		} else if(ACTION_COMMAND_BTN_CANCELAR.equals(e.getActionCommand())){
			//debemos subir la foto
			ventana.dispose();
		} else if(ACTION_COMMAND_BTN_GUARDAR.equals(e.getActionCommand())){
			//debemos validar la ventana para guardarla
			String errors = "";
			
			if("".equals(ventana.getTxtNotacion().getText())){
				errors += "\nLa notación es obligatoria.";
			}
			if(ventana.getLblFoto().getIcon() == null){
				errors += "\nLa foto es obligatoria";
			}
			
			if(! "".equals(errors)){
				JOptionPane.showMessageDialog(ventana, 
						"Disculpe, faltan los siguientes campos: \n" + errors, 
						"Faltan campos obligatorios", 
						JOptionPane.ERROR_MESSAGE);
			} else {
				if(ventana.getRowOrigin() == -1){
					ventana.getRelatedTable().addRow(ventana.getTxtNotacion().getText(),
							ventana.getTextADescripcion().getText(), 
							ventana.getFileChooser().getSelectedFile().getAbsolutePath());
				} else {
					String pathToPicture = ventana.getPathToPicture();
					if(ventana.getFileChooser() != null
							&& ventana.getFileChooser().getSelectedFile() != null){
						pathToPicture = ventana.getFileChooser().getSelectedFile().getAbsolutePath();
					}
					
					ventana.getRelatedTable().updateRow(ventana.getRowOrigin(), 
							ventana.getTxtNotacion().getText(),
							ventana.getTextADescripcion().getText(), 
							pathToPicture);
				}
				ventana.dispose();
			}
		}
	}
}
