package com.fjr.code.gui.operations;

import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

import javax.swing.JOptionPane;

import org.apache.log4j.Logger;

import com.fjr.code.gui.DataBaseConfigDialog;
import com.fjr.code.gui.LoginWindow;
import com.fjr.code.util.DBConnectionUtil;

/**
 * 
 * Class: DataBaseConfigDialogOperations
 * Creation Date: 14/09/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class DataBaseConfigDialogOperations implements ActionListener{
	/**
	 * 
	 */
	private static final Logger log = Logger.getLogger(DataBaseConfigDialogOperations.class);
	public static final String ACTION_COMMAND_TEST_CONNECTION = "btnTestConnection";
	public static final String ACTION_COMMAND_CANCELAR = "btnCancelar";
	
	private DataBaseConfigDialog ventana;
	
	/**
	 * 
	 * @param ventana
	 */
	public DataBaseConfigDialogOperations(DataBaseConfigDialog ventana) {
		// TODO Auto-generated constructor stub
		this.ventana = ventana;
	}

	@Override
	public void actionPerformed(ActionEvent e) {
		// TODO Auto-generated method stub
		if(ACTION_COMMAND_CANCELAR.equals(e.getActionCommand())){
			log.info("Se esta cancelando la configuracion de la conexion a base de datos");
			ventana.dispose();
		} else if(ACTION_COMMAND_TEST_CONNECTION.equals(e.getActionCommand())){
			//verificamos si los campos no son vacios
			if(validateWindowData()){
				//tenemos valores validos, procedemos a crear el archivo y verificar la conexion
				DBConnectionUtil.writePropertiesToFile(ventana.getTextServidor().getText().trim(), 
						ventana.getTextPuerto().getText().trim());
				log.info("Fue creado el archivo con las propiedades de conexion, se procede a probar la misma");
				
				if(DBConnectionUtil.haveValidConnectionConfiguration()){
					log.info("Configuracion exitosa, podemos continuar");
					JOptionPane.showMessageDialog(ventana, 
							"La conexión fue verificada de manera exitosa", 
							"Conexion exitosa", 
							JOptionPane.INFORMATION_MESSAGE);
					ventana.setVisible(false);
					new LoginWindow();
					ventana.dispose();
				} else {
					log.error("La configuracion indicada no es correcta");
					JOptionPane.showMessageDialog(ventana, 
							"Los valores indicados como servidor y puerto\n"
								+ "no permitieron establecer una conexion a la base de datos."
								+ "\n\nPor favor intente de nuevo", 
							"Conexion no realizada", 
							JOptionPane.ERROR_MESSAGE);
				}
			}
		}
	}
	
	private boolean validateWindowData(){
		boolean isValid = true;
		String errors = "";
		
		if("".equals(ventana.getTextServidor().getText().trim())){
			errors += "\nEl valor del Servidor debe ser indicado de manera obligatoria.";
		}
		if("".equals(ventana.getTextPuerto().getText().trim())){
			errors += "\nEl valor del puerto debe ser indicado de manera obligatoria.";
		}

		if("".equals(errors)){
			isValid = true;
		} else {
			JOptionPane.showMessageDialog(ventana,
					"Se han presentado los siguientes errores:\n" + errors, 
					"Error", 
					JOptionPane.ERROR_MESSAGE);
		}
		
		return isValid;
	}
}
