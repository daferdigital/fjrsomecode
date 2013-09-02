package com.fjr.code.gui;

import javax.swing.JPanel;
import java.awt.Color;
import javax.swing.JLabel;
import java.awt.Font;

import javax.swing.JScrollPane;
import javax.swing.JTextField;
import javax.swing.JComboBox;
import javax.swing.JButton;
import org.eclipse.wb.swing.FocusTraversalOnArray;

import com.fjr.code.dao.ExamenBiopsiaDAO;
import com.fjr.code.dao.PatologoDAO;
import com.fjr.code.dao.TipoCedulaDAO;
import com.fjr.code.gui.operations.IngresoPanelOperations;
import com.fjr.code.util.Constants;

import java.awt.Component;
import javax.swing.JTextArea;
import javax.swing.border.LineBorder;
import javax.swing.SwingConstants;
import java.awt.Rectangle;

/**
 * 
 * Class: IngresoPanel
 * Creation Date: 28/08/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class IngresoPanel extends JPanel {

	/**
	 * 
	 */
	private static final long serialVersionUID = 5763855986388595232L;
	private JTextField textNroBiopsia;
	private JComboBox comboTipoCedula;
	private JTextField textCedula;
	private JTextField textNombrePaciente;
	private JTextField textApellido;
	private JTextField textEdad;
	private JTextField textProcedencia;
	private JTextField textPiezaRecibida;
	private JComboBox comboExamen;
	private JTextField textReferido;
	private JComboBox comboPatologo;
	private JTextArea textAreaIDx;
	private JLabel lblTipoExamen;
	private JLabel lblNumeroDias;
	
	/**
	 * 
	 * @param numeroBiopsia
	 */
	public IngresoPanel(String numeroBiopsia) {
		//amarillo pastel
		//setBackground(new Color(255, 255, 153));
		setBackground(new Color(255, 255, 255));
		setLayout(null);
		
		JLabel lblNroBiopsia = new JLabel("<html><b>N&deg; de Biopsia *:</b></html>");
		lblNroBiopsia.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblNroBiopsia.setBounds(20, 11, 117, 18);
		add(lblNroBiopsia);
		
		textNroBiopsia = new JTextField();
		textNroBiopsia.setName(IngresoPanelOperations.ACTION_COMMAND_NRO_BIOPSIA);
		textNroBiopsia.setFont(new Font("Tahoma", Font.PLAIN, 13));
		textNroBiopsia.setToolTipText("<html>\r\nIndique aqu&iacute; el codigo manual a asignar a esta biopsia\r\n<br />\r\nPor ejemplo 13-0192.\r\n<br />\r\nDejar en blanco si esta creando una biopsia nueva\r\n</html>");
		textNroBiopsia.setBounds(180, 11, 184, 20);
		textNroBiopsia.setColumns(10);
		if(numeroBiopsia != null){
			textNroBiopsia.setText(numeroBiopsia);
			textNroBiopsia.setEnabled(false);
		}
		add(textNroBiopsia);
		
		comboTipoCedula = new JComboBox();
		comboTipoCedula.setBounds(180, 40, 47, 20);
		TipoCedulaDAO.populateJCombo(comboTipoCedula);
		add(comboTipoCedula);
		
		JLabel lblCedula = new JLabel("<html><b>C&eacute;dula: </b></html>");
		lblCedula.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblCedula.setBounds(20, 42, 127, 14);
		add(lblCedula);
		
		textCedula = new JTextField();
		textCedula.setName(IngresoPanelOperations.ACTION_COMMAND_NRO_CEDULA);
		textCedula.setFont(new Font("Tahoma", Font.PLAIN, 13));
		textCedula.setColumns(10);
		textCedula.setBounds(237, 40, 127, 20);
		add(textCedula);
		
		JLabel lblNombrePaciente = new JLabel("<html><b>Nombre del Paciente:</b><html>");
		lblNombrePaciente.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblNombrePaciente.setBounds(20, 69, 145, 14);
		add(lblNombrePaciente);
		
		textNombrePaciente = new JTextField();
		textNombrePaciente.setEnabled(false);
		textNombrePaciente.setFont(new Font("Tahoma", Font.PLAIN, 13));
		textNombrePaciente.setColumns(10);
		textNombrePaciente.setBounds(180, 65, 184, 20);
		add(textNombrePaciente);
		
		JLabel lblapellidoDelPaciente = new JLabel("<html><b>Apellido del Paciente:</b><html>");
		lblapellidoDelPaciente.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblapellidoDelPaciente.setBounds(20, 98, 145, 14);
		add(lblapellidoDelPaciente);
		
		textApellido = new JTextField();
		textApellido.setEnabled(false);
		textApellido.setFont(new Font("Tahoma", Font.PLAIN, 13));
		textApellido.setColumns(10);
		textApellido.setBounds(180, 94, 184, 20);
		add(textApellido);
		
		JLabel lblEdad = new JLabel("<html><b>Edad:</b></html>");
		lblEdad.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblEdad.setBounds(20, 127, 127, 14);
		add(lblEdad);
		
		textEdad = new JTextField();
		textEdad.setEnabled(false);
		textEdad.setFont(new Font("Tahoma", Font.PLAIN, 13));
		textEdad.setBounds(180, 123, 184, 20);
		textEdad.setColumns(10);
		add(textEdad);
		
		JLabel lblProcedencia = new JLabel("<html><b>Procedencia :</b></html>");
		lblProcedencia.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblProcedencia.setBounds(20, 154, 127, 14);
		add(lblProcedencia);
		
		textProcedencia = new JTextField();
		textProcedencia.setFont(new Font("Tahoma", Font.PLAIN, 13));
		textProcedencia.setColumns(10);
		textProcedencia.setBounds(180, 152, 184, 20);
		add(textProcedencia);
		
		JLabel lblPiezaRecibida = new JLabel("<html><b>Pieza Recibida:</b></html>");
		lblPiezaRecibida.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblPiezaRecibida.setBounds(20, 181, 127, 14);
		add(lblPiezaRecibida);
		
		textPiezaRecibida = new JTextField();
		textPiezaRecibida.setFont(new Font("Tahoma", Font.PLAIN, 13));
		textPiezaRecibida.setColumns(10);
		textPiezaRecibida.setBounds(180, 177, 184, 20);
		add(textPiezaRecibida);
		
		JLabel lblExamenARealizar = new JLabel("<html><b>Examen a Realizar: </b></html>");
		lblExamenARealizar.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblExamenARealizar.setBounds(20, 211, 127, 14);
		add(lblExamenARealizar);
		
		comboExamen= new JComboBox();
		comboExamen.setActionCommand(IngresoPanelOperations.ACTION_COMMAND_COMBO_EXAMEN);
		comboExamen.setFont(new Font("Tahoma", Font.PLAIN, 13));
		comboExamen.setBounds(180, 206, 184, 22);
		ExamenBiopsiaDAO.populateJCombo(comboExamen);
		add(comboExamen);
		
		JLabel lbltipoDeExamen = new JLabel("<html><b>Tipo de Examen: </b></html>");
		lbltipoDeExamen.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lbltipoDeExamen.setBounds(20, 236, 127, 14);
		add(lbltipoDeExamen);
		
		lblTipoExamen = new JLabel("");
		lblTipoExamen.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblTipoExamen.setBounds(180, 236, 184, 14);
		add(lblTipoExamen);
		
		JLabel lbldiasResultados = new JLabel("<html><b>D&iacute;as para resultados: </b></html>");
		lbldiasResultados.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lbldiasResultados.setBounds(20, 256, 145, 14);
		add(lbldiasResultados);
		
		lblNumeroDias = new JLabel("");
		lblNumeroDias.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblNumeroDias.setBounds(180, 256, 184, 14);
		add(lblNumeroDias);
		
		JLabel lblReferidoMedico = new JLabel("<html><b>Referido / M&eacute;dico:</b></html>");
		lblReferidoMedico.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblReferidoMedico.setBounds(20, 286, 127, 14);
		add(lblReferidoMedico);
		
		textReferido = new JTextField();
		textReferido.setFont(new Font("Tahoma", Font.PLAIN, 13));
		textReferido.setColumns(10);
		textReferido.setBounds(180, 281, 184, 20);
		add(textReferido);
		
		JLabel lblpatoacutelogoDeTurno = new JLabel("<html><b>Pat&oacute;logo de turno: </b></html>");
		lblpatoacutelogoDeTurno.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblpatoacutelogoDeTurno.setBounds(20, 318, 127, 20);
		add(lblpatoacutelogoDeTurno);
		
		comboPatologo = new JComboBox();
		comboPatologo.setFont(new Font("Tahoma", Font.PLAIN, 13));
		comboPatologo.setBounds(180, 316, 184, 22);
		PatologoDAO.populateJCombo(comboPatologo);
		add(comboPatologo);
		
		JLabel lblIdx = new JLabel("<html><b>IDx:</b></html>");
		lblIdx.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblIdx.setBounds(20, 359, 31, 14);
		add(lblIdx);
		
		textAreaIDx = new JTextArea();
		textAreaIDx.setLineWrap(true);
		textAreaIDx.setBorder(new LineBorder(new Color(0, 0, 0)));
		textAreaIDx.setWrapStyleWord(true);
		textAreaIDx.setBounds(72, 314, 290, 100);
		JScrollPane sp = new JScrollPane(textAreaIDx);
		sp.setBounds(new Rectangle(72, 356, 290, 100));
		add(sp);
		
		JLabel lblDejeEnBlanco = new JLabel("<html><b>* Deje en blanco para <br />asignaci&oacute;n autom&aacute;tica</b></html>");
		lblDejeEnBlanco.setHorizontalAlignment(SwingConstants.CENTER);
		lblDejeEnBlanco.setBounds(364, 11, 136, 28);
		add(lblDejeEnBlanco);
		
		setSize(500, 500);
		setLocation(0, Constants.APP_MENU_HEIGTH);
		
		JButton btnGuardar = new JButton("Guardar");
		btnGuardar.setFont(new Font("Tahoma", Font.PLAIN, 13));
		btnGuardar.setBounds(10, 471, 91, 23);
		btnGuardar.setActionCommand(IngresoPanelOperations.ACTION_COMMAND_BTN_GUARDAR);
		add(btnGuardar);
		
		JButton btnPrintLabels = new JButton("Imprimir Etiquetas");
		btnPrintLabels.setFont(new Font("Tahoma", Font.PLAIN, 13));
		btnPrintLabels.setBounds(111, 471, 145, 23);
		btnPrintLabels.setActionCommand(IngresoPanelOperations.ACTION_COMMAND_BTN_PRINT_LABELS);
		add(btnPrintLabels);
		
		JButton btnSendToMacro = new JButton("Enviar a Macro");
		btnSendToMacro.setFont(new Font("Tahoma", Font.PLAIN, 13));
		btnSendToMacro.setBounds(266, 471, 117, 23);
		btnSendToMacro.setActionCommand(IngresoPanelOperations.ACTION_COMMAND_BTN_SEND_TO_MACRO);
		add(btnSendToMacro);
		
		JButton btnCancelar = new JButton("Cancelar");
		btnCancelar.setFont(new Font("Tahoma", Font.PLAIN, 13));
		btnCancelar.setBounds(393, 471, 91, 23);
		btnCancelar.setActionCommand(IngresoPanelOperations.ACTION_COMMAND_BTN_CANCELAR);
		add(btnCancelar);
		setFocusTraversalPolicy(new FocusTraversalOnArray(new Component[]{textNroBiopsia, comboTipoCedula, textCedula, textNombrePaciente, textApellido, textEdad, textProcedencia, textPiezaRecibida, comboExamen, textReferido, comboPatologo, textAreaIDx, btnGuardar, btnPrintLabels, btnSendToMacro, btnCancelar}));
		
		//asignamos el listener
		IngresoPanelOperations listener = new IngresoPanelOperations(this);
		textCedula.addKeyListener(listener);
		textNroBiopsia.addKeyListener(listener);
		comboExamen.addItemListener(listener);
		comboExamen.addKeyListener(listener);
		btnPrintLabels.addActionListener(listener);
		btnGuardar.addActionListener(listener);
		btnSendToMacro.addActionListener(listener);
		btnCancelar.addActionListener(listener);
		
		setVisible(true);
	}

	public static long getSerialversionuid() {
		return serialVersionUID;
	}

	public JTextField getTextNroBiopsia() {
		return textNroBiopsia;
	}

	public JComboBox getComboTipoCedula() {
		return comboTipoCedula;
	}

	public JTextField getTextCedula() {
		return textCedula;
	}

	public JTextField getTextNombrePaciente() {
		return textNombrePaciente;
	}

	public JTextField getTextApellido() {
		return textApellido;
	}

	public JTextField getTextEdad() {
		return textEdad;
	}

	public JTextField getTextProcedencia() {
		return textProcedencia;
	}

	public JTextField getTextPiezaRecibida() {
		return textPiezaRecibida;
	}

	public JComboBox getComboExamen() {
		return comboExamen;
	}

	public JTextField getTextReferido() {
		return textReferido;
	}

	public JComboBox getComboPatologo() {
		return comboPatologo;
	}

	public JTextArea getTextAreaIDx() {
		return textAreaIDx;
	}

	public JLabel getLblTipoExamen() {
		return lblTipoExamen;
	}
	
	public JLabel getLblNumeroDias() {
		return lblNumeroDias;
	}
}
