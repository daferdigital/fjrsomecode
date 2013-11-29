package com.fjr.serialport.threads;

import java.io.InputStream;
import java.io.OutputStream;
import java.util.Enumeration;
import java.util.Formatter;

import javax.comm.CommPortIdentifier;
import javax.comm.SerialPort;

public class SendSMS {
	private static final char cntrlZ = (char) 26;
	private static final String[] commands = {/*"AT+CSCA?\r",*/ "AT+CMGF=1\r", "AT+CMGS=\"+584122354731\"\r", "mensaje de prueba desde dafer" + cntrlZ +"\r" };
	//private static final String[] commands = {"AT+GSN\r", "ATD*123#;\r", "ATH\r"};
	
    private static final String _NO_DEVICE_FOUND = "  no device found";

    private final static Formatter _formatter = new Formatter(System.out);

    static CommPortIdentifier portId;

    static Enumeration<CommPortIdentifier> portList;

    static int bauds[] = { 9600/*, 14400, 19200, 28800, 33600, 38400, 56000, 57600, 115200*/ };

    static final int timeOut = 2000;
    /**
     * Wrapper around {@link CommPortIdentifier#getPortIdentifiers()} to be
     * avoid unchecked warnings.
     */
    private static Enumeration<CommPortIdentifier> getCleanPortIdentifiers() {
        return CommPortIdentifier.getPortIdentifiers();
    }

    public static void main(String[] args) {
        System.out.println("\nSearching for devices...");
        portList = getCleanPortIdentifiers();
        
        while (portList.hasMoreElements()){
            portId = portList.nextElement();
            
            if (portId.getPortType() == CommPortIdentifier.PORT_SERIAL
            		&& "COM10".equals(portId.getName())){
                _formatter.format("%nFound port: %-5s%n", portId.getName());
                
                for (int i = 0; i < bauds.length; i++){
                	_formatter.format("       Trying at %6d...", bauds[i]);
                    
                	SerialPort serialPort = null;
                    try{
                        InputStream inStream;
                        OutputStream outStream;
                        int c;
                        String response;
                        serialPort = (SerialPort) portId.open("Dafer", 1971);
                        serialPort.setFlowControlMode(SerialPort.FLOWCONTROL_RTSCTS_IN);
                        serialPort.setSerialPortParams(bauds[i], SerialPort.DATABITS_8, SerialPort.STOPBITS_1, SerialPort.PARITY_NONE);
                        inStream = serialPort.getInputStream();
                        outStream = serialPort.getOutputStream();
                        serialPort.enableReceiveTimeout(1000);
                        c = inStream.read();
                        while (c != -1)
                            c = inStream.read();
                        
                        //enviamos el SMS
                        for (int j = 0; j < commands.length; j++) {
							long lastTime = System.currentTimeMillis();
							outStream.write(commands[j].getBytes());
							response = "";
							StringBuilder sb = new StringBuilder();
							c = inStream.read();
							
							while (c != -1){
								//System.out.println("En el while");
								sb.append((char) c);
								c = inStream.read();
								lastTime = System.currentTimeMillis();
								
								if((System.currentTimeMillis() - lastTime) > timeOut){
									System.out.println("timeout alcanzado");
									break;
								}
							}
							
							response = sb.toString();
	                        System.out.println("Response comando[" + j + "]: " + "'" + response + "'");
							
	                        if (response.indexOf("OK") >= 0 || response.indexOf(">") >= 0){
	                        	System.out.println("Ok comando " + j);
	                        } else {
	                        	System.out.println("Fallo comando " + j);
	                        	break;
	                        }
						}
                    }
                    catch (Exception e) {
                        System.out.print(_NO_DEVICE_FOUND);
                        Throwable cause = e;
                        while (cause.getCause() != null){
                            cause = cause.getCause();
                        }
                        
                        System.out.println(" (" + cause.getMessage() + ")");
                    } finally {
                        if (serialPort != null){
                            serialPort.close();
                        }
                    }
                }
            }
        }
        
        System.out.println("\nTest complete.");
    }
    
    public static void main1(String[] args)
    {
        System.out.println("\nSearching for devices...");
        portList = getCleanPortIdentifiers();
        while (portList.hasMoreElements())
        {
            portId = portList.nextElement();
            if (portId.getPortType() == CommPortIdentifier.PORT_SERIAL)
            {
                _formatter.format("%nFound port: %-5s%n", portId.getName());
                for (int i = 0; i < bauds.length; i++)
                {
                    SerialPort serialPort = null;
                    _formatter.format("       Trying at %6d...", bauds[i]);
                    try
                    {
                        InputStream inStream;
                        OutputStream outStream;
                        int c;
                        String response;
                        serialPort = (SerialPort) portId.open("SMSLibCommTester", 1971);
                        serialPort.setFlowControlMode(SerialPort.FLOWCONTROL_RTSCTS_IN);
                        serialPort.setSerialPortParams(bauds[i], SerialPort.DATABITS_8, SerialPort.STOPBITS_1, SerialPort.PARITY_NONE);
                        inStream = serialPort.getInputStream();
                        outStream = serialPort.getOutputStream();
                        serialPort.enableReceiveTimeout(1000);
                        c = inStream.read();
                        while (c != -1)
                            c = inStream.read();
                        outStream.write('A');
                        outStream.write('T');
                        outStream.write('+');
                        outStream.write('C');
                        outStream.write('M');
                        outStream.write('G');
                        outStream.write('F');
                        outStream.write('=');
                        outStream.write('1');
                        outStream.write('\r');
                        Thread.sleep(1000);
                        response = "";
                        StringBuilder sb = new StringBuilder();
                        c = inStream.read();
                        while (c != -1){
                            sb.append((char) c);
                            c = inStream.read();
                        }
                        response = sb.toString();
                        if (response.indexOf("OK") >= 0)
                        {
                            try
                            {
                                System.out.print("  Getting Info...");
                                outStream.write('A');
                                outStream.write('T');
                                outStream.write('+');
                                outStream.write('C');
                                outStream.write('M');
                                outStream.write('G');
                                outStream.write('L');
                                /*
                                outStream.write('R');
                                outStream.write('=');
                                outStream.write('1');
                                */
                                outStream.write('\r');
                                response = "";
                                c = inStream.read();
                                while (c != -1)
                                {
                                    response += (char) c;
                                    c = inStream.read();
                                }
                                System.out.println(" Found: " + response.replaceAll("\\s+OK\\s+", "").replaceAll("\n", "").replaceAll("\r", ""));
                            }
                            catch (Exception e)
                            {
                                System.out.println(_NO_DEVICE_FOUND);
                            }
                        }
                        else
                        {
                            System.out.println(_NO_DEVICE_FOUND + "-> " + response);
                        }
                    }
                    catch (Exception e)
                    {
                        System.out.print(_NO_DEVICE_FOUND);
                        Throwable cause = e;
                        while (cause.getCause() != null)
                        {
                            cause = cause.getCause();
                        }
                        System.out.println(" (" + cause.getMessage() + ")");
                    }
                    finally
                    {
                        if (serialPort != null)
                        {
                            serialPort.close();
                        }
                    }
                }
            }
        }
        System.out.println("\nTest complete.");
    }
}
