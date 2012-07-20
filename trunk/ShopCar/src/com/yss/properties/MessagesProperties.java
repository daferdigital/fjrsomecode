package com.yss.properties;

import java.io.File;
import java.io.FileInputStream;
import java.util.Properties;

/**
 * 
 * Class: ErrorProperties
 * Creation Date: 05/07/2012
 * (c) 2012
 *
 * @author T&T
 *
 */
public final class MessagesProperties {
	private static long lastModified = 0;
	private static Properties props = new Properties();
	private static String propsDirPath;
	
	/**
	 * Este enum debe estar en concordancia con el contenido de los keys en el archivo de mensajes.
	 * 
	 */
	public static enum MsgPropertyNames{
		MSG_loginIsEmpty("login.isEmpty"),
		MSG_passwordIsEmpty("password.isEmpty"),
		MSG_credentialsNotCorrect("credentials.notCorrect"),
		MSG_mustStartSession("mustStartSession"),
		MSG_operationNotAllowed("operationNotAllowed"),
		MSG_requestAjaxThrowError("requestAjaxThrowError"),
		MSG_requestAjaxCeroRecords("requestAjaxCeroRecords"),
		MSG_notClientInSession("notClientInSession"),
		MSG_clientDoesntHaveAPrice("clientDoesntHaveAPrice"),
		MSG_webServiceError("webServiceError"),
		MSG_stockNotEnough("stockNotEnough"),
		MSG_stockWSUnreachable("stockWSUnreachable"),
		MSG_preOrderDoesntExists("preOrderDoesntExists"),
		MSG_stockNotEnoughToProduct("stockNotEnoughToProduct"),
		MSG_sucessfullRequest("sucessfullRequest"),
		MSG_notNumericValueToProduct("notNumericValueToProduct");
		
		private String value;
		
		private MsgPropertyNames(String value){
			this.value = value;
		}
		
		@Override
		public String toString() {
			// TODO Auto-generated method stub
			return value;
		}
	}
	
	private MessagesProperties() {
		// TODO Auto-generated constructor stub
	}
	
	/**
	 * inicializado desde el init del servlet
	 * @param propsDirPath
	 */
	public static void setPropsDirPath(String propsDirPath) {
		MessagesProperties.propsDirPath = propsDirPath;
	}
	
	private static void tryLoadPropsContent(){
		try {
			File propsFile = new File(propsDirPath
					+ File.separator + "messages.properties");
			
			if(propsFile.lastModified() > lastModified){
				//debemos leer de nuevo e archivo de propiedades
				synchronized (props) {
					props.load(new FileInputStream(propsFile));
				}
			
				lastModified = propsFile.lastModified();
			}
			
		} catch (Exception e) {
			// TODO: handle exception
		}
	}
	
	/**
	 * 
	 * @param msgKey
	 * @return
	 */
	public static String getPropertyValue(MsgPropertyNames msgKey){
		tryLoadPropsContent();
		
		return props.getProperty(msgKey.value, msgKey.value);
	}
}
