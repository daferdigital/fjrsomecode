package com.fjr.code.gui.operations;

import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

import javax.swing.JOptionPane;

import org.apache.log4j.Logger;

import com.fjr.code.dao.BiopsiaFotosMacroDAO;
import com.fjr.code.dao.BiopsiaInfoDAO;
import com.fjr.code.dao.definitions.FasesBiopsia;
import com.fjr.code.dao.definitions.TipoEstudioEnum;
import com.fjr.code.dto.BiopsiaInfoDTO;
import com.fjr.code.gui.AppWindow;
import com.fjr.code.gui.DiagnosticoWizardDialog;
import com.fjr.code.gui.IngresoPanel;
import com.fjr.code.gui.PrepareDiagnosticoDialog;
import com.fjr.code.pdf.BiopsiaDiagnosticoCISH;
import com.fjr.code.pdf.BiopsiaDiagnosticoCitologia;

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
	public static final Logger log = Logger.getLogger(PrepareDiagnosticoDialogOperations.class);
	
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
			
			//vemos el tipo de estudio para proceder al armado del informe respectivo
			log.info(biopsia.getIdTipoEstudio());
			if(biopsia.getIdTipoEstudio() == TipoEstudioEnum.CISH.getId()){
				log.info("La biopsia '" + biopsia.getCodigo() + "' SI es del tipo CISH");
				BiopsiaDiagnosticoCISH diagnostico = new BiopsiaDiagnosticoCISH(
						biopsia,
						ventana.getcBoxFirmante1().getSelectedItem().toString(),
						ventana.getcBoxFirmante2().getSelectedItem().toString());
				
				try {
					diagnostico.buildDiagnostico();
					diagnostico.open();
				} catch (Throwable e1) {
					// TODO: handle exception
					JOptionPane.showMessageDialog(null, e1.getLocalizedMessage(), 
							"Error abriendo diagnostico", 
							JOptionPane.ERROR_MESSAGE);
					e1.printStackTrace();
				}
			} else if(biopsia.getIdTipoEstudio() == TipoEstudioEnum.CITOLOGIA.getId()){
				log.info("La biopsia '" + biopsia.getCodigo() + "' es una Citologia");
				BiopsiaDiagnosticoCitologia diagnostico = new BiopsiaDiagnosticoCitologia(
						biopsia,
						ventana.getcBoxFirmante1().getSelectedItem().toString(),
						ventana.getcBoxFirmante2().getSelectedItem().toString());
								
				try {
					diagnostico.buildDiagnostico();
					diagnostico.open();
				} catch (Throwable e1) {
					// TODO: handle exception
					JOptionPane.showMessageDialog(null, e1.getLocalizedMessage(), 
							"Error abriendo diagnostico", 
							JOptionPane.ERROR_MESSAGE);
					e1.printStackTrace();
				}
			} else {
				log.info("La biopsia '" + biopsia.getCodigo() + "' NO es del tipo CISH ni  es una Citologia");
				BiopsiaFotosMacroDAO.setMacroFotos(biopsia);
				
				DiagnosticoWizardDialog wizard = new DiagnosticoWizardDialog(biopsia,
						ventana.getcBoxFirmante1().getSelectedItem().toString(),
						ventana.getcBoxFirmante2().getSelectedItem().toString());
				wizard.setVisible(true);
			}
			
			ventana.getBtnVisualizar().setVisible(false);
			ventana.getBtnMarkAsPrint().setVisible(true);
		} else if (ACTION_COMMAND_BTN_MARCAR_COMO_IMPRESO.equals(e.getActionCommand())) {
			BiopsiaInfoDTO biopsia = BiopsiaInfoDAO.getBiopsiaByNumero(
					ventana.getCodigoBiopsia());
			if(BiopsiaInfoDAO.moveBiopsiaToFase(biopsia, FasesBiopsia.INFORME_IMPRESO)){
				//guardamos el informe actual en la base de datos, para futuras consultas
				BiopsiaInfoDAO.storeDiagnosticoBLob(biopsia);
				JOptionPane.showMessageDialog(ventana, 
						"La biopsia " + ventana.getCodigoBiopsia() + " fue llevada a la fase de "
						+ FasesBiopsia.INFORME_IMPRESO.getNombreFase(), 
						"Operación Realizada", JOptionPane.INFORMATION_MESSAGE);
				
				log.info(AppWindow.getInstance().getPanelContenido().getClass().getName());
				if(AppWindow.getInstance().getPanelContenido() instanceof IngresoPanel){
					//debemos actualizar la lista de biopsias para impresion
					//asi se eliminara de ese listado la que acaba de marcarse como impresa
					 IngresoPanel panel = (IngresoPanel) AppWindow.getInstance().getPanelContenido();
					 panel.reloadTables();
				}
				ventana.setVisible(false);
				ventana.dispose();
			} else {
				JOptionPane.showMessageDialog(ventana, 
						"La biopsia " + ventana.getCodigoBiopsia() + " no pude ser llevada a la fase de "
						+ FasesBiopsia.INFORME_IMPRESO.getNombreFase(), 
						"Operación NO Realizada", JOptionPane.ERROR_MESSAGE);
			}
		}
	}
}
