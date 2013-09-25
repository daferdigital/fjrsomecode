package com.fjr.code.gui.operations;

import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

import javax.swing.JOptionPane;

import com.fjr.code.gui.LicenseDialog;
import com.fjr.code.util.LicenseUtil;

/**
 * 
 * Class: LicenseDialogOperations
 * Creation Date: 24/09/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class LicenseDialogOperations implements ActionListener{
	public static final String ACTION_COMMAND_BTN_VALIDAR_LICENCIA = "btnValidarLicencia";
	public static final String ACTION_COMMAND_BTN_CANCEL = "btnCancel";
	
	private LicenseDialog ventana;
	
	/**
	 * 
	 * @param ventana
	 */
	public LicenseDialogOperations(LicenseDialog ventana) {
		// TODO Auto-generated constructor stub
		this.ventana = ventana;
	}

	@Override
	public void actionPerformed(ActionEvent e) {
		// TODO Auto-generated method stub
		if(ACTION_COMMAND_BTN_VALIDAR_LICENCIA.equals(e.getActionCommand())){
			//validamos el valor del serial
			if("".equals(ventana.getTextFieldSerial().getText())){
				JOptionPane.showMessageDialog(ventana, 
						"El valor del Serial es requerido para activar la licencia.", 
						"Faltan Datos", 
						JOptionPane.ERROR_MESSAGE);
			} else {
				LicenseUtil.writeLicenseFile(ventana.getTextFieldSerial().getText());
				if(LicenseUtil.isValidLicense()){
					//validamos la licencia, debemos proseguir con la configuracion de la base de datos.
					JOptionPane.showMessageDialog(ventana,
							"Licencia activada de manera exitosa", 
							"Activación Completada", 
							JOptionPane.INFORMATION_MESSAGE);
				} else {
					JOptionPane.showMessageDialog(ventana, 
							"La licencia es invalida, verifique o solicitela nuevamente.", 
							"Licencia Invalida", 
							JOptionPane.ERROR_MESSAGE);
				}
			}
		} else {
			ventana.dispose();
		}
	}
}
