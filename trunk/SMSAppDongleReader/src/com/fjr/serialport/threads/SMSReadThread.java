package com.fjr.serialport.threads;

import java.util.HashMap;
import java.util.Map;
import java.util.StringTokenizer;

import javax.comm.CommPortIdentifier;

import org.apache.log4j.Logger;

import com.fjr.serialport.dao.SMSDAO;
import com.fjr.serialport.dto.SMSDTO;
import com.fjr.code.util.SendCommandUtil;

/**
 * 
 * Class: SMSReadThread
 * Creation Date: 16/05/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class SMSReadThread implements Runnable{
	private static final String AT_TEXTMODE_COMMAND = "AT+CMGF=1";
	private static final String AT_GET_IMEI_COMMAND = "AT+GSN";
	private static final String AT_READSMS_AT_INDEX = "AT+CMGR=";
	private static final String AT_DELETESMS_AT_INDEX = "AT+CMGD=";
	
	private static final Map<String, String> imeiPortprocessed = new HashMap<String, String>();
	private static final Logger log = Logger.getLogger(SMSReadThread.class);
	
	private String portName;
	private String portImei;
	private CommPortIdentifier port;
	private int failedAttempts = 0;
	
	/**
	 * 
	 * @param portName
	 * @param port
	 */
	public SMSReadThread(String portName, CommPortIdentifier port) {
		// TODO Auto-generated constructor stub
		this.portName = portName;
		this.port = port;
	}
	
	/**
	 * Nombre del puerto al que representa este objecto
	 * @return
	 */
	public String getPortName() {
		return portName;
	}
	
	/**
	 * Revisamos la disponibilidad del puerto.
	 * Obteniendo su codigo imei.
	 * 
	 * @return
	 */
	private boolean setPortImei(){
		//preparamos el modo texto del modem (no hay problema si falla)
		SendCommandUtil.sendCommandToPort(port, AT_TEXTMODE_COMMAND);
		String response = SendCommandUtil.sendCommandToPort(port, AT_GET_IMEI_COMMAND);
		boolean isAvailable = true;
		
		if(response == null || response.toUpperCase().indexOf("OK") < 0){
			isAvailable = false;
			failedAttempts++;
			log.info("El puerto [" + portName 
					+ "] esta ocupado, por lo tanto no puede ser leido (aumentamos sus intentos de lectura fallidos)");
		} else {
			String imei = response;
			imei = imei.replaceAll("\r", "");
			imei = imei.replaceAll("\n", "");
			imei = imei.replaceAll("OK", "");
			
			log.info("Para el puerto '" + port.getName() + "' se tiene que su imei es '" + imei + "'");
			this.portImei = imei;
		}
		
		return isAvailable;
	}
	
	/**
	 * Verificamos los mensajes del SIM Card
	 */
	private void processMessages(){
		final int maxSMSToRead = 10;
		for (int i = maxSMSToRead - 1; i > -1; i--) {
			String response = SendCommandUtil.sendCommandToPort(port, 
					AT_READSMS_AT_INDEX + i);
			
			//vemos si la respuesta es correcta para procesar el mensaje
			if(response != null){
				String[] pieces = response.split("\n");
				boolean gotMetaData = false;
				String smsText = "";
				
				//vemos si efectivamente para el indice leido tenemos algun mensaje
				SMSDTO smsDTO = new SMSDTO();
				
				for (int j = 0; j < pieces.length - 2; j++) {
					log.info("piece -> " + pieces[j]);
					if(pieces[j].toUpperCase().contains("+CMGR: \"REC ")){
						//tenemos un mensaje en este indice
						//lo recolectamos para almacenarlo en base de datos
						StringTokenizer metaData = new StringTokenizer(pieces[j], ",");
						
						if(metaData.hasMoreElements()) {
							gotMetaData = true;
							metaData.nextToken(); //descartamos el primer token
							smsDTO.setNumberFrom(metaData.nextToken());
							smsDTO.setDateReceived(metaData.nextToken() + " " + metaData.nextToken());
						}
					} else if(gotMetaData) {
						//ya leimos la metadata, lo que nos indica que estamos ya en la lectura del mensaje como tal
						//reponemos el separador usado en el split, para que el mensaje quede como salio del tlf originalmente
						smsText += pieces[j] + "\n";
					}
				}
					
				if(gotMetaData){
					smsDTO.setMessage(smsText);
					boolean wasStored = false;
					if(SMSDAO.storeSMSAtDataBase(smsDTO)){
						wasStored = true;
					}
					if(SMSDAO.storeSMSInReaderPHPSystem(smsDTO)){
						log.info("Mensaje Almacenado en el ambiente WEB");
						wasStored = true;
					}
					
					if(wasStored){
						log.info("Eliminando SMS[" + i + "] del dongle");
						//deleteSMSAtIndex(i);
					}
				}
			}
		}
	}
	
	/**
	 * Metodo para eliminar un mensaje en determinado indice
	 * 
	 * @param indexToDelete
	 */
	private void deleteSMSAtIndex(int indexToDelete){
		SendCommandUtil.sendCommandToPort(port, 
				AT_DELETESMS_AT_INDEX + indexToDelete);
	}
	
	/**
	 * Metodo para limpiar los imei's de los puertos procesados 
	 * para la lectura de los SMS.
	 */
	public static void resetProcesedPorts(){
		imeiPortprocessed.clear();
	}
	
	@Override
	public void run() {
		// TODO Auto-generated method stub
		final int maxPortAttempts = 1;
		if(failedAttempts == maxPortAttempts){
			log.info("Este puerto [" + portName + "] alcanzo el maximo de intentos fallidos, por lo tanto no sera revisado");
		} else {
			if(setPortImei()){
				//el puerto esta operativo, entonces lo revisamos
				if(imeiPortprocessed.containsKey(this.portImei)){
					//ya se proceso un puerto con ese mismo numero de imei
					//en este caso no hacemos nada
					log.info("Imei repetido, puerto '" + this.portName + "' no procesamos");
				} else {
					imeiPortprocessed.put(this.portImei, this.portImei);
					processMessages();
				}
			}
		}
	}
}
