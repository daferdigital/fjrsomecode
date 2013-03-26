package com.carrito.servlets;

import java.io.File;

import javax.servlet.ServletConfig;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;

import org.apache.log4j.PropertyConfigurator;

/**
 * 
 * @author Usuario
 *
 */
public class Log4Jservlet  extends HttpServlet {
    /**
	 * 
	 */
	private static final long serialVersionUID = 6855016106743230343L;
	
	
	public void init(ServletConfig config) throws ServletException {
        super.init(config);
        // Lee el directorio donde va a ser colocado el archivo de logs
        String directory = getInitParameter("log-directory");
        // Adiciona el parametro del directorio como un Property del sistema
        // para que pueda ser utilizado dentro del archivo de configuración del Log4J
        System.setProperty("log.directory",directory);
        // Extrae el path donde se encuentra el contexto
        // Asume que el archivo de configuración se encuentra en este directorio
        String prefix = getServletContext().getRealPath(File.separator);
        // Lee el nombre del archivo de configuración de Log4J
        String file = getInitParameter("log4j-init-file");
        if (file == null || file.length() == 0 || !(new File(prefix+file)).isFile()) {
            System.err.println("ERROR: No puede leer el archivo de configuración. ");
            throw new ServletException();
        }
        // Revisa otra parámetro de configuración que le indica
        // si debe revisar el archivo de log por cambios.
        String watch = config.getInitParameter("watch");
        // Extrae el parámetro que le indica cada que tiempo debe revisar el archivo de configuración
        String timeWatch = config.getInitParameter("time-watch");
        // Revisa como debe realizar la configuración de Log4J y llama al método adecuado
        if (watch != null && watch.equalsIgnoreCase("true")) {
            if (timeWatch != null) {
                PropertyConfigurator.configureAndWatch(prefix+file,Long.parseLong(timeWatch));
            } else {
                PropertyConfigurator.configureAndWatch(prefix+file);
            }
        } else {
            PropertyConfigurator.configure(prefix+file);
        }
    }
    /** Destruye el servlet.
    */
    public void destroy() {
        super.destroy();
    }
}
