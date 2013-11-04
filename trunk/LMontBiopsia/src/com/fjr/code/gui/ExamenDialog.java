package com.fjr.code.gui;

import java.awt.BorderLayout;
import java.awt.FlowLayout;

import javax.swing.JButton;
import javax.swing.JDialog;
import javax.swing.JPanel;
import javax.swing.border.EmptyBorder;
import java.awt.Toolkit;
import java.awt.Font;
import javax.swing.JLabel;
import javax.swing.JComboBox;
import javax.swing.JTextField;

import com.fjr.code.dao.EspecialidadDAO;
import com.fjr.code.gui.operations.ExamenDialogOperations;

public class ExamenDialog extends JDialog {

	/**
	 * 
	 */
	private static final long serialVersionUID = 594491748875506112L;
	private final JPanel contentPanel = new JPanel();
	private JTextField txtCodigo;
	private JTextField txtCodigoPremium;
	private JTextField txtNombre;
	private JComboBox comboEspecialidad;
	private JComboBox comboDias;

	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		try {
			ExamenDialog dialog = new ExamenDialog();
			dialog.setDefaultCloseOperation(JDialog.DISPOSE_ON_CLOSE);
			dialog.setVisible(true);
		} catch (Exception e) {
			e.printStackTrace();
		}
	}

	/**
	 * Create the dialog.
	 */
	public ExamenDialog() {
		setDefaultCloseOperation(JDialog.DISPOSE_ON_CLOSE);
		setTitle("Examenes");
		setModal(true);
		setIconImage(Toolkit.getDefaultToolkit().getImage(ExamenDialog.class.getResource("/resources/images/iconLogo1.jpg")));
		setBounds(100, 100, 450, 195);
		getContentPane().setLayout(new BorderLayout());
		contentPanel.setBorder(new EmptyBorder(5, 5, 5, 5));
		getContentPane().add(contentPanel, BorderLayout.CENTER);
		contentPanel.setLayout(null);
		{
			JLabel lblNewLabel = new JLabel("Especialidad");
			lblNewLabel.setFont(new Font("Tahoma", Font.BOLD, 13));
			lblNewLabel.setBounds(10, 11, 88, 14);
			contentPanel.add(lblNewLabel);
		}
		
		comboEspecialidad = new JComboBox();
		comboEspecialidad.setBounds(125, 11, 226, 20);
		EspecialidadDAO.populateJCombo(comboEspecialidad, false);
		contentPanel.add(comboEspecialidad);
		
		JLabel lblNewLabel_1 = new JLabel("Codigo");
		lblNewLabel_1.setFont(new Font("Tahoma", Font.BOLD, 13));
		lblNewLabel_1.setBounds(10, 36, 88, 16);
		contentPanel.add(lblNewLabel_1);
		
		txtCodigo = new JTextField();
		txtCodigo.setBounds(125, 37, 226, 20);
		contentPanel.add(txtCodigo);
		txtCodigo.setColumns(10);
		/*
		JLabel lblCodigoPremium = new JLabel("Codigo Premium");
		lblCodigoPremium.setFont(new Font("Tahoma", Font.BOLD, 13));
		lblCodigoPremium.setBounds(10, 64, 109, 16);
		contentPanel.add(lblCodigoPremium);
		
		txtCodigoPremium = new JTextField();
		txtCodigoPremium.setColumns(10);
		txtCodigoPremium.setBounds(125, 65, 226, 20);
		contentPanel.add(txtCodigoPremium);
		*/
		JLabel lblNombre = new JLabel("Nombre");
		lblNombre.setFont(new Font("Tahoma", Font.BOLD, 13));
		lblNombre.setBounds(10, 63, 109, 16);
		contentPanel.add(lblNombre);
		
		txtNombre = new JTextField();
		txtNombre.setColumns(10);
		txtNombre.setBounds(125, 64, 226, 20);
		contentPanel.add(txtNombre);
		
		JLabel lblDas = new JLabel("D\u00EDas");
		lblDas.setFont(new Font("Tahoma", Font.BOLD, 13));
		lblDas.setBounds(10, 90, 88, 14);
		contentPanel.add(lblDas);
		
		comboDias = new JComboBox();
		comboDias.setBounds(125, 90, 226, 20);
		for(int i = 1; i < 101; i++){
			comboDias.addItem((i < 10 ? "0" : "") + i);
		}
		contentPanel.add(comboDias);
		
		
		ExamenDialogOperations listener = new ExamenDialogOperations(this);
		
		{
			JPanel buttonPane = new JPanel();
			buttonPane.setLayout(new FlowLayout(FlowLayout.RIGHT));
			getContentPane().add(buttonPane, BorderLayout.SOUTH);
			{
				JButton okButton = new JButton("Guardar");
				okButton.setFont(new Font("Tahoma", Font.PLAIN, 12));
				okButton.setActionCommand(ExamenDialogOperations.ACTION_COMMAND_BTN_GUARDAR);
				okButton.addActionListener(listener);
				buttonPane.add(okButton);
				getRootPane().setDefaultButton(okButton);
			}
			{
				JButton cancelButton = new JButton("Cancelar");
				cancelButton.setFont(new Font("Tahoma", Font.PLAIN, 12));
				cancelButton.setActionCommand(ExamenDialogOperations.ACTION_COMMAND_BTN_CANCELAR);
				cancelButton.addActionListener(listener);
				buttonPane.add(cancelButton);
			}
		}
		
		setLocationRelativeTo(null);
	}

	public JTextField getTxtCodigo() {
		return txtCodigo;
	}

	public JTextField getTxtCodigoPremium() {
		return txtCodigoPremium;
	}

	public JTextField getTxtNombre() {
		return txtNombre;
	}

	public JComboBox getComboEspecialidad() {
		return comboEspecialidad;
	}

	public JComboBox getComboDias() {
		return comboDias;
	}
}
