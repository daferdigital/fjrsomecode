package com.fjr.code.dao;

import java.util.LinkedList;
import java.util.List;

import javax.sql.rowset.CachedRowSet;
import javax.swing.JComboBox;

import org.apache.log4j.Logger;

import com.fjr.code.dto.PatologoDTO;
import com.fjr.code.util.DBUtil;

/**
 * 
 * Class: ExamenBiopsiaDAO
 * Creation Date: 28/08/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public final class PatologoDAO {
	/**
	 * 
	 */
	private static final Logger log = Logger.getLogger(PatologoDAO.class);
	
	/**
	 * 
	 */
	private PatologoDAO() {
		// TODO Auto-generated constructor stub
	}
	
	/**
	 * 
	 * @return
	 */
	public static final List<PatologoDTO> getAll(){
		final String query = "SELECT p.id, p.nombre, p.activo "
				+ " FROM patologos p"
				+ " WHERE p.activo='1'"
				+ " ORDER BY p.nombre";
		
		List<PatologoDTO> result = new LinkedList<PatologoDTO>();
		
		try {
			CachedRowSet rowSet = DBUtil.executeSelectQuery(query);
			
			while (rowSet.next()) {
				result.add(new PatologoDTO(rowSet.getInt(1),
						rowSet.getString(2),
						"1".equals(rowSet.getString(3))));
			}
		} catch (Exception e) {
			// TODO: handle exception
			log.error(e.getMessage(), e);
		}
		
		return result;
	}
	
	/**
	 * 
	 * @param combo
	 */
	public static void populateJCombo(JComboBox comboBox){
		List<PatologoDTO> items = getAll();
		
		comboBox.addItem(new PatologoDTO(0, "Seleccione", false));
		for (PatologoDTO patologoDTO : items) {
			comboBox.addItem(patologoDTO);
		}
		
		log.info("Agregados elementos al combo-box de los patologos");
	}
}
