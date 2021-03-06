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

import com.fjr.code.dao.PatologoDAO;
import com.fjr.code.dao.TipoCedulaDAO;
import com.fjr.code.dao.EspecialidadDAO;
import com.fjr.code.dao.TipoEstudioDAO;
import com.fjr.code.gui.operations.IngresoPanelOperations;
import com.fjr.code.gui.operations.ListenerDobleClickTextArea;
import com.fjr.code.gui.tables.JTableDiagnosticos;
import com.fjr.code.gui.tables.JTableIHQSolicitadas;
import com.fjr.code.util.Constants;

import java.awt.Component;
import javax.swing.JTextArea;
import javax.swing.border.LineBorder;
import javax.swing.SwingConstants;
import java.awt.Rectangle;
import javax.swing.JSeparator;
import javax.swing.JTable;

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
	
	private boolean isNewBiopsia = true;
	private JTextField textNroBiopsia;
	private JComboBox comboTipoCedula;
	private JTextField textCedula;
	private JTextField textNombrePaciente;
	private JTextField textApellido;
	private JTextField textEdad;
	private JTextField textProcedencia;
	private JTextField textPiezaRecibida;
	private JComboBox comboEspecialidad;
	private JComboBox comboExamen;
	private JTextField textReferido;
	private JComboBox comboPatologo;
	private JTextArea textAreaIDx;
	private JLabel lblNumeroDias;
	private JScrollPane scrollPaneDiagnosticos;
	private JTable tableDiagnosticos;
	private JScrollPane scrollPaneIHQs;
	private JTable tableConfirmarIHQ;
	private JComboBox comboTipoEstudio;
	
	private int idCliente = Constants.ID_DEFAULT_CLIENTE;
	
	/**
	 * 
	 * @param numeroBiopsia
	 */
	public IngresoPanel(boolean isNewBiopsia) {
		setToolTipText("Agregar Especialidad");
		//amarillo pastel
		//setBackground(new Color(255, 255, 153));
		setBackground(new Color(255, 255, 255));
		setLayout(null);

		this.isNewBiopsia = isNewBiopsia;
		
		JLabel lblNroBiopsia = new JLabel("<html><b>N&deg; de Biopsia *:</b></html>");
		lblNroBiopsia.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblNroBiopsia.setBounds(20, 11, 117, 18);
		add(lblNroBiopsia);
		
		textNroBiopsia = new JTextField();
		textNroBiopsia.setName(IngresoPanelOperations.ACTION_COMMAND_NRO_BIOPSIA);
		textNroBiopsia.setFont(new Font("Tahoma", Font.PLAIN, 13));
		textNroBiopsia.setToolTipText("<html>\r\nIndique aqu&iacute; el codigo manual a asignar a esta biopsia\r\n<br />\r\nPor ejemplo 13-0192.\r\n<br />\r\nDejar en blanco si esta creando una biopsia nueva\r\n</html>");
		textNroBiopsia.setBounds(180, 11, 175, 20);
		textNroBiopsia.setColumns(10);
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
		textCedula.setBounds(237, 40, 118, 20);
		add(textCedula);
		
		JButton btnUpdateClient = new JButton("...");
		btnUpdateClient.setToolTipText("Click para actualizar el cliente de este estudio");
		btnUpdateClient.setFont(new Font("Tahoma", Font.BOLD, 13));
		btnUpdateClient.setBounds(365, 38, 23, 23);
		btnUpdateClient.setActionCommand(IngresoPanelOperations.ACTION_COMMAND_UPDATE_CLIENT);
		add(btnUpdateClient);
		
		JLabel lblNombrePaciente = new JLabel("<html><b>Nombre del Paciente:</b><html>");
		lblNombrePaciente.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblNombrePaciente.setBounds(20, 69, 145, 14);
		add(lblNombrePaciente);
		
		textNombrePaciente = new JTextField();
		textNombrePaciente.setEnabled(false);
		textNombrePaciente.setFont(new Font("Tahoma", Font.PLAIN, 13));
		textNombrePaciente.setColumns(10);
		textNombrePaciente.setBounds(180, 65, 301, 20);
		add(textNombrePaciente);
		
		JLabel lblapellidoDelPaciente = new JLabel("<html><b>Apellido del Paciente:</b><html>");
		lblapellidoDelPaciente.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblapellidoDelPaciente.setBounds(20, 98, 145, 14);
		add(lblapellidoDelPaciente);
		
		textApellido = new JTextField();
		textApellido.setEnabled(false);
		textApellido.setFont(new Font("Tahoma", Font.PLAIN, 13));
		textApellido.setColumns(10);
		textApellido.setBounds(180, 94, 301, 20);
		add(textApellido);
		
		JLabel lblEdad = new JLabel("<html><b>Edad:</b></html>");
		lblEdad.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblEdad.setBounds(20, 127, 127, 14);
		add(lblEdad);
		
		textEdad = new JTextField();
		textEdad.setEnabled(false);
		textEdad.setFont(new Font("Tahoma", Font.PLAIN, 13));
		textEdad.setBounds(180, 123, 301, 20);
		textEdad.setColumns(10);
		add(textEdad);
		
		JLabel lblProcedencia = new JLabel("<html><b>Procedencia :</b></html>");
		lblProcedencia.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblProcedencia.setBounds(20, 154, 127, 14);
		add(lblProcedencia);
		
		textProcedencia = new JTextField();
		textProcedencia.setFont(new Font("Tahoma", Font.PLAIN, 13));
		textProcedencia.setColumns(10);
		textProcedencia.setBounds(180, 152, 301, 20);
		add(textProcedencia);
		
		JLabel lblPiezaRecibida = new JLabel("<html><b>Procedencia del material:</b></html>");
		lblPiezaRecibida.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblPiezaRecibida.setBounds(10, 178, 164, 18);
		add(lblPiezaRecibida);
		
		textPiezaRecibida = new JTextField();
		textPiezaRecibida.setFont(new Font("Tahoma", Font.PLAIN, 13));
		textPiezaRecibida.setColumns(10);
		textPiezaRecibida.setBounds(180, 177, 301, 20);
		add(textPiezaRecibida);
		
		JLabel label = new JLabel("<html><b>Tipo de Estudio: </b></html>");
		label.setFont(new Font("Tahoma", Font.PLAIN, 13));
		label.setBounds(20, 207, 127, 14);
		add(label);
		
		comboTipoEstudio = new JComboBox();
		comboTipoEstudio.setFont(new Font("Tahoma", Font.PLAIN, 13));
		comboTipoEstudio.setBounds(180, 207, 301, 22);
		TipoEstudioDAO.populateJCombo(comboTipoEstudio);
		add(comboTipoEstudio);
		
		JButton btnAddTipoEstudio = new JButton("+");
		btnAddTipoEstudio.setToolTipText("Agregar Tipo de Estudio");
		btnAddTipoEstudio.setFont(new Font("Tahoma", Font.BOLD, 13));
		btnAddTipoEstudio.setBounds(485, 208, 23, 23);
		btnAddTipoEstudio.setActionCommand(IngresoPanelOperations.ACTION_COMMAND_BTN_ADD_TIPO_ESTUDIO);
		add(btnAddTipoEstudio);
		
		JLabel lblEspecialidad = new JLabel("<html><b>Especialidad: </b></html>");
		lblEspecialidad.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblEspecialidad.setBounds(20, 242, 127, 14);
		add(lblEspecialidad);
		
		comboEspecialidad = new JComboBox();
		comboEspecialidad.setFont(new Font("Tahoma", Font.PLAIN, 13));
		comboEspecialidad.setActionCommand(IngresoPanelOperations.ACTION_COMMAND_COMBO_TIPO_EXAMEN);
		comboEspecialidad.setBounds(180, 238, 301, 22);
		EspecialidadDAO.populateJCombo(comboEspecialidad, true);
		add(comboEspecialidad);
		
		JButton btnEspecialidad = new JButton("+");
		btnEspecialidad.setFont(new Font("Tahoma", Font.BOLD, 13));
		btnEspecialidad.setBounds(485, 238, 23, 23);
		btnEspecialidad.setActionCommand(IngresoPanelOperations.ACTION_COMMAND_BTN_ADD_ESPECIALIDAD);
		add(btnEspecialidad);
		
		JLabel lblExamenARealizar = new JLabel("<html><b>Examen a Realizar: </b></html>");
		lblExamenARealizar.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblExamenARealizar.setBounds(20, 275, 127, 14);
		add(lblExamenARealizar);
		
		comboExamen = new JComboBox();
		comboExamen.setActionCommand(IngresoPanelOperations.ACTION_COMMAND_COMBO_EXAMEN);
		comboExamen.setFont(new Font("Tahoma", Font.PLAIN, 13));
		comboExamen.setBounds(180, 271, 301, 22);
		add(comboExamen);
		
		JButton btnExamen = new JButton("+");
		btnExamen.setToolTipText("Agregar Examen");
		btnExamen.setFont(new Font("Tahoma", Font.BOLD, 13));
		btnExamen.setBounds(485, 271, 23, 23);
		btnExamen.setActionCommand(IngresoPanelOperations.ACTION_COMMAND_BTN_ADD_EXAMEN);
		add(btnExamen);
		
		JLabel lbldiasResultados = new JLabel("<html><b>D&iacute;as para resultados: </b></html>");
		lbldiasResultados.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lbldiasResultados.setBounds(20, 304, 145, 14);
		add(lbldiasResultados);
		
		lblNumeroDias = new JLabel("");
		lblNumeroDias.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblNumeroDias.setBounds(180, 304, 184, 14);
		add(lblNumeroDias);
		
		JLabel lblReferidoMedico = new JLabel("<html><b>Referido / M&eacute;dico:</b></html>");
		lblReferidoMedico.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblReferidoMedico.setBounds(20, 329, 127, 14);
		add(lblReferidoMedico);
		
		textReferido = new JTextField();
		textReferido.setFont(new Font("Tahoma", Font.PLAIN, 13));
		textReferido.setColumns(10);
		textReferido.setBounds(180, 329, 301, 20);
		add(textReferido);
		
		JLabel lblpatoacutelogoDeTurno = new JLabel("<html><b>Pat&oacute;logo de turno: </b></html>");
		lblpatoacutelogoDeTurno.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblpatoacutelogoDeTurno.setBounds(20, 361, 127, 20);
		add(lblpatoacutelogoDeTurno);
		
		comboPatologo = new JComboBox();
		comboPatologo.setFont(new Font("Tahoma", Font.PLAIN, 13));
		comboPatologo.setBounds(180, 360, 301, 22);
		PatologoDAO.populateJCombo(comboPatologo);
		add(comboPatologo);
		
		JLabel lblIdx = new JLabel("<html><b>IDx:</b></html>");
		lblIdx.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblIdx.setBounds(20, 392, 31, 14);
		add(lblIdx);
		
		textAreaIDx = new JTextArea();
		textAreaIDx.setLineWrap(true);
		textAreaIDx.setBorder(new LineBorder(new Color(0, 0, 0)));
		textAreaIDx.setWrapStyleWord(true);
		textAreaIDx.setBounds(72, 314, 290, 100);
		textAreaIDx.addMouseListener(new ListenerDobleClickTextArea(textAreaIDx));
		
		JScrollPane sp = new JScrollPane(textAreaIDx);
		sp.setBounds(new Rectangle(73, 392, 408, 108));
		add(sp);
		
		if(isNewBiopsia){
			JLabel lblDejeEnBlanco = new JLabel("<html><b>* Deje en blanco para <br />asignaci&oacute;n autom&aacute;tica</b></html>");
			lblDejeEnBlanco.setHorizontalAlignment(SwingConstants.CENTER);
			lblDejeEnBlanco.setBounds(364, 11, 136, 28);
			add(lblDejeEnBlanco);
		}
		
		setSize(1000, 550);
		setLocation(0, Constants.APP_MENU_HEIGTH);
		
		JButton btnGuardar = new JButton("Guardar");
		btnGuardar.setFont(new Font("Tahoma", Font.PLAIN, 13));
		btnGuardar.setBounds(10, 516, 91, 23);
		btnGuardar.setActionCommand(IngresoPanelOperations.ACTION_COMMAND_BTN_GUARDAR);
		add(btnGuardar);
		
		JButton btnPrintLabels = new JButton("Imprimir Etiquetas");
		btnPrintLabels.setFont(new Font("Tahoma", Font.PLAIN, 13));
		btnPrintLabels.setBounds(111, 516, 145, 23);
		btnPrintLabels.setActionCommand(IngresoPanelOperations.ACTION_COMMAND_BTN_PRINT_LABELS);
		add(btnPrintLabels);
		
		JButton btnSendToMacro = new JButton("Enviar a Macro");
		btnSendToMacro.setFont(new Font("Tahoma", Font.PLAIN, 13));
		btnSendToMacro.setBounds(266, 516, 127, 23);
		btnSendToMacro.setActionCommand(IngresoPanelOperations.ACTION_COMMAND_BTN_SEND_TO_MACRO);
		add(btnSendToMacro);
		
		JButton btnCancelar = new JButton("Cancelar");
		btnCancelar.setFont(new Font("Tahoma", Font.PLAIN, 13));
		btnCancelar.setBounds(403, 516, 91, 23);
		btnCancelar.setActionCommand(IngresoPanelOperations.ACTION_COMMAND_BTN_CANCELAR);
		add(btnCancelar);
		setFocusTraversalPolicy(new FocusTraversalOnArray(new Component[]{textNroBiopsia, comboTipoCedula, textCedula, textNombrePaciente, textApellido, textEdad, textProcedencia, textPiezaRecibida, comboExamen, textReferido, comboPatologo, textAreaIDx, btnGuardar, btnPrintLabels, btnSendToMacro, btnCancelar}));
		
		//asignamos el listener
		IngresoPanelOperations listener = new IngresoPanelOperations(this);
		
		JSeparator separator = new JSeparator();
		separator.setBorder(new LineBorder(new Color(0, 0, 0)));
		separator.setBackground(Color.BLACK);
		separator.setBounds(510, 0, 2, 500);
		add(separator);
		
		JLabel lblBiopsiasEntregadasA = new JLabel("<html>Informes listos para Impresi&oacute;n</html>");
		lblBiopsiasEntregadasA.setFont(new Font("Tahoma", Font.BOLD, 13));
		lblBiopsiasEntregadasA.setBounds(522, 11, 230, 17);
		add(lblBiopsiasEntregadasA);
		
		scrollPaneDiagnosticos = new JScrollPane();
		scrollPaneDiagnosticos.setBorder(new LineBorder(new Color(130, 135, 144)));
		scrollPaneDiagnosticos.setBounds(546, 40, 425, 180);
		add(scrollPaneDiagnosticos);
		
		tableDiagnosticos = new JTableDiagnosticos().getTable();
		scrollPaneDiagnosticos.setViewportView(tableDiagnosticos);
		
		JLabel lblBiopsiasEnEspera = new JLabel("Biopsias En Espera de Confirmar IHQ");
		lblBiopsiasEnEspera.setFont(new Font("Tahoma", Font.BOLD, 13));
		lblBiopsiasEnEspera.setBounds(522, 256, 281, 17);
		add(lblBiopsiasEnEspera);
		
		scrollPaneIHQs = new JScrollPane();
		scrollPaneIHQs.setBorder(new LineBorder(new Color(130, 135, 144)));
		scrollPaneIHQs.setBounds(546, 285, 425, 180);
		
		tableConfirmarIHQ = new JTableIHQSolicitadas().getTable();
		scrollPaneIHQs.setViewportView(tableConfirmarIHQ);
		
		add(scrollPaneIHQs);
		
		JButton btnSearchByName = new JButton("...");
		btnSearchByName.setToolTipText("Click para buscar pacientes por nombre");
		btnSearchByName.setFont(new Font("Tahoma", Font.BOLD, 13));
		btnSearchByName.setActionCommand(IngresoPanelOperations.ACTION_COMMAND_SEARCH_BY_NAME);
		btnSearchByName.addActionListener(listener);
		btnSearchByName.setBounds(485, 63, 23, 23);
		add(btnSearchByName);
		
		textCedula.addKeyListener(listener);
		if(! isNewBiopsia){
			textNroBiopsia.addInputMethodListener(listener);
			textNroBiopsia.addKeyListener(listener);
		}
		
		comboEspecialidad.addItemListener(listener);
		comboExamen.addItemListener(listener);
		comboExamen.addKeyListener(listener);
		btnPrintLabels.addActionListener(listener);
		btnGuardar.addActionListener(listener);
		btnSendToMacro.addActionListener(listener);
		btnCancelar.addActionListener(listener);
		btnAddTipoEstudio.addActionListener(listener);
		btnEspecialidad.addActionListener(listener);
		btnExamen.addActionListener(listener);
		btnUpdateClient.addActionListener(listener);
		setVisible(true);
	}

	/**
	 * Metodo para fijar el foco en el elemento por defecto de la ventana
	 * 
	 */
	public void setFocusAtDefaultElement(){
		this.textCedula.requestFocusInWindow();
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

	public JComboBox getComboEspecialidad() {
		return comboEspecialidad;
	}
	
	public JLabel getLblNumeroDias() {
		return lblNumeroDias;
	}
	
	public void setNewBiopsia(boolean isNewBiopsia) {
		this.isNewBiopsia = isNewBiopsia;
	}
	
	public boolean isNewBiopsia() {
		return isNewBiopsia;
	}
	
	public JComboBox getComboTipoEstudio() {
		return comboTipoEstudio;
	}
	
	public void setIdCliente(int idCliente) {
		this.idCliente = idCliente;
	}
	
	public int getIdCliente() {
		return idCliente;
	}
	
	public void reloadTables(){
		tableDiagnosticos = new JTableDiagnosticos().getTable();
		tableConfirmarIHQ = new JTableIHQSolicitadas().getTable();
		
		scrollPaneDiagnosticos.setViewportView(null);
		scrollPaneDiagnosticos.setVisible(false);
		scrollPaneDiagnosticos.setViewportView(tableDiagnosticos);
		scrollPaneDiagnosticos.setVisible(true);
		
		scrollPaneIHQs.setViewportView(null);
		scrollPaneIHQs.setVisible(false);
		scrollPaneIHQs.setViewportView(tableConfirmarIHQ);
		scrollPaneIHQs.setVisible(true);
	}
}
