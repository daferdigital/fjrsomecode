package com.fjr.code.gui.operations;

import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.InputMethodEvent;
import java.awt.event.InputMethodListener;
import java.awt.event.ItemEvent;
import java.awt.event.ItemListener;
import java.awt.event.KeyEvent;
import java.awt.event.KeyListener;
import java.util.List;

import javax.swing.JComboBox;
import javax.swing.JOptionPane;
import javax.swing.JTextField;

import org.apache.log4j.Logger;

import com.fjr.code.barcode.BarCodeIngreso;
import com.fjr.code.dao.BiopsiaInfoDAO;
import com.fjr.code.dao.ClienteDAO;
import com.fjr.code.dao.EspecialidadDAO;
import com.fjr.code.dao.ExamenesDAO;
import com.fjr.code.dao.PatologoDAO;
import com.fjr.code.dao.TipoEstudioDAO;
import com.fjr.code.dao.definitions.FasesBiopsia;
import com.fjr.code.dao.definitions.TipoEdadEnum;
import com.fjr.code.dto.BiopsiaInfoDTO;
import com.fjr.code.dto.BiopsiaIngresoDTO;
import com.fjr.code.dto.ClienteDTO;
import com.fjr.code.dto.ExamenBiopsiaDTO;
import com.fjr.code.dto.PatologoDTO;
import com.fjr.code.dto.TipoCedulaDTO;
import com.fjr.code.dto.EspecialidadDTO;
import com.fjr.code.dto.TipoEstudioDTO;
import com.fjr.code.gui.AppWindow;
import com.fjr.code.gui.ClienteFormDialog;
import com.fjr.code.gui.IngresoPanel;
import com.fjr.code.gui.maestros.EspecialidadDialog;
import com.fjr.code.gui.maestros.ExamenDialog;
import com.fjr.code.gui.maestros.TipoEstudioDialog;
import com.fjr.code.util.BiopsiaValidationUtil;
import com.fjr.code.util.Constants;
import com.fjr.code.util.GUIPressedOrTypedNroBiopsia;
import com.fjr.code.util.KeyEventsUtil;
import com.fjr.code.util.SecurityEditCode;

/**
 * 
 * Class: IngresoPanelOperations
 * Creation Date: 28/08/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class IngresoPanelOperations implements ActionListener, KeyListener, ItemListener, InputMethodListener{
	/**
	 * log de la clase
	 */
	private static final Logger log = Logger.getLogger(IngresoPanelOperations.class);
	private List<ExamenBiopsiaDTO> examenes = ExamenesDAO.getAll();
	private int idEstudio = -1;
	
	public static final String ACTION_COMMAND_NRO_BIOPSIA = "nroBiopsia";
	public static final String ACTION_COMMAND_NRO_CEDULA = "nroCedula";
	public static final String ACTION_COMMAND_UPDATE_CLIENT = "btnUpdateClient";
	public static final String ACTION_COMMAND_SEARCH_BY_NAME = "btnSearchByName";
	public static final String ACTION_COMMAND_COMBO_TIPO_EXAMEN = "comboTipoExamenChanged";
	public static final String ACTION_COMMAND_COMBO_EXAMEN = "comboExamenChanged";
	public static final String ACTION_COMMAND_BTN_ADD_TIPO_ESTUDIO = "btnAddTipoEstudio";
	public static final String ACTION_COMMAND_BTN_ADD_ESPECIALIDAD = "btnAddEspecialidad";
	public static final String ACTION_COMMAND_BTN_ADD_EXAMEN = "btnAddExamen";
	public static final String ACTION_COMMAND_BTN_GUARDAR = "btnGuardar";
	public static final String ACTION_COMMAND_BTN_PRINT_LABELS = "btnPrintLabels";
	public static final String ACTION_COMMAND_BTN_SEND_TO_MACRO = "btnSendToMacro";
	public static final String ACTION_COMMAND_BTN_CANCELAR = "btnCancelar";
	
	/**
	 * Ventana asociada con estos listeners
	 */
	private IngresoPanel ventana;
	
	private BiopsiaInfoDTO biopsiaInfoDTO;
	
	/**
	 * 
	 * @param ventana
	 */
	public IngresoPanelOperations(IngresoPanel ventana) {
		// TODO Auto-generated constructor stub
		this.ventana = ventana;
		if (ventana.isNewBiopsia()){
			biopsiaInfoDTO = new BiopsiaInfoDTO();
		}
	}
	
	/**
	 * Recibimos el DTO de la biopsia y los cargamos en la ventana
	 * 
	 * @param biopsia
	 */
	private void loadVentanaFromBiopsiaDTO(BiopsiaInfoDTO biopsia){
		if(ventana.isNewBiopsia()){
			ventana.getTextNroBiopsia().setText("");
		}
		ventana.getComboTipoCedula().setSelectedIndex(0);
		ventana.getTextCedula().setText("");
		ventana.getTextNombrePaciente().setText("");
		ventana.getTextApellido().setText("");
		ventana.getTextEdad().setText("");
		ventana.getTextProcedencia().setText("");
		
		ventana.getTextPiezaRecibida().setText("");
		ventana.getComboEspecialidad().setSelectedIndex(0);
		ventana.getTextReferido().setText("");
		ventana.getComboPatologo().setSelectedIndex(0);
		ventana.getTextAreaIDx().setText("");
		
		if(biopsia != null){
			//cargamos los valores
			ventana.getTextNroBiopsia().setText(biopsia.getCodigo());
			
			String[] cedula = biopsia.getCliente().getCedula().split("\\-");
			if(cedula.length == 2){
				for(int i = 0; i < ventana.getComboTipoCedula().getItemCount(); i++){
					if(((TipoCedulaDTO) ventana.getComboTipoCedula().getItemAt(i)).getKeyCedula().startsWith(cedula[0])){
						ventana.getComboTipoCedula().setSelectedIndex(i);
						break;
					}
				}
				
				ventana.getTextCedula().setText(cedula[1]);
			} else {
				log.info("No se obtuvo una cedula correcta desde base de datos, se procede a dejarla vacia");
			}
			
			ventana.getTextNombrePaciente().setText(biopsia.getCliente().getNombres());
			ventana.getTextApellido().setText(biopsia.getCliente().getApellidos());
			if(biopsia.getCliente().getEdad() < 1){
				ventana.getTextEdad().setText(" N/I");
			} else {
				ventana.getTextEdad().setText(Integer.toString(biopsia.getCliente().getEdad())
						+ " " + biopsia.getCliente().getTipoEdad().getNombre().toLowerCase());
			}
			ventana.setIdCliente(biopsia.getCliente().getId());
			
			ventana.getTextProcedencia().setText(biopsia.getIngresoDTO().getProcedencia());
			ventana.getTextPiezaRecibida().setText(biopsia.getIngresoDTO().getPiezaRecibida());
			
			for(int i = 0; i < ventana.getComboTipoEstudio().getItemCount(); i++){
				if(((TipoEstudioDTO) ventana.getComboTipoEstudio().getItemAt(i)).getId() == biopsia.getIdTipoEstudio()){
					ventana.getComboTipoEstudio().setSelectedIndex(i);
				}
			}
			
			for(int i = 0; i < ventana.getComboEspecialidad().getItemCount(); i++){
				if(((EspecialidadDTO) ventana.getComboEspecialidad().getItemAt(i)).getId() == biopsia.getExamenBiopsia().getIdTipoExamen()){
					ventana.getComboEspecialidad().setSelectedIndex(i);
				}
			}
			
			for(int i = 0; i < ventana.getComboExamen().getItemCount(); i++){
				if(((ExamenBiopsiaDTO) ventana.getComboExamen().getItemAt(i)).getId() == biopsia.getExamenBiopsia().getId()){
					ventana.getComboExamen().setSelectedIndex(i);
					break;
				}
			}
			
			ventana.getTextReferido().setText(biopsia.getIngresoDTO().getReferidoMedico());
			
			for(int i = 0; i < ventana.getComboPatologo().getItemCount(); i++){
				if(((PatologoDTO) ventana.getComboPatologo().getItemAt(i)).getId() == biopsia.getIngresoDTO().getPatologoTurno().getId()){
					ventana.getComboPatologo().setSelectedIndex(i);
					break;
				}
			}
			
			ventana.getTextAreaIDx().setText(biopsia.getIngresoDTO().getIdx());
		}
	}
	
	/**
	 * Se construye el ingreso de la biopsia
	 * en base a la informacion de la ventana.
	 * 
	 * @return
	 */
	private BiopsiaInfoDTO buildDTOFromVentana(){
		BiopsiaInfoDTO registro = biopsiaInfoDTO;
		
		if("".equals(ventana.getTextNroBiopsia().getText())){
			registro.setSide1CodeBiopsia("-1");
			registro.setSide2CodeBiopsia("-1");
		}else{
			String[] values = ventana.getTextNroBiopsia().getText().split("\\-");
			registro.setSide1CodeBiopsia(values[0]);
			registro.setSide2CodeBiopsia(values[1]);
		}
		
		registro.setFaseActual(FasesBiopsia.INGRESO);
		
		ClienteDTO cliente = ClienteDAO.getById(ventana.getIdCliente());
		if(cliente == null){
			//no existe el cliente indicado, colocamos el por defecto
			log.info("No existe el cliente indicado, colocamos el por defecto");
			cliente = new ClienteDTO(Constants.ID_DEFAULT_CLIENTE, "", "", "", "", 0, TipoEdadEnum.ANIOS, "", "", "", false);
		}
		registro.setCliente(cliente);
		
		registro.setExamenBiopsia(
				ExamenesDAO.getById(((ExamenBiopsiaDTO) ventana.getComboExamen().getSelectedItem()).getId()));
		registro.setIdTipoEstudio(((TipoEstudioDTO) ventana.getComboTipoEstudio().getSelectedItem()).getId());
		
		BiopsiaIngresoDTO ingreso = new BiopsiaIngresoDTO();
		ingreso.setIdx(ventana.getTextAreaIDx().getText());
		ingreso.setPatologoTurno(PatologoDAO.getById(((PatologoDTO) ventana.getComboPatologo().getSelectedItem()).getId()));
		ingreso.setPiezaRecibida(ventana.getTextPiezaRecibida().getText());
		ingreso.setProcedencia(ventana.getTextProcedencia().getText());
		ingreso.setReferidoMedico(ventana.getTextReferido().getText());
		
		registro.setIngresoDTO(ingreso);
		
		return registro;
	}
	
	/**
	 * Se desea guardar una biopsia, veo si es una nueva o si se esta editando una ya existente.
	 * 
	 * @param isNewBiopsia
	 */
	public boolean validateWindowData(boolean isNewBiopsia){
		boolean isValid = true;
		
		if(isNewBiopsia){
			//se tipeo un codigo de biopsia
			//en cuyo caso debo validar si existe o no
			//o si cumple con el fomato del mismo
			if(! "".equals(ventana.getTextNroBiopsia().getText())){
				if(! BiopsiaValidationUtil.isAValidNroBiopsia(ventana.getTextNroBiopsia().getText())){
					isValid = false;
					log.error("El numero de biopsia '" + ventana.getTextNroBiopsia().getText() 
							+ "' no tiene la estructura esperada");
					JOptionPane.showMessageDialog(ventana, 
							"El formato del número de biopsia no es el esperado.\nDebe ser por ejemplo: 14-15272.\n"
							+ "Recuerde que la identificación asociada al tipo de estudio, será agregada automaticamente.", 
							"Error en formato de número de biopsia", 
							JOptionPane.ERROR_MESSAGE);
				} else {
					//es un numero valido de biopsia, debemos usarlo
					//previa verificacion
					if(BiopsiaInfoDAO.biopsiaAlreadyExists(ventana.getTextNroBiopsia().getText())){
						isValid = false;
						log.error("El numero de biopsia '" + ventana.getTextNroBiopsia().getText()
								+ "' ya existe, para modificarla, debe ingresarse en la opcion de actualizar.");
						JOptionPane.showMessageDialog(ventana, 
								"El número de biopsia ya existe.\nPara actualizar ingrese en el módulo Recepción -> Actualizar", 
								"Número de biopsia ya existe", 
								JOptionPane.ERROR_MESSAGE);
					} else {
						log.info("Se va a intentar guardar el ingreso de la biopsia '" + ventana.getTextNroBiopsia().getText() + "'");
					}
				}
			}
		}
		
		//validamos los campos restantes del formulario
		String errors = "";
		//ya no se validara la obligatoriedad del cliente
		/*
		if(ClienteDAO.getByCedula(((TipoCedulaDTO) ventana.getComboTipoCedula().getSelectedItem()).getKeyCedula() + ventana.getTextCedula().getText()) == null){
			errors += "La cedula indicada no existe.\n";
		}
		*/
		if("".equals(ventana.getTextProcedencia().getText())){
			errors += "Debe indicar un valor para la procedencia de esta pieza.\n";
		}
		if("".equals(ventana.getTextPiezaRecibida().getText())){
			errors += "Debe indicar la procedencia del material para esta biopsia.\n";
		}
		if(ventana.getComboEspecialidad().getSelectedIndex() == 0){
			errors += "Debe indicar la especialidad asociada a esta biopsia.\n";
		}
		if(ventana.getComboExamen().getItemCount() == 0){
			errors += "Debe indicar el examen asociado a esta biopsia.\n";
		}
		if(ventana.getComboPatologo().getSelectedIndex() < 1){
			errors += "Debe indicar el Patologo encargado de esta biopsia.\n";
		}
		
		if(! "".equals(errors)){
			isValid = false;
			JOptionPane.showMessageDialog(ventana, 
					"Se han presentado los siguientes errores:\n" + errors, 
					"Faltan campos para guardar el ingreso", 
					JOptionPane.ERROR_MESSAGE);
		}
		
		return isValid;
	}

	@Override
	public void actionPerformed(ActionEvent e) {
		// TODO Auto-generated method stub
		if(ACTION_COMMAND_BTN_CANCELAR.equals(e.getActionCommand())){
			log.info("Cerrando panel de Ingreso por boton cancelar");
			ventana.setVisible(false);
		} else if(ACTION_COMMAND_BTN_GUARDAR.equals(e.getActionCommand())
				|| ACTION_COMMAND_BTN_SEND_TO_MACRO.equals(e.getActionCommand())){
			log.info("Se desea guardar una biopsia, se verifica el contenido del formulario");
			if(validateWindowData(ventana.isNewBiopsia())){
				//la informacion esta completa y valida
				//guardamos la biopsia
				biopsiaInfoDTO = buildDTOFromVentana();
				boolean goToMacro = ACTION_COMMAND_BTN_SEND_TO_MACRO.equals(e.getActionCommand());
				
				if(whatToDoWithBiopsia(biopsiaInfoDTO, goToMacro)){
					if(goToMacro){
						if(BiopsiaInfoDAO.moveBiopsiaToFase(biopsiaInfoDTO, FasesBiopsia.MACROSCOPICA)){
							JOptionPane.showMessageDialog(ventana,
									"La biopsia " + biopsiaInfoDTO.getCodigo() + " fue colocada en fase " + FasesBiopsia.MACROSCOPICA.getNombreFase(),
									"Actualización realizada",
									JOptionPane.INFORMATION_MESSAGE);
							//ventana.setVisible(false);
							biopsiaInfoDTO = new BiopsiaInfoDTO();
							ventana.setNewBiopsia(true);
							loadVentanaFromBiopsiaDTO(null);
						} else {
							JOptionPane.showMessageDialog(ventana,
									"No pudo actualizarse la fase de esta biopsia a Macroscopica",
									"Error en actualización",
									JOptionPane.ERROR_MESSAGE);
						}
					}
					
					//refrescamos el panel
					if(goToMacro){
						IngresoPanel panel = new IngresoPanel(true);
						AppWindow.getInstance().setPanelContenido(panel, (FasesBiopsia) null);
						AppWindow.getInstance().setExtraTitle("Recepci\u00F3n");
						panel.setFocusAtDefaultElement();
					}
				}
			}
		} else if(ACTION_COMMAND_BTN_PRINT_LABELS.equals(e.getActionCommand())){
			log.info("Peticion para imprimir las etiquetas");
			//validamos los datos minimos requeridos
			String errors = "";
			if("".equals(ventana.getTextNroBiopsia().getText())){
				errors += "\nEl número de biopsia.";
			}
			if("".equals(ventana.getTextCedula().getText())){
				errors += "\nLa cédula.";
			}
			if("".equals(ventana.getTextNombrePaciente().getText()) 
					&& "".equals(ventana.getTextApellido().getText())){
				errors += "\nEl nombre del paciente";
			}
			
			if("".equals(errors)){
				log.info("Informacion completa para imprimir las etiquetas.");
				BarCodeIngreso codeIngreso = new BarCodeIngreso(ventana.getTextNroBiopsia().getText(), 
						ventana.getTextNombrePaciente().getText() + "\n" + ventana.getTextApellido().getText(), 
						((TipoCedulaDTO) ventana.getComboTipoCedula().getSelectedItem()).getKeyCedula() + ventana.getTextCedula().getText());
				try {
					codeIngreso.crearEtiquetaIngreso();
					codeIngreso.printLabelFile();
				} catch (Exception ex) {
					// TODO: handle exception
					log.error(ex.getLocalizedMessage(), ex);
				}
			} else {
				log.info("Informacion incompleta para imprimir las etiquetas.");
				JOptionPane.showMessageDialog(ventana, 
						"Disculpe, los siguientes valores son requeridos para la impresión de las etiquetas:\n" + errors, 
						"Faltan atributos para la impresión.", 
						JOptionPane.ERROR_MESSAGE);
			}
		} else if(ACTION_COMMAND_BTN_ADD_TIPO_ESTUDIO.equals(e.getActionCommand())){
			new TipoEstudioDialog(-1).setVisible(true);
			ventana.getComboTipoEstudio().removeAllItems();
			TipoEstudioDAO.populateJCombo(ventana.getComboTipoEstudio());
		} else if(ACTION_COMMAND_BTN_ADD_ESPECIALIDAD.equals(e.getActionCommand())){
			new EspecialidadDialog(-1).setVisible(true);
			ventana.getComboEspecialidad().removeAllItems();
			EspecialidadDAO.populateJCombo(ventana.getComboEspecialidad(), true);
		} else if(ACTION_COMMAND_BTN_ADD_EXAMEN.equals(e.getActionCommand())){
			new ExamenDialog(-1).setVisible(true);
			ventana.getComboExamen().removeAllItems();
			ExamenesDAO.populateJCombo(ventana.getComboExamen());
		} else if(ACTION_COMMAND_UPDATE_CLIENT.equals(e.getActionCommand())){
			ClienteDTO cliente = ClienteDAO.getById(ventana.getIdCliente());
			ClienteFormDialog clienteForm = new ClienteFormDialog(cliente,
					ventana.getComboTipoCedula().getSelectedIndex(),
					ventana.getTextCedula().getText(),
					ventana);
			ClienteDTO clienteDTO = clienteForm.getCliente();
			
			ventana.setIdCliente(clienteDTO.getId());
		}
	}

	/**
	 * Metodo para realizar la operacion respectiva con la biopsia.
	 * 
	 * @param ingreso
	 * @param goToMacro
	 * @return
	 */
	private boolean whatToDoWithBiopsia(BiopsiaInfoDTO ingreso, boolean goToMacro) {
		// TODO Auto-generated method stub
		boolean result = true;
		
		if(ventana.isNewBiopsia()){
			if(BiopsiaInfoDAO.biopsiaAlreadyExists(ingreso.getCodigo())){
				log.error("No pudo guardarse la biopsia porque ya existe");
				result = false;
				JOptionPane.showMessageDialog(ventana, 
						"Se produjo un error al almacenar la biopsia '" + ingreso.getCodigo() + "'.\n"
						+ "La misma ya existe. Por favor, intente de nuevo.", 
						"Biopsia " + ingreso.getCodigo() + " ya existe", 
						JOptionPane.ERROR_MESSAGE);
			} else {
				if(BiopsiaInfoDAO.insertBiopsiaInfo(ingreso) > 0){
					JOptionPane.showMessageDialog(ventana, 
							"La biopsia de código " + ingreso.getCodigo() + " fue creada de manera exitosa.", 
							"Almacenada biopsia " + ingreso.getCodigo(), 
							JOptionPane.INFORMATION_MESSAGE);
					ventana.setNewBiopsia(false);
					this.idEstudio = ingreso.getIdTipoEstudio();
					ventana.getTextNroBiopsia().setText(ingreso.getCodigo());
				} else {
					log.error("No pudo guardarse la biopsia");
					result = false;
					JOptionPane.showMessageDialog(ventana, 
							"Se produjo un error al almacenar la biopsia.\nPor favor, intente de nuevo.", 
							"Error al guardar", 
							JOptionPane.ERROR_MESSAGE);
				}
			}
		} else {
			log.info("Se desea actualizar una biopsia ya existente");
			if(ingreso.getId() > 0){
				//verifico si hubo cambio en el tipo de estudio
				int confirm = JOptionPane.YES_OPTION;
				boolean mustClone = false;
				
				if(this.idEstudio != ingreso.getIdTipoEstudio()){
					mustClone = true;
					confirm = JOptionPane.showConfirmDialog(null,
							"Se detectó un cambio en el tipo de estudio original para esta Biopsia.\n"
							+ "Desea renumerar esta nueva Biopsia? La anterior sera marcada como Anulada.",
							"Advertencia",
							JOptionPane.YES_NO_OPTION);
				}
				
				if(confirm == JOptionPane.YES_OPTION){
					if(mustClone){
						//preparamos el DTO para permitir el clonado
						ingreso.setSide1CodeBiopsia("-1");
						int originalBiopsiaId = ingreso.getId();
						
						if(BiopsiaInfoDAO.insertBiopsiaInfo(ingreso) > 0){
							BiopsiaInfoDAO.moveBiopsiaToFase(originalBiopsiaId,  FasesBiopsia.ANULADA);
							JOptionPane.showMessageDialog(null,
									"La biopsia fue almacenada con el valor del nuevo tipo de estudio.\n"
									+ "El registro anterior fue anulado del sistema.",
									"Registro Clonado",
									JOptionPane.INFORMATION_MESSAGE);
						} else {
							JOptionPane.showMessageDialog(null,
									"La biopsia fue almacenada con el valor del nuevo tipo de estudio.\n"
									+ "El registro anterior fue anulado del sistema.",
									"Registro Clonado",
									JOptionPane.ERROR_MESSAGE);
						}
					} else {
						if(BiopsiaInfoDAO.updateIngreso(ingreso)){
							log.info("Biopsia '" + ingreso.getCodigo() + "' actualizada con exito.");
							
							if(!goToMacro){
								JOptionPane.showMessageDialog(ventana, 
										"La biopsia " + ingreso.getCodigo() + " fue actualizada de manera exitosa.", 
										"Biopsia " + ingreso.getCodigo() + " actualizada", 
										JOptionPane.INFORMATION_MESSAGE);
							}
						} else {
							log.error("Biopsia '" + ingreso.getCodigo() + "' no pudo ser actualizada");
							result = false;
							JOptionPane.showMessageDialog(ventana, 
									"Se produjo un error al actualizar la biopsia.\nPor favor, intente de nuevo.", 
									"Error al actualizar", 
									JOptionPane.ERROR_MESSAGE);
						}
					}
				}
			} else {
				JOptionPane.showMessageDialog(ventana, 
						"Disculpe, debe cargar el formulario de manera correcta.\n"
						+ "Intente cargar el código de la biopsia usando el lector de código de barras ó\n"
						+ "Escriba el código y presione ENTER para auto-llenar la información de la biopsia.", 
						"Información de Biopsia incompleta.", 
						JOptionPane.ERROR_MESSAGE);
				result = false;
			}
		}
		
		return result;
	}

	@Override
	public void keyTyped(KeyEvent e) {
		if(e.getSource() instanceof JTextField){
			JTextField field = (JTextField) e.getSource();
			
			if(ACTION_COMMAND_NRO_CEDULA.equals(field.getName())){
				//se tipeo un caracter en el texto de la cedula
				//vemos si efectivamente debe mantenerse dicho caracter
				if(! KeyEventsUtil.wasTypedANumber(e)  && e.getKeyChar() != '\b'){
					//quemamos el evento para evitar el tipeo real
					e.consume();
				} else {
					//se tipeo un digito, reviso automaticamente la cedula
					//para evitar inconsistencias
					TipoCedulaDTO tipoCedula = (TipoCedulaDTO) ventana.getComboTipoCedula().getSelectedItem();
					String cedula = tipoCedula.getKeyCedula() + field.getText() + e.getKeyChar();
					boolean mustSearch = true;
					
					if("".equals((field.getText() + e.getKeyChar()).trim())){
						log.info("No busco pacientes con cedulas vacias");
						mustSearch = false;
					}
					
					log.info("Debo verificar la cedula '" + cedula + "'");
					//verificamos los datos basicos del cliente para esa cedula
					ClienteDTO cliente = ClienteDAO.getByCedula(cedula);
					ventana.getTextNombrePaciente().setText("");
					ventana.getTextApellido().setText("");
					ventana.getTextEdad().setText("");
					
					if(cliente != null && mustSearch){
						//el cliente existe, cargamos su data
						if(cliente.isActivo()){
							ventana.getTextNombrePaciente().setText(cliente.getNombres());
							ventana.getTextApellido().setText(cliente.getApellidos());
							if(cliente.getEdad() < 1){
								ventana.getTextEdad().setText(" N/I");
							} else {
								ventana.getTextEdad().setText(Integer.toString(cliente.getEdad())
										+ " " + cliente.getTipoEdad().getNombre().toLowerCase());
							}
							ventana.setIdCliente(cliente.getId());
						} else {
							ventana.setIdCliente(Constants.ID_DEFAULT_CLIENTE);
							JOptionPane.showMessageDialog(ventana,
									"El cliente relacionado a esa cedula no se encuentra activo en el sistema.",
									"Cliente inactivo",
									JOptionPane.INFORMATION_MESSAGE);
						}
					} else {
						ventana.setIdCliente(Constants.ID_DEFAULT_CLIENTE);
					}
				}
			} else if(ACTION_COMMAND_NRO_BIOPSIA.equals(field.getName())){
				/*
				biopsiaInfoDTO = GUIPressedOrTypedNroBiopsia.manageKeyEvent(ventana, e, field, biopsiaInfoDTO);
				loadVentanaFromBiopsiaDTO(biopsiaInfoDTO);
				
				if(biopsiaInfoDTO != null){
					if(! FasesBiopsia.INGRESO.equals(biopsiaInfoDTO.getFaseActual())){
						String editKey = JOptionPane.showInputDialog(ventana, 
								"Disculpe, este registro no esta en fase de Ingreso.\nSi desea editarlo debe introducir la clave de edición.", 
								"Indique la clave para edición", 
								JOptionPane.QUESTION_MESSAGE);
						if(! SecurityEditCode.checkIfValueIsTheSecurityCode(editKey)){
							ventana.setVisible(false);
						}
					}
				}
				*/
			}
		}
	}

	@Override
	public void keyPressed(KeyEvent e) {
		// TODO Auto-generated method stub
		if(e.getSource() instanceof JTextField){
			JTextField field = (JTextField) e.getSource();
			
			if(ACTION_COMMAND_NRO_CEDULA.equals(field.getName())){
				//el evento fue sobre el texto de la cedula
				//verifico si es un caracter permitido
				if(KeyEventsUtil.wasPressedAEnter(e) || KeyEventsUtil.wasPressedABackSpace(e)){
					//verifico si la cedula existe para cargar los datos
					//solo si el campo no es vacio
					if(! "".equals(field.getText().trim())){
						TipoCedulaDTO tipoCedula = (TipoCedulaDTO) ventana.getComboTipoCedula().getSelectedItem();
						String cedula = tipoCedula.getKeyCedula() + field.getText();
						if(KeyEventsUtil.wasPressedABackSpace(e)){
							cedula = cedula.substring(0, cedula.length() - 1);
						}
						
						log.info("Debo verificar la cedula '" + cedula + "'");
						//verificamos los datos basicos del cliente para esa cedula
						ClienteDTO cliente = ClienteDAO.getByCedula(cedula);
						ventana.getTextNombrePaciente().setText("");
						ventana.getTextApellido().setText("");
						ventana.getTextEdad().setText("");
						
						if(cliente == null && KeyEventsUtil.wasPressedAEnter(e)){
							int option = JOptionPane.showConfirmDialog(ventana, 
									"Disculpe, el numero de cedula no esta asociado a ningun cliente."
									+ "\nDesea crear dicho registro?");

							if(option == JOptionPane.OK_OPTION){
								//mostramos la ventana para crear clientes
								cliente = new ClienteDTO(Constants.ID_DEFAULT_CLIENTE, "", "", "", "", 0, TipoEdadEnum.ANIOS, "", "", "", false);
								ClienteFormDialog formDialog = new ClienteFormDialog(cliente, ventana.getComboTipoCedula().getSelectedIndex(), 
										field.getText(),
										ventana);
								
								if(formDialog.getCliente() != null){
									ventana.setIdCliente(formDialog.getCliente().getId());
								}
							}
						} else {
							//el cliente existe, cargamos su data
							if(cliente != null){
								//el cliente no existe, posible backspace en el valor de la cedula
								if(cliente.isActivo()){
									ventana.getTextNombrePaciente().setText(cliente.getNombres());
									ventana.getTextApellido().setText(cliente.getApellidos());
									ventana.getTextEdad().setText(Integer.toString(cliente.getEdad()));
									ventana.setIdCliente(cliente.getId());
								} else {
									JOptionPane.showMessageDialog(ventana,
											"El cliente relacionado a esa cedula no se encuentra activo en el sistema.",
											"Cliente inactivo",
											JOptionPane.INFORMATION_MESSAGE);
								}
							}
						}
					}
				}
			} else if(ACTION_COMMAND_NRO_BIOPSIA.equals(field.getName())){
				biopsiaInfoDTO = GUIPressedOrTypedNroBiopsia.manageKeyEvent(ventana, e, field, biopsiaInfoDTO);
				loadVentanaFromBiopsiaDTO(biopsiaInfoDTO);
				
				this.idEstudio = biopsiaInfoDTO.getIdTipoEstudio();
				log.info("TipoEstudio original de la biopsia " + biopsiaInfoDTO.getCodigo()
						+ "= " + this.idEstudio);
				if(biopsiaInfoDTO != null){
					//verificamos el status de la biopsia
					if(! FasesBiopsia.INGRESO.equals(biopsiaInfoDTO.getFaseActual())){
						/*
						String editKey = JOptionPane.showInputDialog(ventana, 
								"Disculpe, este registro no esta en fase de Ingreso.\nSi desea editarlo debe introducir la clave de edición.", 
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

	@Override
	public void itemStateChanged(ItemEvent e) {
		// TODO Auto-generated method stub
		//vemos cual de los combo box cambio
		if(e.getSource() instanceof JComboBox){
			JComboBox combo = (JComboBox) e.getSource();
			if(ACTION_COMMAND_COMBO_TIPO_EXAMEN.equals((combo).getActionCommand())){
				//cambio el combo del tipo de examen, verifico el valor para hacer el ajuste de los examenes
				ventana.getComboExamen().removeAllItems();
				for (ExamenBiopsiaDTO examen : examenes) {
					if(((EspecialidadDTO) combo.getSelectedItem()).getId() == examen.getIdTipoExamen()){
						ventana.getComboExamen().addItem(examen);
					}
				}
			}else if(ACTION_COMMAND_COMBO_EXAMEN.equals((combo).getActionCommand())){
				//cambio el combo del examen, verifico el valor para hacer el ajuste
				ExamenBiopsiaDTO examen = (ExamenBiopsiaDTO) e.getItem();
				ventana.getLblNumeroDias().setText(Integer.toString(examen.getDiasParaResultado()));
			}
		}	
	}

	@Override
	public void inputMethodTextChanged(InputMethodEvent event) {
		// TODO Auto-generated method stub
		log.info("inputMethodTextChanged");
	}
	
	@Override
	public void caretPositionChanged(InputMethodEvent event) {
		// TODO Auto-generated method stub
		log.info("inputMethodTextChanged");
	}
}
