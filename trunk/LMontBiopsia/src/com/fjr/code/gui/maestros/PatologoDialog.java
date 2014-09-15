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

import com.fjr.code.dao.PatologoDAO;
import com.fjr.code.dto.PatologoDTO;
import com.fjr.code.gui.operations.maestros.PatologoDialogOperations;

import javax.swing.JComboBox;

public class PatologoDialog extends JDialog {

	/**
	 * 
	 */
	private static final long serialVersionUID = 9061966528955864227L;
	private final JPanel contentPanel = new JPanel();
	private int idPatologo;
	private JTextField textNombre;
	private JComboBox cBoxGenero;
	private BusquedaPatologosPanel busquedaPatologosPanel;

	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		try {
			PatologoDialog dialog = new PatologoDialog(-1, null);
			dialog.setDefaultCloseOperation(JDialog.DISPOSE_ON_CLOSE);
			dialog.setVisible(true);
		} catch (Exception e) {
			e.printStackTrace();
		}
	}

	/**
	 * Create the dialog.
	 * @param busquedaPatologosPanel 
	 * @param idEspecialidad 
	 */
	public PatologoDialog(int idPatologo, BusquedaPatologosPanel busquedaPatologosPanel) {
		this.idPatologo = idPatologo;
		this.busquedaPatologosPanel = busquedaPatologosPanel;
		
		PatologoDTO patologo = null;
		if(idPatologo > -1){
			patologo = PatologoDAO.getById(idPatologo);
		}
		
		setDefaultCloseOperation(JDialog.DISPOSE_ON_CLOSE);
		setTitle("Patologo");
		setModal(true);
		setIconImage(Toolkit.getDefaultToolkit().getImage(PatologoDialog.class.getResource("/resources/images/iconLogo1.jpg")));
		setBounds(100, 100, 450, 193);
		getContentPane().setLayout(new BorderLayout());
		contentPanel.setBorder(new EmptyBorder(5, 5, 5, 5));
		getContentPane().add(contentPanel, BorderLayout.CENTER);
		contentPanel.setLayout(null);
		
		JLabel lblGenero = new JLabel("Genero");
		lblGenero.setFont(new Font("Tahoma", Font.BOLD, 13));
		lblGenero.setBounds(10, 11, 92, 21);
		contentPanel.add(lblGenero);
		
		cBoxGenero = new JComboBox();
		cBoxGenero.setBounds(105, 12, 83, 20);
		cBoxGenero.addItem("Dra.");
		cBoxGenero.getItemAt(cBoxGenero.getItemCount() - 1).equals(patologo == null ? "" : patologo.getGenero());
		cBoxGenero.addItem("Dr.");
		cBoxGenero.getItemAt(cBoxGenero.getItemCount() - 1).equals(patologo == null ? "" : patologo.getGenero());
		contentPanel.add(cBoxGenero);
		
		JLabel lblNewLabel = new JLabel("Nombre");
		lblNewLabel.setFont(new Font("Tahoma", Font.BOLD, 13));
		lblNewLabel.setBounds(10, 51, 92, 21);
		contentPanel.add(lblNewLabel);
		
		textNombre = new JTextField();
		textNombre.setBounds(105, 52, 198, 20);
		textNombre.setColumns(10);
		textNombre.setText(patologo == null ? "" : patologo.getNombre());
		contentPanel.add(textNombre);
		
		PatologoDialogOperations listener = new PatologoDialogOperations(this);
		{
			JPanel buttonPane = new JPanel();
			buttonPane.setLayout(new FlowLayout(FlowLayout.RIGHT));
			getContentPane().add(buttonPane, BorderLayout.SOUTH);
			{
				JButton okButton = new JButton("Guardar");
				okButton.setFont(new Font("Tahoma", Font.PLAIN, 12));
				okButton.setActionCommand(PatologoDialogOperations.ACTION_COMMAND_BTN_GUARDAR);
				okButton.addActionListener(listener);
				buttonPane.add(okButton);
				getRootPane().setDefaultButton(okButton);
			}
			{
				JButton cancelButton = new JButton("Cancelar");
				cancelButton.setFont(new Font("Tahoma", Font.PLAIN, 12));
				cancelButton.setActionCommand(PatologoDialogOperations.ACTION_COMMAND_BTN_CANCELAR);
				cancelButton.addActionListener(listener);
				
				JButton btnEliminar = new JButton("Eliminar");
				btnEliminar.setFont(new Font("Tahoma", Font.PLAIN, 12));
				btnEliminar.setActionCommand(PatologoDialogOperations.ACTION_COMMAND_BTN_ELIMINAR);
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

	public JComboBox getcBoxGenero() {
		return cBoxGenero;
	}
	
	public int getIdPatologo() {
		return idPatologo;
	}
	
	public void setIdPatologo(int idPatologo) {
		this.idPatologo = idPatologo;
	}
	
	public BusquedaPatologosPanel getBusquedaPatologosPanel() {
		return busquedaPatologosPanel;
	}
}
