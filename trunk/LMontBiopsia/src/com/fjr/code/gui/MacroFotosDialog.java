package com.fjr.code.gui;

import java.awt.BorderLayout;
import java.awt.Color;
import java.awt.FlowLayout;

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

import com.fjr.code.gui.operations.MacroFotosDialogOperations;

public class MacroFotosDialog extends JDialog {

	/**
	 * 
	 */
	private static final long serialVersionUID = 61608993038820456L;
	
	private final JPanel contentPanel = new JPanel();
	private JScrollPane scrollPane;
	private JFileChooser fileChooser;
	
	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		try {
			MacroFotosDialog dialog = new MacroFotosDialog();
			dialog.setDefaultCloseOperation(JDialog.DISPOSE_ON_CLOSE);
			dialog.setVisible(true);
		} catch (Exception e) {
			e.printStackTrace();
		}
	}

	/**
	 * Create the dialog.
	 */
	public MacroFotosDialog() {
		setTitle("Fotos Macro");
		setIconImage(Toolkit.getDefaultToolkit().getImage(MacroFotosDialog.class.getResource("/resources/images/iconLogo1.jpg")));
		setBounds(100, 100, 450, 415);
		getContentPane().setLayout(new BorderLayout());
		contentPanel.setBorder(new EmptyBorder(5, 5, 5, 5));
		getContentPane().add(contentPanel, BorderLayout.CENTER);
		contentPanel.setLayout(null);
		{
			JLabel lblNewLabel = new JLabel("<html>Descripci&oacute;n de la foto</html>");
			lblNewLabel.setFont(new Font("Tahoma", Font.BOLD, 13));
			lblNewLabel.setBounds(10, 29, 120, 32);
			contentPanel.add(lblNewLabel);
		}

		scrollPane = new JScrollPane();
		scrollPane.setBounds(127, 26, 278, 133);
		contentPanel.add(scrollPane);
		
		JTextArea textArea = new JTextArea();
		textArea.setBorder(new LineBorder(new Color(0, 0, 0)));
		textArea.setLineWrap(true);
		textArea.setWrapStyleWord(true);
		textArea.setBounds(127, 26, 278, 133);
		scrollPane.setViewportView(textArea);
		
		JButton btnSubirFoto = new JButton("Subir Foto");
		btnSubirFoto.setFont(new Font("Tahoma", Font.PLAIN, 13));
		btnSubirFoto.setBounds(10, 195, 101, 23);
		btnSubirFoto.setActionCommand(MacroFotosDialogOperations.ACTION_COMMAND_BTN_SUBIR_FOTO);
		contentPanel.add(btnSubirFoto);
		
		JPanel buttonPane = new JPanel();
		buttonPane.setLayout(new FlowLayout(FlowLayout.RIGHT));
		getContentPane().add(buttonPane, BorderLayout.SOUTH);
		
		JButton okButton = new JButton("OK");
		okButton.setFont(new Font("Tahoma", Font.PLAIN, 13));
		okButton.setActionCommand("OK");
		buttonPane.add(okButton);
		getRootPane().setDefaultButton(okButton);
		
		JButton cancelButton = new JButton("Cancelar");
		cancelButton.setFont(new Font("Tahoma", Font.PLAIN, 13));
		cancelButton.setActionCommand("Cancel");
		buttonPane.add(cancelButton);
		
		fileChooser = new JFileChooser();
		MacroFotosDialogOperations listener = new MacroFotosDialogOperations(this);
		
		btnSubirFoto.addActionListener(listener);
	}
	
	public JFileChooser getFileChooser() {
		return fileChooser;
	}
}
