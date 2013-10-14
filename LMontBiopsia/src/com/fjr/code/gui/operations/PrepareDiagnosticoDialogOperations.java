package com.fjr.code.gui.operations;

import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

import com.fjr.code.dao.BiopsiaInfoDAO;
import com.fjr.code.gui.PrepareDiagnosticoDialog;
import com.fjr.code.pdf.BiopsiaDiagnostico;

/**
 * 
 * Class: PrepareDiagnosticoDialogOperations
 * Creation Date: 13/10/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class PrepareDiagnosticoDialogOperations implements ActionListener{
	public static final String ACTION_COMMAND_BTN_VISUALIZAR = "btnVisualizar";
	public static final String ACTION_COMMAND_BTN_MARCAR_COMO_IMPRESO = "btnMarkAsPrint";
	public static final String ACTION_COMMAND_BTN_CANCELAR = "btnCancelar";
	
	private PrepareDiagnosticoDialog ventana;
	
	/**
	 * 
	 * @param ventana
	 */
	public PrepareDiagnosticoDialogOperations(PrepareDiagnosticoDialog ventana) {
		// TODO Auto-generated constructor stub
		this.ventana = ventana;
	}
	
	@Override
	public void actionPerformed(ActionEvent e) {
		// TODO Auto-generated method stub
		if(ACTION_COMMAND_BTN_CANCELAR.equals(e.getActionCommand())){
			ventana.setVisible(false);
			ventana.dispose();
		} else if (ACTION_COMMAND_BTN_VISUALIZAR.equals(e.getActionCommand())) {
			BiopsiaDiagnostico diagnostico = new BiopsiaDiagnostico(
					BiopsiaInfoDAO.getBiopsiaByNumero(ventana.getCodigoBiopsia()),
					ventana.getcBoxFirmante1().getSelectedItem().toString(),
					ventana.getcBoxFirmante2().getSelectedItem().toString());
			diagnostico.buildDiagnostico();
			diagnostico.open();
		}
	}
}
