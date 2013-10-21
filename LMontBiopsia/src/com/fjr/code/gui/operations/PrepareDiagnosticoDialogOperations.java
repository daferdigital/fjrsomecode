package com.fjr.code.gui.operations;

import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

import javax.swing.JOptionPane;

import com.fjr.code.dao.BiopsiaFotosMacroDAO;
import com.fjr.code.dao.BiopsiaInfoDAO;
import com.fjr.code.dao.definitions.FasesBiopsia;
import com.fjr.code.dto.BiopsiaInfoDTO;
import com.fjr.code.gui.DiagnosticoWizardDialog;
import com.fjr.code.gui.PrepareDiagnosticoDialog;

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
			BiopsiaInfoDTO biopsia = BiopsiaInfoDAO.getBiopsiaByNumero(
					ventana.getCodigoBiopsia());
			BiopsiaFotosMacroDAO.setMacroFotos(biopsia);
			
			DiagnosticoWizardDialog wizard = new DiagnosticoWizardDialog(biopsia,
					ventana.getcBoxFirmante1().getSelectedItem().toString(),
					ventana.getcBoxFirmante2().getSelectedItem().toString());
			wizard.setVisible(true);
			
			ventana.getBtnVisualizar().setVisible(false);
			ventana.getBtnMarkAsPrint().setVisible(true);
		} else if (ACTION_COMMAND_BTN_MARCAR_COMO_IMPRESO.equals(e.getActionCommand())) {
			BiopsiaInfoDTO biopsia = BiopsiaInfoDAO.getBiopsiaByNumero(
					ventana.getCodigoBiopsia());
			if(BiopsiaInfoDAO.moveBiopsiaToFase(biopsia, FasesBiopsia.INFORME_IMPRESO)){
				JOptionPane.showMessageDialog(ventana, 
						"La biopsia " + ventana.getCodigoBiopsia() + " fue llevada a la fase de "
						+ FasesBiopsia.INFORME_IMPRESO.getNombreFase(), 
						"Operación Realizada", JOptionPane.INFORMATION_MESSAGE);
			} else {
				JOptionPane.showMessageDialog(ventana, 
						"La biopsia " + ventana.getCodigoBiopsia() + " no pude ser llevada a la fase de "
						+ FasesBiopsia.INFORME_IMPRESO.getNombreFase(), 
						"Operación NO Realizada", JOptionPane.ERROR_MESSAGE);
			}
		}
	}
}
