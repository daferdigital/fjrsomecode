package com.fjr.code.gui.operations;

import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

import com.fjr.code.dao.BiopsiaInfoDAO;
import com.fjr.code.dao.definitions.FasesBiopsia;
import com.fjr.code.gui.ComprobanteMaterialDialog;
import com.fjr.code.pdf.ComprobanteEntregaMaterial;

/**
 * 
 * Class: ComprobanteMaterialDialogOperations
 * Creation Date: 05/01/2014
 * (c) 2014
 *
 * @author T&T
 *
 */
public class ComprobanteMaterialDialogOperations implements ActionListener {
	public static final String ACTION_COMMAND_BUTTON_GENERAR = "generar";
	public static final String ACTION_COMMAND_BUTTON_CANCELAR = "cancelar";
	
	private ComprobanteMaterialDialog ventana;
	
	/**
	 * 
	 * @param ventana
	 */
	public ComprobanteMaterialDialogOperations(ComprobanteMaterialDialog ventana) {
		// TODO Auto-generated constructor stub
		this.ventana = ventana;
	}
	
	@Override
	public void actionPerformed(ActionEvent e) {
		// TODO Auto-generated method stub
		if(ACTION_COMMAND_BUTTON_GENERAR.equals(e.getActionCommand())){
			BiopsiaInfoDAO.moveBiopsiaToFase(ventana.getIdBiopsia(), FasesBiopsia.MATERIAL_ENTREGADO);
			ComprobanteEntregaMaterial comprobante = new ComprobanteEntregaMaterial(
					BiopsiaInfoDAO.getBiopsiaById(ventana.getIdBiopsia()),
					ventana.getcBoxBloques().getSelectedIndex(),
					ventana.getcBoxLaminas().getSelectedIndex());
			comprobante.buildDiagnostico();
			comprobante.open();
		}
		
		ventana.dispose();
		ventana.setVisible(false);
	}
}
