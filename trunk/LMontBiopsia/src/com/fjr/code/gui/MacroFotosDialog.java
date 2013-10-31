package com.fjr.code.gui;

import java.awt.BorderLayout;
import java.awt.Color;
import java.awt.FlowLayout;
import java.awt.Image;

import javax.swing.Icon;
import javax.swing.ImageIcon;
import javax.swing.JButton;
import javax.swing.JDialog;
import javax.swing.JFileChooser;
import javax.swing.JPanel;
import javax.swing.border.EmptyBorder;
import javax.swing.border.LineBorder;

import java.awt.Toolkit;
import java.awt.Font;
import javax.swing.JLabel;
import javax.swing.JScrollPane;
import javax.swing.JTextArea;

import com.fjr.code.gui.operations.ListenerDobleClickTextArea;
import com.fjr.code.gui.operations.MacroFotosDialogOperations;
import com.fjr.code.gui.tables.JTableMacroFotos;
import javax.swing.JTextField;
import javax.swing.JCheckBox;

public class MacroFotosDialog extends JDialog {

	/**
	 * 
	 */
	private static final long serialVersionUID = 61608993038820456L;
	
	private final JPanel contentPanel = new JPanel();
	private JScrollPane scrollPane;
	private JFileChooser fileChooser;
	private JLabel lblFoto;
	private JTextField txtNotacion;
	private JTextArea textADescripcion;
	private JTableMacroFotos relatedTable;
	private int rowOrigin;
	private String pathToPicture;
	private JCheckBox chkBoxFotoPerOperatoria;
	
	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		try {
			MacroFotosDialog dialog = new MacroFotosDialog(null, "", "", -1, "", true);
			dialog.setDefaultCloseOperation(JDialog.DISPOSE_ON_CLOSE);
			dialog.setVisible(true);
		} catch (Exception e) {
			e.printStackTrace();
		}
	}

	/**
	 * 
	 * @param relatedTable
	 * @param notacion
	 * @param descripcion
	 * @param rowOrigin
	 * @param pathToPicture
	 */
	public MacroFotosDialog(JTableMacroFotos relatedTable, String notacion,
			String descripcion, int rowOrigin, String pathToPicture, boolean fotoPerOperatoria) {
		this.relatedTable = relatedTable;
		this.rowOrigin = rowOrigin;
		this.pathToPicture = pathToPicture;
		
		setTitle("Fotos Macro");
		setModal(true);
		setIconImage(Toolkit.getDefaultToolkit().getImage(MacroFotosDialog.class.getResource("/resources/images/iconLogo1.jpg")));
		setBounds(100, 100, 450, 503);
		getContentPane().setLayout(new BorderLayout());
		contentPanel.setBorder(new EmptyBorder(5, 5, 5, 5));
		getContentPane().add(contentPanel, BorderLayout.CENTER);
		contentPanel.setLayout(null);
		
		JLabel lblNotacion = new JLabel("<html>Observaci&oacute;n</html>");
		lblNotacion.setFont(new Font("Tahoma", Font.BOLD, 13));
		lblNotacion.setBounds(10, 25, 89, 14);
		contentPanel.add(lblNotacion);
		
		txtNotacion = new JTextField();
		txtNotacion.setBounds(127, 23, 278, 20);
		txtNotacion.setText(notacion);
		contentPanel.add(txtNotacion);
		txtNotacion.setColumns(10);
		
		
		JLabel lblNewLabel = new JLabel("<html>Descripci&oacute;n <br />Macro fotograf&iacute;a</html>");
		lblNewLabel.setFont(new Font("Tahoma", Font.BOLD, 13));
		lblNewLabel.setBounds(10, 87, 120, 32);
		contentPanel.add(lblNewLabel);
		
		scrollPane = new JScrollPane();
		scrollPane.setBounds(127, 84, 278, 133);
		contentPanel.add(scrollPane);
		
		textADescripcion = new JTextArea();
		textADescripcion.setBorder(new LineBorder(new Color(0, 0, 0)));
		textADescripcion.setLineWrap(true);
		textADescripcion.setWrapStyleWord(true);
		textADescripcion.setBounds(127, 26, 278, 133);
		textADescripcion.setText(descripcion);
		textADescripcion.addMouseListener(new ListenerDobleClickTextArea(textADescripcion));
		scrollPane.setViewportView(textADescripcion);
		
		JButton btnSubirFoto = new JButton("Subir Foto");
		btnSubirFoto.setFont(new Font("Tahoma", Font.PLAIN, 13));
		btnSubirFoto.setBounds(10, 228, 101, 23);
		btnSubirFoto.setActionCommand(MacroFotosDialogOperations.ACTION_COMMAND_BTN_SUBIR_FOTO);
		contentPanel.add(btnSubirFoto);
		
		lblFoto = new JLabel("");
		lblFoto.setBorder(new LineBorder(new Color(0, 0, 0)));
		lblFoto.setBounds(127, 233, 278, 186);
		if(! "".equals(pathToPicture)){
			Icon icon = new ImageIcon(new ImageIcon(pathToPicture).getImage().getScaledInstance(lblFoto.getWidth(),
					lblFoto.getHeight(),
					Image.SCALE_AREA_AVERAGING));
			lblFoto.setIcon(icon);
		}
		contentPanel.add(lblFoto);
		
		JLabel lblEsFotoPeroperatoria = new JLabel("Es foto Per-Operatoria?");
		lblEsFotoPeroperatoria.setFont(new Font("Tahoma", Font.BOLD, 13));
		lblEsFotoPeroperatoria.setBounds(10, 50, 163, 32);
		contentPanel.add(lblEsFotoPeroperatoria);
		
		chkBoxFotoPerOperatoria = new JCheckBox("");
		chkBoxFotoPerOperatoria.setEnabled(false);
		chkBoxFotoPerOperatoria.setBounds(167, 54, 27, 23);
		chkBoxFotoPerOperatoria.setSelected(fotoPerOperatoria);
		contentPanel.add(chkBoxFotoPerOperatoria);
		
		JPanel buttonPane = new JPanel();
		buttonPane.setLayout(new FlowLayout(FlowLayout.RIGHT));
		getContentPane().add(buttonPane, BorderLayout.SOUTH);
		
		JButton okButton = new JButton("OK");
		okButton.setFont(new Font("Tahoma", Font.PLAIN, 13));
		okButton.setActionCommand("OK");
		okButton.setActionCommand(MacroFotosDialogOperations.ACTION_COMMAND_BTN_GUARDAR);
		buttonPane.add(okButton);
		getRootPane().setDefaultButton(okButton);
		
		JButton cancelButton = new JButton("Cancelar");
		cancelButton.setFont(new Font("Tahoma", Font.PLAIN, 13));
		cancelButton.setActionCommand("Cancel");
		cancelButton.setActionCommand(MacroFotosDialogOperations.ACTION_COMMAND_BTN_CANCELAR);
		buttonPane.add(cancelButton);
		
		fileChooser = new JFileChooser();
		MacroFotosDialogOperations listener = new MacroFotosDialogOperations(this);
		
		btnSubirFoto.addActionListener(listener);
		okButton.addActionListener(listener);
		cancelButton.addActionListener(listener);
		
		this.setLocationRelativeTo(null);
		txtNotacion.requestFocusInWindow();
		
	}
	
	/**
	 * 
	 * @return
	 */
	public JFileChooser getFileChooser() {
		return fileChooser;
	}
	
	public JTableMacroFotos getRelatedTable() {
		return relatedTable;
	}
	
	public int getRowOrigin() {
		return rowOrigin;
	}
	
	public String getPathToPicture() {
		return pathToPicture;
	}
	
	public JTextField getTxtNotacion() {
		return txtNotacion;
	}
	
	public JTextArea getTextADescripcion() {
		return textADescripcion;
	}
	
	public JLabel getLblFoto() {
		return lblFoto;
	}
	
	public JCheckBox getChkBoxFotoPerOperatoria(){
		return chkBoxFotoPerOperatoria;
	}
}
