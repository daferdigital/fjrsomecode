package com.yss.util;

import java.net.MalformedURLException;
import java.net.URL;
import java.util.HashMap;
import java.util.Map;

import javax.xml.ws.Service;

import org.apache.log4j.Logger;

import com.yss.ws.client.syncws.SyncWS;
import com.yss.ws.client.syncws.SyncWSSoap;

/**
 * 
 * Class: WSPortManager
 * Creation Date: 16/07/2012
 * (c) 2012
 *
 * @author T&T
 *
 */
public final class WSPortManager {
	private static final Map<String, Service> ports = new HashMap<String, Service>();
	
	private WSPortManager() {
		// TODO Auto-generated constructor stub
	}
	
	/**
	 * 
	 * @param wsdlTargetURL
	 * @return
	 * @throws MalformedURLException
	 */
	public static SyncWSSoap getSyncWSSoapPort(Logger logger, String wsdlTargetURL) throws MalformedURLException{
		final String method = "getSyncWSSoapPort(): ";
		SyncWS prevObj = null;
		
		if(ports.containsKey(wsdlTargetURL)){
			//tenemos el port ya creado, vemos si es para este mismo url
			prevObj = (SyncWS) ports.get(wsdlTargetURL);
			
			if(wsdlTargetURL.equals(prevObj.getWSDLDocumentLocation())){
				//seguimos apuntando al mismo endpoint WSDL
			} else {
				prevObj = null;
			}
		} 
		
		if(prevObj == null){
			long t0 = System.currentTimeMillis();
			
			logger.info(method + "Intentando conectarse a servicio en URL '" + wsdlTargetURL + "'");
			prevObj = new SyncWS(new URL(wsdlTargetURL));
			logger.info(method + "Conexion exitosa a URL '" + wsdlTargetURL + "' en " 
					+ (System.currentTimeMillis() - t0) + " ms.");
			
			ports.put(wsdlTargetURL, prevObj);
		}
		
		return prevObj.getSyncWSSoap();
	}
}
