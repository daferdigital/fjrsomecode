package com.fjr.code.gui;

import javax.swing.JPanel;
import java.awt.Color;
import javax.swing.JLabel;
import java.awt.Font;
import javax.swing.JTextField;
import javax.swing.SwingConstants;
import javax.swing.JTextArea;
import javax.swing.border.LineBorder;
import javax.swing.JButton;

import com.fjr.code.gui.operations.MicroscopicaPanelOperations;
import com.fjr.code.gui.tables.JTableMicroLaminas;
import com.fjr.code.gui.tables.JTableMicroLaminasIHQ;
import com.fjr.code.util.Constants;
import javax.swing.JTable;
import javax.swing.JSeparator;

import javax.swing.JScrollPane;

/**
 * 
 * Class: MacroscopicaPanel
 * Creation Date: 25/08/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class MicroscopicaPanel extends JPanel {

	/**
	 * 
	 */
	private static final long serialVersionUID = 291756815280980923L;
	private JTextField textNroBiopsia;
	private JTextField textNombrePaciente;
	private JTextField textPiezaRecibida;
	private JTextField textExamenARealizar;
	private JTextArea textAIDx;
	private JTextArea textADiagnostico;
	private JTextArea textADiagnosticoIHQ;
	private JTable tblLaminas;
	private JTableMicroLaminas tableMicroLaminas = JTableMicroLaminas.getNewInstance();
	private JTable tblLaminasIHQ;
	private JTableMicroLaminasIHQ tableMicroLaminasIHQ = JTableMicroLaminasIHQ.getNewInstance();
	
	/**
	 * Create the panel.
	 */
	public MicroscopicaPanel() {
		setBackground(new Color(255, 102, 102));
		setLayout(null);
		
		JLabel lblNroBiopsia = new JLabel("<html><b>N&deg; de Biopsia:</b></html>");
		lblNroBiopsia.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblNroBiopsia.setBounds(10, 13, 117, 14);
		add(lblNroBiopsia);
		
		textNroBiopsia = new JTextField();
		textNroBiopsia.setBounds(157, 11, 184, 20);
		textNroBiopsia.setColumns(10);
		textNroBiopsia.setName(MicroscopicaPanelOperations.ACTION_COMMAND_NRO_BIOPSIA);
		add(textNroBiopsia);
		
		JLabel lblnombreDelPaciente = new JLabel("<html><b>Nombre del Paciente:</b></html>");
		lblnombreDelPaciente.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblnombreDelPaciente.setBounds(10, 38, 137, 14);
		add(lblnombreDelPaciente);
		
		textNombrePaciente = new JTextField();
		textNombrePaciente.setEditable(false);
		textNombrePaciente.setFont(new Font("Tahoma", Font.PLAIN, 13));
		textNombrePaciente.setColumns(10);
		textNombrePaciente.setBounds(157, 38, 184, 20);
		add(textNombrePaciente);
		
		JLabel lblpiezaRecibida = new JLabel("<html><b>Pieza Recibida:</b></html>");
		lblpiezaRecibida.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblpiezaRecibida.setBounds(10, 66, 127, 14);
		add(lblpiezaRecibida);
		
		textPiezaRecibida = new JTextField();
		textPiezaRecibida.setEditable(false);
		textPiezaRecibida.setFont(new Font("Tahoma", Font.PLAIN, 13));
		textPiezaRecibida.setColumns(10);
		textPiezaRecibida.setBounds(157, 69, 184, 20);
		add(textPiezaRecibida);
		
		JLabel lblexamenARealizar = new JLabel("<html><b>Examen a Realizar:</b></html>");
		lblexamenARealizar.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblexamenARealizar.setBounds(10, 98, 127, 14);
		add(lblexamenARealizar);
		
		textExamenARealizar = new JTextField();
		textExamenARealizar.setFont(new Font("Tahoma", Font.PLAIN, 13));
		textExamenARealizar.setEditable(false);
		textExamenARealizar.setColumns(10);
		textExamenARealizar.setBounds(157, 101, 184, 20);
		add(textExamenARealizar);
		
		JLabel labelDescMacroscopica = new JLabel("<html><b>IDx:</b></html>");
		labelDescMacroscopica.setVerticalAlignment(SwingConstants.TOP);
		labelDescMacroscopica.setHorizontalAlignment(SwingConstants.LEFT);
		labelDescMacroscopica.setFont(new Font("Tahoma", Font.PLAIN, 13));
		labelDescMacroscopica.setBounds(10, 148, 117, 37);
		add(labelDescMacroscopica);
		
		JScrollPane scrollPane_1 = new JScrollPane();
		scrollPane_1.setBounds(157, 145, 289, 97);
		add(scrollPane_1);
		
		textAIDx = new JTextArea();
		scrollPane_1.setViewportView(textAIDx);
		textAIDx.setWrapStyleWord(true);
		textAIDx.setLineWrap(true);
		textAIDx.setBorder(new LineBorder(new Color(0, 0, 0)));
		
		JLabel lblDescPeroperatoria = new JLabel("<html><b>Diagnostico:</b></html>");
		lblDescPeroperatoria.setVerticalAlignment(SwingConstants.TOP);
		lblDescPeroperatoria.setHorizontalAlignment(SwingConstants.LEFT);
		lblDescPeroperatoria.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblDescPeroperatoria.setBounds(10, 256, 117, 37);
		add(lblDescPeroperatoria);
		
		JScrollPane scrollPane_2 = new JScrollPane();
		scrollPane_2.setBounds(157, 253, 289, 97);
		add(scrollPane_2);
		
		textADiagnostico = new JTextArea();
		scrollPane_2.setViewportView(textADiagnostico);
		textADiagnostico.setWrapStyleWord(true);
		textADiagnostico.setLineWrap(true);
		textADiagnostico.setBorder(new LineBorder(new Color(0, 0, 0)));
		
		JButton btnGuardar = new JButton("Guardar");
		btnGuardar.setFont(new Font("Tahoma", Font.PLAIN, 12));
		btnGuardar.setBounds(10, 467, 91, 37);
		btnGuardar.setActionCommand(MicroscopicaPanelOperations.ACTION_COMMAND_BTN_GUARDAR);
		add(btnGuardar);
		
		JButton btnSendToDiagnostico = new JButton("<html>Enviar <br />Diagnostico</html>");
		btnSendToDiagnostico.setFont(new Font("Tahoma", Font.PLAIN, 12));
		btnSendToDiagnostico.setBounds(111, 467, 134, 37);
		btnSendToDiagnostico.setActionCommand(MicroscopicaPanelOperations.ACTION_COMMAND_BTN_SEND_TO_DIAGNOSTICO);
		add(btnSendToDiagnostico);
		
		JButton btnSendToIHQ = new JButton("<html>Solicitar <br />IHQ</html>");
		btnSendToIHQ.setFont(new Font("Tahoma", Font.PLAIN, 12));
		btnSendToIHQ.setBounds(263, 467, 110, 37);
		btnSendToIHQ.setActionCommand(MicroscopicaPanelOperations.ACTION_COMMAND_BTN_SEND_TO_IHQ);
		add(btnSendToIHQ);
		
		JButton btnCancel = new JButton("Cancelar");
		btnCancel.setFont(new Font("Tahoma", Font.PLAIN, 12));
		btnCancel.setBounds(383, 467, 91, 37);
		btnCancel.setActionCommand(MicroscopicaPanelOperations.ACTION_COMMAND_BTN_CANCELAR);
		add(btnCancel);
		
		setSize(1000, 518);
		setLocation(0, Constants.APP_MENU_HEIGTH);
		
		JSeparator separator = new JSeparator();
		separator.setOrientation(SwingConstants.VERTICAL);
		separator.setBackground(new Color(0, 0, 0));
		separator.setForeground(new Color(0, 0, 0));
		separator.setBounds(500, 0, 2, 518);
		add(separator);
		
		JLabel lblNewLabel = new JLabel("<html>L&aacute;minas: </html>:");
		lblNewLabel.setFont(new Font("Tahoma", Font.BOLD, 16));
		lblNewLabel.setBounds(516, 14, 82, 26);
		add(lblNewLabel);
		
		JScrollPane scrollPane = new JScrollPane();
		scrollPane.setBounds(546, 39, 444, 203);
		add(scrollPane);
		
		tblLaminas = tableMicroLaminas.getTable();
		scrollPane.setViewportView(tblLaminas);
		
		MicroscopicaPanelOperations listener = new MicroscopicaPanelOperations(this);
		
		JLabel lblNewLabel_1 = new JLabel("<html><b>(Doble click en cualquier registro para realizar su edici&oacute;n)</b></html>");
		lblNewLabel_1.setBounds(595, 22, 326, 14);
		add(lblNewLabel_1);
		
		JLabel lbldiagnosticoPorIhq = new JLabel("<html><b>Estudio IHQ:</b></html>");
		lbldiagnosticoPorIhq.setVerticalAlignment(SwingConstants.TOP);
		lbldiagnosticoPorIhq.setHorizontalAlignment(SwingConstants.LEFT);
		lbldiagnosticoPorIhq.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lbldiagnosticoPorIhq.setBounds(10, 363, 117, 37);
		add(lbldiagnosticoPorIhq);
		
		textADiagnosticoIHQ = new JTextArea();
		textADiagnosticoIHQ.setWrapStyleWord(true);
		textADiagnosticoIHQ.setLineWrap(true);
		textADiagnosticoIHQ.setBorder(new LineBorder(new Color(0, 0, 0)));
		
		JScrollPane scrollPane_4 = new JScrollPane();
		scrollPane_4.setBounds(158, 361, 287, 95);
		add(scrollPane_4);
		scrollPane_4.setViewportView(textADiagnosticoIHQ);
		
		JLabel lbllaacuteminasIhq = new JLabel("<html>L&aacute;minas IHQ: </html>:");
		lbllaacuteminasIhq.setFont(new Font("Tahoma", Font.BOLD, 16));
		lbllaacuteminasIhq.setBounds(512, 256, 127, 26);
		add(lbllaacuteminasIhq);
		
		JLabel lbldobleClickEn = new JLabel("<html><b>(Doble click en cualquier registro para consultarlo)</b></html>");
		lbldobleClickEn.setBounds(628, 264, 326, 14);
		add(lbldobleClickEn);
		
		JScrollPane scrollPane_3 = new JScrollPane();
		scrollPane_3.setBounds(552, 286, 438, 221);
		add(scrollPane_3);
		
		tblLaminasIHQ = tableMicroLaminasIHQ.getTable();
		scrollPane_3.setViewportView(tblLaminasIHQ);
		btnCancel.addActionListener(listener);
		btnGuardar.addActionListener(listener);
		btnSendToDiagnostico.addActionListener(listener);
		btnSendToIHQ.addActionListener(listener);
		textNroBiopsia.addKeyListener(listener);
		
		setVisible(true);
	}

	public JTextField getTextNroBiopsia() {
		return textNroBiopsia;
	}

	public JTextField getTextNombrePaciente() {
		return textNombrePaciente;
	}

	public JTextField getTextPiezaRecibida() {
		return textPiezaRecibida;
	}

	public JTextField getTextExamenARealizar() {
		return textExamenARealizar;
	}

	public JTextArea getTextAIDx() {
		return textAIDx;
	}

	public JTextArea getTextADiagnostico() {
		return textADiagnostico;
	}
	
	public JTextArea getTextADiagnosticoIHQ() {
		return textADiagnosticoIHQ;
	}
	
	public JTable getTblLaminas() {
		return tblLaminas;
	}
	
	/**
	 * Metodo para fijar el foco en el elemento por defecto de la ventana
	 * 
	 */
	public void setFocusAtDefaultElement(){
		this.textNroBiopsia.requestFocusInWindow();
	}
	
	public JTableMicroLaminas getTableMicroLaminas() {
		return tableMicroLaminas;
	}

	public JTable getTblLaminasIHQ() {
		return tblLaminasIHQ;
	}

	public JTableMicroLaminasIHQ getTableMicroLaminasIHQ() {
		return tableMicroLaminasIHQ;
	}
}
