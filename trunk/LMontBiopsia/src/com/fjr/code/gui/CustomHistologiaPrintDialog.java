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

import com.fjr.code.gui.operations.CustomHistologiaPrintDialogOperations;

public class CustomHistologiaPrintDialog extends JDialog {
	/**
	 * 
	 */
	private static final long serialVersionUID = -4158381175554055126L;
	
	private final JPanel contentPanel = new JPanel();
	private JComboBox cBoxBloque;
	private JTextField txtLaminas;
	private JRadioButton rBtnTodas;
	private JRadioButton rBtnEspecificas;
	
	private String codigoBiopsia;
	private int cassete;
	private int maxLaminas;
	
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
		this.codigoBiopsia = codigoBiopsia;
		this.cassete = cassete;
		this.maxLaminas = maxLaminas;
		
		setTitle("Impresi\u00F3n especifica de Laminas");
		setModal(true);
		setDefaultCloseOperation(JDialog.DISPOSE_ON_CLOSE);
		setIconImage(Toolkit.getDefaultToolkit().getImage(CustomHistologiaPrintDialog.class.getResource("/resources/images/iconLogo1.jpg")));
		setBounds(100, 100, 450, 262);
		getContentPane().setLayout(new BorderLayout());
		contentPanel.setBorder(new EmptyBorder(5, 5, 5, 5));
		getContentPane().add(contentPanel, BorderLayout.CENTER);
		contentPanel.setLayout(null);
		
		JLabel lblBiopsia = new JLabel("Biopsia: " + codigoBiopsia);
		lblBiopsia.setFont(new Font("Tahoma", Font.BOLD, 12));
		lblBiopsia.setBounds(10, 11, 149, 23);
		contentPanel.add(lblBiopsia);
		
		JLabel lblNewLabel = new JLabel("Cassete: " + cassete);
		lblNewLabel.setFont(new Font("Tahoma", Font.BOLD, 12));
		lblNewLabel.setBounds(10, 40, 128, 23);
		contentPanel.add(lblNewLabel);
		
		JLabel lblBloque = new JLabel("Bloque:");
		lblBloque.setFont(new Font("Tahoma", Font.BOLD, 12));
		lblBloque.setBounds(10, 65, 64, 23);
		contentPanel.add(lblBloque);
		
		cBoxBloque = new JComboBox();
		for(int i = 0; i < bloques; i++){
			cBoxBloque.addItem(i + 1);
		}
		cBoxBloque.setBounds(84, 65, 75, 20);
		contentPanel.add(cBoxBloque);
		
		JLabel lblLaminas = new JLabel("Laminas:");
		lblLaminas.setFont(new Font("Tahoma", Font.BOLD, 12));
		lblLaminas.setBounds(10, 95, 64, 23);
		contentPanel.add(lblLaminas);
		
		rBtnTodas = new JRadioButton("Todas (" + maxLaminas + ")");
		rBtnTodas.setSelected(true);
		rBtnTodas.setFont(new Font("Tahoma", Font.PLAIN, 12));
		rBtnTodas.setBounds(33, 125, 149, 23);
		contentPanel.add(rBtnTodas);
		
		rBtnEspecificas = new JRadioButton("Especificas");
		rBtnEspecificas.setFont(new Font("Tahoma", Font.PLAIN, 12));
		rBtnEspecificas.setBounds(33, 151, 105, 23);
		contentPanel.add(rBtnEspecificas);
		
		CustomHistologiaPrintDialogOperations listener = new CustomHistologiaPrintDialogOperations(this);
		
		txtLaminas = new JTextField();
		txtLaminas.setBounds(144, 151, 154, 20);
		txtLaminas.setColumns(10);
		txtLaminas.addKeyListener(listener);
		txtLaminas.addFocusListener(listener);
		txtLaminas.setName(CustomHistologiaPrintDialogOperations.ACTION_COMMAND_TXT_LAMINAS);
		contentPanel.add(txtLaminas);
		
		ButtonGroup btnGroup = new ButtonGroup();
		btnGroup.add(rBtnTodas);
		btnGroup.add(rBtnEspecificas);
		
		{
			JPanel buttonPane = new JPanel();
			buttonPane.setLayout(new FlowLayout(FlowLayout.RIGHT));
			getContentPane().add(buttonPane, BorderLayout.SOUTH);
			{
				JButton okButton = new JButton("Imprimir");
				okButton.setFont(new Font("Tahoma", Font.PLAIN, 12));
				okButton.setActionCommand(CustomHistologiaPrintDialogOperations.ACTION_COMMAND_OK);
				okButton.addActionListener(listener);
				buttonPane.add(okButton);
				getRootPane().setDefaultButton(okButton);
			}
			{
				JButton cancelButton = new JButton("Cerrar");
				cancelButton.setFont(new Font("Tahoma", Font.PLAIN, 12));
				cancelButton.setActionCommand(CustomHistologiaPrintDialogOperations.ACTION_COMMAND_CANCEL);
				cancelButton.addActionListener(listener);
				buttonPane.add(cancelButton);
			}
		}
	}

	public JTextField getTxtLaminas() {
		return txtLaminas;
	}

	public JRadioButton getrBtnTodas() {
		return rBtnTodas;
	}

	public JRadioButton getrBtnEspecificas() {
		return rBtnEspecificas;
	}
	
	public String getCodigoBiopsia() {
		return codigoBiopsia;
	}
	
	public int getMaxLaminas() {
		return maxLaminas;
	}
	
	public int getCassete() {
		return cassete;
	}
	
	public JComboBox getcBoxBloque(){
		return cBoxBloque;
	}
}
