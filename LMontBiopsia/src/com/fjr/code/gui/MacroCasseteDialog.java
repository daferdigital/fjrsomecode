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
import javax.swing.JScrollPane;
import javax.swing.JTextArea;
import javax.swing.border.LineBorder;

import com.fjr.code.gui.operations.MacroCasseteDialogOperations;
import com.fjr.code.gui.tables.JTableMacroCassetes;

import java.awt.Color;

/**
 * 
 * Class: MacroCasseteDialog
 * Creation Date: 08/09/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class MacroCasseteDialog extends JDialog {

	/**
	 * 
	 */
	private static final long serialVersionUID = -5322307343213510295L;
	
	private JTableMacroCassetes relatedTable;
	private final JPanel contentPanel = new JPanel();
	private JTextArea textADescCassete;
	private int rowOrigin = -1;
	
	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		try {
			MacroCasseteDialog dialog = new MacroCasseteDialog(null, "", -1);
			dialog.setDefaultCloseOperation(JDialog.DISPOSE_ON_CLOSE);
			dialog.setVisible(true);
		} catch (Exception e) {
			e.printStackTrace();
		}
	}

	/**
	 * Creamos el dialogo
	 * 
	 * @param relatedTable
	 * @param descripcion
	 */
	public MacroCasseteDialog(JTableMacroCassetes relatedTable, String descripcion,
			int rowOrigin) {
		this.relatedTable = relatedTable;
		this.rowOrigin = rowOrigin;
		
		setDefaultCloseOperation(JDialog.DISPOSE_ON_CLOSE);
		setResizable(false);
		setModal(true);
		setTitle("Agregar Cassete");
		setIconImage(Toolkit.getDefaultToolkit().getImage(MacroCasseteDialog.class.getResource("/resources/images/iconLogo1.jpg")));
		setBounds(100, 100, 421, 236);
		getContentPane().setLayout(new BorderLayout());
		contentPanel.setBorder(new EmptyBorder(5, 5, 5, 5));
		getContentPane().add(contentPanel, BorderLayout.CENTER);
		contentPanel.setLayout(null);
		
		JLabel lblNewLabel = new JLabel("<html>Descripci&oacute;n del Cassete:</html>");
		lblNewLabel.setFont(new Font("Tahoma", Font.BOLD, 13));
		lblNewLabel.setBounds(10, 29, 107, 32);
		contentPanel.add(lblNewLabel);
		
		JScrollPane scrollPane = new JScrollPane();
		scrollPane.setBounds(127, 26, 278, 133);
		contentPanel.add(scrollPane);
		
		textADescCassete = new JTextArea();
		textADescCassete.setBorder(new LineBorder(new Color(0, 0, 0)));
		textADescCassete.setLineWrap(true);
		textADescCassete.setWrapStyleWord(true);
		textADescCassete.setBounds(127, 26, 278, 133);
		textADescCassete.setText(descripcion);
		scrollPane.setViewportView(textADescCassete);
		
		JPanel buttonPane = new JPanel();
		buttonPane.setLayout(new FlowLayout(FlowLayout.RIGHT));
		getContentPane().add(buttonPane, BorderLayout.SOUTH);
		
		JButton okButton = new JButton("Aceptar");
		okButton.setFont(new Font("Tahoma", Font.PLAIN, 13));
		okButton.setActionCommand(MacroCasseteDialogOperations.ACTION_COMMAND_BTN_ACEPTAR);
		buttonPane.add(okButton);
		getRootPane().setDefaultButton(okButton);
		
		JButton cancelButton = new JButton("Cancelar");
		cancelButton.setFont(new Font("Tahoma", Font.PLAIN, 13));
		cancelButton.setActionCommand(MacroCasseteDialogOperations.ACTION_COMMAND_BTN_CANCELAR);
		buttonPane.add(cancelButton);
		
		MacroCasseteDialogOperations listener = new MacroCasseteDialogOperations(this);
		okButton.addActionListener(listener);
		cancelButton.addActionListener(listener);
		
		this.setLocationRelativeTo(null);
	}
	
	/**
	 * 
	 * @return
	 */
	public JTextArea getTextADescCassete(){
		return textADescCassete;
	}
	
	public JTableMacroCassetes getRelatedTable() {
		return relatedTable;
	}
	
	public int getRowOrigin() {
		return rowOrigin;
	}
}
