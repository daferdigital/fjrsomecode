package com.dafer.sms.send.japplet.util;

import java.io.InputStream;
import java.io.OutputStream;

import javax.comm.CommPortIdentifier;
import javax.comm.PortInUseException;
import javax.comm.SerialPort;

/**
 * 
 * Class: SendCommandUtil
 * Creation Date: 15/05/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public final class SendCommandUtil {
	private static final int BAUDS = 9600;
	
	/**
	 * Metodo para ejecutar un comando AT en el puerto indicado.
	 * 
	 * @param port Puerto en el cual se ejecutara el comando indicado
	 * @param command Comando AT a ejecutar
	 */
	public static String sendCommandToPort(CommPortIdentifier port, String command){
		String response = null;
		SerialPort serialPort = null;
		InputStream is = null;
		OutputStream os = null;
		int c;
		
		String fixedCommand = command + "\r";
		
		try{
			//ajustamos el puerto
			serialPort = (SerialPort) port.open("DaferSerialPort", 1971);
			serialPort.setFlowControlMode(SerialPort.FLOWCONTROL_RTSCTS_IN);
            serialPort.setSerialPortParams(BAUDS, 
            		SerialPort.DATABITS_8, 
            		SerialPort.STOPBITS_1, 
            		SerialPort.PARITY_NONE);
            
            //obtenemos los flujos de entrada y salida
            is = serialPort.getInputStream();
            os = serialPort.getOutputStream();
            
            //activamos el timeouts de lectura
            serialPort.enableReceiveTimeout(500);
            
            //leemos hasta que tengamos algo para saber que el puerto esta listo para escuchar
            c = is.read();
            while (c != -1) {
            	c = is.read();
            }
            
            //escribimos el comando en el puerto
            byte[] bytes = fixedCommand.getBytes();
            os.write(bytes, 0, bytes.length);
            os.flush();
            DebugLog.info("Enviado comando [" + command + "] al puerto [" + port.getName() + "] de manera exitosa");
            
            //leemos la respuesta del comando
            StringBuilder sb = new StringBuilder();
            c = is.read();
            while (c != -1){
                sb.append((char) c);
                c = is.read();
            }
            
            response = sb.toString();
            DebugLog.info("Respuesta del comando [" + command + "] en el puerto [" + port.getName() 
            		+ "] fue: " + response.replaceAll("\n", "").replaceAll("\r", ""));
		} catch (PortInUseException e) {
			DebugLog.error("El puerto [" + port.getName() + "]. se encuentra en uso (seguramente es el asociado a la conexion de datos): " 
					+ e.getLocalizedMessage());
		}catch (Exception e) {
			// TODO: handle exception
			DebugLog.error("Error durante la ejecucion del comando [" + command
					+ "] en el puerto [" + port.getName() + "]. El error fue: " + e.getLocalizedMessage(), e);
		} finally {
			try {
				is.close();
			} catch (Exception e2) {
				// TODO: handle exception
			}
			
			try {
				os.close();
			} catch (Exception e2) {
				// TODO: handle exception
			}
			
			try {
				serialPort.close();
			} catch (Exception e) {
				// TODO: handle exception
				DebugLog.error("El puerto no pudo ser cerrado debido a: " + e.getLocalizedMessage(), e);
			}
		}
		
		return response;
	}
}
