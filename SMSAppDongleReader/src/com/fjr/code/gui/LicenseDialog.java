package com.fjr.code.gui;

import java.awt.BorderLayout;
import java.awt.FlowLayout;

import javax.swing.JButton;
import javax.swing.JDialog;
import javax.swing.JPanel;
import javax.swing.border.EmptyBorder;
import java.awt.Toolkit;
import java.awt.Font;
import javax.swing.JLabel;
import javax.swing.JTextField;

import com.fjr.code.gui.operations.LicenseDialogOperations;
import com.fjr.code.util.LicenseUtil;

/**
 * 
 * Class: LicenseDialog
 * Creation Date: 24/09/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class LicenseDialog extends JDialog {

	/**
	 * 
	 */
	private static final long serialVersionUID = -6864627009339227346L;
	private final JPanel contentPanel = new JPanel();
	private JTextField textFieldCodigo;
	private JTextField textFieldSerial;

	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		try {
			LicenseDialog dialog = new LicenseDialog();
			dialog.setDefaultCloseOperation(JDialog.DISPOSE_ON_CLOSE);
			dialog.setVisible(true);
		} catch (Exception e) {
			e.printStackTrace();
		}
	}

	/**
	 * Create the dialog.
	 */
	public LicenseDialog() {
		setTitle("Activaci\u00F3n de Licencia");
		setDefaultCloseOperation(JDialog.DISPOSE_ON_CLOSE);
		setModal(true);
		setIconImage(Toolkit.getDefaultToolkit().getImage(LicenseDialog.class.getResource("/resources/images/smsIcon.png")));
		setBounds(100, 100, 450, 300);
		getContentPane().setLayout(new BorderLayout());
		contentPanel.setBorder(new EmptyBorder(5, 5, 5, 5));
		getContentPane().add(contentPanel, BorderLayout.CENTER);
		contentPanel.setLayout(null);
		
		JLabel lblIntroduzcaElCodigo = new JLabel("<html><b>Introduzca el Codigo proporcionado como Licencia en el campo SERIAL y proceda a validarla para poder activar el software.</b></html>");
		lblIntroduzcaElCodigo.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblIntroduzcaElCodigo.setBounds(10, 11, 414, 58);
		contentPanel.add(lblIntroduzcaElCodigo);
		
		JLabel lblCodigoEspecial = new JLabel("Codigo Especial:");
		lblCodigoEspecial.setFont(new Font("Tahoma", Font.BOLD, 13));
		lblCodigoEspecial.setBounds(10, 80, 115, 21);
		contentPanel.add(lblCodigoEspecial);
		
		textFieldCodigo = new JTextField();
		textFieldCodigo.setEditable(false);
		textFieldCodigo.setBounds(135, 80, 270, 20);
		textFieldCodigo.setColumns(10);
		textFieldCodigo.setText(LicenseUtil.getSerialServer());
		contentPanel.add(textFieldCodigo);
		
		JLabel lblSerial = new JLabel("Serial:");
		lblSerial.setFont(new Font("Tahoma", Font.BOLD, 13));
		lblSerial.setBounds(10, 127, 115, 21);
		contentPanel.add(lblSerial);
		
		textFieldSerial = new JTextField();
		textFieldSerial.setColumns(10);
		textFieldSerial.setBounds(135, 127, 270, 20);
		contentPanel.add(textFieldSerial);
		
		JPanel buttonPane = new JPanel();
		buttonPane.setLayout(new FlowLayout(FlowLayout.RIGHT));
		getContentPane().add(buttonPane, BorderLayout.SOUTH);
		
		JButton okButton = new JButton("Validar Licencia");
		okButton.setFont(new Font("Tahoma", Font.PLAIN, 13));
		okButton.setActionCommand(LicenseDialogOperations.ACTION_COMMAND_BTN_VALIDAR_LICENCIA);
		buttonPane.add(okButton);
		getRootPane().setDefaultButton(okButton);

		JButton cancelButton = new JButton("Cancelar");
		cancelButton.setFont(new Font("Tahoma", Font.PLAIN, 13));
		cancelButton.setActionCommand(LicenseDialogOperations.ACTION_COMMAND_BTN_CANCEL);
		buttonPane.add(cancelButton);
		
		LicenseDialogOperations listener = new LicenseDialogOperations(this);
		okButton.addActionListener(listener);
		cancelButton.addActionListener(listener);
		
		setLocationRelativeTo(null);
	}

	public JTextField getTextFieldCodigo() {
		return textFieldCodigo;
	}

	public JTextField getTextFieldSerial() {
		return textFieldSerial;
	}
}
