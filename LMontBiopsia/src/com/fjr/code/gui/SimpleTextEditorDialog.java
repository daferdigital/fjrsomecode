package com.fjr.code.gui;

import java.awt.BorderLayout;
import java.awt.FlowLayout;

import javax.swing.JButton;
import javax.swing.JDialog;
import javax.swing.JPanel;
import javax.swing.JTextArea;
import javax.swing.border.EmptyBorder;
import java.awt.Toolkit;
import java.awt.Font;
import javax.swing.JScrollPane;
import javax.swing.JLabel;
import javax.swing.JTextField;

import com.fjr.code.gui.operations.SimpleTextEditorDialogOperations;

/**
 * 
 * Class: SimpleTextEditorDialog
 * Creation Date: 13/10/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class SimpleTextEditorDialog extends JDialog{
	
	/**
	 * 
	 */
	private static final long serialVersionUID = -1624841233959939114L;
	
	private final JPanel contentPanel = new JPanel();
	private JTextArea referencia;
	private JTextArea txtArea;
	private JTextField textCodigo;
	private JTextField textAbreviatura;
	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		try {
			SimpleTextEditorDialog dialog = new SimpleTextEditorDialog(null);
			dialog.setDefaultCloseOperation(JDialog.DISPOSE_ON_CLOSE);
			dialog.setVisible(true);
		} catch (Exception e) {
			e.printStackTrace();
		}
	}

	/**
	 * Create the dialog.
	 */
	public SimpleTextEditorDialog(JTextArea referencia) {
		setModal(true);
		this.referencia = referencia;
		
		setTitle("Editor de texto simple");
		setDefaultCloseOperation(JDialog.DISPOSE_ON_CLOSE);
		setIconImage(Toolkit.getDefaultToolkit().getImage(SimpleTextEditorDialog.class.getResource("/resources/images/iconLogo1.jpg")));
		setBounds(100, 100, 700, 585);
		getContentPane().setLayout(new BorderLayout());
		contentPanel.setBorder(new EmptyBorder(5, 5, 5, 5));
		getContentPane().add(contentPanel, BorderLayout.CENTER);
		contentPanel.setLayout(null);
		
		JScrollPane scrollPane = new JScrollPane();
		scrollPane.setBounds(10, 68, 672, 416);
		contentPanel.add(scrollPane);
		
		txtArea = new JTextArea();
		txtArea.setWrapStyleWord(true);
		txtArea.setLineWrap(true);
		scrollPane.setViewportView(txtArea);
		txtArea.setText(referencia.getText());
		
		JLabel lblCdigo = new JLabel("C\u00F3digo:");
		lblCdigo.setFont(new Font("Tahoma", Font.BOLD, 13));
		lblCdigo.setBounds(10, 11, 88, 16);
		contentPanel.add(lblCdigo);
		
		JLabel lblAbreviatura = new JLabel("Abreviatura");
		lblAbreviatura.setFont(new Font("Tahoma", Font.BOLD, 13));
		lblAbreviatura.setBounds(10, 38, 88, 16);
		contentPanel.add(lblAbreviatura);
		
		textCodigo = new JTextField();
		textCodigo.setBounds(108, 7, 132, 20);
		contentPanel.add(textCodigo);
		textCodigo.setColumns(10);
		
		textAbreviatura = new JTextField();
		textAbreviatura.setColumns(10);
		textAbreviatura.setBounds(108, 37, 261, 20);
		contentPanel.add(textAbreviatura);
		
		SimpleTextEditorDialogOperations listener = new SimpleTextEditorDialogOperations(this);
		{
			JPanel buttonPane = new JPanel();
			buttonPane.setLayout(new FlowLayout(FlowLayout.RIGHT));
			getContentPane().add(buttonPane, BorderLayout.SOUTH);
			{
				JButton okButton = new JButton(SimpleTextEditorDialogOperations.ACTION_COMMAND_OK);
				okButton.setFont(new Font("Tahoma", Font.PLAIN, 12));
				okButton.setActionCommand(SimpleTextEditorDialogOperations.ACTION_COMMAND_OK);
				okButton.addActionListener(listener);
				buttonPane.add(okButton);
				getRootPane().setDefaultButton(okButton);
			}
			{
				JButton cancelButton = new JButton("Cancel");
				cancelButton.setFont(new Font("Tahoma", Font.PLAIN, 12));
				cancelButton.setActionCommand(SimpleTextEditorDialogOperations.ACTION_COMMAND_CANCEL);
				cancelButton.addActionListener(listener);
				
				JButton btnGuardar = new JButton("Guardar");
				btnGuardar.setFont(new Font("Tahoma", Font.PLAIN, 12));
				btnGuardar.setActionCommand(SimpleTextEditorDialogOperations.ACTION_COMMAND_GUARDAR);
				btnGuardar.addActionListener(listener);
				buttonPane.add(btnGuardar);
				
				JButton btnBuscar = new JButton("Buscar");
				btnBuscar.setFont(new Font("Tahoma", Font.PLAIN, 12));
				btnBuscar.setActionCommand(SimpleTextEditorDialogOperations.ACTION_COMMAND_BUSCAR);
				btnBuscar.addActionListener(listener);
				buttonPane.add(btnBuscar);
				buttonPane.add(cancelButton);
			}
		}
		
		setLocationRelativeTo(null);
	}

	public JTextArea getReferencia() {
		return referencia;
	}

	public void setReferencia(JTextArea referencia) {
		this.referencia = referencia;
	}

	public JTextArea getTxtArea() {
		return txtArea;
	}

	public void setTxtArea(JTextArea txtArea) {
		this.txtArea = txtArea;
	}

	public JTextField getTextCodigo() {
		return textCodigo;
	}

	public void setTextCodigo(JTextField textCodigo) {
		this.textCodigo = textCodigo;
	}

	public JTextField getTextAbreviatura() {
		return textAbreviatura;
	}

	public void setTextAbreviatura(JTextField textAbreviatura) {
		this.textAbreviatura = textAbreviatura;
	}
}
