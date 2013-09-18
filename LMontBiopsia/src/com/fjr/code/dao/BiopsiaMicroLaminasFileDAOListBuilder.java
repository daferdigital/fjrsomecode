package com.fjr.code.dao;

import java.io.File;
import java.util.LinkedList;
import java.util.List;

import javax.sql.rowset.CachedRowSet;

import org.apache.log4j.Logger;

import com.fjr.code.dao.definitions.DAOListBuilder;
import com.fjr.code.dto.BiopsiaMicroLaminasFileDTO;
import com.fjr.code.util.BLOBToDiskUtil;
import com.fjr.code.util.Constants;
import com.fjr.code.util.DBUtil;

/**
 * 
 * Class: BiopsiaMicroLaminasDAOListBuilder
 * Creation Date: 14/09/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
final class BiopsiaMicroLaminasFileDAOListBuilder implements DAOListBuilder<BiopsiaMicroLaminasFileDTO> {
	private static final Logger log = Logger.getLogger(BiopsiaMicroLaminasFileDAOListBuilder.class);
	
	private static final String BEGIN = "SELECT mlf.id, mlf.cassete, mlf.bloque, mlf.lamina, mlf.file_name, mlf.file_content"
			+ " FROM micro_laminas_files mlf "
			+ " WHERE 1 = 1";
	private static final String END = " ORDER BY mlf.id, mlf.cassete, mlf.bloque, mlf.lamina, mlf.file_name";
	
	private String customWhere;
	private List<Object> parameters;
	
	/**
	 * 
	 */
	public BiopsiaMicroLaminasFileDAOListBuilder() {
		// TODO Auto-generated constructor stub
		customWhere = "";
		parameters = new LinkedList<Object>();
	}
	
	
	public void searchByIdBiopsia(int id){
		customWhere += " AND mlf.id = ?";
		parameters.add(id);
	}
	
	public void searchByCassete(int cassete){
		customWhere += " AND mlf.cassete = ?";
		parameters.add(cassete);
	}
	
	public void searchByBloque(int bloque){
		customWhere += " AND mlf.bloque = ?";
		parameters.add(bloque);
	}
	
	public void searchByLamina(int lamina){
		customWhere += " AND mlf.lamina = ?";
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
	public List<BiopsiaMicroLaminasFileDTO> getResults() {
		// TODO Auto-generated method stub
		List<BiopsiaMicroLaminasFileDTO> results = new LinkedList<BiopsiaMicroLaminasFileDTO>();
		
		try {
			CachedRowSet rowSet = DBUtil.executeSelectQuery(getQuery(), getParameters());
			
			while (rowSet.next()) {
				BiopsiaMicroLaminasFileDTO laminaFile = new BiopsiaMicroLaminasFileDTO();
				laminaFile.setId(rowSet.getInt(1));
				laminaFile.setCassete(rowSet.getInt(2));
				laminaFile.setBloque(rowSet.getInt(3));
				laminaFile.setLamina(rowSet.getInt(4));
				
				String fileName = rowSet.getInt(1) + "_" + rowSet.getInt(2)
						+ "_" + rowSet.getInt(3) + "_" + rowSet.getInt(4) + "_";
				if(rowSet.getString(5) != null && ! rowSet.getString(5).startsWith(fileName)){
					fileName += rowSet.getString(5);
				} else {
					fileName = rowSet.getString(5);
				}
				File destination = new File(Constants.TMP_PATH + File.separator + fileName);
				
				laminaFile.setMediaFile(destination);
				if(! BLOBToDiskUtil.writeBLOBToDisk(destination, rowSet.getBytes(6))){
					log.error("Error escribiendo contenido en el archivo " + destination.getAbsolutePath());
				}
				
				log.info("Leida de la base de datos lamina micro file: " + laminaFile);
				results.add(laminaFile);
			}
		} catch (Exception e) {
			// TODO: handle exception
			log.error(e.getMessage(), e);
		}
		
		return results;
	}
}
