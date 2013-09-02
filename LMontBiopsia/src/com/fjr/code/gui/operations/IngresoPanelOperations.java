package com.fjr.code.gui.operations;

import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.ItemEvent;
import java.awt.event.ItemListener;
import java.awt.event.KeyEvent;
import java.awt.event.KeyListener;

import javax.swing.JComboBox;
import javax.swing.JOptionPane;
import javax.swing.JTextField;

import org.apache.log4j.Logger;

import com.fjr.code.dao.ClienteDAO;
import com.fjr.code.dto.ClienteDTO;
import com.fjr.code.dto.ExamenBiopsiaDTO;
import com.fjr.code.dto.TipoCedulaDTO;
import com.fjr.code.gui.ClienteFormDialog;
import com.fjr.code.gui.IngresoPanel;
import com.fjr.code.util.KeyEventsUtil;

/**
 * 
 * Class: IngresoPanelOperations
 * Creation Date: 28/08/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class IngresoPanelOperations implements ActionListener, KeyListener, ItemListener{
	/**
	 * log de la clase
	 */
	private static final Logger log = Logger.getLogger(IngresoPanelOperations.class);
	
	public static final String ACTION_COMMAND_NRO_BIOPSIA = "nroBiopsia";
	public static final String ACTION_COMMAND_NRO_CEDULA = "nroCedula";
	public static final String ACTION_COMMAND_COMBO_EXAMEN = "comboExamenChanged";
	public static final String ACTION_COMMAND_BTN_GUARDAR = "btnGuardar";
	public static final String ACTION_COMMAND_BTN_PRINT_LABELS = "btnPrintLabels";
	public static final String ACTION_COMMAND_BTN_SEND_TO_MACRO = "btnSendToMacro";
	public static final String ACTION_COMMAND_BTN_CANCELAR = "btnCancelar";
	
	/**
	 * Ventana asociada con estos listeners
	 */
	private IngresoPanel ventana;
	
	/**
	 * 
	 * @param ventana
	 */
	public IngresoPanelOperations(IngresoPanel ventana) {
		// TODO Auto-generated constructor stub
		this.ventana = ventana;
	}

	@Override
	public void actionPerformed(ActionEvent e) {
		// TODO Auto-generated method stub
		if(ACTION_COMMAND_BTN_CANCELAR.equals(e.getActionCommand())){
			log.info("Cerrando panel de Ingreso por boton cancelar");
			ventana.setVisible(false);
		} else if(ACTION_COMMAND_BTN_GUARDAR.equals(e.getActionCommand())){
			log.info("Se desea guardar una biopsia, se verifica el contenido del formulario");
			
		}
	}

	@Override
	public void keyTyped(KeyEvent e) {
		if(e.getSource() instanceof JTextField){
			JTextField field = (JTextField) e.getSource();
			
			if(ACTION_COMMAND_NRO_CEDULA.equals(field.getName())){
				//se tipeo un caracter en el texto de la cedula
				//vemos si efectivamente debe mantenerse dicho caracter
				if(! KeyEventsUtil.wasTypedANumber(e)){
					//quemamos el evento para evitar el tipeo real
					e.consume();
				} else {
					//se tipeo un digito, reviso automaticamente la cedula
					//para evitar inconsistencias
					TipoCedulaDTO tipoCedula = (TipoCedulaDTO) ventana.getComboTipoCedula().getSelectedItem();
					String cedula = tipoCedula.getKeyCedula() + field.getText() + e.getKeyChar();
					
					log.info("Debo verificar la cedula '" + cedula + "'");
					//verificamos los datos basicos del cliente para esa cedula
					ClienteDTO cliente = ClienteDAO.getByCedula(cedula);
					ventana.getTextNombrePaciente().setText("");
					ventana.getTextApellido().setText("");
					ventana.getTextEdad().setText("");
					
					if(cliente != null){
						//el cliente existe, cargamos su data
						if(cliente.isActivo()){
							ventana.getTextNombrePaciente().setText(cliente.getNombres());
							ventana.getTextApellido().setText(cliente.getApellidos());
							ventana.getTextEdad().setText(Integer.toString(cliente.getEdad()));
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
								new ClienteFormDialog(ventana.getComboTipoCedula().getSelectedIndex(), 
										field.getText(),
										ventana);
							}
						} else {
							//el cliente existe, cargamos su data
							if(cliente != null){
								//el cliente no existe, posible backspace en el valor de la cedula
								if(cliente.isActivo()){
									ventana.getTextNombrePaciente().setText(cliente.getNombres());
									ventana.getTextApellido().setText(cliente.getApellidos());
									ventana.getTextEdad().setText(Integer.toString(cliente.getEdad()));
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
				if(KeyEventsUtil.wasPressedAEnter(e)){
					if(! "".equals(field.getText().trim())){
						//solicitud para cargar el nro de biopsia que indica el valor del campo
						
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
			if(ACTION_COMMAND_COMBO_EXAMEN.equals(((JComboBox) e.getSource()).getActionCommand())){
				//cambio el combo del tipo de examen, verifico el valor para hacer el ajuste
				ExamenBiopsiaDTO examen = (ExamenBiopsiaDTO) e.getItem();
				ventana.getLblTipoExamen().setText(examen.getNombreTipoExamen());
				ventana.getLblNumeroDias().setText(Integer.toString(examen.getDiasParaResultado()));
			}
		}	
	}
}
