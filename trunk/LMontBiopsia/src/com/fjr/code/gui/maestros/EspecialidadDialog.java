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

import com.fjr.code.dao.EspecialidadDAO;
import com.fjr.code.dto.EspecialidadDTO;
import com.fjr.code.gui.operations.maestros.EspecialidadDialogOperations;

public class EspecialidadDialog extends JDialog {

	/**
	 * 
	 */
	private static final long serialVersionUID = 9061966528955864227L;
	private final JPanel contentPanel = new JPanel();
	private int idEspecialidad;
	private JTextField textNombre;
	private JTextField textCodigo;
	private JTextField textDescripcion;

	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		try {
			EspecialidadDialog dialog = new EspecialidadDialog(-1);
			dialog.setDefaultCloseOperation(JDialog.DISPOSE_ON_CLOSE);
			dialog.setVisible(true);
		} catch (Exception e) {
			e.printStackTrace();
		}
	}

	/**
	 * Create the dialog.
	 * @param idEspecialidad 
	 */
	public EspecialidadDialog(int idEspecialidad) {
		this.idEspecialidad = idEspecialidad;
		EspecialidadDTO especialidad = null;
		if(idEspecialidad > -1){
			especialidad = EspecialidadDAO.getById(idEspecialidad);
		}
		
		setDefaultCloseOperation(JDialog.DISPOSE_ON_CLOSE);
		setTitle("Especialidad");
		setModal(true);
		setIconImage(Toolkit.getDefaultToolkit().getImage(EspecialidadDialog.class.getResource("/resources/images/iconLogo1.jpg")));
		setBounds(100, 100, 450, 193);
		getContentPane().setLayout(new BorderLayout());
		contentPanel.setBorder(new EmptyBorder(5, 5, 5, 5));
		getContentPane().add(contentPanel, BorderLayout.CENTER);
		contentPanel.setLayout(null);
		
		JLabel lblNewLabel = new JLabel("Nombre");
		lblNewLabel.setFont(new Font("Tahoma", Font.BOLD, 13));
		lblNewLabel.setBounds(10, 11, 92, 21);
		contentPanel.add(lblNewLabel);
		
		textNombre = new JTextField();
		textNombre.setBounds(105, 12, 198, 20);
		textNombre.setColumns(10);
		textNombre.setText(especialidad == null ? "" : especialidad.getNombre());
		contentPanel.add(textNombre);
		
		JLabel lblCdigo = new JLabel("C\u00F3digo");
		lblCdigo.setFont(new Font("Tahoma", Font.BOLD, 13));
		lblCdigo.setBounds(10, 43, 92, 21);
		contentPanel.add(lblCdigo);
		
		textCodigo = new JTextField();
		textCodigo.setColumns(10);
		textCodigo.setBounds(105, 44, 198, 20);
		textCodigo.setText(especialidad == null ? "" : especialidad.getCodigo());
		contentPanel.add(textCodigo);
		
		JLabel lblDescripcin = new JLabel("Descripci\u00F3n");
		lblDescripcin.setFont(new Font("Tahoma", Font.BOLD, 13));
		lblDescripcin.setBounds(10, 75, 92, 21);
		contentPanel.add(lblDescripcin);
		
		textDescripcion = new JTextField();
		textDescripcion.setColumns(10);
		textDescripcion.setBounds(105, 76, 198, 20);
		textDescripcion.setText(especialidad == null ? "" : especialidad.getDescripcion());
		contentPanel.add(textDescripcion);
		
		EspecialidadDialogOperations listener = new EspecialidadDialogOperations(this);
		{
			JPanel buttonPane = new JPanel();
			buttonPane.setLayout(new FlowLayout(FlowLayout.RIGHT));
			getContentPane().add(buttonPane, BorderLayout.SOUTH);
			{
				JButton okButton = new JButton("Guardar");
				okButton.setFont(new Font("Tahoma", Font.PLAIN, 12));
				okButton.setActionCommand(EspecialidadDialogOperations.ACTION_COMMAND_BTN_GUARDAR);
				okButton.addActionListener(listener);
				buttonPane.add(okButton);
				getRootPane().setDefaultButton(okButton);
			}
			{
				JButton cancelButton = new JButton("Cancelar");
				cancelButton.setFont(new Font("Tahoma", Font.PLAIN, 12));
				cancelButton.setActionCommand(EspecialidadDialogOperations.ACTION_COMMAND_BTN_CANCELAR);
				cancelButton.addActionListener(listener);
				
				JButton btnEliminar = new JButton("Eliminar");
				btnEliminar.setFont(new Font("Tahoma", Font.PLAIN, 12));
				btnEliminar.setActionCommand(EspecialidadDialogOperations.ACTION_COMMAND_BTN_ELIMINAR);
				btnEliminar.addActionListener(listener);
				
				buttonPane.add(btnEliminar);
				buttonPane.add(cancelButton);
			}
		}
		
		setLocationRelativeTo(null);
	}

	public JTextField getTextNombre() {
		return textNombre;
	}

	public JTextField getTextCodigo() {
		return textCodigo;
	}

	public JTextField getTextDescripcion() {
		return textDescripcion;
	}
	
	public void setIdEspecialidad(int idEspecialidad) {
		this.idEspecialidad = idEspecialidad;
	}
	
	public int getIdEspecialidad() {
		return idEspecialidad;
	}
}
