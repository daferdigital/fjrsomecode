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
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import javax.swing.JScrollPane;

/**
 * 
 * Class: SimpleTextEditorDialog
 * Creation Date: 13/10/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class SimpleTextEditorDialog extends JDialog implements ActionListener{
	
	/**
	 * 
	 */
	private static final long serialVersionUID = -1624841233959939114L;
	
	private static final String ACTION_COMMAND_OK = "Ok";
	private static final String ACTION_COMMAND_CANCEL = "Cancel";
	
	private final JPanel contentPanel = new JPanel();
	private JTextArea referencia;
	private JTextArea txtArea;
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
		setBounds(100, 100, 700, 500);
		getContentPane().setLayout(new BorderLayout());
		contentPanel.setBorder(new EmptyBorder(5, 5, 5, 5));
		getContentPane().add(contentPanel, BorderLayout.CENTER);
		contentPanel.setLayout(null);
		
		JScrollPane scrollPane = new JScrollPane();
		scrollPane.setBounds(10, 11, 672, 416);
		contentPanel.add(scrollPane);
		
		txtArea = new JTextArea();
		txtArea.setWrapStyleWord(true);
		txtArea.setLineWrap(true);
		scrollPane.setViewportView(txtArea);
		txtArea.setText(referencia.getText());
		{
			JPanel buttonPane = new JPanel();
			buttonPane.setLayout(new FlowLayout(FlowLayout.RIGHT));
			getContentPane().add(buttonPane, BorderLayout.SOUTH);
			{
				JButton okButton = new JButton(ACTION_COMMAND_OK);
				okButton.setFont(new Font("Tahoma", Font.PLAIN, 12));
				okButton.setActionCommand(ACTION_COMMAND_OK);
				okButton.addActionListener(this);
				buttonPane.add(okButton);
				getRootPane().setDefaultButton(okButton);
			}
			{
				JButton cancelButton = new JButton("Cancel");
				cancelButton.setFont(new Font("Tahoma", Font.PLAIN, 12));
				cancelButton.setActionCommand(ACTION_COMMAND_CANCEL);
				cancelButton.addActionListener(this);
				buttonPane.add(cancelButton);
			}
		}
		
		setLocationRelativeTo(null);
	}

	@Override
	public void actionPerformed(ActionEvent arg0) {
		// TODO Auto-generated method stub
		if(ACTION_COMMAND_OK.equals(arg0.getActionCommand())){
			referencia.setText(txtArea.getText());
		}
		
		this.setVisible(false);
		this.dispose();
	}
}
