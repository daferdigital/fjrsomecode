package com.dafer.sms.send.japplet.gui;

import javax.swing.JFileChooser;
import javax.swing.JLabel;
import javax.swing.JPanel;
import javax.swing.JScrollPane;
import javax.swing.JTextArea;
import javax.swing.SwingConstants;
import javax.swing.JButton;

import com.dafer.sms.send.japplet.dto.SerialPortDTO;

import java.awt.Font;
import java.util.Map;

/**
 * 
 * Class: SendSMSPanel <br />
 * DateCreated: 02/10/2014 <br />
 * @author T&T <br />
 *
 */
public class SendSMSPanel extends JPanel {

	/**
	 * 
	 */
	private static final long serialVersionUID = -232101020454624871L;
	private JLabel lblRutaArchivo;
	private JButton btnFindFile;
	private JTextArea textAreaSMS;
	private JButton btnEnviarSms;
	private JFileChooser fileChooser = new JFileChooser();
	private Map<String, SerialPortDTO> serialPorts;
	
	/**
	 * Create the panel.
	 * 
	 * @param serialPorts 
	 */
	public SendSMSPanel(Map<String, SerialPortDTO> serialPorts) {
		this.serialPorts = serialPorts;
		setLayout(null);
		
		JLabel lblNewLabel = new JLabel("<html>Mensaje a Enviar:<br /><br />Nota: Se recomienda no exceder los <b>140 caracteres</b></html>");
		lblNewLabel.setVerticalAlignment(SwingConstants.TOP);
		lblNewLabel.setBounds(10, 11, 150, 81);
		add(lblNewLabel);
		
		JScrollPane scrollPane = new JScrollPane();
		scrollPane.setBounds(180, 6, 230, 121);
		add(scrollPane);
		
		textAreaSMS = new JTextArea();
		textAreaSMS.setWrapStyleWord(true);
		textAreaSMS.setLineWrap(true);
		scrollPane.setViewportView(textAreaSMS);
		
		btnFindFile = new JButton("Seleccionar Archivo de Contactos");
		btnFindFile.setActionCommand(SendSMSPanelOperations.ACTION_COMMAND_BTN_FIND_FILE);
		btnFindFile.setFont(new Font("Tahoma", Font.PLAIN, 12));
		btnFindFile.setBounds(10, 150, 208, 23);
		add(btnFindFile);
		
		lblRutaArchivo = new JLabel("");
		lblRutaArchivo.setBounds(10, 194, 359, 14);
		add(lblRutaArchivo);
		
		btnEnviarSms = new JButton("Enviar SMS's");
		btnEnviarSms.setActionCommand(SendSMSPanelOperations.ACTION_COMMAND_BTN_SEND_SMS);
		btnEnviarSms.setFont(new Font("Tahoma", Font.PLAIN, 14));
		btnEnviarSms.setBounds(139, 239, 230, 35);
		add(btnEnviarSms);
		
		SendSMSPanelOperations listener = new SendSMSPanelOperations(this);
		btnFindFile.addActionListener(listener);
		btnEnviarSms.addActionListener(listener);
	}
	
	public JFileChooser getFileChooser() {
		return fileChooser;
	}
	
	public JLabel getLblRutaArchivo() {
		return lblRutaArchivo;
	}
	
	public JTextArea getTextAreaSMS() {
		return textAreaSMS;
	}
	
	public Map<String, SerialPortDTO> getSerialPorts() {
		return serialPorts;
	}
}
