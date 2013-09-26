package com.fjr.code.util;

import java.io.File;
import java.lang.reflect.Method;
import java.net.URL;
import java.net.URLClassLoader;

/**
 * Clase para leer el directorio "libs" asociado a la aplicacion.
 * Y cargar los archivos jar en el classpath de manera dinamica 
 * 
 * Class: CustomClasspathLoader <br />
 * DateCreated: 22/08/2013 <br />
 * @author T&T <br />
 *
 */
public final class CustomClasspathLoader {
	private CustomClasspathLoader() {
		// TODO Auto-generated constructor stub
	}
	
	/**
	 * Metodo para agregar jars desde determinado directorio al classpath
	 * de manera dinamica.
	 * 
	 * @param dir
	 * @throws Throwable 
	 */
	public static final void addJarsToClasspath(String dir) throws Throwable{
		try {
			File f = new File(dir);
			if(f.exists()){
				File[] jars = f.listFiles();
				for (File jarFile : jars) {
					if(jarFile.getName().endsWith(".dll")){
						String currentLP = System.getProperty("java.library.path");
						currentLP = dir.substring(0,  dir.length()-1) + ";" + currentLP;
						
						System.setProperty("java.library.path", currentLP);
						System.out.println(currentLP);
						
						System.loadLibrary(jarFile.getName().substring(0, 
								jarFile.getName().length() - 4));
						
						System.out.println("Cargada en el sistema la libreria " + jarFile.getAbsolutePath());
					} else {
						URL u = jarFile.toURI().toURL();
						URLClassLoader urlClassLoader = (URLClassLoader) ClassLoader.getSystemClassLoader();
					    Class<URLClassLoader> urlClass = URLClassLoader.class;
					    Method method = urlClass.getDeclaredMethod("addURL", new Class[]{URL.class});
					    method.setAccessible(true);
					    method.invoke(urlClassLoader, new Object[]{u});
					    
					    System.out.println("Agregado " + jarFile.getAbsolutePath() + " al classpath");
					}
				}
				
			    System.out.println("Procesado " + dir + ", para busqueda de jars");	
			} else {
				throw new Exception("Directorio de librerias " + dir + " no existe.");
			}
		} catch (Throwable e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
			throw e;
		}
	}
}
