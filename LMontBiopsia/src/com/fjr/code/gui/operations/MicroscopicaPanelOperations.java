package com.fjr.code.gui.operations;

import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.KeyEvent;
import java.awt.event.KeyListener;

import javax.swing.JOptionPane;
import javax.swing.JTextField;

import org.apache.log4j.Logger;

import com.fjr.code.dao.BiopsiaInfoDAO;
import com.fjr.code.dao.BiopsiaMicroLaminasDAO;
import com.fjr.code.dao.definitions.FasesBiopsia;
import com.fjr.code.dto.BiopsiaInfoDTO;
import com.fjr.code.dto.BiopsiaMicroLaminasDTO;
import com.fjr.code.dto.BiopsiaMicroLaminasFileDTO;
import com.fjr.code.gui.MicroscopicaPanel;
import com.fjr.code.util.GUIPressedOrTypedNroBiopsia;
import com.fjr.code.util.SecurityEditCode;

/**
 * 
 * Class: MacroscopicaPanelOperations
 * Creation Date: 08/09/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class MicroscopicaPanelOperations implements KeyListener, ActionListener{
	/**
	 * log de la clase
	 */
	private static final Logger log = Logger.getLogger(MicroscopicaPanelOperations.class);
	
	public static final String ACTION_COMMAND_NRO_BIOPSIA = "nroBiopsia";
	public static final String ACTION_COMMAND_BTN_GUARDAR = "btnGuardar";
	public static final String ACTION_COMMAND_BTN_SEND_TO_DIAGNOSTICO = "btnSendToDiagnostico";
	public static final String ACTION_COMMAND_BTN_SEND_TO_IHQ = "btnSendToIHQ";
	public static final String ACTION_COMMAND_BTN_CANCELAR = "btnCancelar";
	public static final String ACTION_COMMAND_BTN_UPDATE_LAMINA = "btnLamina";
	
	/**
	 * Ventana asociada con estos listeners
	 */
	private MicroscopicaPanel ventana;
	
	private BiopsiaInfoDTO biopsiaInfoDTO;
	
	/**
	 * @param ventana 
	 * 
	 */
	public MicroscopicaPanelOperations(MicroscopicaPanel ventana) {
		// TODO Auto-generated constructor stub
		this.ventana = ventana;
	}

	/**
	 * Recibimos el DTO de la biopsia y los cargamos en la ventana
	 * 
	 * @param biopsia
	 */
	private void loadVentanaFromBiopsiaDTO(BiopsiaInfoDTO biopsia){
		ventana.getTextNombrePaciente().setText("");
		ventana.getTextPiezaRecibida().setText("");
		ventana.getTextExamenARealizar().setText("");
		ventana.getTextAIDx().setText("");
		ventana.getTextADiagnostico().setText("");
		ventana.getTableMicroLaminas().deleteAllRows();
		
		if(biopsia != null){
			//cargamos los valores
			ventana.getTextNroBiopsia().setText(biopsia.getCodigo());
			ventana.getTextNombrePaciente().setText(biopsia.getCliente().getNombres()
					+ " " + biopsia.getCliente().getApellidos());
			ventana.getTextPiezaRecibida().setText(biopsia.getIngresoDTO().getPiezaRecibida());
			ventana.getTextExamenARealizar().setText(biopsia.getExamenBiopsia().getNombreExamen());
			ventana.getTextAIDx().setText(biopsia.getMicroscopicaDTO().getIdx());
			ventana.getTextADiagnostico().setText(biopsia.getMicroscopicaDTO().getDiagnostico());
			
			for (BiopsiaMicroLaminasDTO lamina : biopsia.getMicroscopicaDTO().getLaminasDTO()) {
				String files = "";
				if(lamina.getMicroLaminasFilesDTO() != null
						&& lamina.getMicroLaminasFilesDTO().size() > 0){
					for (BiopsiaMicroLaminasFileDTO microFoto : lamina.getMicroLaminasFilesDTO()) {
						if("".equals(files)){
							files += microFoto.getMediaFile().getAbsolutePath();
						} else {
							files += ";" + microFoto.getMediaFile().getAbsolutePath();
						}
					}
				}
				
				ventana.getTableMicroLaminas().addRow(
						Integer.toString(lamina.getCassete()), 
						Integer.toString(lamina.getBloque()), 
						Integer.toString(lamina.getLamina()), 
						lamina.getDescripcion() == null ? "" : lamina.getDescripcion(),
						lamina.getReactivoDTO() == null ? 0 : lamina.getReactivoDTO().getId(),
						lamina.getReactivoDTO() == null ? "" : lamina.getReactivoDTO().getNombre(), 
						files);
			}
		}
	}
	
	@Override
	public void actionPerformed(ActionEvent e) {
		// TODO Auto-generated method stub
		if(ACTION_COMMAND_BTN_CANCELAR.equals(e.getActionCommand())){
			log.info("Cerrando panel de micro por boton cancelar");
			ventana.setVisible(false);
		} else if(ACTION_COMMAND_BTN_GUARDAR.equals(e.getActionCommand())
				|| ACTION_COMMAND_BTN_SEND_TO_IHQ.equals(e.getActionCommand())
				|| ACTION_COMMAND_BTN_SEND_TO_DIAGNOSTICO.equals(e.getActionCommand())){
			log.info("Se desea guardar una biopsia, se verifica el contenido del formulario");
			
			boolean goToIHQ = ACTION_COMMAND_BTN_SEND_TO_IHQ.equals(e.getActionCommand());
			boolean goToDiagnostico = ACTION_COMMAND_BTN_SEND_TO_DIAGNOSTICO.equals(e.getActionCommand());
			if(validateWindowData(goToDiagnostico, goToIHQ)){
				//la informacion esta completa y valida
				//guardamos la biopsia
				biopsiaInfoDTO = buildDTOFromVentana();
				whatToDowithBiopsia(biopsiaInfoDTO, goToIHQ, goToIHQ);
			}
		}
	}

	@Override
	public void keyTyped(KeyEvent e) {
		// TODO Auto-generated method stub
		/*
		if(e.getSource() instanceof JTextField){
			JTextField field = (JTextField) e.getSource();
			
			if(ACTION_COMMAND_NRO_BIOPSIA.equals(field.getName())){
				biopsiaInfoDTO = GUIPressedOrTypedNroBiopsia.manageKeyEvent(ventana, e, field, biopsiaInfoDTO);
				biopsiaInfoDTO = BiopsiaFotosMacroDAO.setMacroFotos(biopsiaInfoDTO);
				biopsiaInfoDTO = BiopsiaCassetesMacroDAO.setMacroCassetes(biopsiaInfoDTO);
				
				loadVentanaFromBiopsiaDTO(biopsiaInfoDTO);
				
				if(biopsiaInfoDTO != null){
					if(FasesBiopsia.INGRESO.equals(biopsiaInfoDTO.getFaseActual())){
						JOptionPane.showMessageDialog(ventana,
								"La biopsia " + biopsiaInfoDTO.getCodigo() + " aun está en fase de ingreso.\nDebe esperar a que la misma avance a fase de macro.", 
								"Biopsia aún en fase de ingreso", 
								JOptionPane.INFORMATION_MESSAGE);
					} else if(! FasesBiopsia.MACROSCOPICA.equals(biopsiaInfoDTO.getFaseActual())){
						String editKey = JOptionPane.showInputDialog(ventana, 
								"Disculpe, este registro no esta en fase de Macro.\nSi desea editarlo debe introducir la clave de edición.", 
								"Indique la clave para edición", 
								JOptionPane.QUESTION_MESSAGE);
						if(! SecurityEditCode.checkIfValueIsTheSecurityCode(editKey)){
							ventana.setVisible(false);
						}
					}
				}
			}
		}
		*/
	}

	/**
	 * 
	 * @param goToDiagnostico
	 * @param goToIHQ
	 * @return
	 */
	public boolean validateWindowData(boolean goToDiagnostico, boolean goToIHQ){
		boolean isValid = true;
		
		//validamos los campos restantes del formulario
		String errors = "";
		
		if("".equals(ventana.getTextNroBiopsia().getText())){
			errors += "Debe introcudir un número de biopsia\n";
		} else {
			if("".equals(ventana.getTextNombrePaciente().getText())
					|| "".equals(ventana.getTextPiezaRecibida().getText())
					|| "".equals(ventana.getTextExamenARealizar().getText())){
				errors += "Verifique que el número de biopsia es correcto.\n";
			}
			
		}
		
		if(goToDiagnostico){
			if("".equals(ventana.getTextADiagnostico().getText())){
				errors += "Debe indicar un diagnostico.\n";
			}
			
		}
		
		if(goToIHQ){
			if(ventana.getTableMicroLaminas().getTable().getRowCount() < 1){
				errors += "Falta actualizar algunas laminas en esta fase.\n";
			}
		}
		
		
		if(! "".equals(errors)){
			isValid = false;
			JOptionPane.showMessageDialog(ventana, 
					"Se han presentado los siguientes errores:\n" + errors, 
					"Faltan campos", 
					JOptionPane.ERROR_MESSAGE);
		}
		
		return isValid;
	}
	
	@Override
	public void keyPressed(KeyEvent e) {
		// TODO Auto-generated method stub
		if(e.getSource() instanceof JTextField){
			JTextField field = (JTextField) e.getSource();
			
			if(ACTION_COMMAND_NRO_BIOPSIA.equals(field.getName())){
				biopsiaInfoDTO = GUIPressedOrTypedNroBiopsia.manageKeyEvent(ventana, e, field, biopsiaInfoDTO);
				biopsiaInfoDTO = BiopsiaMicroLaminasDAO.setMicroLaminas(biopsiaInfoDTO);
				loadVentanaFromBiopsiaDTO(biopsiaInfoDTO);
				
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
	
	/**
	 * Procesamos la biopsia contra la base de datos
	 * 
	 * @param biopsiaInfoDTO
	 * @param goToDiagnostico
	 * @param goToIHQ
	 */
	private void whatToDowithBiopsia(BiopsiaInfoDTO biopsiaInfoDTO,
			boolean goToDiagnostico, boolean goToIHQ) {
		// TODO Auto-generated method stub
		//ya tenemos verificada la informacion basica de la biopsia
		//procedemos a guardarla
		if(BiopsiaInfoDAO.updateMicro(biopsiaInfoDTO)){
			if(goToDiagnostico){
				if(biopsiaInfoDTO.getMacroscopicaDTO().getCassetesDTO() == null
						|| biopsiaInfoDTO.getMacroscopicaDTO().getCassetesDTO().size() < 1
						|| biopsiaInfoDTO.getMacroscopicaDTO().getMacroFotosDTO() == null
						|| biopsiaInfoDTO.getMacroscopicaDTO().getMacroFotosDTO().size() < 1){
					//tenemos el objeto, pero se desea pasar a info sin fotos ni cassetes
					JOptionPane.showMessageDialog(ventana, 
							"Se desea avanzar a la fase de Histologia, pero no se han registrado fotos ni cassetes.",
							"Información incompleta", 
							JOptionPane.ERROR_MESSAGE);
				} else {
					//tenemos todo para pasar a histo
					if(BiopsiaInfoDAO.moveBiopsiaToFase(biopsiaInfoDTO, FasesBiopsia.HISTOLOGIA)){
						JOptionPane.showMessageDialog(ventana, 
								"La biopsia " + biopsiaInfoDTO.getCodigo() + " fue actualizada correctamente.\n"
								+ "Y llevada a la fase de Histologia",
								"Operación Realizada", 
								JOptionPane.INFORMATION_MESSAGE);
						ventana.setVisible(false);
					}
				}
			} else {
				JOptionPane.showMessageDialog(ventana, 
						"La biopsia " + biopsiaInfoDTO.getCodigo() + " fue actualizada correctamente.",
						"Operación Realizada", 
						JOptionPane.INFORMATION_MESSAGE);
			}
		} else {
			JOptionPane.showMessageDialog(ventana, 
					"No pudo actualizarse la información asociada a la biopsia " + biopsiaInfoDTO.getCodigo(),
					"Error en la operación", 
					JOptionPane.ERROR_MESSAGE);
		}
	}

	/**
	 * Se construye el DTO respectivo tomando la informacion de la ventana.
	 * 
	 * @return
	 */
	private BiopsiaInfoDTO buildDTOFromVentana() {
		// TODO Auto-generated method stub
		//en este punto la ventana es valida
		BiopsiaInfoDTO biopsia = null;
		biopsia = BiopsiaInfoDAO.getBiopsiaByNumero(ventana.getTextNroBiopsia().getText());
		if(biopsia != null){
			biopsia.getMicroscopicaDTO().setIdx(ventana.getTextAIDx().getText());
			biopsia.getMicroscopicaDTO().setDiagnostico(ventana.getTextADiagnostico().getText());
			biopsia.getMicroscopicaDTO().setLaminasDTO(ventana.getTableMicroLaminas().getList());
		}
		
		return biopsia;
	}
}
