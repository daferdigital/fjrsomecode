package com.fjr.code.util;

import java.awt.Component;
import java.awt.event.KeyEvent;

import javax.swing.JOptionPane;
import javax.swing.JTextField;

import org.apache.log4j.Logger;

import com.fjr.code.dao.BiopsiaInfoDAO;
import com.fjr.code.dto.BiopsiaInfoDTO;

/**
 * 
 * Class: GUIPressedOrTypedNroBiopsia
 * Creation Date: 08/09/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public final class GUIPressedOrTypedNroBiopsia {
	/**
	 * 
	 */
	private static final Logger log = Logger.getLogger(GUIPressedOrTypedNroBiopsia.class);
	
	/**
	 * 
	 */
	private GUIPressedOrTypedNroBiopsia() {
		// TODO Auto-generated constructor stub
	}
	
	/**
	 * 
	 * @param ventana
	 * @param event
	 * @param textNroBiopsia
	 * @param oldValue
	 * @return
	 */
	public static BiopsiaInfoDTO manageKeyEvent(Component ventana, KeyEvent event, JTextField textNroBiopsia,
			BiopsiaInfoDTO oldValue){
		BiopsiaInfoDTO biopsia = null;
		String nroBiopsia = "";
		String abreviatura = "";
		boolean doProcess = false;
		
		//vemos el tipo de evento para manipular el texto del campo como corresponda
		if(event.getID() == KeyEvent.KEY_PRESSED){
			if(KeyEventsUtil.wasPressedAEnter(event) || KeyEventsUtil.wasPressedABackSpace(event)){
				//verifico si la biopsia existe para cargar los datos
				//solo si el campo no es vacio
				if(! "".equals(textNroBiopsia.getText().trim())){
					doProcess = true;
					nroBiopsia = textNroBiopsia.getText();
					if(KeyEventsUtil.wasPressedABackSpace(event)){
						nroBiopsia = nroBiopsia.substring(0, nroBiopsia.length() - 1);
					}
					nroBiopsia = nroBiopsia.replaceAll("'", "-");
					nroBiopsia = BiopsiaValidationUtil.formatCodigoBiopsia(nroBiopsia);
				}
			}
		} else if(event.getID() == KeyEvent.KEY_TYPED){
			if(! KeyEventsUtil.wasTypedANumber(event) && !KeyEventsUtil.wasTypedADash(event)){
				//quemamos el evento para evitar el tipeo real
				event.consume();
				nroBiopsia = textNroBiopsia.getText();
			} else {
				doProcess = true;
				nroBiopsia = textNroBiopsia.getText() + event.getKeyChar();
			}
			
			nroBiopsia = nroBiopsia.replaceAll("'", "-");
		}
		
		try {
			abreviatura = "-" + nroBiopsia.split("-")[2];
			nroBiopsia =  nroBiopsia.split("-")[0] + "-" +  nroBiopsia.split("-")[1];
		} catch (Exception e) {
			// TODO: handle exception
		} 
		
		if(doProcess){
			try {
				log.info("Debo verificar la biopsia '" + nroBiopsia + "'");
				
				//verificamos los datos basicos del cliente para esa cedula
				biopsia = BiopsiaInfoDAO.getBiopsiaByNumero(nroBiopsia, abreviatura);
				
				if(event.getID() == KeyEvent.KEY_PRESSED){
					if(biopsia == null && KeyEventsUtil.wasPressedAEnter(event)){
						log.info("Biopsia '" + nroBiopsia + "' no existe");
						JOptionPane.showMessageDialog(ventana, 
								"Disculpe, el número de biopsia indicado no existe.",
								"Biopsia " + nroBiopsia + " no existe.",
								JOptionPane.ERROR_MESSAGE);
					} else if(biopsia != null){
						log.info("Biopsia '" + nroBiopsia + "' si existe");
						//event.consume();
						//textNroBiopsia.setText(biopsia.getCodigo());
						//event.consume();
					}
				} else {
					if(biopsia != null){
						event.consume();
						//textNroBiopsia.setText(biopsia.getCodigo());
						//event.consume();
						log.info("Biopsia '" + nroBiopsia + "' si existe");
					}
				}
			} catch (Exception e) {
				// TODO: handle exception
				log.error(e.getMessage(), e);
			}
		} else {
			biopsia = oldValue;
		}
		
		
		return biopsia;
	}
}
