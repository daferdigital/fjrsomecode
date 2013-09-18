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

public class ConfiguracionInicialDialog extends JDialog {

	/**
	 * 
	 */
	private static final long serialVersionUID = -2906134423123278910L;
	private final JPanel contentPanel = new JPanel();
	private JTextField textField;
	private JTextField textField_1;
	private JTextField textField_2;

	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		try {
			ConfiguracionInicialDialog dialog = new ConfiguracionInicialDialog();
			dialog.setDefaultCloseOperation(JDialog.DISPOSE_ON_CLOSE);
			dialog.setVisible(true);
		} catch (Exception e) {
			e.printStackTrace();
		}
	}

	/**
	 * Create the dialog.
	 */
	public ConfiguracionInicialDialog() {
		setFont(new Font("Dialog", Font.PLAIN, 12));
		setIconImage(Toolkit.getDefaultToolkit().getImage(ConfiguracionInicialDialog.class.getResource("/resources/images/iconLogo1.jpg")));
		setTitle("Configuraci\u00F3n Inicial");
		setBounds(100, 100, 450, 300);
		getContentPane().setLayout(new BorderLayout());
		contentPanel.setBorder(new EmptyBorder(5, 5, 5, 5));
		getContentPane().add(contentPanel, BorderLayout.CENTER);
		contentPanel.setLayout(null);
		
		JLabel lblServidor = new JLabel("Servidor:");
		lblServidor.setFont(new Font("Tahoma", Font.BOLD, 13));
		lblServidor.setBounds(20, 73, 68, 14);
		contentPanel.add(lblServidor);
		
		textField = new JTextField();
		textField.setBounds(123, 71, 134, 20);
		contentPanel.add(textField);
		textField.setColumns(10);
		
		textField_1 = new JTextField();
		textField_1.setColumns(10);
		textField_1.setBounds(123, 98, 134, 20);
		contentPanel.add(textField_1);
		
		JLabel lblPuerto = new JLabel("Puerto:");
		lblPuerto.setFont(new Font("Tahoma", Font.BOLD, 13));
		lblPuerto.setBounds(20, 100, 68, 14);
		contentPanel.add(lblPuerto);
		
		textField_2 = new JTextField();
		textField_2.setColumns(10);
		textField_2.setBounds(123, 129, 134, 20);
		contentPanel.add(textField_2);
		
		JLabel lblBaseDeDatos = new JLabel("Base de Datos");
		lblBaseDeDatos.setFont(new Font("Tahoma", Font.BOLD, 13));
		lblBaseDeDatos.setBounds(10, 129, 103, 14);
		contentPanel.add(lblBaseDeDatos);
		
		JLabel lblindiquePorFavor = new JLabel("<html>Indique por favor, la direccion del servidor de base de datos de premium para realizar la sincronizaci&oacute;n inicial correspondiente.</html>");
		lblindiquePorFavor.setFont(new Font("Tahoma", Font.BOLD, 13));
		lblindiquePorFavor.setBounds(10, 11, 414, 51);
		contentPanel.add(lblindiquePorFavor);
		{
			JPanel buttonPane = new JPanel();
			buttonPane.setLayout(new FlowLayout(FlowLayout.RIGHT));
			getContentPane().add(buttonPane, BorderLayout.SOUTH);
			{
				JButton okButton = new JButton("OK");
				okButton.setFont(new Font("Tahoma", Font.PLAIN, 12));
				okButton.setActionCommand("OK");
				buttonPane.add(okButton);
				getRootPane().setDefaultButton(okButton);
			}
			{
				JButton cancelButton = new JButton("Cancel");
				cancelButton.setFont(new Font("Tahoma", Font.PLAIN, 12));
				cancelButton.setActionCommand("Cancel");
				buttonPane.add(cancelButton);
			}
		}
	}
}
