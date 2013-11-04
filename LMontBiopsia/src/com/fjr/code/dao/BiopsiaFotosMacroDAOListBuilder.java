package com.fjr.code.dao;

import java.io.File;
import java.util.LinkedList;
import java.util.List;

import javax.sql.rowset.CachedRowSet;

import org.apache.log4j.Logger;

import com.fjr.code.dao.definitions.DAOListBuilder;
import com.fjr.code.dto.BiopsiaMacroFotoDTO;
import com.fjr.code.util.BLOBToDiskUtil;
import com.fjr.code.util.Constants;
import com.fjr.code.util.DBUtil;

/**
 * 
 * Class: BiopsiaFotosMacroDAOListBuilder
 * Creation Date: 14/09/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
final class BiopsiaFotosMacroDAOListBuilder implements DAOListBuilder<BiopsiaMacroFotoDTO> {
	private static final Logger log = Logger.getLogger(BiopsiaFotosMacroDAOListBuilder.class);
	
	private static final String BEGIN = "SELECT mf.id, mf.notacion, mf.descripcion, mf.foto, mf.file_name, mf.es_foto_per_operatoria"
			+ " FROM macro_fotos mf "
			+ " WHERE 1 = 1";
	private static final String END = " ORDER BY mf.fecha_registro";
	
	private String customWhere;
	private List<Object> parameters;
	
	/**
	 * 
	 */
	public BiopsiaFotosMacroDAOListBuilder() {
		// TODO Auto-generated constructor stub
		customWhere = "";
		parameters = new LinkedList<Object>();
	}
	
	
	public void searchByIdBiopsia(int id){
		customWhere += " AND mf.id = ?";
		parameters.add(id);
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
	public List<BiopsiaMacroFotoDTO> getResults() {
		// TODO Auto-generated method stub
		List<BiopsiaMacroFotoDTO> results = new LinkedList<BiopsiaMacroFotoDTO>();
		
		try {
			CachedRowSet rowSet = DBUtil.executeSelectQuery(getQuery(), getParameters());
			
			while (rowSet.next()) {
				BiopsiaMacroFotoDTO macroFoto = new BiopsiaMacroFotoDTO();
				String fileName = rowSet.getInt(1) + "_";
				if(rowSet.getString(5) != null && !rowSet.getString(5).startsWith(fileName)){
					fileName += rowSet.getString(5);
				} else {
					fileName = rowSet.getString(5);
				}
				
				File destination = new File(Constants.TMP_PATH + File.separator + fileName);
				
				macroFoto.setId(rowSet.getInt(1));
				macroFoto.setNotacion(rowSet.getString(2));
				macroFoto.setDescripcion(rowSet.getString(3));
				macroFoto.setFotoFile(destination);
				macroFoto.setFotoPerOperatoria(rowSet.getBoolean(6));
				
				if(rowSet.getBytes(4) != null){
					if(! BLOBToDiskUtil.writeBLOBToDisk(destination, rowSet.getBytes(4))){
						log.error("Error escribiendo contenido en el archivo " + destination.getAbsolutePath());
					}
				}
				
				log.info("Leida de la base de datos foto: " + macroFoto);
				results.add(macroFoto);
			}
		} catch (Exception e) {
			// TODO: handle exception
			log.error(e.getMessage(), e);
		}
		
		return results;
	}

}
