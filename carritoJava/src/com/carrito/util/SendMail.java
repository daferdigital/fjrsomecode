package com.carrito.util;

import java.io.BufferedReader;
import java.io.File;
import java.io.FileReader;
import java.util.Properties;

import javax.mail.Authenticator;
import javax.mail.Message;
import javax.mail.Multipart;
import javax.mail.PasswordAuthentication;
import javax.mail.Session;
import javax.mail.Transport;
import javax.mail.internet.InternetAddress;
import javax.mail.internet.MimeBodyPart;
import javax.mail.internet.MimeMessage;
import javax.mail.internet.MimeMultipart;

import org.apache.log4j.Logger;
import org.apache.struts.util.MessageResources;


/**
 * 
 * Class: SendMail
 * Creation Date: 07/04/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public final class SendMail {
	public static final Logger log = Logger.getLogger(SendMail.class);
	
	private static final String MAIL_HOST_KEY = "mail.host";
	private static final String MAIL_PORT_KEY = "mail.port";
	private static final String MAIL_PROTOCOL_KEY = "mail.protocol";
	private static final String MAIL_LOGIN_KEY = "mail.account.from";
	private static final String MAIL_PASSWORD_KEY = "mail.account.password";
	private static final String MAIL_DEBUG_KEY = "mail.debugenabled";
	
	private static final String PROTOCOL_SSL = "SSL";
	private static final String PROTOCOL_TLS = "TLS";
	
	private static final String TEMPLATES_BASE_DIR = "WEB-INF" + File.separator + "mailTemplates";
	
	private SendMail() {
		// TODO Auto-generated constructor stub
	}
	
	/**
	 * 
	 * @param baseSiteDir
	 * 
	 * @return
	 */
	public static String getMailCompraFinalizadaTemplate(String baseSiteDir){
		return getEmailTemplateAsString(baseSiteDir, "compraRealizada.html");
	}
	
	/**
	 * 
	 * @param baseSiteDir
	 * @param mailTemplate
	 * @return
	 */
	private static String getEmailTemplateAsString(String baseSiteDir, String mailTemplate){
		File template = new File(baseSiteDir + File.separator + TEMPLATES_BASE_DIR
				+ File.separator + mailTemplate);
		String contentTemplate = "";
		
		if(template.exists()){
			//obtenemos el contenido del archivo como un string
			BufferedReader in = null;
			
			try {
				in = new BufferedReader(new FileReader(template));
				String line = "";
				
				while((line = in.readLine()) != null){
					contentTemplate += line;
				}
			} catch (Exception e) {
				// TODO Auto-generated catch block
				log.error("Error de lectura/escritura asociado a la plantilla de correo", e);
			} finally {
				try {
					in.close();
				} catch (Exception e2) {
					// TODO: handle exception
				}
			}
			log.info("Leida correctamente plantilla desde " + template.getAbsolutePath());
		} else {
			log.error("Template de correo " + template.getAbsolutePath()
					+ " no existe, no podremos enviar este correo a causa de eso");
		}
		
		return contentTemplate;
	}
	
	/**
	 * 
	 * @param resources
	 * @return
	 */
	private static Session buildMailSession(final MessageResources resources){
		Properties props = new Properties();
		props.put("mail.smtp.host", resources.getMessage(MAIL_HOST_KEY));
		props.put("mail.smtp.port", resources.getMessage(MAIL_PORT_KEY));
		
		log.info("Host/Puerto para salida de correos: " + 
				resources.getMessage(MAIL_HOST_KEY) + "/" + resources.getMessage(MAIL_PORT_KEY));
		
		Authenticator auth = null;
		if(PROTOCOL_SSL.equals(resources.getMessage(MAIL_PROTOCOL_KEY).toUpperCase())
				|| PROTOCOL_TLS.equals(resources.getMessage(MAIL_PROTOCOL_KEY).toUpperCase())){
			//es un envio autenticado
			log.info("Envio de correo autenticado bajo protocolo " + resources.getMessage(MAIL_PROTOCOL_KEY));
			props.put("mail.smtp.auth", "true");
			
			if(PROTOCOL_SSL.equals(resources.getMessage(MAIL_PROTOCOL_KEY).toUpperCase())){
				props.put("mail.smtp.socketFactory.port", resources.getMessage(MAIL_PORT_KEY));
				props.put("mail.smtp.socketFactory.class", "javax.net.ssl.SSLSocketFactory");
				props.put("mail.smtp.socketFactory.fallback", "false");
			}
			if(PROTOCOL_TLS.equals(resources.getMessage(MAIL_PROTOCOL_KEY).toUpperCase())){
				props.put("mail.smtp.starttls.enable", "true");
			}
			
			//construimos el autenticador
			auth = new javax.mail.Authenticator() {
				protected PasswordAuthentication getPasswordAuthentication() {
					return new PasswordAuthentication(resources.getMessage(MAIL_LOGIN_KEY), 
							resources.getMessage(MAIL_PASSWORD_KEY));
				}
			  };
		} else{
			log.info("El protocolo '" + resources.getMessage(MAIL_PROTOCOL_KEY)
					+ "' no es manejado en estos momentos por el sistema."
					+ " Se realizara el envio de manera no autenticada.");
		}
		
		Session session = auth == null ? Session.getInstance(props) : Session.getInstance(props, auth);
		session.setDebug(Boolean.parseBoolean(resources.getMessage(MAIL_DEBUG_KEY)));
		
		return session;
	}
	
	/**
	 * 
	 * @param resources
	 * @param mailTo
	 * @param subject
	 * @param mailMessage
	 */
	public static void sendEmail(final MessageResources resources, final String mailTo, 
			final String subject, final String mailMessage){
		try {
			new Thread(){
				public void run() {
					try {
						Message message = new MimeMessage(buildMailSession(resources));
						
						message.setFrom(new InternetAddress(resources.getMessage(MAIL_LOGIN_KEY)));
						
						message.setRecipients(Message.RecipientType.TO,
							InternetAddress.parse(mailTo));
						
						message.setSubject(subject);
						
						Multipart mp = new MimeMultipart();
						MimeBodyPart htmlPart = new MimeBodyPart();
				        htmlPart.setContent(mailMessage, "text/html");
				        mp.addBodyPart(htmlPart);
				         
				        message.setContent(mp);
				        //message.setText(mailMessage);
				         
						Transport.send(message);
						
						log.info("Correo enviado exitosamente a " + mailTo + ", con el asunto " + subject);
					} catch (Exception e) {
						// TODO: handle exception
						log.error("Error enviando correo a " + mailTo + ", con el asunto " + subject, e);
					}
				};
			}.start();
		} catch (Exception e) {
			// TODO: handle exception
			log.error("Error enviando correo a " + mailTo + ", con el asunto " + subject, e);
		}
	}
}
