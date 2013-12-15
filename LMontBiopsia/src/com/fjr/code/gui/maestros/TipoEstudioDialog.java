package com.fjr.code.gui.maestros;

import java.awt.BorderLayout;
import java.awt.FlowLayout;

import javax.swing.JButton;
import javax.swing.JDialog;
import javax.swing.JPanel;
import javax.swing.border.EmptyBorder;
import java.awt.Toolkit;
import java.awt.Font;
import javax.swing.JLabel;
import javax.swing.JTextField;

import com.fjr.code.dao.TipoEstudioDAO;
import com.fjr.code.dto.TipoEstudioDTO;
import com.fjr.code.gui.operations.maestros.TipoEstudioDialogOperations;

/**
 * 
 * Class: TipoEstudioDialog
 * Creation Date: 15/12/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class TipoEstudioDialog extends JDialog {

	/**
	 * 
	 */
	private static final long serialVersionUID = 594491748875506112L;
	private final JPanel contentPanel = new JPanel();
	private int idTipoEstudio;
	private JTextField txtNombre;
	private JTextField txtAbreviatura;

	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		try {
			TipoEstudioDialog dialog = new TipoEstudioDialog(-1);
			dialog.setDefaultCloseOperation(JDialog.DISPOSE_ON_CLOSE);
			dialog.setVisible(true);
		} catch (Exception e) {
			e.printStackTrace();
		}
	}

	/**
	 * Create the dialog.
	 */
	public TipoEstudioDialog(int idTipoEstudio) {
		this.idTipoEstudio = idTipoEstudio;
		TipoEstudioDTO tipoEstudio = null; 
		if(idTipoEstudio > -1){
			tipoEstudio = TipoEstudioDAO.getById(idTipoEstudio);
		}
		
		setDefaultCloseOperation(JDialog.DISPOSE_ON_CLOSE);
		setTitle("Tipo de Estudio");
		setModal(true);
		setIconImage(Toolkit.getDefaultToolkit().getImage(TipoEstudioDialog.class.getResource("/resources/images/iconLogo1.jpg")));
		setBounds(100, 100, 450, 153);
		getContentPane().setLayout(new BorderLayout());
		contentPanel.setBorder(new EmptyBorder(5, 5, 5, 5));
		getContentPane().add(contentPanel, BorderLayout.CENTER);
		contentPanel.setLayout(null);
		
		JLabel lblNewLabel_1 = new JLabel("C\u00F3digo");
		lblNewLabel_1.setFont(new Font("Tahoma", Font.BOLD, 13));
		lblNewLabel_1.setBounds(10, 11, 88, 16);
		contentPanel.add(lblNewLabel_1);
		
		txtNombre = new JTextField();
		txtNombre.setBounds(125, 12, 226, 20);
		txtNombre.setColumns(10);
		txtNombre.setText(tipoEstudio == null ? "" : tipoEstudio.getNombre());
		contentPanel.add(txtNombre);
		
		JLabel lblNombre = new JLabel("Abreviatura");
		lblNombre.setFont(new Font("Tahoma", Font.BOLD, 13));
		lblNombre.setBounds(10, 38, 109, 16);
		contentPanel.add(lblNombre);
		
		txtAbreviatura = new JTextField();
		txtAbreviatura.setColumns(10);
		txtAbreviatura.setBounds(125, 39, 226, 20);
		txtAbreviatura.setText(tipoEstudio == null ? "" : tipoEstudio.getAbreviatura());
		contentPanel.add(txtAbreviatura);
		
		TipoEstudioDialogOperations listener = new TipoEstudioDialogOperations(this);
		
		{
			JPanel buttonPane = new JPanel();
			buttonPane.setLayout(new FlowLayout(FlowLayout.RIGHT));
			getContentPane().add(buttonPane, BorderLayout.SOUTH);
			{
				JButton btnGuardar = new JButton("Guardar");
				btnGuardar.setFont(new Font("Tahoma", Font.PLAIN, 12));
				btnGuardar.setActionCommand(TipoEstudioDialogOperations.ACTION_COMMAND_BTN_GUARDAR);
				btnGuardar.addActionListener(listener);
				buttonPane.add(btnGuardar);
				getRootPane().setDefaultButton(btnGuardar);
				
				JButton delButton = new JButton("Eliminar");
				delButton.setFont(new Font("Tahoma", Font.PLAIN, 12));
				delButton.setActionCommand(TipoEstudioDialogOperations.ACTION_COMMAND_BTN_ELIMINAR);
				delButton.addActionListener(listener);
				buttonPane.add(delButton);
			}
			{
				JButton cancelButton = new JButton("Cancelar");
				cancelButton.setFont(new Font("Tahoma", Font.PLAIN, 12));
				cancelButton.setActionCommand(TipoEstudioDialogOperations.ACTION_COMMAND_BTN_CANCELAR);
				cancelButton.addActionListener(listener);
				buttonPane.add(cancelButton);
			}
		}
		
		setLocationRelativeTo(null);
	}

	public JTextField getTxtNombre() {
		return txtNombre;
	}

	public JTextField getTxtAbreviatura() {
		return txtAbreviatura;
	}
	
	public int getIdTipoEstudio() {
		return idTipoEstudio;
	}
	
	public void setIdTipoEstudio(int idTipoEstudio) {
		this.idTipoEstudio = idTipoEstudio;
	}
}
