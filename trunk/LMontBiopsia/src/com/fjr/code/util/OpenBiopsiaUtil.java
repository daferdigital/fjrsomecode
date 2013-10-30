package com.fjr.code.util;

import java.io.File;
import java.sql.SQLException;
import java.util.LinkedList;
import java.util.List;

import javax.sql.rowset.CachedRowSet;
import javax.swing.JOptionPane;

import com.fjr.code.dao.BiopsiaInfoDAO;
import com.fjr.code.dao.definitions.FasesBiopsia;
import com.fjr.code.dto.BiopsiaInfoDTO;
import com.fjr.code.gui.InformeImpresoDialog;

/**
 * 
 * Class: OpenBiopsiaUtil
 * Creation Date: 27/10/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class OpenBiopsiaUtil {

	/**
	 * 
	 * @param numero
	 */
	public static void openBiopsia(String numero) {
		// TODO Auto-generated method stub
		BiopsiaInfoDTO biopsia = BiopsiaInfoDAO.getBiopsiaByNumero(numero);
		
		if(biopsia == null){
			JOptionPane.showMessageDialog(null, 
					"La biopsia de numero " + numero + " no fue encontrada en el sistema", 
					"Biopsia " + numero + " no encontrada", 
					JOptionPane.ERROR_MESSAGE);
		} else {
			//vemos la fase de la biopsia para saber que frame abrir
			if(FasesBiopsia.INFORME_IMPRESO.equals(biopsia.getFaseActual())){
				//abriendo biopsia en fase de informe ya impreso
				//traemos el ultimo informe impreso al disco
				final String query = "SELECT ultimo_informe_impreso FROM biopsias WHERE id=?";
				List<Object> parameters = new LinkedList<Object>();
				parameters.add(biopsia.getId());
				
				CachedRowSet rows = DBUtil.executeSelectQuery(query, parameters);
				try {
					if(rows.next()){
						File diagnostico = new File(Constants.TMP_PATH + File.separator + "diagnostico_" + biopsia.getId() + ".pdf");
						BLOBToDiskUtil.writeBLOBToDisk(diagnostico, 
								rows.getBytes(1));
						
						new InformeImpresoDialog(diagnostico.getAbsolutePath(), biopsia.getCodigo()).setVisible(true);
					}
				} catch (SQLException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}
				
			}
		}
	}
}
