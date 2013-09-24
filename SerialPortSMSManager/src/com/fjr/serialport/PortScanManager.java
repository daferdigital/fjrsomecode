package com.fjr.serialport;

import java.util.Enumeration;
import java.util.HashMap;
import java.util.Iterator;
import java.util.Map;
import java.util.Timer;
import java.util.TimerTask;

import javax.comm.CommPortIdentifier;

import org.apache.log4j.Logger;

import com.fjr.serialport.threads.SMSReadThread;
import com.fjr.serialport.util.AppProperties;

/**
 * Clase donde estara implementada la logica para el registro y escaneo de puertos en tiempo real
 * La idea es descartar los puertos que luego de 3 intentos de lectura indiquen que no pueden ser leidos
 * 
 * Class: PortScanner
 * Creation Date: 16/05/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public final class PortScanManager extends TimerTask {
	private static final Logger log = Logger.getLogger(PortScanManager.class);
	
	/**
	 * Variable para almacenar en tiempo real los puertos de tipo SERIAL disponibles en el sistema
	 * 
	 */
	private static Map<String, SMSReadThread> availablePorts = new HashMap<String, SMSReadThread>();
	
	/**
	 * 
	 */
	public PortScanManager() {
		// TODO Auto-generated constructor stub
		new Timer().schedule(this, 
				AppProperties.getDelayPortRead(), 
				AppProperties.getDelayPortRead());
		log.info("Registrada corrida sucesiva de escaneo de puertos");
	}

	/**
	 * Wrapper around {@link CommPortIdentifier#getPortIdentifiers()} to be
     * avoid unchecked warnings.
     */
    @SuppressWarnings("unchecked")
	private static Enumeration<CommPortIdentifier> getCleanPortIdentifiers(){
        return CommPortIdentifier.getPortIdentifiers();
    }
    
    /**
     * Registramos los puertos seriales conectados en el sistema
     */
	private void registerSystemPorts() {
		// TODO Auto-generated method stub
		Enumeration<CommPortIdentifier> ports = getCleanPortIdentifiers();
		
		while (ports.hasMoreElements()) {
			CommPortIdentifier commPortIdentifier = ports.nextElement();
			
			if(commPortIdentifier.getPortType() == CommPortIdentifier.PORT_SERIAL){
				//registramos este puerto para ser leido
				if(! availablePorts.containsKey(commPortIdentifier.getName())){
					log.info("Registrando puerto '" + commPortIdentifier.getName() 
							+ "' por primera vez");
					
					availablePorts.put(commPortIdentifier.getName(),
							new SMSReadThread(commPortIdentifier.getName(),
									commPortIdentifier));
				}
			}
		}
	}
	
	@Override
	public void run() {
		// TODO Auto-generated method stub
		log.info("+ Iniciando lectura de puertos");
		registerSystemPorts();
		
		Iterator<SMSReadThread> iterator = availablePorts.values().iterator();
		while (iterator.hasNext()) {
			SMSReadThread smsReadObject = iterator.next();
			try {
				new Thread(smsReadObject).start();
			} catch (Exception e) {
				// TODO: handle exception
				log.error("Error en el hilo de lectura del puerto [" + smsReadObject.getPortName() + "]", e);
			}
		}
		
		log.info("+ Finalizando lectura de puertos");
	}
}
