package com.fjr.code.gui.operations;

import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.KeyEvent;
import java.awt.event.KeyListener;

import javax.swing.JOptionPane;
import javax.swing.JTextField;

import org.apache.log4j.Logger;

import com.fjr.code.dao.BiopsiaInfoDAO;
import com.fjr.code.dao.definitions.FasesBiopsia;
import com.fjr.code.dto.BiopsiaInfoDTO;
import com.fjr.code.gui.MacroCasseteDialog;
import com.fjr.code.gui.MacroFotosDialog;
import com.fjr.code.gui.MacroscopicaPanel;
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
public class MacroscopicaPanelOperations implements KeyListener, ActionListener{
	/**
	 * log de la clase
	 */
	private static final Logger log = Logger.getLogger(MacroscopicaPanelOperations.class);
	
	public static final String ACTION_COMMAND_NRO_BIOPSIA = "nroBiopsia";
	public static final String ACTION_COMMAND_BTN_GUARDAR = "btnGuardar";
	public static final String ACTION_COMMAND_BTN_PRINT_LABELS = "btnPrintLabels";
	public static final String ACTION_COMMAND_BTN_SEND_TO_HISTOLOGIA = "btnSendToHisto";
	public static final String ACTION_COMMAND_BTN_CANCELAR = "btnCancelar";
	public static final String ACTION_COMMAND_BTN_ADD_CASSETE = "btnCassette";
	public static final String ACTION_COMMAND_BTN_ADD_FOTO = "btnFoto";
	
	/**
	 * Ventana asociada con estos listeners
	 */
	private MacroscopicaPanel ventana;
	
	private BiopsiaInfoDTO biopsiaInfoDTO;
	
	/**
	 * @param ventana 
	 * 
	 */
	public MacroscopicaPanelOperations(MacroscopicaPanel ventana) {
		// TODO Auto-generated constructor stub
		this.ventana = ventana;
	}

	/**
	 * Recibimos el DTO de la biopsia y los cargamos en la ventana
	 * 
	 * @param biopsia
	 */
	private void loadVentanaFromBiopsiaDTO(BiopsiaInfoDTO biopsia){
		//ventana.getTextNroBiopsia().setText("");
		ventana.getTextNombrePaciente().setText("");
		ventana.getTextPiezaRecibida().setText("");
		ventana.getTextExamenARealizar().setText("");
		ventana.getTextADescMacroscopica().setText("");
		ventana.getTextADescPerOperatoria().setText("");
		
		if(biopsia != null){
			//cargamos los valores
			ventana.getTextNroBiopsia().setText(biopsia.getCodigo());
			ventana.getTextNombrePaciente().setText(biopsia.getCliente().getNombres()
					+ " " + biopsia.getCliente().getApellidos());
			ventana.getTextPiezaRecibida().setText(biopsia.getIngresoDTO().getPiezaRecibida());
			ventana.getTextExamenARealizar().setText(biopsia.getExamenBiopsia().getNombreExamen());
			ventana.getTextADescMacroscopica().setText(biopsia.getMacroscopicaDTO().getDescMacroscopica());
			ventana.getTextADescPerOperatoria().setText(biopsia.getMacroscopicaDTO().getDescPerOperatoria());
		}
	}
	
	@Override
	public void actionPerformed(ActionEvent e) {
		// TODO Auto-generated method stub
		if(ACTION_COMMAND_BTN_CANCELAR.equals(e.getActionCommand())){
			log.info("Cerrando panel de macro por boton cancelar");
			ventana.setVisible(false);
		} else if(ACTION_COMMAND_BTN_GUARDAR.equals(e.getActionCommand())
				|| ACTION_COMMAND_BTN_SEND_TO_HISTOLOGIA.equals(e.getActionCommand())){
			log.info("Se desea guardar una biopsia, se verifica el contenido del formulario");
			
			boolean goToHisto = ACTION_COMMAND_BTN_SEND_TO_HISTOLOGIA.equals(e.getActionCommand());
			if(validateWindowData(goToHisto)){
				//la informacion esta completa y valida
				//guardamos la biopsia
				biopsiaInfoDTO = buildDTOFromVentana();
				whatToDowithBiopsia(biopsiaInfoDTO, goToHisto);
			}
		} else if(ACTION_COMMAND_BTN_ADD_CASSETE.equals(e.getActionCommand())){
			new MacroCasseteDialog(ventana.getTableMacroCassetes(), "", -1).setVisible(true);
		} else if(ACTION_COMMAND_BTN_ADD_FOTO.equals(e.getActionCommand())){
			new MacroFotosDialog(ventana.getTableMacroFotos(), "", "", -1, "").setVisible(true);
		}
	}

	@Override
	public void keyTyped(KeyEvent e) {
		// TODO Auto-generated method stub
		if(e.getSource() instanceof JTextField){
			JTextField field = (JTextField) e.getSource();
			
			if(ACTION_COMMAND_NRO_BIOPSIA.equals(field.getName())){
				biopsiaInfoDTO = GUIPressedOrTypedNroBiopsia.manageKeyEvent(ventana, e, field, biopsiaInfoDTO);
				loadVentanaFromBiopsiaDTO(biopsiaInfoDTO);
				
				if(biopsiaInfoDTO != null){
					if(FasesBiopsia.INGRESO.equals(biopsiaInfoDTO.getFaseActual())){
						JOptionPane.showMessageDialog(ventana,
								"La biopsia " + biopsiaInfoDTO.getCodigo() + " aun está en fase de ingreso.\nDebe esperar a que la misma avance a fase de macro.", 
								"Biopsia aún en fase de ingreso", 
								JOptionPane.INFORMATION_MESSAGE);
					} else if(! FasesBiopsia.MACROSCOPICA.equals(biopsiaInfoDTO.getFaseActual())){
						String editKey = JOptionPane.showInputDialog(ventana, 
								"Disculpe, este registro no esta en fase de MAcro.\nSi desea editarlo debe introducir la clave de edición.", 
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

	/**
	 * 
	 * @param isNewBiopsia
	 * @return
	 */
	public boolean validateWindowData(boolean validateTables){
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
		if("".equals(ventana.getTextADescMacroscopica().getText())){
			errors += "Debe indicar una descripción macroscopica.\n";
		}
		
		if(validateTables){
			if(ventana.getTableMacroCassetes().getTable().getRowCount() < 1){
				errors += "Falta agregar los cassetes en esta fase.\n";
			}
			if(ventana.getTableMacroFotos().getTable().getRowCount() < 1){
				errors += "Falta indicar las fotos de esta fase.\n";
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
				loadVentanaFromBiopsiaDTO(biopsiaInfoDTO);
				
				if(biopsiaInfoDTO != null){
					if(FasesBiopsia.INGRESO.equals(biopsiaInfoDTO.getFaseActual())){
						ventana.setVisible(false);
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
	}

	@Override
	public void keyReleased(KeyEvent e) {
		// TODO Auto-generated method stub
	}
	
	private void whatToDowithBiopsia(BiopsiaInfoDTO biopsiaInfoDTO,
			boolean goToHisto) {
		// TODO Auto-generated method stub
		//ya tenemos verificada la informacion basica de la biopsia
		//procedemos a guardarla
		if(BiopsiaInfoDAO.updateMacro(biopsiaInfoDTO)){
			if(goToHisto){
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
					"No pudo actualizarse la información asociada a la biosia " + biopsiaInfoDTO.getCodigo(),
					"Error en la operación", 
					JOptionPane.ERROR_MESSAGE);
		}
	}

	/**
	 * 
	 * @return
	 */
	private BiopsiaInfoDTO buildDTOFromVentana() {
		// TODO Auto-generated method stub
		//en este punto la ventana es valida
		BiopsiaInfoDTO biopsia = null;
		biopsia = BiopsiaInfoDAO.getBiopsiaByNumero(ventana.getTextNroBiopsia().getText());
		if(biopsia != null){
			biopsia.getMacroscopicaDTO().setDescMacroscopica(ventana.getTextADescMacroscopica().getText());
			biopsia.getMacroscopicaDTO().setDescPerOperatoria(ventana.getTextADescPerOperatoria().getText());
			biopsia.getMacroscopicaDTO().setCassetesDTO(ventana.getTableMacroCassetes().getList());
			biopsia.getMacroscopicaDTO().setMacroFotosDTO(ventana.getTableMacroFotos().getList());
		}
		
		return biopsia;
	}
}
