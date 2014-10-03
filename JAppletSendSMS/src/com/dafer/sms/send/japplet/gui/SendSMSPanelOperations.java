package com.dafer.sms.send.japplet.gui;

import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.io.File;
import java.util.LinkedList;
import java.util.List;

import javax.swing.JFileChooser;
import javax.swing.JOptionPane;

import com.dafer.sms.send.japplet.dto.ATCommandDTO;
import com.dafer.sms.send.japplet.dto.SerialPortDTO;
import com.dafer.sms.send.japplet.util.ContactsUtil;
import com.dafer.sms.send.japplet.util.DebugLog;
import com.dafer.sms.send.japplet.util.SendCommandUtil;

/**
 * 
 * Class: SendSMSPanelOperations <br />
 * DateCreated: 02/10/2014 <br />
 * @author T&T <br />
 *
 */
public final class SendSMSPanelOperations implements ActionListener{
	private static final char ctrlZ = (char) 26;
	public static final String ACTION_COMMAND_BTN_FIND_FILE = "btnFindContantsFile";
	public static final String ACTION_COMMAND_BTN_SEND_SMS = "btnSendSms";
	
	private SendSMSPanel parent;
	
	/**
	 * 
	 * @param parent
	 */
	public SendSMSPanelOperations(SendSMSPanel parent) {
		// TODO Auto-generated constructor stub
		this.parent = parent;
	}

	@Override
	public void actionPerformed(ActionEvent e) {
		// TODO Auto-generated method stub
		DebugLog.info("In action event");
		
		if(ACTION_COMMAND_BTN_FIND_FILE.equals(e.getActionCommand())){
			//debemos ubicar el archivo
			DebugLog.info("In ACTION_COMMAND_BTN_FIND_FILE");
			if(JFileChooser.APPROVE_OPTION == parent.getFileChooser().showOpenDialog(parent)){
				String fileName = parent.getFileChooser().getSelectedFile().getAbsolutePath();
				DebugLog.info(fileName);
				
				parent.getLblRutaArchivo().setText(fileName);
				parent.repaint();
			}
		} else if(ACTION_COMMAND_BTN_SEND_SMS.equals(e.getActionCommand())){
			if("".equals(parent.getLblRutaArchivo().getText())){
				JOptionPane.showMessageDialog(parent,
						"Debe seleccionar los contactos",
						"Advertencia",
						JOptionPane.WARNING_MESSAGE);
			} else {
				List<String> contactos = ContactsUtil.getPhoneNumbers(new File(parent.getLblRutaArchivo().getText()));
				if(contactos != null){
					SerialPortDTO port = parent.getSerialPorts().values().iterator().next();
					for (String numero : contactos) {
						//"AT+CMGF=0\r" PDU Mode
						//"AT+CMGF=1\r" TEXT Mode
						SendCommandUtil.sendCommandToPort(port.getCommPort(),
								"AT+CMGF=1\r");
						
						List<ATCommandDTO> comandos = new LinkedList<ATCommandDTO>();
						comandos.add(new ATCommandDTO("AT+CMGS=\"" + numero + "\"\r"));
						comandos.add(new ATCommandDTO(
								parent.getTextAreaSMS().getText() + ctrlZ,
								null));
						
						SendCommandUtil.sendCommandsToPort(port.getCommPort(), comandos);
					}
				}
			}
		}
	}
}
