package com.fjr.code.gui.operations;

import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.ItemEvent;
import java.awt.event.ItemListener;
import java.awt.event.KeyEvent;
import java.awt.event.KeyListener;

import com.fjr.code.gui.IngresoPanel;

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
		
	}

	@Override
	public void keyTyped(KeyEvent e) {
		// TODO Auto-generated method stub
		System.out.println("aqui");
	}

	@Override
	public void keyPressed(KeyEvent e) {
		// TODO Auto-generated method stub
		
	}

	@Override
	public void keyReleased(KeyEvent e) {
		// TODO Auto-generated method stub
		
	}

	@Override
	public void itemStateChanged(ItemEvent e) {
		// TODO Auto-generated method stub
		
	}
}
