package com.fjr.code.gui;

import java.awt.BorderLayout;
import java.awt.FlowLayout;

import javax.swing.JButton;
import javax.swing.JDialog;
import javax.swing.JPanel;
import javax.swing.border.EmptyBorder;
import java.awt.Toolkit;
import java.awt.Font;

import javax.swing.ButtonGroup;
import javax.swing.JRadioButton;
import javax.swing.JLabel;
import javax.swing.JComboBox;
import javax.swing.JTextField;

public class CustomHistologiaPrintDialog extends JDialog {
	/**
	 * 
	 */
	private static final long serialVersionUID = -4158381175554055126L;
	
	private final JPanel contentPanel = new JPanel();
	private JTextField textField;

	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		try {
			CustomHistologiaPrintDialog dialog = new CustomHistologiaPrintDialog(null, 0, 0, 0);
			dialog.setDefaultCloseOperation(JDialog.DISPOSE_ON_CLOSE);
			dialog.setVisible(true);
		} catch (Exception e) {
			e.printStackTrace();
		}
	}

	/**
	 * Create the dialog.
	 */
	public CustomHistologiaPrintDialog(String codigoBiopsia, int cassete, int bloques, int maxLaminas) {
		setTitle("Impresi\u00F3n especifica de Laminas");
		setModal(true);
		setDefaultCloseOperation(JDialog.DISPOSE_ON_CLOSE);
		setIconImage(Toolkit.getDefaultToolkit().getImage(CustomHistologiaPrintDialog.class.getResource("/resources/images/iconLogo1.jpg")));
		setBounds(100, 100, 450, 300);
		getContentPane().setLayout(new BorderLayout());
		contentPanel.setBorder(new EmptyBorder(5, 5, 5, 5));
		getContentPane().add(contentPanel, BorderLayout.CENTER);
		contentPanel.setLayout(null);
		
		JRadioButton rBtnTodas = new JRadioButton("Todas");
		rBtnTodas.setSelected(true);
		rBtnTodas.setFont(new Font("Tahoma", Font.PLAIN, 12));
		rBtnTodas.setBounds(29, 105, 149, 23);
		contentPanel.add(rBtnTodas);
		
		JLabel lblNewLabel = new JLabel("Cassete:");
		lblNewLabel.setFont(new Font("Tahoma", Font.BOLD, 12));
		lblNewLabel.setBounds(6, 11, 149, 23);
		contentPanel.add(lblNewLabel);
		
		JLabel lblBloque = new JLabel("Bloque:");
		lblBloque.setFont(new Font("Tahoma", Font.BOLD, 12));
		lblBloque.setBounds(6, 45, 64, 23);
		contentPanel.add(lblBloque);
		
		JComboBox comboBox = new JComboBox();
		comboBox.setBounds(80, 45, 75, 20);
		contentPanel.add(comboBox);
		
		JLabel lblLaminas = new JLabel("Laminas:");
		lblLaminas.setFont(new Font("Tahoma", Font.BOLD, 12));
		lblLaminas.setBounds(6, 79, 64, 23);
		contentPanel.add(lblLaminas);
		
		JRadioButton rBtnNvosCortes = new JRadioButton("Nuevos Cortes");
		rBtnNvosCortes.setFont(new Font("Tahoma", Font.PLAIN, 12));
		rBtnNvosCortes.setBounds(29, 135, 149, 23);
		contentPanel.add(rBtnNvosCortes);
		
		JRadioButton rBtnEspecificas = new JRadioButton("Especificas");
		rBtnEspecificas.setFont(new Font("Tahoma", Font.PLAIN, 12));
		rBtnEspecificas.setBounds(29, 165, 105, 23);
		contentPanel.add(rBtnEspecificas);
		
		textField = new JTextField();
		textField.setBounds(140, 165, 154, 20);
		contentPanel.add(textField);
		textField.setColumns(10);
		
		ButtonGroup btnGroup = new ButtonGroup();
		btnGroup.add(rBtnTodas);
		btnGroup.add(rBtnNvosCortes);
		btnGroup.add(rBtnEspecificas);
		
		{
			JPanel buttonPane = new JPanel();
			buttonPane.setLayout(new FlowLayout(FlowLayout.RIGHT));
			getContentPane().add(buttonPane, BorderLayout.SOUTH);
			{
				JButton okButton = new JButton("Imprimir");
				okButton.setFont(new Font("Tahoma", Font.PLAIN, 12));
				okButton.setActionCommand("OK");
				buttonPane.add(okButton);
				getRootPane().setDefaultButton(okButton);
			}
			{
				JButton cancelButton = new JButton("Cancelar");
				cancelButton.setFont(new Font("Tahoma", Font.PLAIN, 12));
				cancelButton.setActionCommand("Cancelar");
				buttonPane.add(cancelButton);
			}
		}
	}
}
