package com.fjr.code.gui;

import javax.swing.JPanel;
import javax.swing.JLabel;
import java.awt.Font;
import javax.swing.JTextArea;
import javax.swing.SwingConstants;
import javax.swing.JScrollPane;
import javax.swing.JFileChooser;

/**
 * 
 * Class: SendSMSPanel <br />
 * DateCreated: 21/11/2013 <br />
 * @author T&T <br />
 *
 */
public class SendSMSPanel extends JPanel {

	/**
	 * 
	 */
	private static final long serialVersionUID = 4605215331491298169L;

	/**
	 * Create the panel.
	 */
	public SendSMSPanel() {
		setLayout(null);
		
		JLabel lblNewLabel = new JLabel("<html>Mensaje a Enviar: <br/><br/>Nota: Se recomiendan m&aacute;ximo <b>140</b> caracteres</html>");
		lblNewLabel.setVerticalAlignment(SwingConstants.TOP);
		lblNewLabel.setFont(new Font("Tahoma", Font.PLAIN, 12));
		lblNewLabel.setBounds(10, 15, 121, 84);
		add(lblNewLabel);
		
		JScrollPane scrollPane = new JScrollPane();
		scrollPane.setBounds(141, 11, 263, 100);
		add(scrollPane);
		
		JTextArea textArea = new JTextArea();
		textArea.setWrapStyleWord(true);
		textArea.setLineWrap(true);
		scrollPane.setViewportView(textArea);
		
		JLabel lblNewLabel_1 = new JLabel("New label");
		lblNewLabel_1.setVerticalAlignment(SwingConstants.TOP);
		lblNewLabel_1.setFont(new Font("Tahoma", Font.PLAIN, 12));
		lblNewLabel_1.setBounds(10, 147, 430, 56);
		add(lblNewLabel_1);

	}
}
