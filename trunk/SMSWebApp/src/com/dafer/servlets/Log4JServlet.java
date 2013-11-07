package com.dafer.servlets;

import java.io.File;

import javax.servlet.ServletConfig;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;

import org.apache.log4j.Logger;
import org.apache.log4j.PropertyConfigurator;

/**
 * 
 * Class: Log4JServlet
 * Creation Date: 27/03/2013
 * (c) 2013
 *
 * @author T&T
 * 
 */
public class Log4JServlet  extends HttpServlet {
    /**
	 * 
	 */
	private static final long serialVersionUID = 6855016106743230343L;
	
	
	public void init(ServletConfig config) throws ServletException {
        super.init(config);
        // Lee el directorio donde va a ser colocado el archivo de logs
        String directory = getInitParameter("log-directory");
        
        // Extrae el path donde se encuentra el contexto
        // Asume que el archivo de configuraci�n se encuentra en este directorio
        String prefix = getServletContext().getRealPath(File.separator);
        
        // Adiciona el parametro del directorio como un Property del sistema
        // para que pueda ser utilizado dentro del archivo de configuraci�n del Log4J
        System.setProperty("log.directory",prefix  + directory);
        
        // Lee el nombre del archivo de configuraci�n de Log4J
        String file = getInitParameter("log4j-init-file");
        if (file == null || file.length() == 0 || !(new File(prefix+file)).isFile()) {
            System.err.println("ERROR: No puede leer el archivo de configuraci�n. ");
            throw new ServletException();
        }
        
        // Revisa otra par�metro de configuraci�n que le indica
        // si debe revisar el archivo de log por cambios.
        String watch = config.getInitParameter("watch");
        
        // Extrae el par�metro que le indica cada que tiempo debe revisar el archivo de configuraci�n
        String timeWatch = config.getInitParameter("time-watch");
        
        // Revisa como debe realizar la configuraci�n de Log4J y llama al m�todo adecuado
        if (watch != null && watch.equalsIgnoreCase("true")) {
            if (timeWatch != null) {
                PropertyConfigurator.configureAndWatch(prefix+file,Long.parseLong(timeWatch));
            } else {
                PropertyConfigurator.configureAndWatch(prefix+file);
            }
        } else {
            PropertyConfigurator.configure(prefix+file);
        }
        
        Logger.getLogger(Log4JServlet.class).info("Log iniciado en: " + prefix + directory);
    }
	
    /** Destruye el servlet.
    */
    public void destroy() {
        super.destroy();
    }
}
