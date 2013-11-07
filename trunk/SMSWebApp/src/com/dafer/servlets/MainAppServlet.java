package com.dafer.servlets;

import javax.servlet.ServletConfig;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;

import org.apache.log4j.Logger;

import com.dafer.util.DBConnectionUtil;
import com.dafer.util.DataBaseCreateOperations;

/**
 * 
 * Class: MainAppServlet <br />
 * DateCreated: 06/11/2013 <br />
 * @author T&T <br />
 *
 */
public class MainAppServlet extends HttpServlet{
	private static final Logger log = Logger.getLogger(MainAppServlet.class);
	
	
	/**
	 * 
	 */
	private static final long serialVersionUID = 6771852057866619299L;

	@Override
	public void init(ServletConfig config) throws ServletException {
		// TODO Auto-generated method stub
		String derbyHome = config.getServletContext().getRealPath("/database");
		
		log.info("Iniciando configuracion de servlet de aplicacion");
		
		System.setProperty("derby.system.home", derbyHome);
		log.info("Configurado DERBY_HOME: " + derbyHome);
		
		//intentamos verificar el DataSource derby
		if(DBConnectionUtil.haveValidConnectionConfiguration()){
			log.info("DataSource verificado con exito");
			
			//se inicia el proceso de creacion de base de datos
			DataBaseCreateOperations.createDerbyDataBase();
		} else {
			log.info("DataSource no pudo ser verificado");
		}
		
		log.info("Finalizando configuracion de servlet de aplicacion");
	}
}
