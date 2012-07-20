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
public final class AppProperties {
	private static long lastModified = 0;
	private static Properties props = new Properties();
	private static String propsDirPath;
	
	/**
	 * Este enum debe estar en concordancia con el contenido de los keys en el archivo de propiedades.
	 * 
	 */
	public static enum AppPropertyNames{
		APP_pagingRecordsNumber("pagingRecordsNumber"),
		APP_wsdlUrlProfitWS("wsdlUrlProfitWS"),
		APP_EMAIL_SMTP_HOST("email.smtp.host"),
		APP_EMAIL_SMTP_PORT("email.smtp.port"),
		APP_EMAIL_PROTOCOL("email.protocol"),
		APP_EMAIL_AUTH_USER("email.auth.user"),
		APP_EMAIL_AUTH_PWD("email.auth.pwd"),
		APP_EMAIL_ENABLE_DEBUG_LOG("email.enable.debug.log");
		
		private String value;
		
		private AppPropertyNames(String value){
			this.value = value;
		}
		
		@Override
		public String toString() {
			// TODO Auto-generated method stub
			return value;
		}
	}
	
	/**
	 * Defualt constructor
	 */
	private AppProperties() {
		// TODO Auto-generated constructor stub
	}
	
	/**
	 * inicializado desde el init del servlet
	 * @param propsDirPath
	 */
	public static void setPropsDirPath(String propsDirPath) {
		AppProperties.propsDirPath = propsDirPath;
	}
	
	/**
	 * 
	 */
	private static void tryLoadPropsContent(){
		try {
			File propsFile = new File(propsDirPath
					+ File.separator + "application.properties");
			
			if(propsFile.lastModified() > lastModified){
				//debemos leer de nuevo e archivo de propiedades
				synchronized (props) {
					props.load(new FileInputStream(propsFile));
				}
				
				lastModified = propsFile.lastModified();
			}
		} catch (Exception e) {
			// TODO: handle exception
			e.printStackTrace();
		}
	}
	
	/**
	 * 
	 * @param propertyName
	 * @return
	 */
	public static String getPropertyValue(AppPropertyNames propertyName){
		tryLoadPropsContent();
		
		return props.getProperty(propertyName.value, propertyName.value);
	}
	
	/**
	 * 
	 * @param propertyName
	 * @param defaultValue
	 * @return
	 */
	public static String getPropertyValue(AppPropertyNames propertyName, String defaultValue){
		tryLoadPropsContent();
		
		return props.getProperty(propertyName.value, defaultValue);
	}
}
