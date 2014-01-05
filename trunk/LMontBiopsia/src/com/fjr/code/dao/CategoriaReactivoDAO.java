package com.fjr.code.dao;

import java.util.LinkedList;
import java.util.List;
import java.util.Map;

import javax.swing.JComboBox;

import org.apache.log4j.Logger;

import com.fjr.code.dao.definitions.CriterioBusquedaCategoriaReactivo;
import com.fjr.code.dto.CategoriaReactivoDTO;
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
public final class CategoriaReactivoDAO {
	/**
	 * 
	 */
	private static final Logger log = Logger.getLogger(CategoriaReactivoDAO.class);
	
	/**
	 * 
	 */
	private CategoriaReactivoDAO() {
		// TODO Auto-generated constructor stub
	}
	
	/**
	 * 
	 * @return
	 */
	public static final CategoriaReactivoDTO getById(int id){
		CategoriaReactivoDAOListBuilder builder = new CategoriaReactivoDAOListBuilder();
		builder.searchById(id);
		
		List<CategoriaReactivoDTO> result = builder.getResults();
		if(result != null && result.size() > 0){
			return result.get(0);
		}
		
		return null;
	}
	
	/**
	 * 
	 * @return
	 */
	public static final List<CategoriaReactivoDTO> getAll(){
		CategoriaReactivoDAOListBuilder builder = new CategoriaReactivoDAOListBuilder();
		
		List<CategoriaReactivoDTO> result = builder.getResults();
		
		return result;
	}
	
	/**
	 * 
	 * @param comboBox
	 */
	public static void populateJCombo(JComboBox comboBox){
		populateJCombo(comboBox, 0);
	}
	
	/**
	 * 
	 * @param comboBox
	 * @param idToSelect
	 */
	public static void populateJCombo(JComboBox comboBox, int idToSelect){
		List<CategoriaReactivoDTO> items = getAll();
		
		CategoriaReactivoDTO tempDTO = new CategoriaReactivoDTO();
		tempDTO.setId(0);
		tempDTO.setNombre("Seleccione");
		
		comboBox.addItem(tempDTO);
		for (CategoriaReactivoDTO categoriaReactivoDTO : items) {
			comboBox.addItem(categoriaReactivoDTO);
			if(idToSelect == categoriaReactivoDTO.getId()){
				comboBox.setSelectedIndex(comboBox.getItemCount() - 1);
			}
		}
		
		log.info("Agregados elementos al combo-box de las categorias de los reactivos");
	}
	
	/**
	 * 
	 * @param valores
	 * @return 
	 */
	public static List<CategoriaReactivoDTO> searchAllByCriteria(
			Map<CriterioBusquedaCategoriaReactivo, String> valores) {
		// TODO Auto-generated method stub
		CategoriaReactivoDAOListBuilder builder = new CategoriaReactivoDAOListBuilder();
		
		if(valores != null){
			for (CriterioBusquedaCategoriaReactivo criterio : valores.keySet()) {
				if(CriterioBusquedaCategoriaReactivo.NOMBRE.equals(criterio)){
					builder.searchByLikeNombre(valores.get(criterio));
				}
			}
		}
		
		return builder.getResults();
	}
	
	/**
	 * 
	 * @param categoriaReactivoDTO
	 * @return
	 */
	public static int insert(CategoriaReactivoDTO categoriaReactivoDTO) {
		// TODO Auto-generated method stub
		int idCreated = -1;
		
		try {
			final String query = "INSERT INTO categorias_reactivos (nombre) VALUES (?)";
			List<Object> parameters = new LinkedList<Object>();
			
			parameters.add(categoriaReactivoDTO.getNombre());
			
			idCreated = DBUtil.executeInsertQuery(query, parameters);
		} catch (Exception e) {
			// TODO: handle exception
			log.error("Error creando examen. Error: " + e.getMessage(), e);
		}
		
		return idCreated;
	}
	
	/**
	 * 
	 * @param categoriaReactivoDTO
	 * @return
	 */
	public static boolean update(CategoriaReactivoDTO categoriaReactivoDTO) {
		// TODO Auto-generated method stub
		boolean wasUpdated = true;
		
		try {
			final String query = "UPDATE categorias_reactivos SET nombre=? WHERE id=?";
			List<Object> parameters = new LinkedList<Object>();
			
			parameters.add(categoriaReactivoDTO.getNombre());
			parameters.add(categoriaReactivoDTO.getId());
			
			wasUpdated = DBUtil.executeNonSelectQuery(query, parameters);
		} catch (Exception e) {
			// TODO: handle exception
			wasUpdated = false;
			log.error("Error actualizando categoria de reactivo. Error: " + e.getMessage(), e);
		}
		
		return wasUpdated;
	}
}
