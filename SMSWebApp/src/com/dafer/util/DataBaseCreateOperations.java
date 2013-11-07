package com.dafer.util;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;

import javax.sql.rowset.CachedRowSet;

import org.apache.log4j.Logger;

/**
 * 
 * Class: DataBaseCreateOperations
 * Creation Date: 17/09/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class DataBaseCreateOperations {
	private static final Logger log = Logger.getLogger(DataBaseCreateOperations.class);
	
	/**
	 * 
	 * @param resource
	 * @return
	 */
	private static String[] getCommands(String resource){
		BufferedReader br = null;
		StringBuilder sb = new StringBuilder();
		
		log.info("Lectura de querys desde " + resource);
		
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
	private static boolean executeCommands(String[] commands){
		boolean result = true;
		
		log.info("Iniciando creacion de querys");
		
		for (String comando : commands) {
			if(! DBUtil.executeNonSelectQuery(comando)){
				result = false;
				log.error("Ejecutado comando: " + comando);
				break;
			}
			
			log.info("Ejecutado comando: " + comando);
		}
			
		return result;
	}
	
	/**
	 * 
	 */
	public static void createDerbyDataBase() {
		// TODO Auto-generated method stub
		//verificamos si la base de datos existe o no
		final String query = "SELECT * FROM version";
		boolean dbExists = false;
		
		CachedRowSet rows = DBUtil.executeSelectQuery(query);
		try {
			if(rows != null && rows.next()){
				//la base de datos existe
				dbExists = true;
				log.info("La base de datos ya existe");
			}
		} catch (Exception e) {
			// TODO: handle exception
		}
		
		if(! dbExists){
			//creamos la base de datos
			
			String[] commands = getCommands("/resources/db/create.sql");
							
			if(executeCommands(commands)){
				log.info("Creadas satisfactoriamente las tablas de la base de datos");
				
				commands = getCommands("/resources/db/insert.sql");
				
				if(executeCommands(commands)){
					log.info("Ejecutados satisfactoriamente los inserts de la base de datos");
				} else {
					log.error("Error ejecutando los inserts de la base de datos");
				}
			} else {
				log.error("Error creando las tablas de la base de datos");
			}
		}
	}
}
