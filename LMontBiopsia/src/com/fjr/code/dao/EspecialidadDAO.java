package com.fjr.code.dao;

import java.util.LinkedList;
import java.util.List;
import java.util.Map;

import javax.swing.JComboBox;

import org.apache.log4j.Logger;

import com.fjr.code.dao.definitions.CriterioBusquedaEspecialidad;
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
	 * Obtenemos la especialidad en base a su id.
	 * 
	 * @return
	 */
	public static final EspecialidadDTO getById(int idEspecialidad){
		EspecialidadDAOListBuilder builder = new EspecialidadDAOListBuilder();
		builder.searchById(idEspecialidad);
		
		List<EspecialidadDTO> result = builder.getResults();
		if(result != null && result.size() > 0){
			return result.get(0);
		}
		
		return null;
	}
	
	public static void populateJCombo(JComboBox comboBox, boolean addEmptyRecord){
		populateJCombo(comboBox, addEmptyRecord, -1);
	}
	
	/**
	 * 
	 * @param combo
	 */
	public static void populateJCombo(JComboBox comboBox, boolean addEmptyRecord,
			int idToSelect){
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
			if(idToSelect != -1){
				if(tipoExamenDTO.getId() == idToSelect){
					comboBox.setSelectedIndex(comboBox.getItemCount() - 1);
				}
			}
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
	
	/**
	 * 
	 * @param valores
	 * @return 
	 */
	public static List<EspecialidadDTO> searchAllByCriteria(
			Map<CriterioBusquedaEspecialidad, String> valores) {
		// TODO Auto-generated method stub
		EspecialidadDAOListBuilder builder = new EspecialidadDAOListBuilder();
		
		if(valores != null){
			for (CriterioBusquedaEspecialidad criterio : valores.keySet()) {
				if(CriterioBusquedaEspecialidad.NOMBRE.equals(criterio)){
					builder.searchByLikeNombre(valores.get(criterio));
				} else if(CriterioBusquedaEspecialidad.DESCRIPCION.equals(criterio)){
					builder.searchByLikeDescripcion(valores.get(criterio));
				} else if(CriterioBusquedaEspecialidad.CODIGO.equals(criterio)){
					builder.searchByLikeCodigo(valores.get(criterio));
				}
			}
		}
		
		//verificamos las fechas desde y hasta
		return builder.getResults();
	}
	
	/**
	 * 
	 * @param tipoEstudioDTO
	 * @return
	 */
	public static boolean update(EspecialidadDTO especialidadDTO) {
		// TODO Auto-generated method stub
		boolean wasUpdated = true;
		
		try {
			final String query = "UPDATE especialidad SET nombre=?, codigo=?, descripcion=? WHERE id=?";
			List<Object> parameters = new LinkedList<Object>();
			
			parameters.add(especialidadDTO.getNombre());
			parameters.add(especialidadDTO.getCodigo());
			parameters.add(especialidadDTO.getDescripcion());
			parameters.add(especialidadDTO.getId());
			
			wasUpdated = DBUtil.executeNonSelectQuery(query, parameters);
			log.info("Actualizada especialidad de id=" + especialidadDTO.getId());
		} catch (Exception e) {
			// TODO: handle exception
			wasUpdated = false;
			log.error("Error creando especialidad. Error: " + e.getMessage(), e);
		}
		
		return wasUpdated;
	}
	
	/**
	 * 
	 * @param tipoEstudioDTO
	 * @return
	 */
	public static boolean delete(int idTipoEstudio) {
		// TODO Auto-generated method stub
		boolean wasDeleted = true;
		
		try {
			final String query = "UPDATE especialidad SET activo='0' WHERE id=?";
			
			List<Object> parameters = new LinkedList<Object>();
			parameters.add(idTipoEstudio);
			
			wasDeleted = DBUtil.executeNonSelectQuery(query, parameters);
			log.info("Borrado (logicamente) especialidad de id=" + idTipoEstudio);
		} catch (Exception e) {
			// TODO: handle exception
			wasDeleted = false;
			log.error("Error borrando (logicamente) especialidad de id=" 
					+ idTipoEstudio + ". Error: " + e.getMessage(), e);
		}
		
		return wasDeleted;
	}
}
