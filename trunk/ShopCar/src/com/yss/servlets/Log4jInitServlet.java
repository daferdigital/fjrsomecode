package com.yss.servlets;

import java.io.File;

import javax.servlet.ServletConfig;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;

import org.apache.log4j.Logger;
import org.apache.log4j.PropertyConfigurator;

/**
 * 
 * Class: Log4jInitServlet
 * Creation Date: 01/07/2012
 * (c) 2012
 *
 * @author T&T
 *
 */
public class Log4jInitServlet extends HttpServlet{
	
	private static boolean wasStartedAppLog = false;
	
	/**
	 * 
	 */
	private static final long serialVersionUID = 4009402355918182040L;

	public void init(ServletConfig config) throws ServletException {
		long t0 = System.currentTimeMillis();
		
        super.init(config);
        // Extrae el path donde se encuentra el contexto
        // Asume que el archivo de configuración se encuentra en este directorio
        String prefix = getServletContext().getRealPath(File.separator);
        
        System.setProperty("log.directory", prefix + getInitParameter("log-directory"));
        
        // Lee el nombre del archivo de configuración de Log4J
        String file = getInitParameter("log4j-init-file");
        
        if (file == null || file.length() == 0 || !(new File(prefix+file)).isFile()) {
            System.err.println("ERROR: No puede leer el archivo de configuracion. ");
            throw new ServletException();
        }
        
        PropertyConfigurator.configure(prefix + file);
        Logger.getLogger(Log4jInitServlet.class).info("Log inicializado en ruta: " 
        		+ (prefix + getInitParameter("log-directory"))
        		+ " Tomando " + (System.currentTimeMillis() - t0) + " ms.");
        wasStartedAppLog = true;
    }
	
    /** 
     * Destruye el servlet.
     */
    public void destroy() {
    	super.destroy();
    }
    
    public static boolean wasStartedAppLog(){
    	return wasStartedAppLog;
    }
    
}
