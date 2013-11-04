package com.fjr.code.dao;

import java.util.LinkedList;
import java.util.List;

import javax.swing.JComboBox;

import org.apache.log4j.Logger;

import com.fjr.code.dto.EspecialidadDTO;
import com.fjr.code.util.DBUtil;

/**
 * 
 * Class: TipoExamenDAO
 * Creation Date: 28/08/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public final class EspecialidadDAO {
	/**
	 * 
	 */
	private static final Logger log = Logger.getLogger(EspecialidadDAO.class);
	
	/**
	 * 
	 */
	private EspecialidadDAO() {
		// TODO Auto-generated constructor stub
	}
	
	/**
	 * Obtenemos todos los examenes posibles de las biopsias.
	 * 
	 * @return
	 */
	public static final List<EspecialidadDTO> getAll(){
		EspecialidadDAOListBuilder builder = new EspecialidadDAOListBuilder();
		
		List<EspecialidadDTO> result = builder.getResults();
		
		return result;
	}
	
	/**
	 * Obtenemos el examen en base a su id.
	 * 
	 * @return
	 */
	public static final EspecialidadDTO getById(int idTipoExamen){
		EspecialidadDAOListBuilder builder = new EspecialidadDAOListBuilder();
		builder.searchByTipoExamenId(idTipoExamen);
		
		List<EspecialidadDTO> result = builder.getResults();
		if(result != null && result.size() > 0){
			return result.get(0);
		}
		
		return null;
	}
	
	/**
	 * 
	 * @param combo
	 */
	public static void populateJCombo(JComboBox comboBox, boolean addEmptyRecord){
		List<EspecialidadDTO> items = getAll();
		
		if(addEmptyRecord){
			EspecialidadDTO tipo = new EspecialidadDTO();
			tipo.setId(-1);
			tipo.setCodigo("");
			tipo.setNombre("Seleccione");
			tipo.setActivo(false);
			tipo.setDescripcion("");
			
			comboBox.addItem(tipo);
			
		}
		
		for (EspecialidadDTO tipoExamenDTO : items) {
			comboBox.addItem(tipoExamenDTO);
		}
		
		log.info("Agregados elementos al combo-box de los tipos de examenes");
	}

	/**
	 * 
	 * @param especialidad
	 */
	public static int insert(EspecialidadDTO especialidad) {
		// TODO Auto-generated method stub
		int idCreated = -1;
		
		try {
			final String query = "INSERT INTO especialidad (nombre, codigo, descripcion, activo) VALUES (?,?,?,?)";
			List<Object> parameters = new LinkedList<Object>();
			
			parameters.add(especialidad.getNombre());
			parameters.add(especialidad.getCodigo());
			parameters.add(especialidad.getDescripcion());
			parameters.add(especialidad.isActivo());
			
			idCreated = DBUtil.executeInsertQuery(query, parameters);
			
		} catch (Exception e) {
			// TODO: handle exception
			log.error("Error creando especialidad. Error: " + e.getMessage(), e);
		}
		
		return idCreated;
	}
}
