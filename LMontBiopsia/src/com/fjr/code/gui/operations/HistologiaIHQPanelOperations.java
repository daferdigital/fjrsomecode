package com.fjr.code.gui.operations;

import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.KeyEvent;
import java.awt.event.KeyListener;

import javax.swing.JOptionPane;
import javax.swing.JTextField;

import org.apache.log4j.Logger;

import com.fjr.code.dao.BiopsiaMicroLaminasDAO;
import com.fjr.code.dao.definitions.FasesBiopsia;
import com.fjr.code.dto.BiopsiaInfoDTO;
import com.fjr.code.gui.HistologiaIHQPanel;
import com.fjr.code.util.GUIPressedOrTypedNroBiopsia;
import com.fjr.code.util.SecurityEditCode;

/**
 * 
 * Class: HistologiaIHQPanelOperations
 * Creation Date: 17/09/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class HistologiaIHQPanelOperations implements ActionListener, KeyListener {
	private static final Logger log = Logger.getLogger(HistologiaIHQPanelOperations.class);
	
	public static final String ACTION_COMMAND_NRO_BIOPSIA = "nroBiopsia";
	public static final String ACTION_COMMAND_BTN_GUARDAR = "btnGuardar";
	public static final String ACTION_COMMAND_BTN_SEND_TO_DIAGNOSTICO = "btnSendToDiagnostico";
	public static final String ACTION_COMMAND_BTN_SEND_TO_IHQ = "btnSendToIHQ";
	public static final String ACTION_COMMAND_BTN_CANCELAR = "btnCancelar";
	public static final String ACTION_COMMAND_BTN_UPDATE_LAMINA = "btnLamina";
	
	private BiopsiaInfoDTO biopsiaInfoDTO;
	private HistologiaIHQPanel ventana;
	
	
	/**
	 * 
	 * @param ventana
	 */
	public HistologiaIHQPanelOperations(HistologiaIHQPanel ventana) {
		// TODO Auto-generated constructor stub
	}

	@Override
	public void actionPerformed(ActionEvent e) {
		// TODO Auto-generated method stub
		
	}

	@Override
	public void keyTyped(KeyEvent e) {
		// TODO Auto-generated method stub
		
	}

	@Override
	public void keyPressed(KeyEvent e) {
		// TODO Auto-generated method stub
		if(e.getSource() instanceof JTextField){
			JTextField field = (JTextField) e.getSource();
			
			if(ACTION_COMMAND_NRO_BIOPSIA.equals(field.getName())){
				biopsiaInfoDTO = GUIPressedOrTypedNroBiopsia.manageKeyEvent(ventana, e, field, biopsiaInfoDTO);
				biopsiaInfoDTO = BiopsiaMicroLaminasDAO.setMicroLaminas(biopsiaInfoDTO);
				//loadVentanaFromBiopsiaDTO(biopsiaInfoDTO);
				
				if(biopsiaInfoDTO != null){
					if(FasesBiopsia.INGRESO.equals(biopsiaInfoDTO.getFaseActual())
							|| FasesBiopsia.MACROSCOPICA.equals(biopsiaInfoDTO.getFaseActual())
							|| FasesBiopsia.HISTOLOGIA.equals(biopsiaInfoDTO.getFaseActual())){
						ventana.setVisible(false);
						JOptionPane.showMessageDialog(ventana,
								"La biopsia " + biopsiaInfoDTO.getCodigo() + " aun está en fase de "
										+ biopsiaInfoDTO.getFaseActual().getNombreFase() 
										+ ".\nDebe esperar a que la misma avance a fase de micro.", 
								"Biopsia aún en fase de " + biopsiaInfoDTO.getFaseActual().getNombreFase(), 
								JOptionPane.INFORMATION_MESSAGE);
					} else if(! FasesBiopsia.MICROSCOPICA.equals(biopsiaInfoDTO.getFaseActual())){
						String editKey = JOptionPane.showInputDialog(ventana, 
								"Disculpe, este registro no esta en fase de Micro.\nSi desea editarlo debe introducir la clave de edición.", 
								"Indique la clave para edición", 
								JOptionPane.QUESTION_MESSAGE);
						if(! SecurityEditCode.checkIfValueIsTheSecurityCode(editKey)){
							ventana.setVisible(false);
						}
					}
				}
			}
		}
	}

	@Override
	public void keyReleased(KeyEvent e) {
		// TODO Auto-generated method stub
		
	}

}
