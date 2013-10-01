package com.fjr.code.dao;

import java.util.LinkedList;
import java.util.List;

import javax.sql.rowset.CachedRowSet;

import org.apache.log4j.Logger;

import com.fjr.code.dao.definitions.DAOListBuilder;
import com.fjr.code.dto.CategoriaReactivoDTO;
import com.fjr.code.dto.ReactivoDTO;
import com.fjr.code.util.DBUtil;

/**
 * 
 * Class: BiopsiaMicroLaminasReactivosDAOListBuilder
 * Creation Date: 14/09/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
final class BiopsiaMicroLaminasReactivosDAOListBuilder implements DAOListBuilder<ReactivoDTO> {
	private static final Logger log = Logger.  getLogger(BiopsiaMicroLaminasReactivosDAOListBuilder.class);
	
	private static final String BEGIN = "SELECT cr.id, cr.nombre, r.id, r.nombre, r.abreviatura, r.precio, "
			+ " ml.descripcion, ml.procesado"
			+ " FROM micro_laminas ml, reactivos r, categorias_reactivos cr"
			+ " WHERE r.id > 0"
			+ " AND r.id_categoria_reactivo = cr.id "
			+ " AND ml.id_reactivo = r.id";
	
	private static final String END = " ORDER BY r.nombre";
	
	private String customWhere;
	private List<Object> parameters;
	
	/**
	 * 
	 */
	public BiopsiaMicroLaminasReactivosDAOListBuilder() {
		// TODO Auto-generated constructor stub
		customWhere = "";
		parameters = new LinkedList<Object>();
	}
	
	
	public void searchByIdBiopsia(int id){
		customWhere += " AND ml.id = ?";
		parameters.add(id);
	}
	
	public void searchByCassete(int cassete){
		customWhere += " AND ml.cassete = ?";
		parameters.add(cassete);
	}
	
	public void searchByBloque(int bloque){
		customWhere += " AND ml.bloque = ?";
		parameters.add(bloque);
	}
	
	public void searchByLamina(int lamina){
		customWhere += " AND ml.lamina = ?";
		parameters.add(lamina);
	}
	
	@Override
	public List<Object> getParameters() {
		// TODO Auto-generated method stub
		return parameters;
	}

	@Override
	public String getQuery() {
		// TODO Auto-generated method stub
		return BEGIN + customWhere + END;
	}

	@Override
	public List<ReactivoDTO> getResults() {
		// TODO Auto-generated method stub
		List<ReactivoDTO> results = new LinkedList<ReactivoDTO>();
		
		try {
			CachedRowSet rowSet = DBUtil.executeSelectQuery(getQuery(), getParameters());
			
			while (rowSet.next()) {
				CategoriaReactivoDTO categoriaDTO = new CategoriaReactivoDTO();
				categoriaDTO.setId(rowSet.getInt(1));
				categoriaDTO.setNombre(rowSet.getString(2));
				
				ReactivoDTO tempDTO = new ReactivoDTO();
				tempDTO.setId(rowSet.getInt(3));
				tempDTO.setNombre(rowSet.getString(4));
				tempDTO.setAbreviatura(rowSet.getString(5));
				tempDTO.setPrecio(rowSet.getDouble(6));
				tempDTO.setDescripcionIHQ(rowSet.getString(7));
				tempDTO.setProcesadoIHQ(rowSet.getBoolean(8));
				tempDTO.setCategoriaReactivoDTO(categoriaDTO);
				
				
				log.info("Leida de la base de datos reactivo de lamina micro: " + tempDTO);
				results.add(tempDTO);
			}
		} catch (Exception e) {
			// TODO: handle exception
			log.error(e.getMessage(), e);
		}
		
		return results;
	}
}
