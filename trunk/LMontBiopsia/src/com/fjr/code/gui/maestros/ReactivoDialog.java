package com.fjr.code.gui.maestros;

import java.awt.BorderLayout;
import java.awt.FlowLayout;

import javax.swing.JButton;
import javax.swing.JDialog;
import javax.swing.JPanel;
import javax.swing.border.EmptyBorder;
import java.awt.Toolkit;
import java.awt.Font;
import javax.swing.JComboBox;
import javax.swing.JLabel;
import javax.swing.JTextField;

import com.fjr.code.dao.CategoriaReactivoDAO;
import com.fjr.code.dao.ReactivoDAO;
import com.fjr.code.dto.ReactivoDTO;
import com.fjr.code.gui.operations.maestros.ReactivoDialogOperations;

/**
 * 
 * Class: ReactivoDialog
 * Creation Date: 15/12/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class ReactivoDialog extends JDialog {

	/**
	 * 
	 */
	private static final long serialVersionUID = 594491748875506112L;
	private final JPanel contentPanel = new JPanel();
	private int idReactivo;
	private JTextField txtNombre;
	private JTextField txtAbreviatura;
	private JComboBox cBoxCategoria;

	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		try {
			ReactivoDialog dialog = new ReactivoDialog(-1);
			dialog.setDefaultCloseOperation(JDialog.DISPOSE_ON_CLOSE);
			dialog.setVisible(true);
		} catch (Exception e) {
			e.printStackTrace();
		}
	}

	/**
	 * Create the dialog.
	 */
	public ReactivoDialog(int idReactivo) {
		this.idReactivo = idReactivo;
		
		ReactivoDTO reactivoDTO = null; 
		if(idReactivo > -1){
			reactivoDTO = ReactivoDAO.getById(idReactivo);
		}
		
		setDefaultCloseOperation(JDialog.DISPOSE_ON_CLOSE);
		setTitle("Reactivo");
		setModal(true);
		setIconImage(Toolkit.getDefaultToolkit().getImage(ReactivoDialog.class.getResource("/resources/images/iconLogo1.jpg")));
		setBounds(100, 100, 450, 184);
		getContentPane().setLayout(new BorderLayout());
		contentPanel.setBorder(new EmptyBorder(5, 5, 5, 5));
		getContentPane().add(contentPanel, BorderLayout.CENTER);
		contentPanel.setLayout(null);
		
		JLabel lblCategoria = new JLabel("Categoria");
		lblCategoria.setFont(new Font("Tahoma", Font.BOLD, 13));
		lblCategoria.setBounds(10, 11, 88, 16);
		contentPanel.add(lblCategoria);
		
		cBoxCategoria = new JComboBox();
		cBoxCategoria.setBounds(125, 9, 226, 20);
		CategoriaReactivoDAO.populateJCombo(cBoxCategoria, 
				reactivoDTO == null ? -1 : reactivoDTO.getCategoriaReactivoDTO().getId());
		contentPanel.add(cBoxCategoria);
		
		JLabel lblNewLabel_1 = new JLabel("Nombre");
		lblNewLabel_1.setFont(new Font("Tahoma", Font.BOLD, 13));
		lblNewLabel_1.setBounds(10, 39, 88, 16);
		contentPanel.add(lblNewLabel_1);
		
		txtNombre = new JTextField();
		txtNombre.setBounds(125, 40, 226, 20);
		txtNombre.setColumns(10);
		txtNombre.setText(reactivoDTO == null ? "" : reactivoDTO.getNombre());
		contentPanel.add(txtNombre);
		
		JLabel lblNombre = new JLabel("Abreviatura");
		lblNombre.setFont(new Font("Tahoma", Font.BOLD, 13));
		lblNombre.setBounds(10, 66, 109, 16);
		contentPanel.add(lblNombre);
		
		txtAbreviatura = new JTextField();
		txtAbreviatura.setColumns(10);
		txtAbreviatura.setBounds(125, 67, 226, 20);
		txtAbreviatura.setText(reactivoDTO == null ? "" : reactivoDTO.getAbreviatura());
		contentPanel.add(txtAbreviatura);
		
		ReactivoDialogOperations listener = new ReactivoDialogOperations(this);
		
		{
			JPanel buttonPane = new JPanel();
			buttonPane.setLayout(new FlowLayout(FlowLayout.RIGHT));
			getContentPane().add(buttonPane, BorderLayout.SOUTH);
			{
				JButton btnGuardar = new JButton("Guardar");
				btnGuardar.setFont(new Font("Tahoma", Font.PLAIN, 12));
				btnGuardar.setActionCommand(ReactivoDialogOperations.ACTION_COMMAND_BTN_GUARDAR);
				btnGuardar.addActionListener(listener);
				buttonPane.add(btnGuardar);
				getRootPane().setDefaultButton(btnGuardar);
			}
			{
				JButton cancelButton = new JButton("Cancelar");
				cancelButton.setFont(new Font("Tahoma", Font.PLAIN, 12));
				cancelButton.setActionCommand(ReactivoDialogOperations.ACTION_COMMAND_BTN_CANCELAR);
				cancelButton.addActionListener(listener);
				
				JButton btnEliminar = new JButton("Eliminar");
				btnEliminar.setFont(new Font("Tahoma", Font.PLAIN, 12));
				btnEliminar.addActionListener(listener);
				btnEliminar.setActionCommand(ReactivoDialogOperations.ACTION_COMMAND_BTN_ELIMINAR);
				
				buttonPane.add(btnEliminar);
				buttonPane.add(cancelButton);
			}
		}
		
		setLocationRelativeTo(null);
	}
	
	public JComboBox getcBoxCategoria() {
		return cBoxCategoria;
	}
	
	public JTextField getTxtNombre() {
		return txtNombre;
	}

	public JTextField getTxtAbreviatura() {
		return txtAbreviatura;
	}
	
	public int getIdReactivo() {
		return idReactivo;
	}
	
	public void setIdReactivo(int idReactivo) {
		this.idReactivo = idReactivo;
	}
}
