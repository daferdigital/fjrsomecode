package com.fjr.code.gui.operations;

import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.KeyEvent;
import java.awt.event.KeyListener;
import java.util.List;

import javax.swing.JOptionPane;
import javax.swing.JTextField;

import org.apache.log4j.Logger;

import com.fjr.code.barcode.BarCodeHistologia;
import com.fjr.code.dao.BiopsiaCassetesMacroDAO;
import com.fjr.code.dao.BiopsiaInfoDAO;
import com.fjr.code.dao.BiopsiaMicroLaminasDAO;
import com.fjr.code.dao.BiopsiaNuevosCortesDAO;
import com.fjr.code.dao.definitions.FasesBiopsia;
import com.fjr.code.dto.BiopsiaCasseteDTO;
import com.fjr.code.dto.BiopsiaInfoDTO;
import com.fjr.code.gui.HistologiaPanel;
import com.fjr.code.util.GUIPressedOrTypedNroBiopsia;
import com.fjr.code.util.SecurityEditCode;

/**
 * 
 * Class: HistologiaPanelOperations
 * Creation Date: 14/09/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class HistologiaPanelOperations implements ActionListener, KeyListener{
	/**
	 * log de la clase
	 */
	private static final Logger log = Logger.getLogger(HistologiaPanelOperations.class);
	
	public static final String ACTION_COMMAND_NRO_BIOPSIA = "nroBiopsia";
	public static final String ACTION_COMMAND_BTN_GUARDAR = "btnGuardar";
	public static final String ACTION_COMMAND_BTN_PRINT_LABELS = "btnPrintLabels";
	public static final String ACTION_COMMAND_BTN_JUST_PRINT_NEW_LABELS = "btnJustPrintNewLabels";
	public static final String ACTION_COMMAND_BTN_SEND_TO_MICROSCOPICA = "btnSendToMicro";
	public static final String ACTION_COMMAND_BTN_CANCELAR = "btnCancelar";
	public static final String ACTION_COMMAND_BTN_MODIFY_CASSETE = "btnCassette";
	
	private HistologiaPanel ventana;
	private BiopsiaInfoDTO biopsiaInfoDTO;
	
	/**
	 * 
	 * @param ventana
	 */
	public HistologiaPanelOperations(HistologiaPanel ventana) {
		// TODO Auto-generated constructor stub
		this.ventana = ventana;
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
				biopsiaInfoDTO = BiopsiaCassetesMacroDAO.setHistoCassetes(biopsiaInfoDTO);
				loadVentanaFromBiopsiaDTO(biopsiaInfoDTO);
				
				if(biopsiaInfoDTO != null){
					if(FasesBiopsia.INGRESO.equals(biopsiaInfoDTO.getFaseActual())
							|| FasesBiopsia.MACROSCOPICA.equals(biopsiaInfoDTO.getFaseActual())){
						ventana.setVisible(false);
						JOptionPane.showMessageDialog(ventana,
								"La biopsia " + biopsiaInfoDTO.getCodigo() + " aun está en fase de " + 
										biopsiaInfoDTO.getFaseActual().getNombreFase() + ".\nDebe esperar a que la misma avance a fase de Histología.", 
								"Biopsia en fase de " + biopsiaInfoDTO.getFaseActual().getNombreFase(), 
								JOptionPane.INFORMATION_MESSAGE);
					} else if(! FasesBiopsia.HISTOLOGIA.equals(biopsiaInfoDTO.getFaseActual())){
						String editKey = JOptionPane.showInputDialog(ventana, 
								"Disculpe, este registro no esta en fase de Histología.\nSi desea editarlo debe introducir la clave de edición.", 
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

	@Override
	public void actionPerformed(ActionEvent e) {
		// TODO Auto-generated method stub
		if(ACTION_COMMAND_BTN_CANCELAR.equals(e.getActionCommand())){
			log.info("Cerrando panel de histologia por boton cancelar");
			ventana.setVisible(false);
		} else if(ACTION_COMMAND_BTN_PRINT_LABELS.equals(e.getActionCommand())){
			if(biopsiaInfoDTO != null && !"".equals(ventana.getTextNombrePaciente().getText())
					&& ventana.getTableHistoCassetes().getList() != null
					&& ventana.getTableHistoCassetes().getList().size() > 0
					&& ventana.getTableHistoCassetes().allCassetesHaveBlocksAndLaminas()){
				//tengo todo a la mano para proceder a la impresion de las etiquetas de esta fase
				log.info("Se desean imprimir las etiquetas de la fase de histologia para la biopsia '" 
						+ biopsiaInfoDTO.getCodigo()  + "'");
				BarCodeHistologia histoLabels = new BarCodeHistologia(biopsiaInfoDTO.getCodigo(),
						ventana.getTableHistoCassetes().getList(),
						false);
				try {
					histoLabels.crearEtiquetaHistologia();
					histoLabels.printLabelFile();
				} catch (Exception e1) {
					// TODO Auto-generated catch block
					log.error("Error creando etiquetas de fase macro. Error fue: " + e1.getLocalizedMessage(), e1);
					JOptionPane.showMessageDialog(ventana, 
							"Ocurrio un error durante la creación de las etiquetas de impresión de esta fase.\n"
							+ "Por favor intente de nuevo.", 
							"Error creando etiquetas de impresión", 
							JOptionPane.ERROR_MESSAGE);
				}
			} else {
				log.error("No se tiene toda la informacion en la ventana para crear las etiquetas de impresion.");
				JOptionPane.showMessageDialog(ventana, 
						"Para poder imprimir las etiquetas debe procesar un código válido de Biopsia.\n"
						+ "Y además debe existir la información de los respectivos cassetes (bloques y láminas).", 
						"Información incompleta", 
						JOptionPane.ERROR_MESSAGE);
			}
		} else if(ACTION_COMMAND_BTN_GUARDAR.equals(e.getActionCommand())
				|| ACTION_COMMAND_BTN_SEND_TO_MICROSCOPICA.equals(e.getActionCommand())){
			log.info("Se desea guardar una biopsia, se verifica el contenido del formulario");
			
			boolean goToMicro = ACTION_COMMAND_BTN_SEND_TO_MICROSCOPICA.equals(e.getActionCommand());
			if(validateWindowData(goToMicro)){
				//la informacion esta completa y valida
				//guardamos la biopsia
				biopsiaInfoDTO = buildDTOFromVentana();
				whatToDowithBiopsia(biopsiaInfoDTO, goToMicro);
			}
		} else if(ACTION_COMMAND_BTN_JUST_PRINT_NEW_LABELS.equals(e.getActionCommand())){
			List<BiopsiaCasseteDTO> nuevosCortes = BiopsiaNuevosCortesDAO.getNuevosCortes(biopsiaInfoDTO.getId());
			if(nuevosCortes == null || nuevosCortes.size() == 0){
				JOptionPane.showMessageDialog(ventana, 
						"Disculpe, no se encontró información de nuevos cortes para esta biopsia",
						"Advertencia",
						JOptionPane.WARNING_MESSAGE);
			} else {
				BarCodeHistologia histoLabels = new BarCodeHistologia(biopsiaInfoDTO.getCodigo(),
						nuevosCortes,
						true);
				try {
					histoLabels.crearEtiquetaHistologia();
					histoLabels.printLabelFile();
				} catch (Exception e1) {
					// TODO Auto-generated catch block
					log.error("Error creando etiquetas para nuevos cortes. Error fue: " + e1.getLocalizedMessage(), e1);
					JOptionPane.showMessageDialog(ventana, 
							"Ocurrio un error durante la creación de las etiquetas de impresión de esta fase.\n"
							+ "Por favor intente de nuevo.", 
							"Error creando etiquetas de impresión", 
							JOptionPane.ERROR_MESSAGE);
				}
			}
		}
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
		ventana.getTextADescHistologia().setText("");
		ventana.getTableHistoCassetes().deleteAllRows();
		
		if(biopsia != null){
			//cargamos los valores
			ventana.getTextNroBiopsia().setText(biopsia.getCodigo());
			ventana.getTextNombrePaciente().setText(biopsia.getCliente().getNombres()
					+ " " + biopsia.getCliente().getApellidos());
			ventana.getTextPiezaRecibida().setText(biopsia.getIngresoDTO().getPiezaRecibida());
			ventana.getTextExamenARealizar().setText(biopsia.getExamenBiopsia().getNombreExamen());
			ventana.getTextADescHistologia().setText(biopsia.getHistologiaDTO().getDescripcion());
			
			for (BiopsiaCasseteDTO cassete : biopsia.getHistologiaDTO().getCassetesDTO()) {
				ventana.getTableHistoCassetes().addRow(cassete.isReprocesar(),
						cassete.getNumero(),
						cassete.getBloques(),
						cassete.getLaminas(),
						cassete.getDescripcion(),
						biopsia.getCodigo());
			}
		}
	}
	
	/**
	 * 
	 * @param goToMicro
	 * @return
	 */
	public boolean validateWindowData(boolean goToMicro){
		boolean isValid = true;
		
		//validamos los campos restantes del formulario
		String errors = "";
		
		if("".equals(ventana.getTextNroBiopsia().getText())){
			errors += "Debe introcudir un número de biopsia\n";
		} else {
			if("".equals(ventana.getTextNombrePaciente().getText())
					//|| "".equals(ventana.getTextPiezaRecibida().getText())
					|| "".equals(ventana.getTextExamenARealizar().getText())){
				errors += "Verifique que el número de biopsia es correcto.\n";
			}
		}
		
		if(goToMicro){
			if(! ventana.getTableHistoCassetes().allCassetesHaveBlocksAndLaminas()){
				errors += "Falta indicar bloques y/o laminas en esta fase.\n";
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
			biopsia.getHistologiaDTO().setDescripcion(ventana.getTextADescHistologia().getText());
			biopsia.getHistologiaDTO().setCassetesDTO(ventana.getTableHistoCassetes().getList());
		}
		
		return biopsia;
	}
	
	/**
	 * Procesamos la biopsia contra la base de datos.
	 * 
	 * @param biopsiaInfoDTO
	 * @param goToMicro
	 */
	private void whatToDowithBiopsia(BiopsiaInfoDTO biopsiaInfoDTO,
			boolean goToMicro) {
		// TODO Auto-generated method stub
		//ya tenemos verificada la informacion basica de la biopsia
		//procedemos a guardarla
		if(BiopsiaInfoDAO.updateHisto(biopsiaInfoDTO, goToMicro)){
			if(goToMicro){
				if(biopsiaInfoDTO.getHistologiaDTO().getCassetesDTO() == null
						|| biopsiaInfoDTO.getHistologiaDTO().getCassetesDTO().size() < 1
						|| ! ventana.getTableHistoCassetes().allCassetesHaveBlocksAndLaminas()){
					//tenemos el objeto, pero se desea pasar a info sin fotos ni cassetes
					JOptionPane.showMessageDialog(ventana, 
							"Se desea avanzar a la fase de Microscopica,\npero no se ha indicado toda la información de bloques y laminas en los cassetes.",
							"Información incompleta", 
							JOptionPane.ERROR_MESSAGE);
				} else {
					//tenemos todo para pasar a micro
					if(BiopsiaInfoDAO.moveBiopsiaToFase(biopsiaInfoDTO, FasesBiopsia.MICROSCOPICA)){
						BiopsiaCassetesMacroDAO.markBiopsiaAsReprocessed(biopsiaInfoDTO.getId());
						BiopsiaMicroLaminasDAO.setReprocesarToBiopsia(false, biopsiaInfoDTO.getId());
						
						JOptionPane.showMessageDialog(ventana, 
								"La biopsia " + biopsiaInfoDTO.getCodigo() + " fue actualizada correctamente.\n"
								+ "Y llevada a la fase de Miscroscopica",
								"Operación Realizada", 
								JOptionPane.INFORMATION_MESSAGE);
						//ventana.setVisible(false);
						loadVentanaFromBiopsiaDTO(null);
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
}
