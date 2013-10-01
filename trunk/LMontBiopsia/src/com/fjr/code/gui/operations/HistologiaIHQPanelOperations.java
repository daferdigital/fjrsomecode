package com.fjr.code.gui.operations;

import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.KeyEvent;
import java.awt.event.KeyListener;

import javax.swing.JOptionPane;
import javax.swing.JTextField;

import org.apache.log4j.Logger;

import com.fjr.code.barcode.BarCodeIHQ;
import com.fjr.code.dao.BiopsiaInfoDAO;
import com.fjr.code.dao.BiopsiaMicroLaminasDAO;
import com.fjr.code.dao.definitions.FasesBiopsia;
import com.fjr.code.dto.BiopsiaInfoDTO;
import com.fjr.code.dto.BiopsiaMicroLaminasDTO;
import com.fjr.code.dto.BiopsiaMicroLaminasFileDTO;
import com.fjr.code.dto.ReactivoDTO;
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
	public static final Logger log = Logger.getLogger(HistologiaIHQPanelOperations.class);
	
	public static final String ACTION_COMMAND_NRO_BIOPSIA = "nroBiopsia";
	public static final String ACTION_COMMAND_BTN_GUARDAR = "btnGuardar";
	public static final String ACTION_COMMAND_BTN_SEND_TO_MICRO = "btnSendToMicro";
	public static final String ACTION_COMMAND_BTN_PRINT_LABELS = "btnPrintLabels";
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
		this.ventana = ventana;
	}

	@Override
	public void actionPerformed(ActionEvent e) {
		// TODO Auto-generated method stub
		if(ACTION_COMMAND_BTN_CANCELAR.equals(e.getActionCommand())){
			log.info("Cerrando panel de histologia-ihq por boton cancelar");
			ventana.setVisible(false);
		} else if(ACTION_COMMAND_BTN_GUARDAR.equals(e.getActionCommand())
				|| ACTION_COMMAND_BTN_SEND_TO_MICRO.equals(e.getActionCommand())){
			log.info("Se desea guardar una biopsia, se verifica el contenido del formulario");
			
			boolean goToMicro = ACTION_COMMAND_BTN_SEND_TO_MICRO.equals(e.getActionCommand());
			if(validateWindowData(goToMicro)){
				//la informacion esta completa y valida
				//guardamos la biopsia
				biopsiaInfoDTO = buildDTOFromVentana();
				whatToDoWithBiopsia(biopsiaInfoDTO, goToMicro);
			}
		} else if(ACTION_COMMAND_BTN_PRINT_LABELS.equals(e.getActionCommand())){
			if(biopsiaInfoDTO != null && !"".equals(ventana.getTextNombrePaciente().getText())
					&& ventana.getTableMicroLaminasIHQ().getList() != null
					&& ventana.getTableMicroLaminasIHQ().getList().size() > 0){
				//tengo todo a la mano para proceder a la impresion de las etiquetas de esta fase
				log.info("Se desean imprimir las etiquetas de la fase de IHQ para la biopsia '" 
						+ biopsiaInfoDTO.getCodigo()  + "'");
				BarCodeIHQ ihqLabels = new BarCodeIHQ(biopsiaInfoDTO.getCodigo(), 
						ventana.getTableMicroLaminasIHQ().getList());
				try {
					ihqLabels.crearEtiquetaIHQ();
					ihqLabels.printLabelFile();
				} catch (Exception e1) {
					// TODO Auto-generated catch block
					log.error("Error creando etiquetas de fase macro. Error fue: " + e1.getLocalizedMessage(), e1);
					JOptionPane.showMessageDialog(ventana, 
							"Ocurrio un error durante la creación de las etiquetas de impresión de esta fase.\n"
							+ "Por favor intente de nuevo.", 
							"Error creando etiquetas de impresión", 
							JOptionPane.ERROR_MESSAGE);
				}
			}
		}
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
				biopsiaInfoDTO = BiopsiaMicroLaminasDAO.setMicroLaminas(biopsiaInfoDTO, true);
				loadVentanaFromBiopsiaDTO(biopsiaInfoDTO);
				
				if(biopsiaInfoDTO != null){
					if(FasesBiopsia.INGRESO.equals(biopsiaInfoDTO.getFaseActual())
							|| FasesBiopsia.MACROSCOPICA.equals(biopsiaInfoDTO.getFaseActual())
							|| FasesBiopsia.HISTOLOGIA.equals(biopsiaInfoDTO.getFaseActual())
							|| FasesBiopsia.MICROSCOPICA.equals(biopsiaInfoDTO.getFaseActual())
							|| FasesBiopsia.ENTREGA.equals(biopsiaInfoDTO.getFaseActual())
							|| FasesBiopsia.CONFIRMAR_IHQ.equals(biopsiaInfoDTO.getFaseActual())){
						ventana.setVisible(false);
						JOptionPane.showMessageDialog(ventana,
								"La biopsia " + biopsiaInfoDTO.getCodigo() + " aun está en fase de "
										+ biopsiaInfoDTO.getFaseActual().getNombreFase() 
										+ ".\nDebe esperar a que la misma avance a fase de IHQ.", 
								"Biopsia aún en fase de " + biopsiaInfoDTO.getFaseActual().getNombreFase(), 
								JOptionPane.INFORMATION_MESSAGE);
					} else if(! FasesBiopsia.IHQ.equals(biopsiaInfoDTO.getFaseActual())){
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
	 * Recibimos el DTO de la biopsia y los cargamos en la ventana
	 * 
	 * @param biopsia
	 */
	private void loadVentanaFromBiopsiaDTO(BiopsiaInfoDTO biopsia){
		ventana.getTextNombrePaciente().setText("");
		ventana.getTextPiezaRecibida().setText("");
		ventana.getTextExamenARealizar().setText("");
		ventana.getTableMicroLaminasIHQ().deleteAllRows();
		
		if(biopsia != null){
			//cargamos los valores
			ventana.getTextNroBiopsia().setText(biopsia.getCodigo());
			ventana.getTextNombrePaciente().setText(biopsia.getCliente().getNombres()
					+ " " + biopsia.getCliente().getApellidos());
			ventana.getTextPiezaRecibida().setText(biopsia.getIngresoDTO().getPiezaRecibida());
			ventana.getTextExamenARealizar().setText(biopsia.getExamenBiopsia().getNombreExamen());
			
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
				
				if(lamina.getReactivosDTO() != null
						&& lamina.getReactivosDTO().size() > 0){
					for (ReactivoDTO reactivo : lamina.getReactivosDTO()) {
						ventana.getTableMicroLaminasIHQ().addRow(
								reactivo.isProcesadoIHQ(),
								Integer.toString(lamina.getCassete()), 
								Integer.toString(lamina.getBloque()), 
								Integer.toString(lamina.getLamina()), 
								reactivo.getDescripcionIHQ() == null ? "" : reactivo.getDescripcionIHQ(),
								reactivo.getId(),
								reactivo.getNombre(), 
								files);
					}
				}
			}
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
			biopsia.getMicroscopicaDTO().setLaminasDTO(ventana.getTableMicroLaminasIHQ().getList());
		}
		
		return biopsia;
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
			if(! ventana.getTableMicroLaminasIHQ().isValidForIHQ()){
				errors += "Desea enviar a Micro sin haber procesado todos los reactivos.\n";
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
	 * Procesamos la biopsia contra la base de datos
	 * 
	 * @param biopsiaInfoDTO
	 * @param goToMicro
	 */
	private void whatToDoWithBiopsia(BiopsiaInfoDTO biopsiaInfoDTO,
			boolean goToMicro) {
		// TODO Auto-generated method stub
		//ya tenemos verificada la informacion basica de la biopsia
		//procedemos a guardarla
		if(BiopsiaInfoDAO.updateMicroIHQ(biopsiaInfoDTO, goToMicro)){
			if(goToMicro){
				//tenemos todo para pasar a entrega
				if(BiopsiaInfoDAO.moveBiopsiaToFase(biopsiaInfoDTO, FasesBiopsia.MICROSCOPICA)){
					JOptionPane.showMessageDialog(ventana, 
							"La biopsia " + biopsiaInfoDTO.getCodigo() + " fue actualizada correctamente.\n"
							+ "Y llevada a la fase de Micro",
							"Operación Realizada", 
							JOptionPane.INFORMATION_MESSAGE);
					ventana.setVisible(false);
				} else {
					//tenemos el objeto, pero se desea pasar a info sin fotos ni cassetes
					JOptionPane.showMessageDialog(ventana, 
							"No pudo llevarse la biopsia a la fase de Micro.",
							"Actualización Incompleta", 
							JOptionPane.ERROR_MESSAGE);
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
