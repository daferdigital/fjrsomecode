package com.fjr.code.dao;

import java.util.Calendar;
import java.util.LinkedList;
import java.util.List;

import javax.sql.rowset.CachedRowSet;

import org.apache.log4j.Logger;

import com.fjr.code.dao.definitions.DAOListBuilder;
import com.fjr.code.dao.definitions.FasesBiopsia;
import com.fjr.code.dao.definitions.TipoEdadEnum;
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
	
	private static final String BEGIN = "SELECT b.id, b.side1_code_biopsia, b.side2_code_biopsia, fb.id AS faseId," //1-4
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
			//otros valores 35-40
			+ " b.fecha_registro, p.genero, b.id_tipo_estudio, tie.abreviatura, c.tipo_edad, bmi.diagnostico_ihq"
			+ " FROM  biopsias b LEFT JOIN biopsias_ingresos bi ON b.id = bi.id"
			+ " LEFT JOIN biopsias_macroscopicas bm ON b.id = bm.id"
			+ " LEFT JOIN biopsias_histologias bh ON b.id = bh.id"
			+ " LEFT JOIN biopsias_microscopicas bmi ON b.id = bmi.id"
			+ " LEFT JOIN patologos p ON bi.id_patologo_turno = p.id,"
			+ " especialidad te, fases_biopsia fb, cliente c, examenes_biopsias eb, tipo_estudio tie"
			+ " WHERE b.id_cliente = c.id"
			+ " AND c.activo = '1'"
			+ " AND eb.id = b.id_examen_biopsia"
			+ " AND te.id =  eb.id_tipo_examen"
			+ " AND b.id_fase_actual = fb.id"
			+ " AND tie.id = b.id_tipo_estudio";
	
	private static String END = " ORDER BY b.side1_code_biopsia, b.side2_code_biopsia";
	
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
	 * Ajuste para buscar por id de la biopsia
	 * @param idBiopsia
	 */
	public void searchByIdBiopsia(int idBiopsia){
		customWhere += " AND b.id = ?";
		parameters.add(idBiopsia);
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
	 * Ajuste para buscar por cedula de cliente usando LIKE
	 * @param cedula
	 */
	public void searchByLikeCedulaCliente(String cedula){
		customWhere += " AND LOWER(c.cedula) LIKE(?)";
		parameters.add("%" + cedula.toLowerCase() + "%");
	}
	
	/**
	 * Ajuste para buscar por diagnostico usando LIKE
	 * @param texto
	 */
	public void searchByLikeDiagnostico(String texto){
		customWhere += " AND LOWER(bmi.diagnostico) LIKE(?)";
		parameters.add("%" + texto.toLowerCase() + "%");
	}
	
	/**
	 * Ajuste para buscar por especialidad usando LIKE
	 * @param especialidad
	 */
	public void searchByLikeEspecialidad(String especialidad){
		customWhere += " AND LOWER(te.nombre) LIKE(?)";
		parameters.add("%" + especialidad.toLowerCase() + "%");
	}
	
	/**
	 * Ajuste para buscar por examen usando LIKE
	 * @param examen
	 */
	public void searchByLikeExamen(String examen){
		customWhere += " AND LOWER(eb.nombre) LIKE(?)";
		parameters.add("%" + examen.toLowerCase() + "%");
	}
	
	/**
	 * Ajuste para buscar por fase usando LIKE
	 * @param fase
	 */
	public void searchByLikeFase(String fase){
		customWhere += " AND LOWER(fb.nombre) LIKE(?)";
		parameters.add("%" + fase.toLowerCase() + "%");
	}
	
	/**
	 * Ajuste para buscar por medico que refiere usando LIKE
	 * @param medicoQueRefiere
	 */
	public void searchByLikeMedicoQueRefiere(String medicoQueRefiere){
		customWhere += " AND LOWER(bi.referido_medico) LIKE(?)";
		parameters.add("%" + medicoQueRefiere.toLowerCase() + "%");
	}
	
	/**
	 * Ajuste para buscar por numero de biopsia usando LIKE
	 * @param numeroBiopsia
	 */
	public void searchByLikeNumeroBiopsia(String numeroBiopsia){
		if(numeroBiopsia.contains("-")){
			//tengo guion, debo hacer el split
			String[] pieces = numeroBiopsia.split("-");
			customWhere += " AND (LOWER(b.side1_code_biopsia) LIKE(?) AND LOWER(b.side2_code_biopsia) LIKE(?))";
			parameters.add("%" + pieces[0].toLowerCase() + "%");
			parameters.add("%" + pieces[1].toLowerCase() + "%");
		} else {
			customWhere += " AND LOWER(CONCAT(b.side1_code_biopsia, b.side2_code_biopsia)) LIKE(?)";
			parameters.add("%" + numeroBiopsia.toLowerCase() + "%");
		}
	}
	
	/**
	 * Ajuste para buscar por paciente usando LIKE
	 * @param paciente
	 */
	public void searchByLikePaciente(String paciente){
		customWhere += " AND LOWER(CONCAT(c.nombres, ' ', c.apellidos)) LIKE(?)";
		parameters.add("%" + paciente.toLowerCase() + "%");
	}
	
	/**
	 * Ajuste para buscar por patologo usando LIKE
	 * @param patologo
	 */
	public void searchByLikePatologo(String patologo){
		customWhere += " AND LOWER(p.nombre) LIKE(?)";
		parameters.add("%" + patologo.toLowerCase() + "%");
	}
	
	/**
	 * Ajuste para buscar por procedencia del material (pieza recibida) usando LIKE
	 * @param procedenciaMaterial
	 */
	public void searchByLikeProcedenciaMaterial(String procedenciaMaterial){
		customWhere += " AND LOWER(bi.pieza_recibida) LIKE(?)";
		parameters.add("%" + procedenciaMaterial.toLowerCase() + "%");
	}
	
	/**
	 * Ajuste para buscar por tipo de estudio usando LIKE
	 * @param tipoEstudio
	 */
	public void searchByLikeTipoEstudio(String tipoEstudio){
		customWhere += " AND LOWER(tie.nombre) LIKE(?)";
		parameters.add("%" + tipoEstudio.toLowerCase() + "%");
	}
	
	/**
	 * Ajuste para buscar por fecha desde
	 * @param fechaDesde
	 */
	public void searchByFechaDesde(String fechaDesde){
		customWhere += " AND b.fecha_registro >= ?";
		parameters.add(fechaDesde);
	}
	
	/**
	 * Ajuste para buscar por fecha hasta
	 * @param fechaHasta
	 */
	public void searchByFechaHasta(String fechaHasta){
		customWhere += " AND b.fecha_registro <= ?";
		parameters.add(fechaHasta);
	}
	
	public void searchByFasesDeEntrega(){
		customWhere += " AND b.id_fase_actual IN(?,?,?)";
		parameters.add(FasesBiopsia.ENTREGADA_A_PACIENTE.getCodigoFase());
		parameters.add(FasesBiopsia.INFORME_IMPRESO.getCodigoFase());
		parameters.add(FasesBiopsia.MATERIAL_ENTREGADO.getCodigoFase());
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
	
	public void setOrberByRegistro() {
		// TODO Auto-generated method stub
		END = " ORDER BY b.fecha_registro DESC, b.side1_code_biopsia, b.side2_code_biopsia DESC";
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
				biopsiaAllInfo.setSide1CodeBiopsia(rowSet.getString(2));
				biopsiaAllInfo.setSide2CodeBiopsia(rowSet.getString(3));
				biopsiaAllInfo.setFaseActual(FasesBiopsia.getInfoByCode(rowSet.getInt(4)));
				biopsiaAllInfo.setIdTipoEstudio(rowSet.getInt(37));
				biopsiaAllInfo.setAbreviaturaTipoEstudio(rowSet.getString(38));
				
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
				ingresoDTO.setPatologoTurno(new PatologoDTO(rowSet.getInt(9), 
						rowSet.getString(10), 
						rowSet.getBoolean(11),
						rowSet.getString(36)));
				
				//datos especificos del cliente
				TipoEdadEnum tipoEdad;
				switch (rowSet.getInt(39)) {
				case 1:
					tipoEdad = TipoEdadEnum.MESES;
					break;
				case 2:
					tipoEdad = TipoEdadEnum.ANIOS;
					break;
				default:
					tipoEdad = TipoEdadEnum.ANIOS;
					break;
				}
				biopsiaAllInfo.setCliente(
						new ClienteDTO(rowSet.getInt(12), 
								rowSet.getString(13), 
								rowSet.getString(14), 
								rowSet.getString(15), 
								rowSet.getString(16), 
								rowSet.getInt(17), 
								tipoEdad,
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
								rowSet.getString(28),
								""));
				
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
				microDTO.setDiagnosticoIHQ(rowSet.getString(40));
				
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
