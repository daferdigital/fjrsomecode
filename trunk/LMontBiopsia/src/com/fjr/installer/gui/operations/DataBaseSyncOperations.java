package com.fjr.installer.gui.operations;

import java.awt.Cursor;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.util.LinkedList;
import java.util.List;

import javax.swing.JOptionPane;
import javax.swing.SwingUtilities;

import org.apache.log4j.Logger;

import com.fjr.code.util.DBConnectionSetUpUtil;
import com.fjr.code.util.DBUtilSetUp;
import com.fjr.installer.gui.DataBaseSync;

/**
 * 
 * Class: DataBaseCreateOperations
 * Creation Date: 17/09/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class DataBaseSyncOperations implements ActionListener {
	private static final Logger log = Logger.getLogger(DataBaseSyncOperations.class);
	public static final String ACTION_COMMAND_BTN_TEST_CONNECTION = "btnTestConnection";
	public static final String ACTION_COMMAND_BTN_CREATE_DB = "btnCreateDB";
	public static final String ACTION_COMMAND_BTN_CANCEL = "btnCancel";
	
	private DataBaseSync ventana;
	
	/**
	 * 
	 * @param ventana
	 */
	public DataBaseSyncOperations(DataBaseSync ventana) {
		// TODO Auto-generated constructor stub
		this.ventana = ventana;
	}

	@Override
	public void actionPerformed(ActionEvent e) {
		// TODO Auto-generated method stub
		if(e.getActionCommand().equals(ACTION_COMMAND_BTN_CANCEL)){
			ventana.dispose();
		} else if(e.getActionCommand().equals(ACTION_COMMAND_BTN_TEST_CONNECTION)
				|| (e.getActionCommand().equals(ACTION_COMMAND_BTN_CREATE_DB))){
			//probamos la conexion
			DBConnectionSetUpUtil.writePropertiesToFile(ventana.getTxtServidor().getText(), 
					ventana.getTxtPuerto().getText(), 
					ventana.getTxtClaveRoot().getText(),
					ventana.getTxtNombreBaseDatos().getText());
			boolean connectionIsValid = DBConnectionSetUpUtil.haveValidConnectionConfiguration();
			
			if(connectionIsValid){
				if(e.getActionCommand().equals(ACTION_COMMAND_BTN_CREATE_DB)){
					ventana.setCursor(Cursor.getPredefinedCursor(Cursor.WAIT_CURSOR));
					
					if(! "".equals(ventana.getTxtNombreBaseDatos().getText())){
						//sincronizamos
						final String selectClientes = "SELECT * from cliempre";
					} else {
						JOptionPane.showMessageDialog(ventana, 
								"Debe colocar el nombre de la base de datos origen, para la sincronización.", 
								"Falta base de datos origen", 
								JOptionPane.ERROR_MESSAGE);
					}
				} else {
					JOptionPane.showMessageDialog(ventana, 
							"La configuración de la conexión al servidor es correcta.", 
							"Configuración correcta", 
							JOptionPane.INFORMATION_MESSAGE);
				}
			} else {
				JOptionPane.showMessageDialog(ventana, 
						"Error en la configuración de la conexión.", 
						"Configuración de conexión errada", 
						JOptionPane.ERROR_MESSAGE);
			}
			
			ventana.setCursor(Cursor.getPredefinedCursor(Cursor.DEFAULT_CURSOR));
		}
	}
	
	/**
	 * 
	 * @param commands
	 * @return
	 */
	private boolean executeCommands(String[] commands, List<Integer> indexesToTry,
			int taskPercent, int initialValue){
		boolean result = true;
		
		log.info("Iniciando creacion de querys");
		int i = 0;
		indexesToTry = indexesToTry == null ? new LinkedList<Integer>(): indexesToTry;
		int stepValue = taskPercent / commands.length;
		
		for (String comando : commands) {
			if(! DBUtilSetUp.executeNonSelectQuery(comando)){
				if(! indexesToTry.contains(i)){
					result = false;
					log.error("Ejecutado comando: " + comando);
					ventana.getProgressBar().setValue(0);
					break;
				}
			}
			
			updateProgresBarValue(ventana.getProgressBar().getValue() + stepValue);
			log.info("Ejecutado comando: " + comando);
		}
		
		if(result){
			updateProgresBarValue(taskPercent + initialValue);
		}
		
		return result;
	}
	
	/**
	 * 
	 * @param value
	 */
	private void updateProgresBarValue(final int value){
		SwingUtilities.invokeLater(new Runnable(){
			@Override
			public void run() {
				// TODO Auto-generated method stub
				ventana.getProgressBar().setValue(value);
				try {
					Thread.sleep(10);
				} catch (InterruptedException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}
			}
		});
		
	}
}
