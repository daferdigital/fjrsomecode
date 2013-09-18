package com.fjr.installer.gui;

import java.awt.BorderLayout;
import java.awt.FlowLayout;

import javax.swing.JButton;
import javax.swing.JDialog;
import javax.swing.JPanel;
import javax.swing.border.EmptyBorder;
import java.awt.Toolkit;
import java.awt.Font;
import java.util.Calendar;

import javax.swing.JLabel;
import javax.swing.JTextField;

import com.fjr.installer.gui.operations.DataBaseCreateOperations;
import com.fjr.installer.gui.operations.DataBaseSyncOperations;

public class DataBaseSync extends JDialog {

	/**
	 * 
	 */
	private static final long serialVersionUID = 1070898485873023193L;
	private final JPanel contentPanel = new JPanel();
	private JTextField txtServidor;
	private JTextField txtPuerto;
	private JTextField txtClaveRoot;
	private JTextField txtNombreBaseDatos;

	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		try {
			DataBaseSync dialog = new DataBaseSync();
			dialog.setDefaultCloseOperation(JDialog.DISPOSE_ON_CLOSE);
			dialog.setVisible(true);
		} catch (Exception e) {
			e.printStackTrace();
		}
	}

	/**
	 * Create the dialog.
	 */
	public DataBaseSync() {
		setDefaultCloseOperation(JDialog.DISPOSE_ON_CLOSE);
		setTitle("Creaci\u00F3n Base de Datos de LMont Biopsia");
		setModal(true);
		setIconImage(Toolkit.getDefaultToolkit().getImage(DataBaseSync.class.getResource("/resources/images/iconLogo1.jpg")));
		setBounds(100, 100, 450, 242);
		getContentPane().setLayout(new BorderLayout());
		contentPanel.setBorder(new EmptyBorder(5, 5, 5, 5));
		getContentPane().add(contentPanel, BorderLayout.CENTER);
		contentPanel.setLayout(null);
		{
			JLabel lblNewLabel = new JLabel("Servidor:");
			lblNewLabel.setFont(new Font("Tahoma", Font.BOLD, 13));
			lblNewLabel.setBounds(10, 17, 70, 14);
			contentPanel.add(lblNewLabel);
		}
		
		txtServidor = new JTextField();
		txtServidor.setBounds(130, 11, 160, 20);
		contentPanel.add(txtServidor);
		txtServidor.setColumns(10);
		
		JLabel lblPuerto = new JLabel("Puerto:");
		lblPuerto.setFont(new Font("Tahoma", Font.BOLD, 13));
		lblPuerto.setBounds(10, 48, 70, 14);
		contentPanel.add(lblPuerto);
		
		txtPuerto = new JTextField();
		txtPuerto.setColumns(10);
		txtPuerto.setBounds(130, 42, 160, 20);
		txtPuerto.setText("3306");
		contentPanel.add(txtPuerto);
		
		JLabel lblClaveRoot = new JLabel("Clave ROOT:");
		lblClaveRoot.setFont(new Font("Tahoma", Font.BOLD, 13));
		lblClaveRoot.setBounds(10, 79, 89, 14);
		contentPanel.add(lblClaveRoot);
		
		txtClaveRoot = new JTextField();
		txtClaveRoot.setColumns(10);
		txtClaveRoot.setBounds(130, 73, 160, 20);
		contentPanel.add(txtClaveRoot);
		
		JLabel lblCdigoraBiopsia = new JLabel("C\u00F3digo 1ra Biopsia:");
		lblCdigoraBiopsia.setFont(new Font("Tahoma", Font.BOLD, 13));
		lblCdigoraBiopsia.setBounds(10, 110, 124, 20);
		contentPanel.add(lblCdigoraBiopsia);
		
		txtNombreBaseDatos = new JTextField();
		txtNombreBaseDatos.setColumns(10);
		txtNombreBaseDatos.setBounds(171, 111, 119, 20);
		contentPanel.add(txtNombreBaseDatos);
		
		JLabel label = new JLabel("");
		label.setFont(new Font("Tahoma", Font.BOLD, 13));
		label.setBounds(140, 110, 30, 20);
		label.setText((Calendar.getInstance().get(Calendar.YEAR) - 2000) + " - ");
		contentPanel.add(label);
		
		JPanel buttonPane = new JPanel();
		buttonPane.setLayout(new FlowLayout(FlowLayout.RIGHT));
		getContentPane().add(buttonPane, BorderLayout.SOUTH);
			
		JButton btnTestConnection = new JButton("Probar Conexi\u00F3n");
		btnTestConnection.setFont(new Font("Tahoma", Font.PLAIN, 12));
		btnTestConnection.setActionCommand(DataBaseCreateOperations.ACTION_COMMAND_BTN_TEST_CONNECTION);
		buttonPane.add(btnTestConnection);
		
		JButton btnCreateDB = new JButton("Crear Base de Datos");
		btnCreateDB.setFont(new Font("Tahoma", Font.PLAIN, 12));
		btnCreateDB.setActionCommand(DataBaseCreateOperations.ACTION_COMMAND_BTN_CREATE_DB);
		buttonPane.add(btnCreateDB);
		getRootPane().setDefaultButton(btnCreateDB);
		
		JButton btnCancel = new JButton("Cancelar");
		btnCancel.setFont(new Font("Tahoma", Font.PLAIN, 12));
		btnCancel.setActionCommand(DataBaseCreateOperations.ACTION_COMMAND_BTN_CANCEL);
		buttonPane.add(btnCancel);
		
		DataBaseSyncOperations listener = new DataBaseSyncOperations(this);
		btnCancel.addActionListener(listener);
		btnCreateDB.addActionListener(listener);
		btnTestConnection.addActionListener(listener);
		
		setLocationRelativeTo(null);
	}
	
	public JTextField getTxtServidor() {
		return txtServidor;
	}
	
	public JTextField getTxtPuerto() {
		return txtPuerto;
	}
	
	public JTextField getTxtClaveRoot() {
		return txtClaveRoot;
	}
	
	public JTextField getTxtNombreBaseDatos() {
		return txtNombreBaseDatos;
	}
}
