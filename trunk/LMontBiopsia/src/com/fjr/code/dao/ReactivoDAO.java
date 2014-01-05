package com.fjr.code.dao;

import java.util.LinkedList;
import java.util.List;
import java.util.Map;

import javax.swing.JComboBox;

import org.apache.log4j.Logger;

import com.fjr.code.dao.definitions.CriterioBusquedaReactivo;
import com.fjr.code.dto.ReactivoDTO;
import com.fjr.code.util.DBUtil;

/**
 * 
 * Class: ReactivoDAO
 * Creation Date: 28/08/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public final class ReactivoDAO {
	/**
	 * 
	 */
	private static final Logger log = Logger.getLogger(ReactivoDAO.class);
	
	/**
	 * 
	 */
	private ReactivoDAO() {
		// TODO Auto-generated constructor stub
	}
	
	/**
	 * 
	 * @return
	 */
	public static final ReactivoDTO getById(int id){
		ReactivoDAOListBuilder builder = new ReactivoDAOListBuilder();
		builder.searchById(id);
		
		List<ReactivoDTO> result = builder.getResults();
		if(result != null && result.size() > 0){
			return result.get(0);
		}
		
		return null;
	}
	
	/**
	 * 
	 * @return
	 */
	public static final List<ReactivoDTO> getAll(){
		ReactivoDAOListBuilder builder = new ReactivoDAOListBuilder();
		
		List<ReactivoDTO> result = builder.getResults();
		
		return result;
	}
	
	/**
	 * 
	 * @param comboBox
	 * @param idToSelect
	 */
	public static void populateJCombo(JComboBox comboBox, int idToSelect){
		List<ReactivoDTO> items = getAll();
		
		ReactivoDTO tempDTO = new ReactivoDTO();
		tempDTO.setId(0);
		tempDTO.setNombre("Seleccione");
		
		comboBox.addItem(tempDTO);
		for (ReactivoDTO reactivoDTO : items) {
			comboBox.addItem(reactivoDTO);
			if(idToSelect == reactivoDTO.getId()){
				comboBox.setSelectedIndex(comboBox.getItemCount() - 1);
			}
		}
		
		log.info("Agregados elementos al combo-box de los reactivos");
	}
	
	/**
	 * 
	 * @param valores
	 * @return 
	 */
	public static List<ReactivoDTO> searchAllByCriteria(
			Map<CriterioBusquedaReactivo, String> valores) {
		// TODO Auto-generated method stub
		ReactivoDAOListBuilder builder = new ReactivoDAOListBuilder();
		
		if(valores != null){
			for (CriterioBusquedaReactivo criterio : valores.keySet()) {
				if(CriterioBusquedaReactivo.NOMBRE.equals(criterio)){
					builder.searchByLikeNombre(valores.get(criterio));
				} else if(CriterioBusquedaReactivo.ABREVIATURA.equals(criterio)){
					builder.searchByLikeAbreviatura(valores.get(criterio));
				} else if(CriterioBusquedaReactivo.CATEGORIA.equals(criterio)){
					builder.searchByLikeCategoriaNombre(valores.get(criterio));
				}
			}
		}
		
		return builder.getResults();
	}
	
	/**
	 * 
	 * @param tipoEstudioDTO
	 * @return
	 */
	public static int insert(ReactivoDTO reactivoDTO) {
		// TODO Auto-generated method stub
		int idCreated = -1;
		
		try {
			final String query = "INSERT INTO reactivos (nombre, abreviatura, precio, id_categoria_reactivo) VALUES (?,?,?,?)";
			List<Object> parameters = new LinkedList<Object>();
			
			parameters.add(reactivoDTO.getNombre());
			parameters.add(reactivoDTO.getAbreviatura().length() > 5 
					? reactivoDTO.getAbreviatura().substring(0, 5) : reactivoDTO.getAbreviatura());
			parameters.add(reactivoDTO.getPrecio());
			parameters.add(reactivoDTO.getCategoriaReactivoDTO().getId());
			
			idCreated = DBUtil.executeInsertQuery(query, parameters);
		} catch (Exception e) {
			// TODO: handle exception
			log.error("Error creando reactivo. Error: " + e.getMessage(), e);
		}
		
		return idCreated;
	}
	
	/**
	 * 
	 * @param reactivoDTO
	 * @return
	 */
	public static boolean update(ReactivoDTO reactivoDTO) {
		// TODO Auto-generated method stub
		boolean wasUpdated = true;
		
		try {
			final String query = "UPDATE reactivos SET nombre=?, abreviatura=?, precio=?, id_categoria_reactivo=? WHERE id=?";
			List<Object> parameters = new LinkedList<Object>();
			
			parameters.add(reactivoDTO.getNombre());
			parameters.add(reactivoDTO.getAbreviatura().length() > 5 
					? reactivoDTO.getAbreviatura().substring(0, 5) : reactivoDTO.getAbreviatura());
			parameters.add(reactivoDTO.getPrecio());
			parameters.add(reactivoDTO.getCategoriaReactivoDTO().getId());
			parameters.add(reactivoDTO.getId());
			
			wasUpdated = DBUtil.executeNonSelectQuery(query, parameters);
		} catch (Exception e) {
			// TODO: handle exception
			wasUpdated = false;
			log.error("Error actualizando reactivo. Error: " + e.getMessage(), e);
		}
		
		return wasUpdated;
	}
	
	/**
	 * 
	 * @param tipoEstudioDTO
	 * @return
	 */
	public static boolean delete(int idReactivo) {
		// TODO Auto-generated method stub
		boolean wasDeleted = true;
		
		try {
			final String query = "UPDATE reactivos SET activo='0' WHERE id=?";
			
			List<Object> parameters = new LinkedList<Object>();
			parameters.add(idReactivo);
			
			wasDeleted = DBUtil.executeNonSelectQuery(query, parameters);
			log.info("Borrado (logicamente) reactivo de id=" + idReactivo);
		} catch (Exception e) {
			// TODO: handle exception
			wasDeleted = false;
			log.error("Error borrando (logicamente) reactivo de id=" 
					+ idReactivo + ". Error: " + e.getMessage(), e);
		}
		
		return wasDeleted;
	}
}
