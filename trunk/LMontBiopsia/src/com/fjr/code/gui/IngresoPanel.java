package com.fjr.code.gui;

import javax.swing.JPanel;
import java.awt.Color;
import javax.swing.JLabel;
import java.awt.Font;
import javax.swing.JTextField;
import javax.swing.JComboBox;
import javax.swing.JButton;
import org.eclipse.wb.swing.FocusTraversalOnArray;

import com.fjr.code.util.Constants;

import java.awt.Component;
import javax.swing.JTextArea;
import javax.swing.border.LineBorder;
import javax.swing.SwingConstants;

public class IngresoPanel extends JPanel {

	/**
	 * 
	 */
	private static final long serialVersionUID = 5763855986388595232L;
	private JTextField textNroBiopsia;
	private JTextField textEdad;
	private JTextField textNombrePaciente;
	private JTextField textCedula;
	private JTextField textProcedencia;
	private JTextField textPiezaRecibida;
	private JComboBox comboExamen;
	private JComboBox comboPatologo;
	private JTextArea textAreaIDx;
	private JTextField textReferido;
	
	/**
	 * Create the panel.
	 */
	public IngresoPanel() {
		//amarillo pastel
		//setBackground(new Color(255, 255, 153));
		setBackground(new Color(255, 255, 255));
		setLayout(null);
		
		JLabel lblNroBiopsia = new JLabel("<html><b>N&deg; de Biopsia *:</b></html>");
		lblNroBiopsia.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblNroBiopsia.setBounds(20, 11, 117, 18);
		add(lblNroBiopsia);
		
		textNroBiopsia = new JTextField();
		textNroBiopsia.setFont(new Font("Tahoma", Font.PLAIN, 13));
		textNroBiopsia.setToolTipText("<html>\r\nIndique aqu&iacute; el codigo manual a asignar a esta biopsia\r\n<br />\r\nPor ejemplo 13-0192.\r\n<br />\r\nDejar en blanco si esta creando una biopsia nueva\r\n</html>");
		textNroBiopsia.setBounds(180, 11, 184, 20);
		textNroBiopsia.setColumns(10);
		add(textNroBiopsia);
		
		JLabel lblCedula = new JLabel("<html><b>C&eacute;dula: </b></html>");
		lblCedula.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblCedula.setBounds(20, 42, 127, 14);
		add(lblCedula);
		
		textCedula = new JTextField();
		textCedula.setFont(new Font("Tahoma", Font.PLAIN, 13));
		textCedula.setColumns(10);
		textCedula.setBounds(180, 40, 184, 20);
		add(textCedula);
		
		JLabel lblNombrePaciente = new JLabel("<html><b>Nombre del Paciente:</b><html>");
		lblNombrePaciente.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblNombrePaciente.setBounds(20, 69, 145, 14);
		add(lblNombrePaciente);
		
		textNombrePaciente = new JTextField();
		textNombrePaciente.setFont(new Font("Tahoma", Font.PLAIN, 13));
		textNombrePaciente.setColumns(10);
		textNombrePaciente.setBounds(180, 65, 184, 20);
		add(textNombrePaciente);
		
		JLabel lblEdad = new JLabel("<html><b>Edad:</b></html>");
		lblEdad.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblEdad.setBounds(20, 94, 127, 14);
		add(lblEdad);
		
		textEdad = new JTextField();
		textEdad.setFont(new Font("Tahoma", Font.PLAIN, 13));
		textEdad.setBounds(180, 90, 184, 20);
		textEdad.setColumns(10);
		add(textEdad);
		
		JLabel lblProcedencia = new JLabel("<html><b>Procedencia :</b></html>");
		lblProcedencia.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblProcedencia.setBounds(20, 119, 127, 14);
		add(lblProcedencia);
		
		textProcedencia = new JTextField();
		textProcedencia.setFont(new Font("Tahoma", Font.PLAIN, 13));
		textProcedencia.setColumns(10);
		textProcedencia.setBounds(180, 117, 184, 20);
		add(textProcedencia);
		
		JLabel lblPiezaRecibida = new JLabel("<html><b>Pieza Recibida:</b></html>");
		lblPiezaRecibida.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblPiezaRecibida.setBounds(20, 146, 127, 14);
		add(lblPiezaRecibida);
		
		textPiezaRecibida = new JTextField();
		textPiezaRecibida.setFont(new Font("Tahoma", Font.PLAIN, 13));
		textPiezaRecibida.setColumns(10);
		textPiezaRecibida.setBounds(180, 142, 184, 20);
		add(textPiezaRecibida);
		
		JLabel lblExamenARealizar = new JLabel("<html><b>Examen a Realizar: </b></html>");
		lblExamenARealizar.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblExamenARealizar.setBounds(20, 173, 127, 14);
		add(lblExamenARealizar);
		
		comboExamen= new JComboBox();
		comboExamen.setFont(new Font("Tahoma", Font.PLAIN, 13));
		comboExamen.setEditable(true);
		comboExamen.setBounds(180, 168, 184, 22);
		add(comboExamen);
		
		JLabel lblReferidoMedico = new JLabel("<html><b>Referido / M&eacute;dico:</b></html>");
		lblReferidoMedico.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblReferidoMedico.setBounds(20, 209, 127, 14);
		add(lblReferidoMedico);
		
		textReferido = new JTextField();
		textReferido.setFont(new Font("Tahoma", Font.PLAIN, 13));
		textReferido.setColumns(10);
		textReferido.setBounds(180, 204, 184, 20);
		add(textReferido);
		
		JLabel lblpatoacutelogoDeTurno = new JLabel("<html><b>Pat&oacute;logo de turno: </b></html>");
		lblpatoacutelogoDeTurno.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblpatoacutelogoDeTurno.setBounds(20, 241, 127, 20);
		add(lblpatoacutelogoDeTurno);
		
		comboPatologo = new JComboBox();
		comboPatologo.setFont(new Font("Tahoma", Font.PLAIN, 13));
		comboPatologo.setBounds(180, 239, 184, 22);
		add(comboPatologo);
		
		JLabel lblIdx = new JLabel("<html><b>IDx:</b></html>");
		lblIdx.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblIdx.setBounds(20, 294, 31, 14);
		add(lblIdx);
		
		textAreaIDx = new JTextArea();
		textAreaIDx.setBorder(new LineBorder(new Color(0, 0, 0)));
		textAreaIDx.setWrapStyleWord(true);
		textAreaIDx.setLineWrap(true);
		textAreaIDx.setBounds(75, 291, 289, 97);
		add(textAreaIDx);
		
		JLabel lblDejeEnBlanco = new JLabel("<html><b>* Deje en blanco para <br />asignaci&oacute;n autom&aacute;tica</b></html>");
		lblDejeEnBlanco.setHorizontalAlignment(SwingConstants.CENTER);
		lblDejeEnBlanco.setBounds(364, 11, 136, 28);
		add(lblDejeEnBlanco);
		
		setSize(500, 452);
		setLocation(0, Constants.APP_MENU_HEIGTH);
		
		JButton btnGuardar = new JButton("Guardar");
		btnGuardar.setFont(new Font("Tahoma", Font.PLAIN, 13));
		btnGuardar.setBounds(10, 418, 91, 23);
		add(btnGuardar);
		
		JButton btnPrintLabels = new JButton("Imprimir Etiquetas");
		btnPrintLabels.setFont(new Font("Tahoma", Font.PLAIN, 13));
		btnPrintLabels.setBounds(111, 418, 145, 23);
		add(btnPrintLabels);
		
		JButton btnSendToMacro = new JButton("Enviar a Macro");
		btnSendToMacro.setFont(new Font("Tahoma", Font.PLAIN, 13));
		btnSendToMacro.setBounds(266, 418, 117, 23);
		add(btnSendToMacro);
		
		JButton btnCancelar = new JButton("Cancelar");
		btnCancelar.setFont(new Font("Tahoma", Font.PLAIN, 13));
		btnCancelar.setBounds(393, 418, 91, 23);
		add(btnCancelar);
		setFocusTraversalPolicy(new FocusTraversalOnArray(new Component[]{textNroBiopsia, textCedula, textNombrePaciente, textEdad, textProcedencia, textPiezaRecibida, comboExamen, textReferido, comboPatologo, textAreaIDx, btnGuardar, btnPrintLabels, btnSendToMacro, btnCancelar}));
		setVisible(true);
	}
}
