package com.yss.util;

import java.util.List;
import java.util.Properties;

import javax.mail.Address;
import javax.mail.Authenticator;
import javax.mail.Message;
import javax.mail.PasswordAuthentication;
import javax.mail.Session;
import javax.mail.Transport;
import javax.mail.internet.InternetAddress;
import javax.mail.internet.MimeMessage;

import org.apache.log4j.Logger;

import com.yss.properties.AppProperties;
import com.yss.properties.AppProperties.AppPropertyNames;

public class SendMailUtil {
	private static final Logger logger = Logger.getLogger(SendMailUtil.class);
	
	private static final String PROTOCOL_SSL = "SSL";
	private static final String PROTOCOL_TLS = "TLS";
	private static final String PROTOCOL_NO_AUTH = "NO_AUTH";
	
	/**
	 * 
	 * @return
	 */
	private static Session getSession(){
		final String method = "getSession(): ";
		
		Session sess = null;
		boolean requireAuth = true;
		long t0 = System.currentTimeMillis();
		
		try {
			//construimos el properties
			Properties props =  new Properties();
			
			//colocamos las opciones comunes a todos los protocolos
			props.put("mail.smtp.host", AppProperties.getPropertyValue(AppPropertyNames.APP_EMAIL_SMTP_HOST));
			
			//validamos que el puerto tenga formato numerico
			try {
				props.put("mail.smtp.port", Integer.parseInt(AppProperties.getPropertyValue(AppPropertyNames.APP_EMAIL_SMTP_PORT)));
			} catch (Exception e) {
				// TODO: handle exception
				logger.warn(method + "Se va a usar el puerto por defecto para el envio del correo en base al protocolo indicado");
			}
			
			//verificamos el protocolo para asignar las propiedades especificas de cada uno
			if(PROTOCOL_SSL.equals(AppProperties.getPropertyValue(AppPropertyNames.APP_EMAIL_PROTOCOL).toUpperCase())){
				props.put("mail.smtp.auth", "true");  // If you need to authenticate
				props.put("mail.smtp.socketFactory.class", "javax.net.ssl.SSLSocketFactory");
				props.put("mail.smtp.socketFactory.fallback", "false");
				
				try {
					props.put("mail.smtp.socketFactory.port", Integer.parseInt(AppProperties.getPropertyValue(
							AppPropertyNames.APP_EMAIL_SMTP_PORT)));
				} catch (Exception e) {
					// TODO: handle exception
					logger.warn(method + "Se va a usar el puerto por defecto para el envio del correo bajo el protocolo SSL");
				}
			} else if(PROTOCOL_TLS.equals(AppProperties.getPropertyValue(AppPropertyNames.APP_EMAIL_PROTOCOL).toUpperCase())){
				props.put("mail.smtp.auth", "true"); 
				props.put("mail.smtp.starttls.enable","true");
			} else {
				//estamos en el caso por defecto, no autenticado
				requireAuth = false;
			}
			
            //ya ajustado el objeto de propiedades, construimos el propio objeto Session
			if(requireAuth){
				sess = Session.getDefaultInstance(props,
						new Authenticator() {
							protected PasswordAuthentication getPasswordAuthentication() {
								return new PasswordAuthentication(AppProperties.getPropertyValue(AppPropertyNames.APP_EMAIL_AUTH_USER),
										AppProperties.getPropertyValue(AppPropertyNames.APP_EMAIL_AUTH_PWD));
							};
        			});
			} else {
				sess = Session.getDefaultInstance(props);
			}
			
			sess.setDebug(Boolean.parseBoolean(
					AppProperties.getPropertyValue(AppPropertyNames.APP_EMAIL_ENABLE_DEBUG_LOG)));
		} catch (Exception e) {
			// TODO: handle exception
			logger.error("Error creando objeto 'Session' para el envio de un correo. Error fue"
					+ e.getLocalizedMessage(), e);
		}
		
		logger.info(method + "Finalizando metodo en " + (System.currentTimeMillis() - t0) + " ms. Retornando: " + sess);
		return sess;
	}
	
	public static boolean sendEmail(List<Address> dirTo){
		Session sess = getSession();
		
		if(sess != null){
			try {
				Message mensaje = new MimeMessage(sess);
				Address[] addressTo = new Address[0];
				
				mensaje.setFrom(new InternetAddress(AppProperties.getPropertyValue(AppPropertyNames.APP_EMAIL_AUTH_USER)));
	            mensaje.addRecipients(Message.RecipientType.TO, dirTo.toArray(addressTo));
	            
	            mensaje.setSubject("Prueba");
	            mensaje.setContent("Prueba", "text/html");
	            
	            Transport.send(mensaje);
	            logger.info("mensaje enviado");
			} catch (Exception e) {
				// TODO: handle exception
				logger.error(e.getLocalizedMessage(), e);
			}
		}
		
		return true;
	}
}
