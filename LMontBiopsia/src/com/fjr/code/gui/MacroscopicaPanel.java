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

import com.fjr.code.gui.operations.ListenerDobleClickTextArea;
import com.fjr.code.gui.operations.MacroscopicaPanelOperations;
import com.fjr.code.gui.tables.JTableMacroCassetes;
import com.fjr.code.gui.tables.JTableMacroFotos;
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
public class MacroscopicaPanel extends JPanel {

	/**
	 * 
	 */
	private static final long serialVersionUID = 291756815280980923L;
	private JTextField textNroBiopsia;
	private JTextField textNombrePaciente;
	private JTextField textPiezaRecibida;
	private JTextField textExamenARealizar;
	private JTextArea textADescMacroscopica;
	private JTable tblCassetes;
	private JTableMacroCassetes tableMacroCassetes = JTableMacroCassetes.getNewInstance();
	private JTable tblFotos;
	private JTableMacroFotos tableMacroFotos = JTableMacroFotos.getNewInstance();
	
	/**
	 * Create the panel.
	 */
	public MacroscopicaPanel() {
		setBackground(new Color(255, 255, 153));
		setLayout(null);
		
		JLabel lblNroBiopsia = new JLabel("<html><b>N&deg; de Biopsia:</b></html>");
		lblNroBiopsia.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblNroBiopsia.setBounds(10, 13, 117, 14);
		add(lblNroBiopsia);
		
		textNroBiopsia = new JTextField();
		textNroBiopsia.setBounds(157, 11, 184, 20);
		textNroBiopsia.setColumns(10);
		textNroBiopsia.setName(MacroscopicaPanelOperations.ACTION_COMMAND_NRO_BIOPSIA);
		add(textNroBiopsia);
		
		JLabel lblnombreDelPaciente = new JLabel("<html><b>Nombre del Paciente:</b></html>");
		lblnombreDelPaciente.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblnombreDelPaciente.setBounds(10, 38, 137, 14);
		add(lblnombreDelPaciente);
		
		textNombrePaciente = new JTextField();
		textNombrePaciente.setEditable(false);
		textNombrePaciente.setFont(new Font("Tahoma", Font.PLAIN, 13));
		textNombrePaciente.setColumns(10);
		textNombrePaciente.setBounds(157, 38, 289, 20);
		add(textNombrePaciente);
		
		JLabel lblpiezaRecibida = new JLabel("<html><b>Pieza Recibida:</b></html>");
		lblpiezaRecibida.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblpiezaRecibida.setBounds(10, 66, 127, 14);
		add(lblpiezaRecibida);
		
		textPiezaRecibida = new JTextField();
		textPiezaRecibida.setEditable(false);
		textPiezaRecibida.setFont(new Font("Tahoma", Font.PLAIN, 13));
		textPiezaRecibida.setColumns(10);
		textPiezaRecibida.setBounds(157, 69, 289, 20);
		add(textPiezaRecibida);
		
		JLabel lblexamenARealizar = new JLabel("<html><b>Examen a Realizar:</b></html>");
		lblexamenARealizar.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblexamenARealizar.setBounds(10, 98, 127, 14);
		add(lblexamenARealizar);
		
		textExamenARealizar = new JTextField();
		textExamenARealizar.setFont(new Font("Tahoma", Font.PLAIN, 13));
		textExamenARealizar.setEditable(false);
		textExamenARealizar.setColumns(10);
		textExamenARealizar.setBounds(157, 101, 289, 20);
		add(textExamenARealizar);
		
		JLabel labelDescMacroscopica = new JLabel("<html><b>Descripci&oacute;n Macrosc&oacute;pica:</b></html>");
		labelDescMacroscopica.setHorizontalAlignment(SwingConstants.CENTER);
		labelDescMacroscopica.setFont(new Font("Tahoma", Font.PLAIN, 13));
		labelDescMacroscopica.setBounds(10, 148, 117, 37);
		add(labelDescMacroscopica);
		
		JScrollPane scrollPane_1 = new JScrollPane();
		scrollPane_1.setBounds(157, 145, 289, 97);
		add(scrollPane_1);
		
		textADescMacroscopica = new JTextArea();
		scrollPane_1.setViewportView(textADescMacroscopica);
		textADescMacroscopica.setWrapStyleWord(true);
		textADescMacroscopica.setLineWrap(true);
		textADescMacroscopica.addMouseListener(new ListenerDobleClickTextArea(textADescMacroscopica));
		textADescMacroscopica.setBorder(new LineBorder(new Color(0, 0, 0)));
		
		JButton btnGuardar = new JButton("Guardar");
		btnGuardar.setFont(new Font("Tahoma", Font.PLAIN, 12));
		btnGuardar.setBounds(10, 359, 91, 37);
		btnGuardar.setActionCommand(MacroscopicaPanelOperations.ACTION_COMMAND_BTN_GUARDAR);
		add(btnGuardar);
		
		JButton btnPrintLabels = new JButton("Imprimir Etiquetas");
		btnPrintLabels.setFont(new Font("Tahoma", Font.PLAIN, 12));
		btnPrintLabels.setBounds(111, 359, 134, 37);
		btnPrintLabels.setActionCommand(MacroscopicaPanelOperations.ACTION_COMMAND_BTN_PRINT_LABELS);
		add(btnPrintLabels);
		
		JButton btnSendToHistologia = new JButton("<html>Enviar a <br />Histolog&iacute;a</html>");
		btnSendToHistologia.setFont(new Font("Tahoma", Font.PLAIN, 12));
		btnSendToHistologia.setBounds(263, 359, 110, 37);
		btnSendToHistologia.setActionCommand(MacroscopicaPanelOperations.ACTION_COMMAND_BTN_SEND_TO_HISTOLOGIA);
		add(btnSendToHistologia);
		
		JButton btnCancel = new JButton("Cancelar");
		btnCancel.setFont(new Font("Tahoma", Font.PLAIN, 12));
		btnCancel.setBounds(383, 359, 91, 37);
		btnCancel.setActionCommand(MacroscopicaPanelOperations.ACTION_COMMAND_BTN_CANCELAR);
		add(btnCancel);
		
		setSize(Constants.APP_WINDOW_MAX_X, 400);
		setLocation(0, Constants.APP_MENU_HEIGTH);
		
		JSeparator separator = new JSeparator();
		separator.setOrientation(SwingConstants.VERTICAL);
		separator.setBackground(new Color(0, 0, 0));
		separator.setForeground(new Color(0, 0, 0));
		separator.setBounds(500, 0, 2, 400);
		add(separator);
		
		JLabel lblNewLabel = new JLabel("Cassetes:");
		lblNewLabel.setFont(new Font("Tahoma", Font.BOLD, 16));
		lblNewLabel.setBounds(516, 14, 82, 26);
		add(lblNewLabel);
		
		JButton btnAgregarCassete = new JButton("Agregar Cassete");
		btnAgregarCassete.setActionCommand(MacroscopicaPanelOperations.ACTION_COMMAND_BTN_ADD_CASSETE);
		btnAgregarCassete.setBounds(608, 10, 134, 23);
		add(btnAgregarCassete);
		
		JScrollPane scrollPane = new JScrollPane();
		scrollPane.setBounds(546, 39, 444, 145);
		add(scrollPane);
		
		tblCassetes = tableMacroCassetes.getTable();
		scrollPane.setViewportView(tblCassetes);
		
		JLabel lblFotos = new JLabel("Fotos:");
		lblFotos.setFont(new Font("Tahoma", Font.BOLD, 16));
		lblFotos.setBounds(513, 204, 56, 26);
		add(lblFotos);
		
		JButton btnAddFoto = new JButton("Agregar Macro Foto");
		btnAddFoto.setFont(new Font("Tahoma", Font.PLAIN, 12));
		btnAddFoto.setBounds(579, 208, 152, 23);
		btnAddFoto.setActionCommand(MacroscopicaPanelOperations.ACTION_COMMAND_BTN_ADD_FOTO);
		add(btnAddFoto);
		
		JScrollPane scrollPaneFotos = new JScrollPane();
		scrollPaneFotos.setBounds(546, 238, 444, 145);
		add(scrollPaneFotos);
		
		tblFotos = tableMacroFotos.getTable();
		scrollPaneFotos.setViewportView(tblFotos);
		
		MacroscopicaPanelOperations listener = new MacroscopicaPanelOperations(this);
		
		JButton btnAgregarFotoPeroperatoria = new JButton("Agregar Foto Per-Operatoria");
		btnAgregarFotoPeroperatoria.setFont(new Font("Tahoma", Font.PLAIN, 12));
		btnAgregarFotoPeroperatoria.setActionCommand(MacroscopicaPanelOperations.ACTION_COMMAND_BTN_ADD_FOTO_PER_OPERATORIA);
		btnAgregarFotoPeroperatoria.setBounds(745, 208, 217, 23);
		add(btnAgregarFotoPeroperatoria);
		
		btnCancel.addActionListener(listener);
		btnGuardar.addActionListener(listener);
		btnPrintLabels.addActionListener(listener);
		btnSendToHistologia.addActionListener(listener);
		btnAddFoto.addActionListener(listener);
		btnAgregarCassete.addActionListener(listener);
		btnAgregarFotoPeroperatoria.addActionListener(listener);
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

	public JTextArea getTextADescMacroscopica() {
		return textADescMacroscopica;
	}

	public JTable getTblCassetes() {
		return tblCassetes;
	}
	
	public JTable getTblFotos() {
		return tblFotos;
	}
	
	/**
	 * Metodo para fijar el foco en el elemento por defecto de la ventana
	 * 
	 */
	public void setFocusAtDefaultElement(){
		this.textNroBiopsia.requestFocusInWindow();
	}
	
	public JTableMacroCassetes getTableMacroCassetes() {
		return tableMacroCassetes;
	}
	
	public JTableMacroFotos getTableMacroFotos() {
		return tableMacroFotos;
	}
}
