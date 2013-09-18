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

import com.fjr.code.gui.operations.HistologiaPanelOperations;
import com.fjr.code.gui.tables.JTableHistologia;
import com.fjr.code.util.Constants;
import javax.swing.JTable;
import javax.swing.JSeparator;

import javax.swing.JScrollPane;

/**
 * 
 * Class: HistologiaPanel
 * Creation Date: 25/08/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class HistologiaPanel extends JPanel {

	/**
	 * 
	 */
	private static final long serialVersionUID = 291756815280980923L;
	private JTextField textNroBiopsia;
	private JTextField textNombrePaciente;
	private JTextField textPiezaRecibida;
	private JTextField textExamenARealizar;
	private JTextArea textADescHistologia;
	private JTable tblCassetes;
	private JTableHistologia tableHistoCassetes = JTableHistologia.getNewInstance();
	
	/**
	 * Create the panel.
	 */
	public HistologiaPanel() {
		setBackground(new Color(153, 204, 255));
		setLayout(null);
		
		JLabel lblNroBiopsia = new JLabel("<html><b>N&deg; de Biopsia:</b></html>");
		lblNroBiopsia.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblNroBiopsia.setBounds(10, 13, 117, 14);
		add(lblNroBiopsia);
		
		textNroBiopsia = new JTextField();
		textNroBiopsia.setBounds(157, 11, 184, 20);
		textNroBiopsia.setColumns(10);
		textNroBiopsia.setName(HistologiaPanelOperations.ACTION_COMMAND_NRO_BIOPSIA);
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
		
		JLabel labelDesc = new JLabel("<html><b>Descripci&oacute;n:</b></html>");
		labelDesc.setVerticalAlignment(SwingConstants.TOP);
		labelDesc.setHorizontalAlignment(SwingConstants.LEFT);
		labelDesc.setFont(new Font("Tahoma", Font.PLAIN, 13));
		labelDesc.setBounds(10, 148, 117, 37);
		add(labelDesc);
		
		textADescHistologia = new JTextArea();
		textADescHistologia.setWrapStyleWord(true);
		textADescHistologia.setLineWrap(true);
		textADescHistologia.setBorder(new LineBorder(new Color(0, 0, 0)));
		textADescHistologia.setBounds(157, 145, 289, 97);
		add(textADescHistologia);
		
		JButton btnGuardar = new JButton("Guardar");
		btnGuardar.setFont(new Font("Tahoma", Font.PLAIN, 12));
		btnGuardar.setBounds(10, 258, 91, 37);
		btnGuardar.setActionCommand(HistologiaPanelOperations.ACTION_COMMAND_BTN_GUARDAR);
		add(btnGuardar);
		
		JButton btnPrintLabels = new JButton("Imprimir Etiquetas");
		btnPrintLabels.setFont(new Font("Tahoma", Font.PLAIN, 12));
		btnPrintLabels.setBounds(111, 258, 134, 37);
		btnPrintLabels.setActionCommand(HistologiaPanelOperations.ACTION_COMMAND_BTN_PRINT_LABELS);
		add(btnPrintLabels);
		
		JButton btnSendToMicroscopica = new JButton("<html>Enviar a <br />Microscopica</html>");
		btnSendToMicroscopica.setFont(new Font("Tahoma", Font.PLAIN, 12));
		btnSendToMicroscopica.setBounds(263, 258, 110, 37);
		btnSendToMicroscopica.setActionCommand(HistologiaPanelOperations.ACTION_COMMAND_BTN_SEND_TO_MICROSCOPICA);
		add(btnSendToMicroscopica);
		
		JButton btnCancel = new JButton("Cancelar");
		btnCancel.setFont(new Font("Tahoma", Font.PLAIN, 12));
		btnCancel.setBounds(383, 258, 91, 37);
		btnCancel.setActionCommand(HistologiaPanelOperations.ACTION_COMMAND_BTN_CANCELAR);
		add(btnCancel);
		
		setSize(1000, 310);
		setLocation(0, Constants.APP_MENU_HEIGTH);
		
		JSeparator separator = new JSeparator();
		separator.setOrientation(SwingConstants.VERTICAL);
		separator.setBackground(new Color(0, 0, 0));
		separator.setForeground(new Color(0, 0, 0));
		separator.setBounds(500, 0, 2, 310);
		add(separator);
		
		JLabel lblNewLabel = new JLabel("Cassetes:");
		lblNewLabel.setFont(new Font("Tahoma", Font.BOLD, 16));
		lblNewLabel.setBounds(516, 14, 82, 26);
		add(lblNewLabel);
		
		JScrollPane scrollPane = new JScrollPane();
		scrollPane.setBounds(546, 51, 444, 230);
		
		tblCassetes = tableHistoCassetes.getTable();
		scrollPane.setViewportView(tblCassetes);
		
		add(scrollPane);
		
		HistologiaPanelOperations listener = new HistologiaPanelOperations(this);
		
		JLabel lblNewLabel_1 = new JLabel("<html>(doble click en el registro para realizar la edici&oacute;n)</html>");
		lblNewLabel_1.setBounds(608, 22, 239, 14);
		add(lblNewLabel_1);
		btnCancel.addActionListener(listener);
		btnGuardar.addActionListener(listener);
		btnPrintLabels.addActionListener(listener);
		btnSendToMicroscopica.addActionListener(listener);
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

	public JTextArea getTextADescHistologia() {
		return textADescHistologia;
	}
	
	public JTable getTblCassetes() {
		return tblCassetes;
	}
	
	/**
	 * Metodo para fijar el foco en el elemento por defecto de la ventana
	 * 
	 */
	public void setFocusAtDefaultElement(){
		this.textNroBiopsia.requestFocusInWindow();
	}
	
	public JTableHistologia getTableHistoCassetes() {
		return tableHistoCassetes;
	}
}
