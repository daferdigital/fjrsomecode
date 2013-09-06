package com.fjr.code.dao;

import java.util.LinkedList;
import java.util.List;

import javax.sql.rowset.CachedRowSet;

import org.apache.log4j.Logger;

import com.fjr.code.dao.definitions.DAOListBuilder;
import com.fjr.code.dao.definitions.FasesBiopsia;
import com.fjr.code.dto.BiopsiaInfoDTO;
import com.fjr.code.dto.BiopsiaIngresoDTO;
import com.fjr.code.dto.BiopsiaMacroscopicaDTO;
import com.fjr.code.dto.PatologoDTO;
import com.fjr.code.util.DBUtil;

/**
 * 
 * Class: BiopsiaInfoDAOListBuilder
 * Creation Date: 01/09/2013
 * (c) 2013
 *
 * @author T&T
 * 
 */
public class BiopsiaInfoDAOListBuilder implements DAOListBuilder<BiopsiaInfoDTO> {
	/**
	 * 
	 */
	private static final Logger log = Logger.getLogger(BiopsiaInfoDAOListBuilder.class);
	
	private static final String BEGIN = "SELECT b.id, b.year_biopsia, b.numero_biopsia, fb.id AS faseId,"
			//datos de ingreso
			+ " bi.procedencia, bi.pieza_recibida, bi.referido_medico, bi.idx, p.id AS idPatologo, p.nombre AS nombrePatologo, p.activo"
			+ " FROM  biopsias b LEFT JOIN biopsias_ingresos bi ON b.id = bi.id"
			+ " LEFT JOIN biopsias_macroscopicas bm ON b.id = bm.id"
			+ " LEFT JOIN patologos p ON bi.id_patologo_turno = p.id,"
			+ " fases_biopsia fb, cliente c, examenes_biopsias eb"
			+ " WHERE b.id_cliente = c.id"
			+ " AND eb.id = b.id_examen_biopsia"
			+ " AND b.id_fase_actual = fb.id";
	
	private static final String END = "ORDER BY b.year_biopsia, b.numero_biopsia";
	
	private String customWhere;
	private List<Object> parameters;
	
	/**
	 * 
	 */
	public BiopsiaInfoDAOListBuilder() {
		// TODO Auto-generated constructor stub
		customWhere = "";
		parameters = new LinkedList<Object>();
	}
	
	/**
	 * Ajuste para buscar por id de cliente
	 * @param id
	 */
	public void searchByIdCliente(int id){
		customWhere += " AND c.id = ?";
		parameters.add(id);
	}
	
	/**
	 * Ajuste para buscar por cedula de cliente
	 * @param cedula
	 */
	public void searchByCedulaCliente(String cedula){
		customWhere += " AND c.cedula = ?";
		parameters.add(cedula);
	}
	
	public void searchByNumeroBiopsia(String nroBiopsia){
		customWhere += " AND CONCAT(b.year_biopsia, '-', b.numero_biopsia) = ?";
		parameters.add(nroBiopsia);
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
	public List<BiopsiaInfoDTO> getResults() {
		// TODO Auto-generated method stub
		List<BiopsiaInfoDTO> results = new LinkedList<BiopsiaInfoDTO>();
		
		try {
			CachedRowSet rowSet = DBUtil.executeSelectQuery(getQuery(),
					getParameters());
			
			while (rowSet.next()) {
				BiopsiaInfoDTO biopsiaAllInfo = new BiopsiaInfoDTO();
				biopsiaAllInfo.setId(rowSet.getInt(1));
				biopsiaAllInfo.setYearBiopsia(rowSet.getInt(2));
				biopsiaAllInfo.setNumeroBiopsia(rowSet.getInt(3));
				biopsiaAllInfo.setFaseActual(FasesBiopsia.getInfoByCode(rowSet.getInt(4)));
				
				//datos especificos de ingreso
				BiopsiaIngresoDTO ingresoDTO = new BiopsiaIngresoDTO();
				ingresoDTO.setIdBiopsia(rowSet.getInt(1));
				ingresoDTO.setProcedencia(rowSet.getString(5));
				ingresoDTO.setPiezaRecibida(rowSet.getString(6));
				ingresoDTO.setReferidoMedico(rowSet.getString(7));
				ingresoDTO.setIdx(rowSet.getString(8));
				ingresoDTO.setPatologoTurno(new PatologoDTO(rowSet.getInt(9), rowSet.getString(10), rowSet.getBoolean(11)));
				
				//datos especificos de macro
				BiopsiaMacroscopicaDTO macroDTO = new BiopsiaMacroscopicaDTO();
				
				biopsiaAllInfo.setIngresoDTO(ingresoDTO);
				biopsiaAllInfo.setMacroscopicaDTO(macroDTO);
				results.add(biopsiaAllInfo);
			}
		} catch (Exception e) {
			// TODO: handle exception
			log.error(e.getMessage(), e);
		}
		
		return results;
	}

}
