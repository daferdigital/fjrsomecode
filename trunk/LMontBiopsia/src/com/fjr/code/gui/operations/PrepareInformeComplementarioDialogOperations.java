package com.fjr.code.gui.operations;

import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

import javax.swing.JOptionPane;

import org.apache.log4j.Logger;

import com.fjr.code.dao.BiopsiaInfoDAO;
import com.fjr.code.dto.BiopsiaInfoDTO;
import com.fjr.code.gui.PrepareInformeComplementarioDialog;
import com.fjr.code.pdf.BiopsiaDiagnosticoComplementario;

/**
 * 
 * Class: PrepareInformeComplementarioDialogOperations
 * Creation Date: 13/10/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class PrepareInformeComplementarioDialogOperations implements ActionListener{
	public static final Logger log = Logger.getLogger(PrepareInformeComplementarioDialogOperations.class);
	
	public static final String ACTION_COMMAND_BTN_VISUALIZAR = "btnVisualizar";
	public static final String ACTION_COMMAND_BTN_MARCAR_COMO_IMPRESO = "btnMarkAsPrint";
	public static final String ACTION_COMMAND_BTN_CANCELAR = "btnCancelar";
	
	private PrepareInformeComplementarioDialog ventana;
	
	/**
	 * 
	 * @param ventana
	 */
	public PrepareInformeComplementarioDialogOperations(PrepareInformeComplementarioDialog ventana) {
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
			BiopsiaInfoDTO biopsia = BiopsiaInfoDAO.getBiopsiaById(
					ventana.getIdBiopsia());
			
			//vemos el tipo de estudio para proceder al armado del informe respectivo
			BiopsiaDiagnosticoComplementario diagnosticoComplemantario = new BiopsiaDiagnosticoComplementario(biopsia, 
					ventana.getcBoxFirmante1().getSelectedItem().toString(), 
					ventana.getcBoxFirmante2().getSelectedItem().toString(), 
					ventana.getTxtADiagnostico().getText(), 
					ventana.getTxtAComentarios().getText());
			
			try {
				diagnosticoComplemantario.buildDiagnostico();
				diagnosticoComplemantario.open();
			} catch (Throwable e1) {
				// TODO: handle exception
				JOptionPane.showMessageDialog(null, e1.getLocalizedMessage(), 
						"Error abriendo Diagnostico Complementario", 
						JOptionPane.ERROR_MESSAGE);
				e1.printStackTrace();
			}
			
			ventana.getBtnVisualizar().setVisible(false);
			ventana.getBtnMarkAsPrint().setVisible(true);
		} else if (ACTION_COMMAND_BTN_MARCAR_COMO_IMPRESO.equals(e.getActionCommand())) {
			BiopsiaInfoDTO biopsia = BiopsiaInfoDAO.getBiopsiaById(
					ventana.getIdBiopsia());
			if(BiopsiaInfoDAO.storeDiagnosticoComplementarioBLob(biopsia)){
				JOptionPane.showMessageDialog(ventana, 
						"El Informe Complementario fue almacenado en el sistema.", 
						"Operación Realizada", 
						JOptionPane.INFORMATION_MESSAGE);
				
				ventana.setVisible(false);
				ventana.dispose();
			} else {
				JOptionPane.showMessageDialog(ventana, 
						"El Informe Complementario NO pudo ser almacenado en el sistema.", 
						"Operación NO Realizada", 
						JOptionPane.ERROR_MESSAGE);
			}
		}
	}
}
