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
import javax.swing.SwingConstants;

public class RecepcionPanel extends JPanel {

	/**
	 * 
	 */
	private static final long serialVersionUID = 5763855986388595232L;
	private JTextField textField;
	private JTextField textField_1;
	private JTextField textField_2;
	private JTextField textField_3;
	private JTextField textField_4;
	private JTextField textField_5;

	/**
	 * Create the panel.
	 */
	public RecepcionPanel() {
		setBackground(new Color(255, 255, 153));
		setLayout(null);
		
		JLabel lblNewLabel = new JLabel("<html>C&eacute;dula: </html>");
		lblNewLabel.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblNewLabel.setBounds(102, 42, 127, 14);
		add(lblNewLabel);
		
		textField = new JTextField();
		textField.setFont(new Font("Tahoma", Font.PLAIN, 13));
		textField.setBounds(233, 92, 184, 20);
		add(textField);
		textField.setColumns(10);
		
		JLabel lblNewLabel_1 = new JLabel("<html>N&deg; de Biopsia:</html>");
		lblNewLabel_1.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblNewLabel_1.setBounds(102, 11, 99, 18);
		add(lblNewLabel_1);
		
		textField_1 = new JTextField();
		textField_1.setFont(new Font("Tahoma", Font.PLAIN, 13));
		textField_1.setToolTipText("<html>\r\nIndique aqu&iacute; el codigo manual a asignar a esta biopsia\r\n<br />\r\nPor ejemplo 13-0192.\r\n<br />\r\nDejar en blanco si esta creando una biopsia nueva\r\n</html>");
		textField_1.setBounds(233, 11, 184, 20);
		add(textField_1);
		textField_1.setColumns(10);
		
		JLabel lblEdad = new JLabel("Edad:");
		lblEdad.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblEdad.setBounds(102, 94, 127, 14);
		add(lblEdad);
		
		textField_2 = new JTextField();
		textField_2.setFont(new Font("Tahoma", Font.PLAIN, 13));
		textField_2.setColumns(10);
		textField_2.setBounds(233, 40, 184, 20);
		add(textField_2);
		
		JLabel lblProcedencia = new JLabel("Procedencia :");
		lblProcedencia.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblProcedencia.setBounds(102, 119, 127, 14);
		add(lblProcedencia);
		
		textField_3 = new JTextField();
		textField_3.setFont(new Font("Tahoma", Font.PLAIN, 13));
		textField_3.setColumns(10);
		textField_3.setBounds(233, 119, 184, 20);
		add(textField_3);
		
		JLabel lblreferidoMeacutedico = new JLabel("<html>Referido / M&eacute;dico:</html>");
		lblreferidoMeacutedico.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblreferidoMeacutedico.setBounds(102, 146, 127, 14);
		add(lblreferidoMeacutedico);
		
		textField_4 = new JTextField();
		textField_4.setFont(new Font("Tahoma", Font.PLAIN, 13));
		textField_4.setColumns(10);
		textField_4.setBounds(233, 144, 184, 20);
		add(textField_4);
		
		JLabel lblExamenARealizar = new JLabel("Examen a Realizar: ");
		lblExamenARealizar.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblExamenARealizar.setBounds(102, 173, 127, 14);
		add(lblExamenARealizar);
		
		JComboBox comboBox = new JComboBox();
		comboBox.setFont(new Font("Tahoma", Font.PLAIN, 13));
		comboBox.setEditable(true);
		comboBox.setBounds(233, 170, 184, 22);
		add(comboBox);
		
		JLabel lblpatoacutelogoDeTurno = new JLabel("<html>Pat&oacute;logo de turno: </html>");
		lblpatoacutelogoDeTurno.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblpatoacutelogoDeTurno.setBounds(102, 198, 127, 20);
		add(lblpatoacutelogoDeTurno);
		
		JComboBox comboBox_1 = new JComboBox();
		comboBox_1.setFont(new Font("Tahoma", Font.PLAIN, 13));
		comboBox_1.setBounds(233, 198, 184, 22);
		add(comboBox_1);
		
		textField_5 = new JTextField();
		textField_5.setFont(new Font("Tahoma", Font.PLAIN, 13));
		textField_5.setColumns(10);
		textField_5.setBounds(233, 67, 184, 20);
		add(textField_5);
		
		JLabel lblceacutedula = new JLabel("Nombre del Paciente:");
		lblceacutedula.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblceacutedula.setBounds(102, 69, 127, 14);
		add(lblceacutedula);
		
		JButton btnNewButton = new JButton("Guardar");
		btnNewButton.setBounds(18, 355, 91, 23);
		add(btnNewButton);
		
		JButton btnNewButton_1 = new JButton("Enviar a Macro");
		btnNewButton_1.setBounds(133, 355, 110, 23);
		add(btnNewButton_1);
		
		JButton btnNewButton_2 = new JButton("Imprimir Etiquetas");
		btnNewButton_2.setBounds(265, 355, 121, 23);
		add(btnNewButton_2);
		
		setSize(500, 396);
		setLocation(0, Constants.APP_MENU_HEIGTH);
		
		JButton btnCancelar = new JButton("Cancelar");
		btnCancelar.setBounds(399, 355, 91, 23);
		add(btnCancelar);
		
		JLabel lblIdx = new JLabel("IDX:");
		lblIdx.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblIdx.setBounds(102, 238, 39, 14);
		add(lblIdx);
		
		JTextArea textArea = new JTextArea();
		textArea.setWrapStyleWord(true);
		textArea.setLineWrap(true);
		textArea.setBounds(133, 234, 289, 97);
		add(textArea);
		setFocusTraversalPolicy(new FocusTraversalOnArray(new Component[]{lblNewLabel_1, textField_1, lblNewLabel, textField_2, lblceacutedula, textField_5, lblEdad, textField, lblProcedencia, textField_3, lblreferidoMeacutedico, textField_4, lblExamenARealizar, comboBox, lblpatoacutelogoDeTurno, comboBox_1, lblIdx, textArea, btnNewButton, btnNewButton_1, btnNewButton_2, btnCancelar}));
		setVisible(true);
	}
}
