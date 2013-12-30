package com.fjr.code.gui.operations;

import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.FocusEvent;
import java.awt.event.FocusListener;
import java.awt.event.KeyEvent;
import java.awt.event.KeyListener;
import java.util.LinkedList;
import java.util.List;

import javax.swing.JOptionPane;
import javax.swing.JTextField;

import org.apache.log4j.Logger;

import com.fjr.code.barcode.BarCodeHistologia;
import com.fjr.code.dto.BiopsiaCasseteDTO;
import com.fjr.code.gui.CustomHistologiaPrintDialog;

/**
 * 
 * Class: CustomHistologiaPrintDialogOperations
 * Creation Date: 29/12/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class CustomHistologiaPrintDialogOperations implements ActionListener, KeyListener, FocusListener{
	private static final Logger log = Logger.getLogger(CustomHistologiaPrintDialogOperations.class);
	private static final String VALUES_ALLOWED = ",0123456789";
	
	public static final String ACTION_COMMAND_OK = "btnOk";
	public static final String ACTION_COMMAND_CANCEL = "btnCancel";
	public static final String ACTION_COMMAND_TXT_LAMINAS = "txtLaminas";
	
	private CustomHistologiaPrintDialog ventana;
	
	/**
	 * 
	 * @param ventana
	 */
	public CustomHistologiaPrintDialogOperations(CustomHistologiaPrintDialog ventana) {
		// TODO Auto-generated constructor stub
		this.ventana = ventana;
	}

	@Override
	public void keyTyped(KeyEvent e) {
		// TODO Auto-generated method stub
		if(VALUES_ALLOWED.contains("" + e.getKeyChar())){
			log.info("Es valido el caracter " + e.getKeyChar());
		} else {
			e.consume();
		}
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
	public void actionPerformed(ActionEvent e) {
		// TODO Auto-generated method stub
		if(ACTION_COMMAND_OK.equals(e.getActionCommand())){
			log.info("Peticion para imprimir etiquetas personalizadas");
			List<BiopsiaCasseteDTO> cassetes = new LinkedList<BiopsiaCasseteDTO>();
			
			if(ventana.getrBtnTodas().isSelected()){
				log.info("Se desean imprimir todas las laminas ("
						+ ventana.getMaxLaminas() + ")");
				for (int i = 0; i < ventana.getMaxLaminas(); i++) {
					BiopsiaCasseteDTO casseteDTO = new BiopsiaCasseteDTO();
					casseteDTO.setNumero(ventana.getCassete());
					casseteDTO.setBloques(ventana.getcBoxBloque().getSelectedIndex() + 1);
					casseteDTO.setLaminaEspecifica(i + 1);
					casseteDTO.setLaminas(ventana.getMaxLaminas());
					
					cassetes.add(casseteDTO);
				}
			} else {
				log.info("Se desean imprimir laminas especificas");
				String[] laminas = ventana.getTxtLaminas().getText().split(",");
				
				if (laminas != null && laminas.length > 0) {
					for (int i = 0; i < laminas.length; i++) {
						BiopsiaCasseteDTO casseteDTO = new BiopsiaCasseteDTO();
						casseteDTO.setNumero(ventana.getCassete());
						casseteDTO.setBloques(ventana.getcBoxBloque().getSelectedIndex() + 1);
						casseteDTO.setLaminaEspecifica(Integer.parseInt(laminas[i]));
						casseteDTO.setLaminas(ventana.getMaxLaminas());
					
						cassetes.add(casseteDTO);
					}
				} else {
					JOptionPane.showMessageDialog(ventana, 
							"Debe indicar de manera correcta los valores de las laminas", 
							"Valor inválido", 
							JOptionPane.ERROR_MESSAGE);
				}
			}
			
			log.info("Listado de " + cassetes.size());
			if(cassetes.size() > 0){
				BarCodeHistologia printHistologia = new BarCodeHistologia(ventana.getCodigoBiopsia(), cassetes, true);
				try {
					printHistologia.crearEtiquetaHistologia();
					printHistologia.printLabelFile();
				} catch (Exception e1) {
					// TODO Auto-generated catch block
					log.error("Error imprimiendo etiquetas de cassetes", e1);
				}
			}
		} else if(ACTION_COMMAND_CANCEL.equals(e.getActionCommand())){
			ventana.setVisible(false);
			ventana.dispose();
		}
	}

	@Override
	public void focusGained(FocusEvent e) {
		// TODO Auto-generated method stub
		if(e.getSource() instanceof JTextField){
			JTextField field = (JTextField) e.getSource();
			if(ACTION_COMMAND_TXT_LAMINAS.equals(field.getName())){
				ventana.getrBtnEspecificas().setSelected(true);
			}
		}
	}

	@Override
	public void focusLost(FocusEvent e) {
		// TODO Auto-generated method stub
		
	}
}
