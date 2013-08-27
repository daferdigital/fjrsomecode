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

import com.fjr.code.util.Constants;
import javax.swing.JTable;
import javax.swing.JSeparator;
import java.awt.event.ActionListener;
import java.awt.event.ActionEvent;

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
	private JTextField txtNroBiopsia;
	private JTextField textField;
	private JTextField textField_1;
	private JTextField textField_2;
	private JTable tblFotos;
	private JTable table;

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
		
		txtNroBiopsia = new JTextField();
		txtNroBiopsia.setBounds(157, 11, 184, 20);
		add(txtNroBiopsia);
		txtNroBiopsia.setColumns(10);
		
		JLabel labelIDx = new JLabel("<html><b>Descripci&oacute;n Macrosc&oacute;pica:</b></html>");
		labelIDx.setHorizontalAlignment(SwingConstants.CENTER);
		labelIDx.setFont(new Font("Tahoma", Font.PLAIN, 13));
		labelIDx.setBounds(10, 148, 117, 37);
		add(labelIDx);
		
		JTextArea textAreaIDx = new JTextArea();
		textAreaIDx.setWrapStyleWord(true);
		textAreaIDx.setLineWrap(true);
		textAreaIDx.setBorder(new LineBorder(new Color(0, 0, 0)));
		textAreaIDx.setBounds(157, 145, 289, 97);
		add(textAreaIDx);
		
		JButton button = new JButton("Guardar");
		button.setFont(new Font("Tahoma", Font.PLAIN, 12));
		button.setBounds(10, 359, 91, 37);
		add(button);
		
		JButton btnenviarAhistologiacutea = new JButton("<html>Enviar a <br />Histolog&iacute;a</html>");
		btnenviarAhistologiacutea.setFont(new Font("Tahoma", Font.PLAIN, 12));
		btnenviarAhistologiacutea.setBounds(263, 359, 110, 37);
		add(btnenviarAhistologiacutea);
		
		JButton button_2 = new JButton("Imprimir Etiquetas");
		button_2.setFont(new Font("Tahoma", Font.PLAIN, 12));
		button_2.setBounds(111, 359, 134, 37);
		add(button_2);
		
		JButton button_3 = new JButton("Cancelar");
		button_3.setFont(new Font("Tahoma", Font.PLAIN, 12));
		button_3.setBounds(383, 359, 91, 37);
		add(button_3);
		
		JLabel lblnombreDelPaciente = new JLabel("<html><b>Nombre del Paciente:</b></html>");
		lblnombreDelPaciente.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblnombreDelPaciente.setBounds(10, 38, 137, 14);
		add(lblnombreDelPaciente);
		
		textField = new JTextField();
		textField.setEditable(false);
		textField.setFont(new Font("Tahoma", Font.PLAIN, 13));
		textField.setColumns(10);
		textField.setBounds(157, 38, 184, 20);
		add(textField);
		
		JLabel lblpiezaRecibida = new JLabel("<html><b>Pieza Recibida:</b></html>");
		lblpiezaRecibida.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblpiezaRecibida.setBounds(10, 66, 127, 14);
		add(lblpiezaRecibida);
		
		textField_1 = new JTextField();
		textField_1.setEditable(false);
		textField_1.setFont(new Font("Tahoma", Font.PLAIN, 13));
		textField_1.setColumns(10);
		textField_1.setBounds(157, 69, 184, 20);
		add(textField_1);
		
		JLabel lbldescripcioacutenPeroperatoria = new JLabel("<html><b>Descripci&oacute;n Per-operatoria:</b></html>");
		lbldescripcioacutenPeroperatoria.setHorizontalAlignment(SwingConstants.CENTER);
		lbldescripcioacutenPeroperatoria.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lbldescripcioacutenPeroperatoria.setBounds(10, 256, 117, 37);
		add(lbldescripcioacutenPeroperatoria);
		
		JTextArea txtADescPerOperatoria = new JTextArea();
		txtADescPerOperatoria.setWrapStyleWord(true);
		txtADescPerOperatoria.setLineWrap(true);
		txtADescPerOperatoria.setBorder(new LineBorder(new Color(0, 0, 0)));
		txtADescPerOperatoria.setBounds(157, 253, 289, 97);
		add(txtADescPerOperatoria);
		
		setSize(Constants.APP_WINDOW_MAX_X, 400);
		setLocation(0, Constants.APP_MENU_HEIGTH);
		
		JLabel lblexamenARealizar = new JLabel("<html><b>Examen a Realizar:</b></html>");
		lblexamenARealizar.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblexamenARealizar.setBounds(10, 98, 127, 14);
		add(lblexamenARealizar);
		
		textField_2 = new JTextField();
		textField_2.setFont(new Font("Tahoma", Font.PLAIN, 13));
		textField_2.setEditable(false);
		textField_2.setColumns(10);
		textField_2.setBounds(157, 101, 184, 20);
		add(textField_2);
		
		tblFotos = new JTable(2,2);
		tblFotos.setCellSelectionEnabled(true);
		tblFotos.setBounds(546, 39, 289, 145);
		add(tblFotos);
		
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
		
		JLabel lblFotos = new JLabel("Fotos:");
		lblFotos.setFont(new Font("Tahoma", Font.BOLD, 16));
		lblFotos.setBounds(513, 204, 56, 26);
		add(lblFotos);
		
		table = new JTable(2, 2);
		table.setCellSelectionEnabled(true);
		table.setBounds(546, 238, 289, 145);
		add(table);
		
		JButton btnAgregarCassete = new JButton("Agregar Cassete");
		btnAgregarCassete.setBounds(608, 10, 134, 23);
		add(btnAgregarCassete);
		
		JButton button_1 = new JButton("Agregar Foto");
		button_1.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
			}
		});
		button_1.setBounds(608, 208, 134, 23);
		add(button_1);
		setVisible(true);
	}
}
