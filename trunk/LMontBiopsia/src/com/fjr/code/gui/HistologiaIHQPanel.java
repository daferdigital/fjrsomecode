package com.fjr.code.gui;

import javax.swing.JPanel;
import java.awt.Color;
import javax.swing.JLabel;
import java.awt.Font;
import javax.swing.JTextField;
import javax.swing.SwingConstants;
import javax.swing.JButton;

import com.fjr.code.gui.operations.HistologiaIHQPanelOperations;
import com.fjr.code.gui.tables.JTableMicroLaminasIHQ;
import com.fjr.code.util.Constants;
import javax.swing.JTable;
import javax.swing.JSeparator;

import javax.swing.JScrollPane;

/**
 * 
 * Class: HistologiaIHQPanel
 * Creation Date: 25/08/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class HistologiaIHQPanel extends JPanel {

	/**
	 * 
	 */
	private static final long serialVersionUID = 291756815280980923L;
	private JTextField textNroBiopsia;
	private JTextField textNombrePaciente;
	private JTextField textPiezaRecibida;
	private JTextField textExamenARealizar;
	private JTable tblLaminasIHQ;
	private JTableMicroLaminasIHQ tableMicroLaminasIHQ = JTableMicroLaminasIHQ.getNewInstance();
	
	/**
	 * Create the panel.
	 */
	public HistologiaIHQPanel() {
		setBackground(new Color(153, 255, 153));
		setLayout(null);
		
		JLabel lblNroBiopsia = new JLabel("<html><b>N&deg; de Biopsia:</b></html>");
		lblNroBiopsia.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblNroBiopsia.setBounds(10, 13, 117, 14);
		add(lblNroBiopsia);
		
		textNroBiopsia = new JTextField();
		textNroBiopsia.setBounds(157, 11, 184, 20);
		textNroBiopsia.setColumns(10);
		textNroBiopsia.setName(HistologiaIHQPanelOperations.ACTION_COMMAND_NRO_BIOPSIA);
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
		
		JButton btnGuardar = new JButton("Guardar");
		btnGuardar.setFont(new Font("Tahoma", Font.PLAIN, 12));
		btnGuardar.setBounds(24, 359, 91, 37);
		btnGuardar.setActionCommand(HistologiaIHQPanelOperations.ACTION_COMMAND_BTN_GUARDAR);
		add(btnGuardar);
		
		JButton btnPrintLabels = new JButton("<html>Imprimir <br /> Etiquetas</html>");
		btnPrintLabels.setFont(new Font("Tahoma", Font.PLAIN, 12));
		btnPrintLabels.setActionCommand(HistologiaIHQPanelOperations.ACTION_COMMAND_BTN_PRINT_LABELS);
		btnPrintLabels.setBounds(125, 359, 107, 37);
		add(btnPrintLabels);
		
		JButton btnSendToMicro = new JButton("<html>Enviar a Micro</html>");
		btnSendToMicro.setFont(new Font("Tahoma", Font.PLAIN, 12));
		btnSendToMicro.setBounds(249, 359, 107, 37);
		btnSendToMicro.setActionCommand(HistologiaIHQPanelOperations.ACTION_COMMAND_BTN_SEND_TO_MICRO);
		add(btnSendToMicro);
		
		JButton btnCancel = new JButton("Cancelar");
		btnCancel.setFont(new Font("Tahoma", Font.PLAIN, 12));
		btnCancel.setBounds(366, 359, 91, 37);
		btnCancel.setActionCommand(HistologiaIHQPanelOperations.ACTION_COMMAND_BTN_CANCELAR);
		add(btnCancel);
		
		setSize(Constants.APP_WINDOW_MAX_X, 400);
		setLocation(0, Constants.APP_MENU_HEIGTH);
		
		JSeparator separator = new JSeparator();
		separator.setOrientation(SwingConstants.VERTICAL);
		separator.setBackground(new Color(0, 0, 0));
		separator.setForeground(new Color(0, 0, 0));
		separator.setBounds(500, 0, 2, 400);
		add(separator);
		
		JLabel lblNewLabel = new JLabel("<html>L&aacute;minas: </html>:");
		lblNewLabel.setFont(new Font("Tahoma", Font.BOLD, 16));
		lblNewLabel.setBounds(516, 14, 82, 26);
		add(lblNewLabel);
		
		JScrollPane scrollPane = new JScrollPane();
		scrollPane.setBounds(546, 39, 444, 327);
		add(scrollPane);
		
		tblLaminasIHQ = tableMicroLaminasIHQ.getTable();
		scrollPane.setViewportView(tblLaminasIHQ);
		
		HistologiaIHQPanelOperations listener = new HistologiaIHQPanelOperations(this);
		
		JLabel lblNewLabel_1 = new JLabel("<html><b>(Doble click en cualquier registro para realizar su edici&oacute;n)</b></html>");
		lblNewLabel_1.setBounds(595, 22, 326, 14);
		add(lblNewLabel_1);
		
		btnCancel.addActionListener(listener);
		btnGuardar.addActionListener(listener);
		btnSendToMicro.addActionListener(listener);
		btnPrintLabels.addActionListener(listener);
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
	
	public JTable getTblLaminasIHQ() {
		return tblLaminasIHQ;
	}
	
	/**
	 * Metodo para fijar el foco en el elemento por defecto de la ventana
	 * 
	 */
	public void setFocusAtDefaultElement(){
		this.textNroBiopsia.requestFocusInWindow();
	}
	
	public JTableMicroLaminasIHQ getTableMicroLaminasIHQ() {
		return tableMicroLaminasIHQ;
	}
}
