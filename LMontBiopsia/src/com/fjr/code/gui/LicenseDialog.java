package com.fjr.code.gui;

import java.awt.BorderLayout;
import java.awt.FlowLayout;
import java.awt.Font;

import javax.swing.JButton;
import javax.swing.JDialog;
import javax.swing.JLabel;
import javax.swing.JPanel;
import javax.swing.JTextField;
import javax.swing.border.EmptyBorder;

import java.awt.Toolkit;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

public class LicenseDialog extends JDialog implements ActionListener {

	/**
	 * 
	 */
	private static final long serialVersionUID = -6864627009339227346L;
	
	private JPanel contentPanel = null;
	
	private JTextField txtEmpresa;
	private JTextField txtNumRif;
	private JTextField txtNumIP;
	private JTextField txtSerial;
	private JTextField txtLicencia;

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
		setModal(true);
		setDefaultCloseOperation(JDialog.DISPOSE_ON_CLOSE);
		setIconImage(Toolkit.getDefaultToolkit().getImage(LicenseDialog.class.getResource("/resources/images/iconLogo1.jpg")));
		setTitle("Activaci\u00F3n de Licencia");
		setBounds(100, 100, 450, 500);
		getContentPane().setLayout(new BorderLayout());
		setLocationRelativeTo(null);
		
		getPanelMain();
		getContentPane().add(contentPanel, BorderLayout.CENTER);
		{
			JPanel buttonPane = new JPanel();
			buttonPane.setLayout(new FlowLayout(FlowLayout.RIGHT));
			getContentPane().add(buttonPane, BorderLayout.SOUTH);
			{
				JButton okButton = new JButton("Activar");
				okButton.setFont(new Font("Tahoma", Font.PLAIN, 13));
				okButton.setActionCommand("OK");
				buttonPane.add(okButton);
				getRootPane().setDefaultButton(okButton);
			}
			{
				JButton cancelButton = new JButton("Cancelar");
				cancelButton.setFont(new Font("Tahoma", Font.PLAIN, 13));
				cancelButton.setActionCommand("Cancel");
				buttonPane.add(cancelButton);
			}
		}
	}
	
	public void getPanelMain() {
		contentPanel = new JPanel(null);

		JLabel lbl0 = new JLabel("<html>Licenciamiento</html>");
		JLabel lbl1 = new JLabel("Nombre de la Empresa: ");
		JLabel lbl2 = new JLabel("Código de Identificacion Fiscal: ");
		JLabel lbl3 = new JLabel("Servidor/IP: ");
		JLabel lbl4 = new JLabel("Serial del Servidor: ");
		JLabel lbl5 = new JLabel("Número de Licencia: ");
		JLabel lbl6 = new JLabel("Versión de Qnetfiles: ");
		JLabel lbl7 = new JLabel("Usuarios permitidos : ");
		
		//lblVersion = new JLabel("Free");
		//lblLicencias = new JLabel(Constants.LIMITE_MINIMO_USUARIOS);

		lbl0.setFont(new Font("Tahoma", Font.BOLD, 14));
		lbl1.setFont(new Font("Tahoma", Font.PLAIN, 12));
		lbl2.setFont(new Font("Tahoma", Font.PLAIN, 12));
		lbl3.setFont(new Font("Tahoma", Font.PLAIN, 12));
		lbl4.setFont(new Font("Tahoma", Font.PLAIN, 12));
		lbl5.setFont(new Font("Tahoma", Font.PLAIN, 12));
		lbl6.setFont(new Font("Tahoma", Font.PLAIN, 12));
		lbl7.setFont(new Font("Tahoma", Font.PLAIN, 12));
		
		//lblVersion.setFont(new Font("Tahoma", Font.BOLD, 12));
		//lblLicencias.setFont(new Font("Tahoma", Font.BOLD, 12));
		
		lbl0.setVerticalAlignment(JLabel.TOP);

		lbl0.setBounds(10, 10, 340, 60);
		lbl1.setBounds(10, 40, 180, 20);
		lbl2.setBounds(10, 90, 180, 20);
		lbl3.setBounds(10, 140, 180, 20);
		lbl4.setBounds(10, 190, 180, 20);
		lbl5.setBounds(10, 240, 180, 20);
		lbl6.setBounds(10, 300, 180, 20);
		lbl7.setBounds(10, 320, 180, 20);

		//lblVersion.setBounds(140, 300, 180, 20);
		//lblLicencias.setBounds(140, 320, 180, 20);

		int col = 29;

		txtEmpresa = new JTextField(col);
		txtNumRif = new JTextField(col);
		txtNumIP = new JTextField(col);
		txtSerial = new JTextField(col);
		txtLicencia = new JTextField(col);

		int k = 20;

		txtEmpresa.setBounds(10, 40 + k, 500, 25);
		txtNumRif.setBounds(10, 90 + k, 200, 25);
		txtNumIP.setBounds(10, 140 + k, 200, 25);
		txtSerial.setBounds(10, 190 + k, 400, 25);
		txtLicencia.setBounds(10, 240 + k, 400, 25);
		
		txtSerial.setEditable(false);

		contentPanel.add(lbl0);
		contentPanel.add(lbl1);
		contentPanel.add(txtEmpresa);
		contentPanel.add(lbl2);
		contentPanel.add(txtNumRif);
		contentPanel.add(lbl3);
		contentPanel.add(txtNumIP);
		contentPanel.add(lbl4);
		contentPanel.add(txtSerial);
		contentPanel.add(lbl5);
		contentPanel.add(txtLicencia);
		contentPanel.add(lbl6);
		contentPanel.add(lbl7);
		//panel.add(lblVersion);
		//panel.add(lblLicencias);
	}
	
	/**
	 * 
	 */
	public static void showDialog(){
		new LicenseDialog().setVisible(true);
	}

	@Override
	public void actionPerformed(ActionEvent e) {
		// TODO Auto-generated method stub
		if("Cancel".equals(e.getActionCommand())){
			//debemos cerrar
			this.dispose();
		} else {
			//debemos validar la licencia
			//vemos si los campos requeridos no son vacios
			if("".equals(txtLicencia.getText().trim())){
				
			}
		}
	}
}
