package com.fjr.code.gui;

import java.awt.BorderLayout;
import java.awt.Desktop;
import java.awt.FlowLayout;

import javax.swing.JButton;
import javax.swing.JDialog;
import javax.swing.JOptionPane;
import javax.swing.JPanel;
import javax.swing.border.EmptyBorder;
import java.awt.Toolkit;
import java.awt.Font;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.io.File;
import java.io.IOException;

import javax.swing.JLabel;

import com.fjr.code.util.SecurityEditCode;

/**
 * 
 * Class: InformeImpresoDialog
 * Creation Date: 22/03/2014
 * (c) 2014
 *
 * @author T&T
 *
 */
public class InformeImpresoDialog extends JDialog implements ActionListener{
	/**
	 * 
	 */
	private static final long serialVersionUID = 6529844693961901098L;
	
	private static final String ACTION_COMMAND_REIMPRIMIR = "reImprimir";
	private static final String ACTION_COMMAND_EDITAR = "editar";
	
	private final JPanel contentPanel = new JPanel();
	private String pathToDiagnostico;
	private String codigoBiopsia;
	
	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		try {
			InformeImpresoDialog dialog = new InformeImpresoDialog(null, null);
			dialog.setDefaultCloseOperation(JDialog.DISPOSE_ON_CLOSE);
			dialog.setVisible(true);
		} catch (Exception e) {
			e.printStackTrace();
		}
	}

	/**
	 * Create the dialog.
	 */
	public InformeImpresoDialog(String pathToDiagnostico, String codigoBiopsia) {
		this.pathToDiagnostico = pathToDiagnostico;
		this.codigoBiopsia = codigoBiopsia;
		
		setDefaultCloseOperation(JDialog.DISPOSE_ON_CLOSE);
		setTitle("Indique su operaci\u00F3n");
		setModal(true);
		setIconImage(Toolkit.getDefaultToolkit().getImage(InformeImpresoDialog.class.getResource("/resources/images/iconLogo1.jpg")));
		setBounds(100, 100, 450, 190);
		getContentPane().setLayout(new BorderLayout());
		contentPanel.setBorder(new EmptyBorder(5, 5, 5, 5));
		getContentPane().add(contentPanel, BorderLayout.CENTER);
		contentPanel.setLayout(null);
		{
			JLabel lblNewLabel = new JLabel("<html>Si desea imprimir nuevamente el informe de esta biopsia, presione el bot&oacute;n de <b>Reimprimir</b><br /><br />Si por el contrario desea crear un nuevo informe para esta biopsia, por favor haga click en el bot&oacute;n de <b>Editar</b></html>");
			lblNewLabel.setFont(new Font("Tahoma", Font.PLAIN, 13));
			lblNewLabel.setBounds(10, 11, 414, 102);
			contentPanel.add(lblNewLabel);
		}
		{
			JPanel buttonPane = new JPanel();
			buttonPane.setLayout(new FlowLayout(FlowLayout.RIGHT));
			getContentPane().add(buttonPane, BorderLayout.SOUTH);
			{
				JButton okButton = new JButton("Reimprimir");
				okButton.setFont(new Font("Tahoma", Font.PLAIN, 12));
				okButton.setActionCommand(ACTION_COMMAND_REIMPRIMIR);
				okButton.addActionListener(this);
				buttonPane.add(okButton);
				getRootPane().setDefaultButton(okButton);
			}
			{
				JButton cancelButton = new JButton("Editar");
				cancelButton.setFont(new Font("Tahoma", Font.PLAIN, 12));
				cancelButton.setActionCommand(ACTION_COMMAND_EDITAR);
				cancelButton.addActionListener(this);
				buttonPane.add(cancelButton);
			}
		}
		
		setLocationRelativeTo(null);
	}

	@Override
	public void actionPerformed(ActionEvent e) {
		// TODO Auto-generated method stub
		if(ACTION_COMMAND_REIMPRIMIR.equals(e.getActionCommand())){
			//se va a reimprimir el informe
			try {
				Desktop.getDesktop().open(new File(this.pathToDiagnostico));
				this.setVisible(false);
				this.dispose();
			} catch (IOException ioe) {
				// TODO Auto-generated catch block
				ioe.printStackTrace();
			}
		} else if(ACTION_COMMAND_EDITAR.equals(e.getActionCommand())){
			//se desea editar de nuevo la biopsia
			//se solicita la clave y de ser valida se procede a editar
			String editKey = JOptionPane.showInputDialog(null, 
					"Disculpe, esta operación requiere permisos especiales.\nSi desea editar el diagnostico debe introducir la clave de edición.", 
					"Indique la clave para edición", 
					JOptionPane.QUESTION_MESSAGE);
			if(SecurityEditCode.checkIfValueIsTheSecurityCode(editKey)){
				this.setVisible(false);
				this.dispose();
				new PrepareDiagnosticoDialog(this.codigoBiopsia).setVisible(true);
			} else {
				JOptionPane.showMessageDialog(null, "Clave incorrecta", "Clave incorrecta", JOptionPane.ERROR_MESSAGE);
			}
		}
	}
}
