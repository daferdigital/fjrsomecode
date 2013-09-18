package com.fjr.code.gui;

import java.awt.BorderLayout;
import java.awt.FlowLayout;

import javax.swing.JButton;
import javax.swing.JDialog;
import javax.swing.JPanel;
import javax.swing.border.EmptyBorder;
import java.awt.Font;
import java.awt.Toolkit;
import javax.swing.JLabel;
import javax.swing.SwingConstants;
import javax.swing.JTextField;

import com.fjr.code.gui.operations.DataBaseConfigDialogOperations;

/**
 * 
 * Class: DataBaseConfigDialog
 * Creation Date: 14/09/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class DataBaseConfigDialog extends JDialog {

	/**
	 * 
	 */
	private static final long serialVersionUID = 3650870083721006596L;
	private final JPanel contentPanel = new JPanel();
	private JTextField textServidor;
	private JTextField textPuerto;

	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		try {
			DataBaseConfigDialog dialog = new DataBaseConfigDialog();
			dialog.setDefaultCloseOperation(JDialog.DISPOSE_ON_CLOSE);
			dialog.setVisible(true);
		} catch (Exception e) {
			e.printStackTrace();
		}
	}

	/**
	 * Create the dialog.
	 */
	public DataBaseConfigDialog() {
		setDefaultCloseOperation(JDialog.DISPOSE_ON_CLOSE);
		setTitle("Configure su conexi\u00F3n a Base de Datos");
		setIconImage(Toolkit.getDefaultToolkit().getImage(DataBaseConfigDialog.class.getResource("/resources/images/iconLogo1.jpg")));
		setBounds(100, 100, 450, 279);
		getContentPane().setLayout(new BorderLayout());
		contentPanel.setBorder(new EmptyBorder(5, 5, 5, 5));
		getContentPane().add(contentPanel, BorderLayout.CENTER);
		contentPanel.setLayout(null);
		{
			JLabel lblNewLabel = new JLabel("<html>Por favor, indique la direcci&oacute;n de su servidor de base de datos as&iacute; como el puerto del mismo.<br /><br />Hasta que no indique esta configuraci&oacute;n no podr&aacute; utilizar el sistema.</html>");
			lblNewLabel.setVerticalAlignment(SwingConstants.TOP);
			lblNewLabel.setFont(new Font("Tahoma", Font.BOLD, 13));
			lblNewLabel.setBounds(10, 11, 347, 96);
			contentPanel.add(lblNewLabel);
		}
		{
			JLabel lblNewLabel_1 = new JLabel("Servidor:");
			lblNewLabel_1.setFont(new Font("Tahoma", Font.BOLD, 13));
			lblNewLabel_1.setBounds(10, 135, 75, 14);
			contentPanel.add(lblNewLabel_1);
		}
		
		textServidor = new JTextField();
		textServidor.setBounds(97, 133, 151, 20);
		contentPanel.add(textServidor);
		textServidor.setColumns(10);
		
		JLabel lblPuerto = new JLabel("Puerto:");
		lblPuerto.setFont(new Font("Tahoma", Font.BOLD, 13));
		lblPuerto.setBounds(10, 162, 75, 14);
		contentPanel.add(lblPuerto);
		
		textPuerto = new JTextField();
		textPuerto.setText("3306");
		textPuerto.setColumns(10);
		textPuerto.setBounds(97, 160, 151, 20);
		contentPanel.add(textPuerto);
		
		JPanel buttonPane = new JPanel();
		buttonPane.setLayout(new FlowLayout(FlowLayout.RIGHT));
		getContentPane().add(buttonPane, BorderLayout.SOUTH);
		
		JButton okButton = new JButton("<html>Probar Conexi&oacute;n</html>");
		okButton.setFont(new Font("Tahoma", Font.PLAIN, 13));
		okButton.setActionCommand(DataBaseConfigDialogOperations.ACTION_COMMAND_TEST_CONNECTION);
		buttonPane.add(okButton);
		getRootPane().setDefaultButton(okButton);
		
		JButton cancelButton = new JButton("Cancelar");
		cancelButton.setFont(new Font("Tahoma", Font.PLAIN, 13));
		cancelButton.setActionCommand(DataBaseConfigDialogOperations.ACTION_COMMAND_CANCELAR);
		buttonPane.add(cancelButton);
		
		DataBaseConfigDialogOperations listener = new DataBaseConfigDialogOperations(this);
		okButton.addActionListener(listener);
		cancelButton.addActionListener(listener);
		
		setLocationRelativeTo(null);
		setVisible(true);
	}
	
	public JTextField getTextServidor() {
		return textServidor;
	}
	
	public JTextField getTextPuerto() {
		return textPuerto;
	}
}
