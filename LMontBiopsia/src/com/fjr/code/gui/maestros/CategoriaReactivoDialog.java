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

import com.fjr.code.dao.CategoriaReactivoDAO;
import com.fjr.code.dto.CategoriaReactivoDTO;
import com.fjr.code.gui.operations.maestros.CategoriaReactivoDialogOperations;

/**
 * 
 * Class: CategoriaReactivoDialog
 * Creation Date: 15/12/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class CategoriaReactivoDialog extends JDialog {

	/**
	 * 
	 */
	private static final long serialVersionUID = 594491748875506112L;
	private final JPanel contentPanel = new JPanel();
	private int idCategoriaReactivo;
	private JTextField txtNombre;

	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		try {
			CategoriaReactivoDialog dialog = new CategoriaReactivoDialog(-1);
			dialog.setDefaultCloseOperation(JDialog.DISPOSE_ON_CLOSE);
			dialog.setVisible(true);
		} catch (Exception e) {
			e.printStackTrace();
		}
	}

	/**
	 * Create the dialog.
	 */
	public CategoriaReactivoDialog(int idCategoriaReactivo) {
		this.idCategoriaReactivo = idCategoriaReactivo;
		CategoriaReactivoDTO categoriaReactivo = null; 
		if(idCategoriaReactivo > -1){
			categoriaReactivo = CategoriaReactivoDAO.getById(idCategoriaReactivo);
		}
		
		setDefaultCloseOperation(JDialog.DISPOSE_ON_CLOSE);
		setTitle("Categoria de Reactivo");
		setModal(true);
		setIconImage(Toolkit.getDefaultToolkit().getImage(CategoriaReactivoDialog.class.getResource("/resources/images/iconLogo1.jpg")));
		setBounds(100, 100, 351, 121);
		getContentPane().setLayout(new BorderLayout());
		contentPanel.setBorder(new EmptyBorder(5, 5, 5, 5));
		getContentPane().add(contentPanel, BorderLayout.CENTER);
		contentPanel.setLayout(null);
		
		JLabel lblNewLabel_1 = new JLabel("Nombre: ");
		lblNewLabel_1.setFont(new Font("Tahoma", Font.BOLD, 13));
		lblNewLabel_1.setBounds(10, 11, 88, 16);
		contentPanel.add(lblNewLabel_1);
		
		txtNombre = new JTextField();
		txtNombre.setBounds(82, 10, 226, 20);
		txtNombre.setColumns(10);
		txtNombre.setText(categoriaReactivo == null ? "" : categoriaReactivo.getNombre());
		contentPanel.add(txtNombre);
		
		
		CategoriaReactivoDialogOperations listener = new CategoriaReactivoDialogOperations(this);
		{
			JPanel buttonPane = new JPanel();
			buttonPane.setLayout(new FlowLayout(FlowLayout.RIGHT));
			getContentPane().add(buttonPane, BorderLayout.SOUTH);
			{
				JButton btnGuardar = new JButton("Guardar");
				btnGuardar.setFont(new Font("Tahoma", Font.PLAIN, 12));
				btnGuardar.setActionCommand(CategoriaReactivoDialogOperations.ACTION_COMMAND_BTN_GUARDAR);
				btnGuardar.addActionListener(listener);
				buttonPane.add(btnGuardar);
				getRootPane().setDefaultButton(btnGuardar);
			}
			{
				JButton cancelButton = new JButton("Cancelar");
				cancelButton.setFont(new Font("Tahoma", Font.PLAIN, 12));
				cancelButton.setActionCommand(CategoriaReactivoDialogOperations.ACTION_COMMAND_BTN_CANCELAR);
				cancelButton.addActionListener(listener);
				buttonPane.add(cancelButton);
			}
		}
		
		setLocationRelativeTo(null);
	}

	public JTextField getTxtNombre() {
		return txtNombre;
	}
	
	public int getIdCategoriaReactivo() {
		return idCategoriaReactivo;
	}
	
	public void setIdCategoriaReactivo(int idCategoriaReactivo) {
		this.idCategoriaReactivo = idCategoriaReactivo;
	}
}
