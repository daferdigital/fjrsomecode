package com.fjr.code.gui;

import java.awt.BorderLayout;
import java.awt.FlowLayout;

import javax.swing.JButton;
import javax.swing.JDialog;
import javax.swing.JPanel;
import javax.swing.JScrollPane;
import javax.swing.border.EmptyBorder;
import java.awt.Toolkit;
import javax.swing.JLabel;
import javax.swing.JComboBox;
import javax.swing.JTextField;
import java.awt.Font;
import javax.swing.JTextArea;
import javax.swing.border.LineBorder;

import com.fjr.code.dao.TipoCedulaDAO;
import com.fjr.code.gui.operations.ClienteFormDialogOperations;

import java.awt.Color;

/**
 * 
 * Class: ClienteFormDialog
 * Creation Date: 31/08/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class ClienteFormDialog extends JDialog {

	/**
	 * 
	 */
	private static final long serialVersionUID = 5952939989484127217L;
	
	private final JPanel contentPanel = new JPanel();
	private JComboBox comboTipoCedula;
	private JTextField textNroCedula;
	private JTextField textNombre;
	private JTextField textApellido;
	private JComboBox comboEdad;
	private JTextField textTelefono;
	private JTextField textCorreo;
	private JTextArea textAreaDireccion;
	private JButton okButton;
	private JButton cancelButton;

	private Object ventanaReferencia;
	
	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		try {
			ClienteFormDialog dialog = new ClienteFormDialog(0, "", null);
			dialog.setDefaultCloseOperation(JDialog.DISPOSE_ON_CLOSE);
			dialog.setVisible(true);
		} catch (Exception e) {
			e.printStackTrace();
		}
	}

	/**
	 * Create the dialog.
	 */
	public ClienteFormDialog(int indexTipoCedula, String cedula, Object ventanaReferencia) {
		this.ventanaReferencia = ventanaReferencia;
		
		setTitle("Informaci\u00F3n de Paciente");
		setResizable(false);
		setModal(true);
		setIconImage(Toolkit.getDefaultToolkit().getImage(ClienteFormDialog.class.getResource("/resources/images/iconLogo1.jpg")));
		setDefaultCloseOperation(JDialog.DISPOSE_ON_CLOSE);
		setBounds(100, 100, 450, 300);
		
		getContentPane().setLayout(new BorderLayout());
		contentPanel.setBorder(new EmptyBorder(5, 5, 5, 5));
		getContentPane().add(contentPanel, BorderLayout.CENTER);
		contentPanel.setLayout(null);
		
		JLabel lblceacutedula = new JLabel("<html><b>C&eacute;dula: (*)</b></html>");
		lblceacutedula.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblceacutedula.setBounds(10, 11, 127, 14);
		contentPanel.add(lblceacutedula);
		
		comboTipoCedula = new JComboBox();
		comboTipoCedula.setBounds(174, 11, 60, 20);
		TipoCedulaDAO.populateJCombo(comboTipoCedula);
		comboTipoCedula.setSelectedIndex(indexTipoCedula);
		contentPanel.add(comboTipoCedula);
		
		textNroCedula = new JTextField();
		textNroCedula.setBounds(244, 11, 100, 20);
		textNroCedula.setColumns(10);
		textNroCedula.setText(cedula);
		textNroCedula.setName(ClienteFormDialogOperations.ACTION_COMMAND_TEXT_CEDULA);
		contentPanel.add(textNroCedula);
		
		JLabel lblnombreDelPaciente = new JLabel("<html><b>Nombre del Paciente(*):</b><html>");
		lblnombreDelPaciente.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblnombreDelPaciente.setBounds(10, 36, 157, 14);
		contentPanel.add(lblnombreDelPaciente);
		
		textNombre = new JTextField();
		textNombre.setBounds(174, 36, 170, 20);
		contentPanel.add(textNombre);
		textNombre.setColumns(10);
		
		JLabel lblapellidoDelPaciente = new JLabel("<html><b>Apellido del Paciente(*):</b><html>");
		lblapellidoDelPaciente.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblapellidoDelPaciente.setBounds(10, 61, 170, 14);
		contentPanel.add(lblapellidoDelPaciente);
		
		textApellido = new JTextField();
		textApellido.setColumns(10);
		textApellido.setBounds(174, 61, 170, 20);
		contentPanel.add(textApellido);
		
		JLabel label_3 = new JLabel("<html><b>Edad:</b></html>");
		label_3.setFont(new Font("Tahoma", Font.PLAIN, 13));
		label_3.setBounds(10, 86, 127, 14);
		contentPanel.add(label_3);
		
		comboEdad = new JComboBox();
		comboEdad.setBounds(174, 86, 72, 20);
		for(int i = 1; i < 101; i++){
			comboEdad.addItem((i < 10 ? "0" : "") + i);
		}
		contentPanel.add(comboEdad);
		
		JLabel lblteleacutefono = new JLabel("<html><b>Tel&eacute;fono(*):</b><html>");
		lblteleacutefono.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblteleacutefono.setBounds(10, 111, 145, 14);
		contentPanel.add(lblteleacutefono);
		
		textTelefono = new JTextField();
		textTelefono.setColumns(10);
		textTelefono.setBounds(174, 111, 170, 20);
		contentPanel.add(textTelefono);
		
		JLabel lblcorreo = new JLabel("<html><b>Correo:</b><html>");
		lblcorreo.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblcorreo.setBounds(10, 136, 145, 14);
		contentPanel.add(lblcorreo);
		
		textCorreo = new JTextField();
		textCorreo.setColumns(10);
		textCorreo.setBounds(174, 136, 170, 20);
		textCorreo.setName(ClienteFormDialogOperations.ACTION_COMMAND_TEXT_CORREO);
		contentPanel.add(textCorreo);
		
		JLabel lbldireccioacuten = new JLabel("<html><b>Direcci&oacute;n:</b></html>");
		lbldireccioacuten.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lbldireccioacuten.setBounds(10, 161, 127, 14);
		contentPanel.add(lbldireccioacuten);
		
		JScrollPane scrollPane = new JScrollPane();
		scrollPane.setBounds(174, 167, 220, 59);
		contentPanel.add(scrollPane);
		
		textAreaDireccion = new JTextArea();
		scrollPane.setViewportView(textAreaDireccion);
		textAreaDireccion.setWrapStyleWord(true);
		textAreaDireccion.setLineWrap(true);
		textAreaDireccion.setBorder(new LineBorder(new Color(0, 0, 0)));
		
		{
			JPanel buttonPane = new JPanel();
			buttonPane.setLayout(new FlowLayout(FlowLayout.RIGHT));
			getContentPane().add(buttonPane, BorderLayout.SOUTH);
			
			JLabel lblNewLabel = new JLabel("(*) Obligatorio");
			lblNewLabel.setForeground(Color.RED);
			lblNewLabel.setFont(new Font("Tahoma", Font.BOLD, 12));
			buttonPane.add(lblNewLabel);
			{
				okButton = new JButton("Guardar");
				okButton.setFont(new Font("Tahoma", Font.PLAIN, 13));
				okButton.setActionCommand(ClienteFormDialogOperations.ACTION_COMMAND_BUTTON_OK);
				buttonPane.add(okButton);
				getRootPane().setDefaultButton(okButton);
			}
			{
				cancelButton = new JButton("Cancelar");
				cancelButton.setFont(new Font("Tahoma", Font.PLAIN, 13));
				cancelButton.setActionCommand(ClienteFormDialogOperations.ACTION_COMMAND_BUTTON_CANCEL);
				buttonPane.add(cancelButton);
			}
		}
		
		ClienteFormDialogOperations listener = new ClienteFormDialogOperations(this);
		
		okButton.addActionListener(listener);
		cancelButton.addActionListener(listener);
		textNroCedula.addKeyListener(listener);
		textCorreo.addKeyListener(listener);
		
		setLocationRelativeTo(null);
		setVisible(true);
	}
	
	public JComboBox getComboTipoCedula() {
		return comboTipoCedula;
	}

	public void setComboTipoCedula(JComboBox comboTipoCedula) {
		this.comboTipoCedula = comboTipoCedula;
	}

	public JTextField getTextNroCedula() {
		return textNroCedula;
	}

	public void setTextNroCedula(JTextField textNroCedula) {
		this.textNroCedula = textNroCedula;
	}

	public JTextField getTextNombre() {
		return textNombre;
	}

	public void setTextNombre(JTextField textNombre) {
		this.textNombre = textNombre;
	}

	public JTextField getTextApellido() {
		return textApellido;
	}

	public void setTextApellido(JTextField textApellido) {
		this.textApellido = textApellido;
	}

	public JComboBox getComboEdad() {
		return comboEdad;
	}

	public void setComboEdad(JComboBox comboEdad) {
		this.comboEdad = comboEdad;
	}

	public JTextField getTextTelefono() {
		return textTelefono;
	}

	public void setTextTelefono(JTextField textTelefono) {
		this.textTelefono = textTelefono;
	}

	public JTextField getTextCorreo() {
		return textCorreo;
	}

	public void setTextCorreo(JTextField textCorreo) {
		this.textCorreo = textCorreo;
	}

	public JTextArea getTextAreaDireccion() {
		return textAreaDireccion;
	}

	public void setTextAreaDireccion(JTextArea textAreaDireccion) {
		this.textAreaDireccion = textAreaDireccion;
	}
	
	public Object getVentanaReferencia() {
		return ventanaReferencia;
	}
}
