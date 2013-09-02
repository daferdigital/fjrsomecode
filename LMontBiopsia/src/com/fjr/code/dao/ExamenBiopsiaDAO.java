package com.fjr.code.dao;

import java.util.LinkedList;
import java.util.List;

import javax.sql.rowset.CachedRowSet;
import javax.swing.JComboBox;

import org.apache.log4j.Logger;

import com.fjr.code.dto.ExamenBiopsiaDTO;
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
public final class ExamenBiopsiaDAO {
	/**
	 * 
	 */
	private static final Logger log = Logger.getLogger(ExamenBiopsiaDAO.class);
	
	/**
	 * 
	 */
	private ExamenBiopsiaDAO() {
		// TODO Auto-generated constructor stub
	}
	
	/**
	 * 
	 * @return
	 */
	public static final List<ExamenBiopsiaDTO> getAll(){
		final String query = "SELECT te.id AS idTipoExamen, te.codigo AS codigoTipoExamen, te.nombre AS nombreTipoExamen, "
				+ " eb.id AS idExamen, eb.codigo AS codigoExamen, eb.nombre AS nombreExamen, eb.dias_resultado "
				+ " FROM tipo_examenes te, examenes_biopsias eb"
				+ " WHERE te.activo='1'"
				+ " AND eb.activo='1'"
				+ " AND te.id = eb.id_tipo_examen"
				+ " ORDER BY eb.codigo, eb.nombre";
		
		List<ExamenBiopsiaDTO> result = new LinkedList<ExamenBiopsiaDTO>();
		
		try {
			CachedRowSet rowSet = DBUtil.executeSelectQuery(query);
			
			while (rowSet.next()) {
				result.add(new ExamenBiopsiaDTO(rowSet.getInt(4),
						rowSet.getString(5),
						rowSet.getString(6),
						rowSet.getInt(7),
						rowSet.getInt(1),
						rowSet.getString(2),
						rowSet.getString(3)));
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
		List<ExamenBiopsiaDTO> items = getAll();
		
		comboBox.addItem(new ExamenBiopsiaDTO(0, 
				"", 
				"Seleccione", 
				0, 
				0, 
				"", 
				""));
		for (ExamenBiopsiaDTO examenBiopsiaDTO : items) {
			comboBox.addItem(examenBiopsiaDTO);
		}
		
		log.info("Agregados elementos al combo-box de los tipos de examenes");
	}
}
