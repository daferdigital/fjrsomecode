package com.fjr.code.dao;

import java.util.Calendar;
import java.util.LinkedList;
import java.util.List;

import javax.sql.rowset.CachedRowSet;

import org.apache.log4j.Logger;

import com.fjr.code.dao.definitions.DAOListBuilder;
import com.fjr.code.dao.definitions.FasesBiopsia;
import com.fjr.code.dto.BiopsiaHistologiaDTO;
import com.fjr.code.dto.BiopsiaInfoDTO;
import com.fjr.code.dto.BiopsiaIngresoDTO;
import com.fjr.code.dto.BiopsiaMacroscopicaDTO;
import com.fjr.code.dto.BiopsiaMicroscopicaDTO;
import com.fjr.code.dto.ClienteDTO;
import com.fjr.code.dto.ExamenBiopsiaDTO;
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
class BiopsiaInfoDAOListBuilder implements DAOListBuilder<BiopsiaInfoDTO> {
	/**
	 * 
	 */
	private static final Logger log = Logger.getLogger(BiopsiaInfoDAOListBuilder.class);
	
	private static final String BEGIN = "SELECT b.id, b.year_biopsia, b.numero_biopsia, fb.id AS faseId," //1-4
			//datos de ingreso //5-11
			+ " bi.procedencia, bi.pieza_recibida, bi.referido_medico, bi.idx, p.id AS idPatologo, p.nombre AS nombrePatologo, p.activo,"
			//datos de cliente //12-21 
			+ " c.id, c.id_premium, c.cedula, c.nombres, c.apellidos, c.edad, c.telefono, c.correo, c.direccion, c.activo, "
			//datos del tipo de examen 22-28
			+ " eb.id, eb.codigo, eb.dias_resultado, eb.nombre, te.id, te.nombre, te.codigo,"
			//datos basicos de macro 29 - 30
			+ " bm.desc_macro, bm.desc_per_operatoria,"
			//datos basicos de histologia 31
			+ " bh.descripcion,"
			//datos basicos de micro 32-34
			+ " bmi.idx, bmi.diagnostico, bmi.estudio_ihq,"
			//otros valores 35
			+ " b.fecha_registro"
			+ " FROM  biopsias b LEFT JOIN biopsias_ingresos bi ON b.id = bi.id"
			+ " LEFT JOIN biopsias_macroscopicas bm ON b.id = bm.id"
			+ " LEFT JOIN biopsias_histologias bh ON b.id = bh.id"
			+ " LEFT JOIN biopsias_microscopicas bmi ON b.id = bmi.id"
			+ " LEFT JOIN patologos p ON bi.id_patologo_turno = p.id,"
			+ " tipo_examenes te, fases_biopsia fb, cliente c, examenes_biopsias eb"
			+ " WHERE b.id_cliente = c.id"
			+ " AND c.activo = '1'"
			+ " AND eb.id = b.id_examen_biopsia"
			+ " AND te.id =  eb.id_tipo_examen"
			+ " AND b.id_fase_actual = fb.id";
	
	private static final String END = " ORDER BY b.year_biopsia, b.numero_biopsia";
	
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
	
	/**
	 * 
	 * @param nroBiopsia
	 */
	public void searchByNumeroBiopsia(String nroBiopsia){
		customWhere += " AND CONCAT(b.year_biopsia, '-', b.numero_biopsia) = ?";
		parameters.add(nroBiopsia);
	}
	
	/**
	 * 
	 * @param nroBiopsia
	 */
	public void searchByFase(FasesBiopsia fase){
		customWhere += " AND b.id_fase_actual = ?";
		parameters.add(fase.getCodigoFase());
	}
	
	/**
	 * 
	 * @param nroBiopsia
	 */
	public void searchByFasesActivas(){
		customWhere += " AND (b.id_fase_actual <> ? AND b.id_fase_actual <> ?)";
		parameters.add(FasesBiopsia.ENTREGADA_A_PACIENTE.getCodigoFase());
		parameters.add(FasesBiopsia.RECHAZADA_IHQ.getCodigoFase());
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
				
				Calendar fechaRegistro = Calendar.getInstance();
				fechaRegistro.setTimeInMillis(rowSet.getTimestamp(35).getTime());
				biopsiaAllInfo.setFechaRegistro(fechaRegistro);
				
				//datos especificos de ingreso
				BiopsiaIngresoDTO ingresoDTO = new BiopsiaIngresoDTO();
				ingresoDTO.setIdBiopsia(rowSet.getInt(1));
				ingresoDTO.setProcedencia(rowSet.getString(5));
				ingresoDTO.setPiezaRecibida(rowSet.getString(6));
				ingresoDTO.setReferidoMedico(rowSet.getString(7));
				ingresoDTO.setIdx(rowSet.getString(8));
				ingresoDTO.setPatologoTurno(new PatologoDTO(rowSet.getInt(9), rowSet.getString(10), rowSet.getBoolean(11)));
				
				//datos especificos del cliente
				biopsiaAllInfo.setCliente(
						new ClienteDTO(rowSet.getInt(12), 
								rowSet.getString(13), 
								rowSet.getString(14), 
								rowSet.getString(15), 
								rowSet.getString(16), 
								rowSet.getInt(17), 
								rowSet.getString(18), 
								rowSet.getString(19), 
								rowSet.getString(20), 
								rowSet.getBoolean(21)));
				
				//datos especificos del examen de la biopsia
				biopsiaAllInfo.setExamenBiopsia(
						new ExamenBiopsiaDTO(
								rowSet.getInt(22), 
								rowSet.getString(23), 
								rowSet.getString(25), 
								rowSet.getInt(24), 
								rowSet.getInt(26), 
								rowSet.getString(27),
								rowSet.getString(28)));
				
				//datos especificos de macro
				BiopsiaMacroscopicaDTO macroDTO = new BiopsiaMacroscopicaDTO();
				macroDTO.setId(rowSet.getInt(1));
				macroDTO.setDescMacroscopica(rowSet.getString(29));
				macroDTO.setDescPerOperatoria(rowSet.getString(30));
				
				//datos especificos de histologia
				BiopsiaHistologiaDTO histoDTO = new BiopsiaHistologiaDTO();
				histoDTO.setId(rowSet.getInt(1));
				histoDTO.setDescripcion(rowSet.getString(31));
				
				//datos especificos de micro
				BiopsiaMicroscopicaDTO microDTO = new BiopsiaMicroscopicaDTO();
				microDTO.setId(rowSet.getInt(1));
				microDTO.setIdx(rowSet.getString(32));
				microDTO.setDiagnostico(rowSet.getString(33));
				microDTO.setEstudioIHQ(rowSet.getString(34));
				
				//agregamos los DTO
				biopsiaAllInfo.setIngresoDTO(ingresoDTO);
				biopsiaAllInfo.setMacroscopicaDTO(macroDTO);
				biopsiaAllInfo.setHistologiaDTO(histoDTO);
				biopsiaAllInfo.setMicroscopicaDTO(microDTO);
				
				results.add(biopsiaAllInfo);
			}
		} catch (Exception e) {
			// TODO: handle exception
			log.error(e.getMessage(), e);
		}
		
		return results;
	}

}
