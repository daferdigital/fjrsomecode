package com.dafer.sms.send.japplet.util;

import java.util.Enumeration;
import java.util.HashMap;
import java.util.Map;

import javax.comm.CommPortIdentifier;

import com.dafer.sms.send.japplet.dto.SerialPortDTO;

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
public final class PreparePortsManager {
	
	/**
	 * Variable para almacenar en tiempo real los puertos de tipo SERIAL disponibles en el sistema
	 * Se almancenaran de manera unica dependiendo de su IMEI
	 * 
	 */
	private Map<String, SerialPortDTO> availablePorts = new HashMap<String, SerialPortDTO>();
	

	public PreparePortsManager() {
		// TODO Auto-generated constructor stub
		registerSystemPorts();
	}
	
	/**
	 * Wrapper around {@link CommPortIdentifier#getPortIdentifiers()} to be
     * avoid unchecked warnings.
     */
    @SuppressWarnings("unchecked")
	private Enumeration<CommPortIdentifier> getCleanPortIdentifiers(){
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
					DebugLog.info("Registrando puerto '" + commPortIdentifier.getName() 
							+ "' por primera vez");
					availablePorts.put(commPortIdentifier.getName(),
							new SerialPortDTO(commPortIdentifier.getName(),
									commPortIdentifier));
				}
			}
		}
	}
	
	/**
	 * 
	 * @return
	 */
	public Map<String, SerialPortDTO> getAvailablePorts() {
		return availablePorts;
	}
	
	/**
	 * 
	 */
	public Map<String, SerialPortDTO> getAvailablePortsById(){
		Map<String, SerialPortDTO> clone = new HashMap<String, SerialPortDTO>();
		
		for (String portKey: availablePorts.keySet()) {
			SerialPortDTO port = availablePorts.get(portKey);
			if(port.getSerialPortId() != null && !"".equals(port.getSerialPortId())){
				clone.put(availablePorts.get(portKey).getSerialPortId(), port);
			}
		}
		
		return clone;
	}
}
