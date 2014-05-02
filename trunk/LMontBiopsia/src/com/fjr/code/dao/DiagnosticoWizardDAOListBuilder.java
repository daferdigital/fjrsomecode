package com.fjr.code.dao;

import java.io.File;
import java.util.Calendar;
import java.util.LinkedList;
import java.util.List;

import javax.sql.rowset.CachedRowSet;

import org.apache.log4j.Logger;

import com.fjr.code.dao.definitions.DAOListBuilder;
import com.fjr.code.dto.DiagnosticoWizardDTO;
import com.fjr.code.util.BLOBUtil;
import com.fjr.code.util.Constants;
import com.fjr.code.util.DBUtil;

/**
 * 
 * Class: EspecialidadDAOListBuilder
 * Creation Date: 28/08/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
final class DiagnosticoWizardDAOListBuilder implements DAOListBuilder<DiagnosticoWizardDTO>{
	/**
	 * 
	 */
	private static final Logger log = Logger.getLogger(DiagnosticoWizardDAOListBuilder.class);
	
	private static final String BEGIN = "SELECT b.id, dm.id_firmante_1, dm.id_firmante_2, dm.fecha, dd.linea, dd.seccion,"
			+ " dd.texto_seccion, dd.imagen1_name, dd.imagen1_data, dd.imagen2_name, dd.imagen2_data,"
			+ " dd.imagen3_name, dd.imagen3_data"
			+ " FROM tipo_estudio tie, diagnostico_maestro dm, diagnostico_detalle dd, biopsias b"
			+ " WHERE b.id = dm.id_biopsia"
			+ " AND dm.id_biopsia = dd.id_biopsia"
			+ " AND tie.id = b.id_tipo_estudio";
	private static final String END = " ORDER BY dm.id_biopsia, dd.linea";

	private List<Object> parameters;
	private String customWhere;
	
	/**
	 * 
	 * @param codigoBiopsia
	 */
	public DiagnosticoWizardDAOListBuilder(String codigoBiopsia) {
		// TODO Auto-generated constructor stub
		parameters = new LinkedList<Object>();
		customWhere = "";
		
		String tipoEstudioAbreviatura = "";
		try {
			tipoEstudioAbreviatura = "-" + codigoBiopsia.split("-")[2];
			codigoBiopsia = codigoBiopsia.split("-")[0] + "-" + codigoBiopsia.split("-")[1];;
			log.info("Buscando biopsia: " + codigoBiopsia + "/" + tipoEstudioAbreviatura);
		} catch (Exception e) {
			// TODO: handle exception
		}
		
		searchByNumeroBiopsia(codigoBiopsia);
		setTipoEstudioAbreviatura(tipoEstudioAbreviatura);
	}
	
	/**
	 * 
	 * @param nroBiopsia
	 */
	public void searchByNumeroBiopsia(String nroBiopsia){
		customWhere += " AND CONCAT(b.side1_code_biopsia, '-', b.side2_code_biopsia) = ?";
		parameters.add(nroBiopsia);
	}
	
	/**
	 * 
	 * @param tipoEstudioAbreviatura
	 */
	public void setTipoEstudioAbreviatura(String tipoEstudioAbreviatura){
		customWhere += " AND LOWER(tie.abreviatura) = ?";
		parameters.add(tipoEstudioAbreviatura.toLowerCase());
	}
	
	/**
	 * 
	 * @return
	 */
	public String getQuery(){
		return BEGIN + customWhere + END;
	}
	
	/**
	 * 
	 * @return
	 */
	public List<Object> getParameters(){
		return parameters;
	}
	
	/**
	 * Ejecutamos el query contenido en el objeto y retornamos los resultados en una lista.
	 * 
	 * @return
	 */
	public List<DiagnosticoWizardDTO> getResults(){
		List<DiagnosticoWizardDTO> results = new LinkedList<DiagnosticoWizardDTO>();
		
		try {
			CachedRowSet rowSet = DBUtil.executeSelectQuery(getQuery(), getParameters());
			Calendar fecha = Calendar.getInstance();
			while (rowSet.next()) {
				DiagnosticoWizardDTO wizard = new DiagnosticoWizardDTO();
				wizard.setIdBiopsia(rowSet.getInt(1));
				wizard.setIdFirmante1(rowSet.getInt(2));
				wizard.setIdFirmante2(rowSet.getInt(3));
				
				fecha.setTimeInMillis(rowSet.getTimestamp(4).getTime());
				wizard.setFechaWizard(fecha);
				
				wizard.setNumeroLinea(rowSet.getInt(5));
				wizard.setSeccion(rowSet.getString(6));
				wizard.setTextoSeccion(rowSet.getString(7));
				
				if(rowSet.getString(8) != null && !"".equals(rowSet.getString(8))){
					wizard.setNameFileImagen1(rowSet.getString(8));
					BLOBUtil.writeBLOBToDisk(
							new File(Constants.TMP_PATH + File.separator + rowSet.getString(8)),
							rowSet.getBytes(9));
				}
				
				if(rowSet.getString(10) != null && !"".equals(rowSet.getString(10))){
					wizard.setNameFileImagen2(rowSet.getString(10));
					BLOBUtil.writeBLOBToDisk(
							new File(Constants.TMP_PATH + File.separator + rowSet.getString(10)),
							rowSet.getBytes(11));
				}
				
				if(rowSet.getString(12) != null && !"".equals(rowSet.getString(12))){
					wizard.setNameFileImagen3(rowSet.getString(12));
					BLOBUtil.writeBLOBToDisk(
							new File(Constants.TMP_PATH + File.separator + rowSet.getString(12)),
							rowSet.getBytes(13));
				}
				
				results.add(wizard);
			}
		} catch (Exception e) {
			// TODO: handle exception
			log.error(e.getMessage(), e);
		}
		
		return results;
	}
}
