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

import com.fjr.code.gui.operations.ComprobanteMaterialDialogOperations;

/**
 * 
 * Class: ComprobanteMaterialDialog
 * Creation Date: 05/01/2014
 * (c) 2014
 *
 * @author T&T
 *
 */
public class ComprobanteMaterialDialog extends JDialog {

	/**
	 * 
	 */
	private static final long serialVersionUID = 1561549673148412120L;
	private final JPanel contentPanel = new JPanel();
	private JComboBox cBoxBloques;
	private JComboBox cBoxLaminas;
	private int idBiopsia;
	
	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		try {
			ComprobanteMaterialDialog dialog = new ComprobanteMaterialDialog(0,0,0);
			dialog.setDefaultCloseOperation(JDialog.DISPOSE_ON_CLOSE);
			dialog.setVisible(true);
		} catch (Exception e) {
			e.printStackTrace();
		}
	}

	/**
	 * 
	 * @param idBiopsia
	 * @param bloques
	 * @param laminas
	 */
	public ComprobanteMaterialDialog(int idBiopsia, int bloques, int laminas) {
		this.idBiopsia = idBiopsia;
		
		setDefaultCloseOperation(JDialog.DISPOSE_ON_CLOSE);
		setTitle("Comprobante de Entrega de Material");
		setIconImage(Toolkit.getDefaultToolkit().getImage(ComprobanteMaterialDialog.class.getResource("/resources/images/iconLogo1.jpg")));
		setBounds(100, 100, 450, 146);
		getContentPane().setLayout(new BorderLayout());
		contentPanel.setBorder(new EmptyBorder(5, 5, 5, 5));
		getContentPane().add(contentPanel, BorderLayout.CENTER);
		contentPanel.setLayout(null);
		
		JLabel lblBloques = new JLabel("Bloques: ");
		lblBloques.setFont(new Font("Tahoma", Font.PLAIN, 12));
		lblBloques.setBounds(10, 11, 69, 14);
		contentPanel.add(lblBloques);
		
		cBoxBloques = new JComboBox();
		cBoxBloques.addItem(0);
		for (int i = 0; i < bloques; i++) {
			cBoxBloques.addItem(i + 1);
		}
		cBoxBloques.setBounds(89, 9, 94, 20);
		contentPanel.add(cBoxBloques);
		
		JLabel lblLaminas = new JLabel("Laminas:");
		lblLaminas.setFont(new Font("Tahoma", Font.PLAIN, 12));
		lblLaminas.setBounds(10, 38, 69, 14);
		contentPanel.add(lblLaminas);
		
		cBoxLaminas = new JComboBox();
		cBoxLaminas.addItem(0);
		for (int i = 0; i < laminas; i++) {
			cBoxLaminas.addItem(i + 1);
		}
		cBoxLaminas.setBounds(89, 36, 94, 20);
		contentPanel.add(cBoxLaminas);
		
		ComprobanteMaterialDialogOperations listener = new ComprobanteMaterialDialogOperations(this);
		{
			JPanel buttonPane = new JPanel();
			buttonPane.setLayout(new FlowLayout(FlowLayout.RIGHT));
			getContentPane().add(buttonPane, BorderLayout.SOUTH);
			{
				JButton okButton = new JButton("Generar Comprobante");
				okButton.setFont(new Font("Tahoma", Font.PLAIN, 12));
				okButton.setActionCommand(ComprobanteMaterialDialogOperations.ACTION_COMMAND_BUTTON_GENERAR);
				okButton.addActionListener(listener);
				buttonPane.add(okButton);
				getRootPane().setDefaultButton(okButton);
			}
			{
				JButton cancelButton = new JButton("Cerrar");
				cancelButton.setFont(new Font("Tahoma", Font.PLAIN, 12));
				cancelButton.setActionCommand(ComprobanteMaterialDialogOperations.ACTION_COMMAND_BUTTON_CANCELAR);
				cancelButton.addActionListener(listener);
				buttonPane.add(cancelButton);
			}
		}
		
		setLocationRelativeTo(null);
	}

	public JComboBox getcBoxBloques() {
		return cBoxBloques;
	}

	public JComboBox getcBoxLaminas() {
		return cBoxLaminas;
	}

	public int getIdBiopsia() {
		return idBiopsia;
	}
}
