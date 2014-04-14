package com.fjr.code.gui.operations;

import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.KeyEvent;
import java.awt.event.KeyListener;

import javax.swing.JOptionPane;
import javax.swing.JTextField;

import org.apache.log4j.Logger;

import com.fjr.code.barcode.BarCodeMacroscopica;
import com.fjr.code.dao.BiopsiaCassetesMacroDAO;
import com.fjr.code.dao.BiopsiaFotosMacroDAO;
import com.fjr.code.dao.BiopsiaInfoDAO;
import com.fjr.code.dao.definitions.FasesBiopsia;
import com.fjr.code.dto.BiopsiaCasseteDTO;
import com.fjr.code.dto.BiopsiaInfoDTO;
import com.fjr.code.dto.BiopsiaMacroFotoDTO;
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
	public static final String ACTION_COMMAND_BTN_ADD_FOTO_PER_OPERATORIA = "btnFotoPerOperatoria";
	public static final String ACTION_COMMAND_BTN_ADD_X_CASSETES = "btnAddXCassetes";
	
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
		ventana.getTextNombrePaciente().setText("");
		ventana.getTextPiezaRecibida().setText("");
		ventana.getTextExamenARealizar().setText("");
		ventana.getTextADescMacroscopica().setText("");
		ventana.getTableMacroFotos().deleteAllRows();
		ventana.getTableMacroCassetes().deleteAllRows();
		
		if(biopsia != null){
			//cargamos los valores
			ventana.getTextNroBiopsia().setText(biopsia.getCodigo());
			ventana.getTextNombrePaciente().setText(biopsia.getCliente().getNombres()
					+ " " + biopsia.getCliente().getApellidos());
			ventana.getTextPiezaRecibida().setText(biopsia.getIngresoDTO().getPiezaRecibida());
			ventana.getTextExamenARealizar().setText(biopsia.getExamenBiopsia().getNombreExamen());
			ventana.getTextADescMacroscopica().setText(biopsia.getMacroscopicaDTO().getDescMacroscopica());
			
			for (BiopsiaMacroFotoDTO macroFoto : biopsia.getMacroscopicaDTO().getMacroFotosDTO()) {
				ventana.getTableMacroFotos().addRow(macroFoto.getNotacion(), 
						macroFoto.getDescripcion(), 
						macroFoto.getFotoFile().getAbsolutePath(),
						macroFoto.isFotoPerOperatoria());
			}
			
			for (BiopsiaCasseteDTO cassete : biopsia.getMacroscopicaDTO().getCassetesDTO()) {
				ventana.getTableMacroCassetes().addRow(cassete.getDescripcion());
			}
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
			new MacroFotosDialog(ventana.getTableMacroFotos(), "", "", -1, "", false).setVisible(true);
		} else if(ACTION_COMMAND_BTN_ADD_FOTO_PER_OPERATORIA.equals(e.getActionCommand())){
			new MacroFotosDialog(ventana.getTableMacroFotos(), "", "", -1, "", true).setVisible(true);
		} else if(ACTION_COMMAND_BTN_PRINT_LABELS.equals(e.getActionCommand())){
			if(biopsiaInfoDTO != null && !"".equals(ventana.getTextNombrePaciente().getText())
					&& ventana.getTableMacroCassetes().getList() != null
					&& ventana.getTableMacroCassetes().getList().size() > 0){
				//tengo todo a la mano para proceder a la impresion de las etiquetas de esta fase
				log.info("Se desean imprimir las etiquetas de la fase macro para la biopsia '" + biopsiaInfoDTO.getCodigo()  + "'");
				BarCodeMacroscopica macroLabels = new BarCodeMacroscopica(biopsiaInfoDTO.getCodigo(),
						biopsiaInfoDTO.getAbreviaturaTipoEstudio(),
						ventana.getTableMacroCassetes().getList().size());
				try {
					macroLabels.crearEtiquetaMacroscopica();
					macroLabels.printLabelFile();
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
						+ "Y además debe existir la información de los respectivos cassetes.", 
						"Información incompleta", 
						JOptionPane.ERROR_MESSAGE);
			}
			
		} else if(ACTION_COMMAND_BTN_ADD_X_CASSETES.equals(e.getActionCommand())){
			//se desean generar automaticamente X cassetes, todos con N/A en su descripcion
			int cassetes = 0;
			try {
				cassetes = Integer.parseInt(ventana.getTextXCassetes().getText().trim());
			} catch (Exception e2) {
				// TODO: handle exception
				JOptionPane.showMessageDialog(ventana, 
						"Debe indicar un valor numerico correcto para los cassetes que desea agregar de manera automatica", 
						"Número incorrecto", 
						JOptionPane.ERROR_MESSAGE);
			}
			
			for (int i = 0; i < cassetes; i++) {
				ventana.getTableMacroCassetes().addRow("N/A");
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
	 * @param validateTables
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
					//|| "".equals(ventana.getTextPiezaRecibida().getText())
					|| "".equals(ventana.getTextExamenARealizar().getText())){
				errors += "Verifique que el número de biopsia es correcto.\n";
			}
			
		}
		/*
		if("".equals(ventana.getTextADescMacroscopica().getText())){
			errors += "Debe indicar una descripción macroscopica.\n";
		}
		*/
		if(validateTables){
			if(ventana.getTableMacroCassetes().getTable().getRowCount() < 1){
				errors += "Falta agregar los cassetes en esta fase.\n";
			}
			/*
			if(ventana.getTableMacroFotos().getTable().getRowCount() < 1){
				errors += "Falta indicar las fotos de esta fase.\n";
			}
			*/
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
				biopsiaInfoDTO = BiopsiaFotosMacroDAO.setMacroFotos(biopsiaInfoDTO);
				biopsiaInfoDTO = BiopsiaCassetesMacroDAO.setMacroCassetes(biopsiaInfoDTO);
				loadVentanaFromBiopsiaDTO(biopsiaInfoDTO);
				
				if(biopsiaInfoDTO != null){
					if(FasesBiopsia.INGRESO.equals(biopsiaInfoDTO.getFaseActual())){
						ventana.setVisible(false);
						JOptionPane.showMessageDialog(ventana,
								"La biopsia " + biopsiaInfoDTO.getCodigo() + " aun está en fase de ingreso.\nDebe esperar a que la misma avance a fase de macro.", 
								"Biopsia aún en fase de ingreso", 
								JOptionPane.INFORMATION_MESSAGE);
					} else if(! FasesBiopsia.MACROSCOPICA.equals(biopsiaInfoDTO.getFaseActual())){
						/*
						String editKey = JOptionPane.showInputDialog(ventana, 
								"Disculpe, este registro no esta en fase de Macro.\nSi desea editarlo debe introducir la clave de edición.", 
								"Indique la clave para edición", 
								JOptionPane.QUESTION_MESSAGE);
						if(! SecurityEditCode.checkIfValueIsTheSecurityCode(editKey)){
							ventana.setVisible(false);
						}
						*/
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
	 * Procesamos la biopsia contra la base de datos.
	 * 
	 * @param biopsiaInfoDTO
	 * @param goToHisto
	 */
	private void whatToDowithBiopsia(BiopsiaInfoDTO biopsiaInfoDTO,
			boolean goToHisto) {
		// TODO Auto-generated method stub
		//ya tenemos verificada la informacion basica de la biopsia
		//procedemos a guardarla
		if(BiopsiaInfoDAO.updateMacro(biopsiaInfoDTO, goToHisto)){
			if(goToHisto){
				if(biopsiaInfoDTO.getMacroscopicaDTO().getCassetesDTO() == null
						|| biopsiaInfoDTO.getMacroscopicaDTO().getCassetesDTO().size() < 1
						/*|| biopsiaInfoDTO.getMacroscopicaDTO().getMacroFotosDTO() == null
						|| biopsiaInfoDTO.getMacroscopicaDTO().getMacroFotosDTO().size() < 1*/){
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
			biopsia.getMacroscopicaDTO().setDescMacroscopica(ventana.getTextADescMacroscopica().getText());
			biopsia.getMacroscopicaDTO().setDescPerOperatoria("");
			biopsia.getMacroscopicaDTO().setCassetesDTO(ventana.getTableMacroCassetes().getList());
			biopsia.getMacroscopicaDTO().setMacroFotosDTO(ventana.getTableMacroFotos().getList());
		}
		
		return biopsia;
	}
}
