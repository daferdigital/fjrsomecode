package com.fjr.installer.gui.operations;

import java.awt.Cursor;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.util.Calendar;
import java.util.LinkedList;
import java.util.List;

import javax.swing.JOptionPane;

import org.apache.log4j.Logger;

import com.fjr.code.util.DBConnectionSetUpUtil;
import com.fjr.code.util.DBUtilSetUp;
import com.fjr.installer.gui.DataBaseCreate;

/**
 * 
 * Class: DataBaseCreateOperations
 * Creation Date: 17/09/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class DataBaseCreateOperations implements ActionListener {
	private static final Logger log = Logger.getLogger(DataBaseCreateOperations.class);
	public static final String ACTION_COMMAND_BTN_TEST_CONNECTION = "btnTestConnection";
	public static final String ACTION_COMMAND_BTN_CREATE_DB = "btnCreateDB";
	public static final String ACTION_COMMAND_BTN_CANCEL = "btnCancel";
	
	private DataBaseCreate ventana;
	
	/**
	 * 
	 * @param ventana
	 */
	public DataBaseCreateOperations(DataBaseCreate ventana) {
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
					"lmont_biopsia");
			boolean connectionIsValid = DBConnectionSetUpUtil.haveValidConnectionConfiguration();
			
			if(connectionIsValid){
				if(e.getActionCommand().equals(ACTION_COMMAND_BTN_CREATE_DB)){
					ventana.setCursor(Cursor.getPredefinedCursor(Cursor.WAIT_CURSOR));
					
					if(! "".equals(ventana.getTxt1raBiopsia().getText())){
						//creamos la base de datos y el usuario respectivo
						String[] commands = getCommands("/resources/db/create_db.sql");
						List<Integer> indexesToTry = new LinkedList<Integer>();
						indexesToTry.add(0);
						
						if(executeCommands(commands, null, 90, 0)){
							commands = getCommands("/resources/db/create_user.sql");
							
							if(executeCommands(commands, indexesToTry, 5, 90)){
								commands = new String[1];
								commands[0] = "INSERT INTO biopsias(year_biopsia, numero_biopsia, fecha_registro, id_examen_biopsia, id_cliente, id_fase_actual)"
										+ " VALUES(" + (Calendar.getInstance().get(Calendar.YEAR) - 2000) + ", " + ventana.getTxt1raBiopsia().getText() + ", NOW(), -1, -1, 1)";
								if(DBUtilSetUp.executeInsertQueryAsBoolean(commands[0], null)){
									ventana.getProgressBar().setValue(100);
									JOptionPane.showMessageDialog(ventana, 
											"Base de datos de la aplicación LMont Biopsia fue creada.", 
											"Base de datos creada.", 
											JOptionPane.INFORMATION_MESSAGE);
								} else {
									JOptionPane.showMessageDialog(ventana, 
											"Error creando registro inicial en base de datos.", 
											"Error", 
											JOptionPane.ERROR_MESSAGE);
								}
							} else {
								JOptionPane.showMessageDialog(ventana, 
										"Error creando usuario de base de datos.", 
										"Error", 
										JOptionPane.ERROR_MESSAGE);
							}
						} else {
							JOptionPane.showMessageDialog(ventana, 
									"Error creando base de datos.", 
									"Error", 
									JOptionPane.ERROR_MESSAGE);
						}
					} else {
						JOptionPane.showMessageDialog(ventana, 
								"Debe colocar el numero de biopsia inicial en el sistema.", 
								"Falta el numero inicial", 
								JOptionPane.ERROR_MESSAGE);
					}
				} else {
					JOptionPane.showMessageDialog(ventana, 
							"La configuración de la base de datos del servidor es correcta.", 
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
	 * @param resource
	 * @return
	 */
	private String[] getCommands(String resource){
		BufferedReader br = null;
		StringBuilder sb = new StringBuilder();
		
		log.info("lectura de querys desde " + resource);
		try {
			InputStream is =  DataBaseCreateOperations.class.getResourceAsStream(resource);
			String line;
			br = new BufferedReader(new InputStreamReader(is));
			while ((line = br.readLine()) != null) {
				if(!line.startsWith("--") && ! line.startsWith("/*")){
					sb.append(line);
				}
			}
		} catch (Throwable ioe) {
			log.error("Error leyendo recursos", ioe);
		} finally {
			if (br != null) {
				try {
					br.close();
				} catch (IOException ioe) {
					ioe.printStackTrace();
				}
			}
		}
		
		String[] commands = sb.toString().split(";");
		log.info("Leidos " + commands.length + " querys desde " + resource);
		return commands;
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
		ventana.getProgressBar().setValue(value);
		ventana.getProgressBar().repaint();
	}
}
