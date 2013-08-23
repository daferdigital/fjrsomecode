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

public class RecepcionPanel extends JPanel {

	/**
	 * 
	 */
	private static final long serialVersionUID = 5763855986388595232L;
	private JTextField textNroBiopsia;
	private JTextField textCedula;
	private JTextField textNombrePaciente;
	private JTextField textEdad;
	private JTextField textProcedencia;
	private JTextField textReferido;
	private JComboBox comboExamen;
	private JComboBox comboPatologo;
	private JTextArea textAreaIDX;
	
	/**
	 * Create the panel.
	 */
	public RecepcionPanel() {
		setBackground(new Color(255, 255, 153));
		setLayout(null);
		
		JLabel lblNroBiopsia = new JLabel("<html>N&deg; de Biopsia:</html>");
		lblNroBiopsia.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblNroBiopsia.setBounds(102, 11, 99, 18);
		add(lblNroBiopsia);
		
		textNroBiopsia = new JTextField();
		textNroBiopsia.setFont(new Font("Tahoma", Font.PLAIN, 13));
		textNroBiopsia.setToolTipText("<html>\r\nIndique aqu&iacute; el codigo manual a asignar a esta biopsia\r\n<br />\r\nPor ejemplo 13-0192.\r\n<br />\r\nDejar en blanco si esta creando una biopsia nueva\r\n</html>");
		textNroBiopsia.setBounds(233, 11, 184, 20);
		textNroBiopsia.setColumns(10);
		add(textNroBiopsia);
		
		JLabel lblCedula = new JLabel("<html>C&eacute;dula: </html>");
		lblCedula.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblCedula.setBounds(102, 42, 127, 14);
		add(lblCedula);
		
		textCedula = new JTextField();
		textCedula.setFont(new Font("Tahoma", Font.PLAIN, 13));
		textCedula.setBounds(233, 92, 184, 20);
		textCedula.setColumns(10);
		add(textCedula);
		
		JLabel lblNombrePaciente = new JLabel("Nombre del Paciente:");
		lblNombrePaciente.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblNombrePaciente.setBounds(102, 69, 127, 14);
		add(lblNombrePaciente);
		
		textNombrePaciente = new JTextField();
		textNombrePaciente.setFont(new Font("Tahoma", Font.PLAIN, 13));
		textNombrePaciente.setColumns(10);
		textNombrePaciente.setBounds(233, 67, 184, 20);
		add(textNombrePaciente);
		
		JLabel lblEdad = new JLabel("Edad:");
		lblEdad.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblEdad.setBounds(102, 94, 127, 14);
		add(lblEdad);
		
		textEdad = new JTextField();
		textEdad.setFont(new Font("Tahoma", Font.PLAIN, 13));
		textEdad.setColumns(10);
		textEdad.setBounds(233, 40, 184, 20);
		add(textEdad);
		
		JLabel lblProcedencia = new JLabel("Procedencia :");
		lblProcedencia.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblProcedencia.setBounds(102, 119, 127, 14);
		add(lblProcedencia);
		
		textProcedencia = new JTextField();
		textProcedencia.setFont(new Font("Tahoma", Font.PLAIN, 13));
		textProcedencia.setColumns(10);
		textProcedencia.setBounds(233, 119, 184, 20);
		add(textProcedencia);
		
		JLabel lblreferidoMeacutedico = new JLabel("<html>Referido / M&eacute;dico:</html>");
		lblreferidoMeacutedico.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblreferidoMeacutedico.setBounds(102, 146, 127, 14);
		add(lblreferidoMeacutedico);
		
		textReferido = new JTextField();
		textReferido.setFont(new Font("Tahoma", Font.PLAIN, 13));
		textReferido.setColumns(10);
		textReferido.setBounds(233, 144, 184, 20);
		add(textReferido);
		
		JLabel lblExamenARealizar = new JLabel("Examen a Realizar: ");
		lblExamenARealizar.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblExamenARealizar.setBounds(102, 173, 127, 14);
		add(lblExamenARealizar);
		
		comboExamen= new JComboBox();
		comboExamen.setFont(new Font("Tahoma", Font.PLAIN, 13));
		comboExamen.setEditable(true);
		comboExamen.setBounds(233, 170, 184, 22);
		add(comboExamen);
		
		JLabel lblpatoacutelogoDeTurno = new JLabel("<html>Pat&oacute;logo de turno: </html>");
		lblpatoacutelogoDeTurno.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblpatoacutelogoDeTurno.setBounds(102, 198, 127, 20);
		add(lblpatoacutelogoDeTurno);
		
		comboPatologo = new JComboBox();
		comboPatologo.setFont(new Font("Tahoma", Font.PLAIN, 13));
		comboPatologo.setBounds(233, 198, 184, 22);
		add(comboPatologo);
		
		JLabel lblIdx = new JLabel("IDX:");
		lblIdx.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblIdx.setBounds(102, 238, 39, 14);
		add(lblIdx);
		
		textAreaIDX = new JTextArea();
		textAreaIDX.setWrapStyleWord(true);
		textAreaIDX.setLineWrap(true);
		textAreaIDX.setBounds(133, 234, 289, 97);
		add(textAreaIDX);
		
		JButton btnNewButton = new JButton("Guardar");
		btnNewButton.setBounds(18, 355, 91, 23);
		add(btnNewButton);
		
		JButton btnNewButton_1 = new JButton("Enviar a Macro");
		btnNewButton_1.setBounds(133, 355, 110, 23);
		add(btnNewButton_1);
		
		JButton btnNewButton_2 = new JButton("Imprimir Etiquetas");
		btnNewButton_2.setBounds(265, 355, 121, 23);
		add(btnNewButton_2);
		
		JButton btnCancelar = new JButton("Cancelar");
		btnCancelar.setBounds(399, 355, 91, 23);
		add(btnCancelar);
		
		setSize(500, 396);
		setLocation(0, Constants.APP_MENU_HEIGTH);
		setFocusTraversalPolicy(new FocusTraversalOnArray(new Component[]{lblNroBiopsia, textNroBiopsia, lblCedula, textCedula, lblNombrePaciente, textNombrePaciente, lblEdad, textEdad, lblProcedencia, textProcedencia, lblreferidoMeacutedico, textReferido, lblExamenARealizar, comboExamen, lblpatoacutelogoDeTurno, comboPatologo, lblIdx, textAreaIDX, btnNewButton, btnNewButton_1, btnNewButton_2, btnCancelar}));
		
		setVisible(true);
	}
}
