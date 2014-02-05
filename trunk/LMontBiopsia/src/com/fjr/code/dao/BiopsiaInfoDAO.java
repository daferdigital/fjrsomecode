package com.fjr.code.dao;

import java.io.File;
import java.io.FileInputStream;
import java.sql.Timestamp;
import java.util.LinkedList;
import java.util.List;
import java.util.Map;

import javax.sql.rowset.CachedRowSet;

import org.apache.log4j.Logger;

import com.fjr.code.dao.definitions.CriterioBusquedaBiopsia;
import com.fjr.code.dao.definitions.FasesBiopsia;
import com.fjr.code.dto.BiopsiaCasseteDTO;
import com.fjr.code.dto.BiopsiaInfoDTO;
import com.fjr.code.dto.BiopsiaMacroFotoDTO;
import com.fjr.code.dto.BiopsiaMicroLaminasDTO;
import com.fjr.code.dto.BiopsiaMicroLaminasFileDTO;
import com.fjr.code.dto.ReactivoDTO;
import com.fjr.code.util.Constants;
import com.fjr.code.util.DBUtil;

/**
 * 
 * Class: BiopsiaInfoDAO
 * Creation Date: 01/09/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class BiopsiaInfoDAO {
	private static final Logger log = Logger.getLogger(BiopsiaInfoDAO.class);
	
	private BiopsiaInfoDAO() {
		// TODO Auto-generated constructor stub
	}
	
	/**
	 * Verifica si un determinado numero de biopsia ya esta registrado.
	 * 
	 * @param nroBiopsia
	 * @return
	 */
	public static boolean biopsiaAlreadyExists(String nroBiopsia){
		boolean biopsiaExists = false;
		String tipoEstudioAbreviatura = "";
		
		try {
			tipoEstudioAbreviatura = "-" + nroBiopsia.split("-")[2];
		} catch (Exception e) {
			// TODO: handle exception
		}
		
		if(getBiopsiaByNumero(nroBiopsia, tipoEstudioAbreviatura) != null){
			biopsiaExists = true;
			log.info("La biopsia con numero " + nroBiopsia + " ya esta registrada");
		}
		
		return biopsiaExists;
	}
	
	/**
	 * Obtenemos el registro completo de una determinada biopsia.
	 * 
	 * @param numero
	 * @return
	 */
	public static BiopsiaInfoDTO getBiopsiaByNumero(String numero){
		String tipoEstudioAbreviatura = "";
		
		try {
			tipoEstudioAbreviatura = "-" + numero.split("-")[2];
			numero = numero.split("-")[0] + "-" + numero.split("-")[1];;
			log.info("Buscando biopsia: " + numero + "/" + tipoEstudioAbreviatura);
		} catch (Exception e) {
			// TODO: handle exception
		}
		
		return getBiopsiaByNumero(numero, tipoEstudioAbreviatura);
	}
	
	/**
	 * Obtenemos el registro completo de una determinada biopsia.
	 * 
	 * @param numero
	 * @param tipoEstudioAbreviatura
	 * @return
	 */
	public static BiopsiaInfoDTO getBiopsiaByNumero(String numero, String tipoEstudioAbreviatura){
		BiopsiaInfoDTO biopsia = null;
		
		log.info("Preparando busqueda de biopsia " + numero + "/" + tipoEstudioAbreviatura);
		
		BiopsiaInfoDAOListBuilder builder = new BiopsiaInfoDAOListBuilder();
		builder.searchByNumeroBiopsia(numero);
		builder.setTipoEstudioAbreviatura(tipoEstudioAbreviatura);
		List<BiopsiaInfoDTO> records = builder.getResults();
		
		if(records != null && records.size() > 0){
			biopsia = records.get(0);
		}
		
		return biopsia;
	}
	
	/**
	 * 
	 * @param idBiopsia
	 * @return
	 */
	public static BiopsiaInfoDTO getBiopsiaById(int idBiopsia){
		BiopsiaInfoDTO biopsia = null;
		
		log.info("Preparando busqueda de biopsia con id " + idBiopsia);
		
		BiopsiaInfoDAOListBuilder builder = new BiopsiaInfoDAOListBuilder();
		builder.searchByIdBiopsia(idBiopsia);
		List<BiopsiaInfoDTO> records = builder.getResults();
		
		if(records != null && records.size() > 0){
			biopsia = records.get(0);
		}
		
		return biopsia;
	}
	
	/**
	 * Obtenemos el registro completo de una determinada biopsia.
	 * 
	 * @param numero
	 * @return
	 */
	public static List<BiopsiaInfoDTO> getBiopsiasByFase(FasesBiopsia fase){
		BiopsiaInfoDAOListBuilder builder = new BiopsiaInfoDAOListBuilder();
		builder.searchByFase(fase);
		List<BiopsiaInfoDTO> records = builder.getResults();
		
		return records;
	}
	
	/**
	 * Obtenemos el registro completo de una determinada biopsia.
	 * @param faseABuscar 
	 * 
	 * @param numero
	 * @return
	 */
	public static List<BiopsiaInfoDTO> getBiopsiasEnFasesActivas(FasesBiopsia faseABuscar){
		BiopsiaInfoDAOListBuilder builder = new BiopsiaInfoDAOListBuilder();
		
		if(faseABuscar != null){
			builder.searchByFase(faseABuscar);
		} else {
			builder.searchByFasesActivas();
		}
		
		builder.setOrberByRegistro();
		
		List<BiopsiaInfoDTO> records = builder.getResults();
		
		return records;
	}
	
	/**
	 * 
	 * @param biopsiaInfo
	 * @return
	 */
	public static int insertBiopsiaInfo(BiopsiaInfoDTO biopsiaInfo){
		int insertedId = 0;
		
		final String queryBasico = "INSERT INTO biopsias (side1_code_biopsia, side2_code_biopsia, fecha_registro, id_examen_biopsia, id_cliente, id_fase_actual, id_tipo_estudio)"
				+ " VALUES(?,?,?,?,?,?,?)";
		final String queryIngreso = "INSERT INTO biopsias_ingresos(id, procedencia, pieza_recibida, referido_medico, idx, id_patologo_turno)"
				+ " VALUES(?,?,?,?,?,?)";
		
		int[] result = null;
		if("-1".equals(biopsiaInfo.getSide1CodeBiopsia())){
			result = BiopsiaCodigoDAO.getAutomaticYearAndNumber(biopsiaInfo.getIdTipoEstudio());
			if(result[0] < 0){
				//no se pudo obtener de manera automatica el valor del codigo de biopsia
				//debemos salir
				log.error("No se pudo obtener el codigo de la biopsia de manera automatica.");
				return -1;
			}else {
				biopsiaInfo.setSide1CodeBiopsia(String.format("%02d", result[0]));
				biopsiaInfo.setSide2CodeBiopsia(String.format("%05d", result[1]));
			}
		}
		
		try {
			//preparamos el query basico
			List<Object> parameters = new LinkedList<Object>();
			parameters.add(biopsiaInfo.getSide1CodeBiopsia());
			parameters.add(biopsiaInfo.getSide2CodeBiopsia());
			parameters.add(new Timestamp(System.currentTimeMillis()));
			parameters.add(biopsiaInfo.getExamenBiopsia().getId());
			parameters.add(biopsiaInfo.getCliente().getId());
			parameters.add(FasesBiopsia.INGRESO.getCodigoFase());
			parameters.add(biopsiaInfo.getIdTipoEstudio());
			
			insertedId = DBUtil.executeInsertQuery(queryBasico, parameters);
			
			if(insertedId > 0){
				log.info("Se inserto el registro maestro de la biopsia " + biopsiaInfo.getCodigo());
				
				parameters.clear();
				parameters.add(insertedId);
				parameters.add(biopsiaInfo.getIngresoDTO().getProcedencia());
				parameters.add(biopsiaInfo.getIngresoDTO().getPiezaRecibida());
				parameters.add(biopsiaInfo.getIngresoDTO().getReferidoMedico());
				parameters.add(biopsiaInfo.getIngresoDTO().getIdx());
				parameters.add(biopsiaInfo.getIngresoDTO().getPatologoTurno().getId());
				
				//la tabla de ingreso
				if(DBUtil.executeInsertQueryAsBoolean(queryIngreso, parameters)){
					log.info("Registrado el detalle de ingreso para la biopsia " + biopsiaInfo.getCodigo());
				} else {
					insertedId = -1;
					log.error("No pudo registrarse el detalle de ingreso para la biopsia " + biopsiaInfo.getCodigo());
				}
			}
		} catch (Exception e) {
			// TODO: handle exception
			log.error(e.getLocalizedMessage(), e);
			e.printStackTrace();
		}
		
		biopsiaInfo.setId(insertedId);
		biopsiaInfo.setAbreviaturaTipoEstudio(
				TipoEstudioDAO.getById(biopsiaInfo.getIdTipoEstudio()).getAbreviatura());
		
		return insertedId;
	}

	/**
	 * Actualizacion en base de datos de una biopsia y su ingreso.
	 * 
	 * @param ingreso
	 * @return
	 */
	public static boolean updateIngreso(BiopsiaInfoDTO ingreso) {
		// TODO Auto-generated method stub
		/*
		 * en este punto debo garantizar tener el id de la biopsia en el DTO 
		 */
		boolean result = false;
		
		final String updateBiopsia = "UPDATE biopsias "
				+ " SET side1_code_biopsia = ?, side2_code_biopsia = ?, id_examen_biopsia = ?,"
				+ " id_cliente = ?, id_tipo_estudio = ? WHERE id = ?";
		final String updateIngreso = "UPDATE biopsias_ingresos "
				+ " SET procedencia = ?, pieza_recibida = ?, referido_medico = ?,"
				+ "idx = ?, id_patologo_turno = ? WHERE id = ?";
		
		List<Object> parameters = new LinkedList<Object>();
		
		try {
			parameters.add(ingreso.getSide1CodeBiopsia());
			parameters.add(ingreso.getSide2CodeBiopsia());
			parameters.add(ingreso.getExamenBiopsia().getId());
			parameters.add(ingreso.getCliente().getId());
			parameters.add(ingreso.getIdTipoEstudio());
			parameters.add(ingreso.getId());
			
			if(DBUtil.executeNonSelectQuery(updateBiopsia, parameters)){
				log.info("Actualizado registro maestro de la biopsia " + ingreso.getCodigo());
				parameters.clear();
			
				parameters.add(ingreso.getIngresoDTO().getProcedencia());
				parameters.add(ingreso.getIngresoDTO().getPiezaRecibida());
				parameters.add(ingreso.getIngresoDTO().getReferidoMedico());
				parameters.add(ingreso.getIngresoDTO().getIdx());
				if(ingreso.getIngresoDTO().getPatologoTurno() == null){
					parameters.add(DBUtil.NULL_PARAMETER);
				} else {
					parameters.add(ingreso.getIngresoDTO().getPatologoTurno().getId());
				}
				
				parameters.add(ingreso.getId());
					
				result = DBUtil.executeNonSelectQuery(updateIngreso, parameters);
			}
		} catch (Exception e) {
			// TODO: handle exception
			log.error(e.getLocalizedMessage(), e);
		}
		
		return result;
	}
	
	/**
	 * 
	 * @param idBiopsia
	 * @param nuevaFase
	 * @return
	 */
	public static boolean moveBiopsiaToFase(int idBiopsia, FasesBiopsia nuevaFase) {
		// TODO Auto-generated method stub
		BiopsiaInfoDTO biopsia = new BiopsiaInfoDTO();
		biopsia.setId(idBiopsia);
		biopsia.setSide1CodeBiopsia("0");
		biopsia.setSide2CodeBiopsia("0");
		
		return moveBiopsiaToFase(biopsia, nuevaFase);
	}
	
	/**
	 * 
	 * @param biopsia
	 * @param nuevaFase
	 * @return
	 */
	public static boolean moveBiopsiaToFase(BiopsiaInfoDTO biopsia, FasesBiopsia nuevaFase) {
		// TODO Auto-generated method stub
		final String query = "UPDATE biopsias SET id_fase_actual = ? WHERE id = ?";
		boolean result = false;
		
		try {
			List<Object> parameters = new LinkedList<Object>();
			parameters.add(nuevaFase.getCodigoFase());
			parameters.add(biopsia.getId());
			
			result = DBUtil.executeNonSelectQuery(query, parameters);
			log.info("Biopsia " + biopsia.getCodigo() + ", llevada a fase " + nuevaFase.getNombreFase());
		} catch (Exception e) {
			// TODO: handle exception
			log.error("Biopsia " + biopsia.getCodigo() + " no pudo ser llevada a fase " + nuevaFase.getNombreFase(), e);
		}
		
		return result;
	}
	
	/**
	 * Confirmamos si la biopsia indicada comoo parametro existe en la tabla asociada
	 * a la fase que se desea consultar.
	 * 
	 * @param biopsiaInfoDTO
	 * @param faseAConsultar
	 * @return
	 */
	public static boolean existsBiopsiaEnFase(BiopsiaInfoDTO biopsiaInfoDTO,
			FasesBiopsia faseAConsultar){
		final String query = "SELECT * FROM " + faseAConsultar.getTablaRelacionada() + " WHERE id=?";
		boolean result = false;
		
		try {
			List<Object> parameters = new LinkedList<Object>();
			parameters.add(biopsiaInfoDTO.getId());
			if(DBUtil.getRecordCountToQuery(query, parameters) > 0){
				result = true;
			}
		} catch (Exception e) {
			// TODO: handle exception
			log.error(e.getLocalizedMessage(), e);
		}
		
		log.info("Verificacion de existencia de biopsia '" + biopsiaInfoDTO.getCodigo() 
				+ "' en fase " + faseAConsultar.getNombreFase() + " = " + result);
		
		return result;
	}
	
	/**
	 * 
	 * @param biopsiaInfoDTO
	 * @param goToHisto
	 * @return
	 */
	public static boolean updateMacro(BiopsiaInfoDTO biopsiaInfoDTO, boolean goToHisto) {
		final String queryInsertMacro = "INSERT INTO biopsias_macroscopicas (id, desc_macro, desc_per_operatoria) "
				+ "VALUES (?,?,?)";
		final String queryUpdateMacro = "UPDATE biopsias_macroscopicas SET desc_macro=?, desc_per_operatoria=? WHERE id=? ";
		final String queryCassetes = "INSERT INTO macro_cassetes (id, numero, descripcion) VALUES (?,?,?)";
		final String queryDeleteCassetes = "DELETE FROM macro_cassetes WHERE id = ?";
		final String queryFotos = "INSERT INTO macro_fotos (id, notacion, descripcion, foto, file_name, fecha_registro, es_foto_per_operatoria) VALUES (?,?,?,?,?, NOW(),?)";
		final String queryDeleteFotos = "DELETE FROM macro_fotos WHERE id = ?";
		
		boolean result = false;
		List<Object> parameters = new LinkedList<Object>();
		
		if(existsBiopsiaEnFase(biopsiaInfoDTO, FasesBiopsia.MACROSCOPICA)){
			//la biopsia ya existe, ejecutamos el update
			log.info("La biopsia macro '" + biopsiaInfoDTO.getCodigo() + "' ya existe, ejecutamos el update");
			parameters.add(biopsiaInfoDTO.getMacroscopicaDTO().getDescMacroscopica());
			parameters.add(biopsiaInfoDTO.getMacroscopicaDTO().getDescPerOperatoria());
			parameters.add(biopsiaInfoDTO.getId());
			
			if(DBUtil.executeNonSelectQuery(queryUpdateMacro, parameters)){
				result = true;
			}
		} else {
			log.info("La biopsia macro '" + biopsiaInfoDTO.getCodigo() + "' no existia, ejecutamos el insert");
			
			parameters.add(biopsiaInfoDTO.getId());
			parameters.add(biopsiaInfoDTO.getMacroscopicaDTO().getDescMacroscopica());
			parameters.add(biopsiaInfoDTO.getMacroscopicaDTO().getDescPerOperatoria());
			
			if(DBUtil.executeInsertQueryAsBoolean(queryInsertMacro, parameters)){
				result = true;
			}
		}
		
		if(! result){
			log.error("No pudo guardarse el maestro de la biopsia en fase macroscopica. Se aborta el resto del proceso.");
		}else {
			log.info("El maestro de la biopsia en fase macroscopica fue almacenado sin problemas, "
					+ "continuamos con los detalles de fotos y cassetes");
			//almacenamos las fotos
			parameters.clear();
			parameters.add(biopsiaInfoDTO.getId());
			
			if(DBUtil.executeNonSelectQuery(queryDeleteFotos, parameters)){
				result = true;
				
				//guardamos las fotos de la biopsia en cuestion
				List<BiopsiaMacroFotoDTO> fotos = biopsiaInfoDTO.getMacroscopicaDTO().getMacroFotosDTO();
				if(fotos != null){
					for (BiopsiaMacroFotoDTO foto : fotos) {
						parameters.clear();
						
						byte[] bytesFile = null;
						String fotoFileName = "";
						try {
							bytesFile = new byte[(int) foto.getFotoFile().length()];
							foto.getFotoBlob().read(bytesFile);
							fotoFileName = foto.getFotoFile().getName();
						} catch (Exception e) {
							// TODO: handle exception
							log.error(e.getLocalizedMessage(), e);
						}
						
						parameters.add(biopsiaInfoDTO.getId());
						parameters.add(foto.getNotacion());
						parameters.add(foto.getDescripcion());
						parameters.add(bytesFile);
						parameters.add(fotoFileName);
						parameters.add(foto.isFotoPerOperatoria() ? "1" : "0");
						
						if(! DBUtil.executeInsertQueryAsBoolean(queryFotos, parameters)){
							result = false;
							break;
						} else {
							log.info("Almacenada foto: " + foto);
						}
					}
				}
				
				//ya se procesaron las fotos
				//verificamos que todo esta OK para continuar con los cassetes
				if(! result){
					log.error("Las fotos de la biopsia '" + biopsiaInfoDTO.getCodigo() 
							+ "' no pudieron almacenarse correctamente, abortamos el proceso de los cassetes");
				} else {
					log.info("Se almacenaran los cassetes de la biopsia '" + biopsiaInfoDTO.getCodigo() + "'");
					parameters.clear();
					parameters.add(biopsiaInfoDTO.getId());
					
					if(DBUtil.executeNonSelectQuery(queryDeleteCassetes, parameters)){
						result = true;
						
						//guardamos las fotos de la biopsia en cuestion
						List<BiopsiaCasseteDTO> cassetes = biopsiaInfoDTO.getMacroscopicaDTO().getCassetesDTO();
						if(cassetes != null) {
							for (BiopsiaCasseteDTO cassete : cassetes) {
								parameters.clear();
								
								parameters.add(biopsiaInfoDTO.getId());
								parameters.add(cassete.getNumero());
								parameters.add(cassete.getDescripcion());
								
								if(! DBUtil.executeInsertQueryAsBoolean(queryCassetes, parameters)){
									result = false;
									break;
								} else {
									log.info("Almacenado cassete: " + cassete);
								}
							}
						}
					} else {
						log.error("No pudieron eliminarse los cassetes de la biopsia '" + biopsiaInfoDTO.getCodigo() + "'");
						result = false;
					}
				}
			} else {
				log.error("No pudieron eliminarse las fotos de la biopsia '" + biopsiaInfoDTO.getCodigo() + "'");
				result = false;
			}
		}
		
		// TODO Auto-generated method stub
		log.info("Resultado de almacenar informacion macroscopica de la biopsia '" + biopsiaInfoDTO.getCodigo() 
				+ "' fue: " + result);
		return result ;
	}
	
	/**
	 * 
	 * @param biopsiaInfoDTO
	 * @param goToHisto
	 * @return
	 */
	public static boolean updateHisto(BiopsiaInfoDTO biopsiaInfoDTO, boolean goToMicro) {
		final String queryInsertHisto = "INSERT INTO biopsias_histologias (id, descripcion) VALUES (?,?)";
		final String queryUpdateHisto = "UPDATE biopsias_histologias SET descripcion=? WHERE id=? ";
		final String queryCassetes = "UPDATE macro_cassetes SET bloques=?, laminas=? WHERE id=? AND numero=?";
		final String queryMicroLaminas = "INSERT INTO micro_laminas (id, cassete, bloque, lamina) VALUES (?,?,?,?)";
		final String queryMicroLaminasDelete = "DELETE FROM micro_laminas WHERE id=?";
		
		boolean result = false;
		List<Object> parameters = new LinkedList<Object>();
		
		if(existsBiopsiaEnFase(biopsiaInfoDTO, FasesBiopsia.HISTOLOGIA)){
			//la biopsia ya existe, ejecutamos el update
			log.info("La biopsia histo '" + biopsiaInfoDTO.getCodigo() + "' ya existe, ejecutamos el update");
			parameters.add(biopsiaInfoDTO.getHistologiaDTO().getDescripcion());
			parameters.add(biopsiaInfoDTO.getId());
			
			if(DBUtil.executeNonSelectQuery(queryUpdateHisto, parameters)){
				result = true;
			}
		} else {
			log.info("La biopsia histo '" + biopsiaInfoDTO.getCodigo() + "' no existia, ejecutamos el insert");
			
			parameters.add(biopsiaInfoDTO.getId());
			parameters.add(biopsiaInfoDTO.getHistologiaDTO().getDescripcion());
			
			if(DBUtil.executeInsertQueryAsBoolean(queryInsertHisto, parameters)){
				result = true;
			}
		}
		
		if(! result){
			log.error("No pudo guardarse el maestro de la biopsia en fase histologia. Se aborta el resto del proceso.");
		}else {
			log.info("El maestro de la biopsia en fase histologia fue almacenado sin problemas, "
					+ "continuamos con los detalles de los cassetes");
			//guardamos los cassetes de la biopsia en cuestion
			List<BiopsiaCasseteDTO> cassetes = biopsiaInfoDTO.getHistologiaDTO().getCassetesDTO();
			for (BiopsiaCasseteDTO cassete : cassetes) {
				parameters.clear();
				parameters.add(cassete.getBloques());
				parameters.add(cassete.getLaminas());
				parameters.add(biopsiaInfoDTO.getId());
				parameters.add(cassete.getNumero());
				
				if(! DBUtil.executeNonSelectQuery(queryCassetes, parameters)){
					result = false;
					break;
				} else {
					log.info("Almacenado cassete: " + cassete);
				}
			}
			
			//ya se procesaron los cassetes
			if(! result){
				log.error("Los cassetes de la biopsia '" + biopsiaInfoDTO.getCodigo() 
						+ "' no pudieron almacenarse correctamente");
			} else {
				//procesamos las laminas para la fase de micro
				log.info("Procesamos las laminas para la fase micro.");
				//limpiamos el ambiente previo
				parameters.clear();
				parameters.add(biopsiaInfoDTO.getId());
				
				if(DBUtil.executeNonSelectQuery(queryMicroLaminasDelete, parameters)){
					//guardamos los cassetes de la biopsia en cuestion
					for (BiopsiaCasseteDTO cassete : cassetes) {
						for (int j = 1; j < cassete.getBloques() + 1; j++) {
							for (int i = 1; i < cassete.getLaminas() + 1; i++) {
								parameters.clear();
								parameters.add(biopsiaInfoDTO.getId());
								parameters.add(cassete.getNumero());
								parameters.add(j);
								parameters.add(i);
								
								if(! DBUtil.executeNonSelectQuery(queryMicroLaminas, parameters)){
									result = false;
									break;
								} else {
									log.info("Almacenada micro_lamina: " + cassete + ", con bloque/lamina " + j + "/" + i);
								}
							}
						}
					}
				} else {
					log.error("No pudieron eliminarse las laminas previas de la fase de micro, debemos abortar.");
					result = false;
				}
			}
		}
		
		// TODO Auto-generated method stub
		log.info("Resultado de almacenar informacion de histologia de la biopsia '" + biopsiaInfoDTO.getCodigo() 
				+ "' fue: " + result);
		return result ;
	}
	
	/**
	 * 
	 * @param biopsiaInfoDTO
	 * @param goToIHQ
	 * @return
	 */
	public static boolean updateMicro(BiopsiaInfoDTO biopsiaInfoDTO, boolean goToIHQ) {
		final String queryInsertMicro = "INSERT INTO biopsias_microscopicas (id, idx, diagnostico, estudio_ihq, diagnostico_ihq) VALUES (?,?,?,?,?)";
		final String queryUpdateMicro = "UPDATE biopsias_microscopicas SET idx=?, diagnostico=?, estudio_ihq=?, diagnostico_ihq=? WHERE id=? ";
		final String queryInsertLaminasReactivos = "INSERT INTO micro_laminas (descripcion, id_reactivo, id, cassete, bloque, lamina, reprocesar) VALUES(?,?,?,?,?,?,?)";
		final String queryLaminasReactivos = "DELETE FROM micro_laminas WHERE id=? AND cassete=? AND bloque=? AND lamina=?";
		final String queryDeleteLaminasFiles = "DELETE FROM micro_laminas_files WHERE id=? AND cassete=? AND bloque=? AND lamina=?";
		final String queryLaminasFiles = "INSERT INTO micro_laminas_files (id, cassete, bloque, lamina, file_name, file_content) VALUES (?,?,?,?,?,?)";
		
		boolean result = false;
		List<Object> parameters = new LinkedList<Object>();
		
		if(existsBiopsiaEnFase(biopsiaInfoDTO, FasesBiopsia.MICROSCOPICA)){
			//la biopsia ya existe, ejecutamos el update
			log.info("La biopsia micro '" + biopsiaInfoDTO.getCodigo() + "' ya existe, ejecutamos el update");
			parameters.add(biopsiaInfoDTO.getMicroscopicaDTO().getIdx());
			parameters.add(biopsiaInfoDTO.getMicroscopicaDTO().getDiagnostico());
			parameters.add(biopsiaInfoDTO.getMicroscopicaDTO().getEstudioIHQ());
			parameters.add(biopsiaInfoDTO.getMicroscopicaDTO().getDiagnosticoIHQ());
			parameters.add(biopsiaInfoDTO.getId());
			
			if(DBUtil.executeNonSelectQuery(queryUpdateMicro, parameters)){
				result = true;
			}
		} else {
			log.info("La biopsia histo '" + biopsiaInfoDTO.getCodigo() + "' no existia, ejecutamos el insert");
			
			parameters.add(biopsiaInfoDTO.getId());
			parameters.add(biopsiaInfoDTO.getMicroscopicaDTO().getIdx());
			parameters.add(biopsiaInfoDTO.getMicroscopicaDTO().getDiagnostico());
			parameters.add(biopsiaInfoDTO.getMicroscopicaDTO().getEstudioIHQ());
			parameters.add(biopsiaInfoDTO.getMicroscopicaDTO().getDiagnosticoIHQ());
			
			if(DBUtil.executeInsertQueryAsBoolean(queryInsertMicro, parameters)){
				result = true;
			}
		}
		
		if(! result){
			log.error("No pudo guardarse el maestro de la biopsia en fase microscopica. Se aborta el resto del proceso.");
		}else {
			log.info("El maestro de la biopsia en fase microscopica fue almacenado sin problemas, "
					+ "continuamos con los detalles de las laminas");
			//guardamos las laminas de la biopsia en cuestion
			List<BiopsiaMicroLaminasDTO> laminas = biopsiaInfoDTO.getMicroscopicaDTO().getLaminasDTO();
			for (BiopsiaMicroLaminasDTO lamina : laminas) {
				log.info("Almacenada micro_lamina: " + lamina + " procedemos a almacenar sus files");
				List<BiopsiaMicroLaminasFileDTO> listaFiles = lamina.getMicroLaminasFilesDTO();
					
				if(listaFiles != null && listaFiles.size() > 0) {
					parameters.clear();
					parameters.add(biopsiaInfoDTO.getId());
					parameters.add(lamina.getCassete());
					parameters.add(lamina.getBloque());
					parameters.add(lamina.getLamina());
						
					if(! DBUtil.executeNonSelectQuery(queryDeleteLaminasFiles, parameters)){
						result = false;
					} else {
						//se eliminaron los files anteriores, se almacenaran los nuevos
						for (BiopsiaMicroLaminasFileDTO biopsiaMicroLaminasFileDTO : listaFiles) {
							parameters.clear();
							parameters.add(biopsiaInfoDTO.getId());
							parameters.add(lamina.getCassete());
							parameters.add(lamina.getBloque());
							parameters.add(lamina.getLamina());
							parameters.add(biopsiaMicroLaminasFileDTO.getMediaFile().getName());
							parameters.add(biopsiaMicroLaminasFileDTO.getFileStream());
							
							if(!DBUtil.executeInsertQueryAsBoolean(queryLaminasFiles, parameters)){
								result = false;
								break;
							}
						}
					}
				}
					
				List<ReactivoDTO> reactivos = lamina.getReactivosDTO();
				
				parameters.clear();
				parameters.add(biopsiaInfoDTO.getId());
				parameters.add(lamina.getCassete());
				parameters.add(lamina.getBloque());
				parameters.add(lamina.getLamina());
				DBUtil.executeNonSelectQuery(queryLaminasReactivos, parameters);
					
				parameters.clear();
				parameters.add(lamina.getDescripcion());
				parameters.add(Constants.REACTIVO_VACIO);
				parameters.add(biopsiaInfoDTO.getId());
				parameters.add(lamina.getCassete());
				parameters.add(lamina.getBloque());
				parameters.add(lamina.getLamina());
				parameters.add(lamina.isMustReprocess());
				if(! DBUtil.executeNonSelectQuery(queryInsertLaminasReactivos, parameters)){
					result = false;
				}
					
				if(result && reactivos != null && reactivos.size() > 0) {
					for (ReactivoDTO reactivo : reactivos) {
						parameters.clear();
						//parameters.add(lamina.getDescripcion());
						parameters.add("");
						parameters.add(reactivo.getId());
						parameters.add(biopsiaInfoDTO.getId());
						parameters.add(lamina.getCassete());
						parameters.add(lamina.getBloque());
						parameters.add(lamina.getLamina());
						parameters.add(false);
						
						if(!DBUtil.executeNonSelectQuery(queryInsertLaminasReactivos, parameters)){
							result = false;
							break;
						}
					}
				}
			}
			
			//ya se procesaron los cassetes
			if(! result){
				log.error("Los cassetes de la biopsia '" + biopsiaInfoDTO.getCodigo() 
						+ "' no pudieron almacenarse correctamente");
			}
		}
		
		// TODO Auto-generated method stub
		log.info("Resultado de almacenar informacion de histologia de la biopsia '" + biopsiaInfoDTO.getCodigo() 
				+ "' fue: " + result);
		return result ;
	}
	
	/**
	 * 
	 * @param biopsiaInfoDTO
	 * @param goToMicro (no usado por ahora)
	 * @return
	 */
	public static boolean updateMicroIHQ(BiopsiaInfoDTO biopsiaInfoDTO, boolean goToMicro) {
		final String queryUpdateLaminasReactivos = "UPDATE micro_laminas SET"
				+ " descripcion=?, procesado=?"
				+ " WHERE id_reactivo=?"
				+ " AND id=?"
				+ " AND cassete=?"
				+ " AND bloque=?"
				+ " AND lamina=?";
		final String queryDeleteLaminasFiles = "DELETE FROM micro_laminas_ihq_files WHERE id=? AND cassete=? AND bloque=? AND lamina=? AND id_reactivo=?";
		final String queryLaminasFiles = "INSERT INTO micro_laminas_ihq_files (id, cassete, bloque, lamina, file_name, file_content, id_reactivo) VALUES (?,?,?,?,?,?,?)";
		
		boolean result = true;
		List<Object> parameters = new LinkedList<Object>();

		//modificamos la descripcion de las laminas que representan a IHQ
		List<BiopsiaMicroLaminasDTO> laminas = biopsiaInfoDTO.getMicroscopicaDTO().getLaminasDTO();
		for (BiopsiaMicroLaminasDTO biopsiaMicroLaminasDTO : laminas) {
			List<ReactivoDTO> reactivos = biopsiaMicroLaminasDTO.getReactivosDTO();
			
			for (ReactivoDTO reactivoDTO : reactivos) {
				parameters.clear();
				parameters.add(reactivoDTO.getDescripcionIHQ());
				parameters.add(reactivoDTO.isProcesadoIHQ());
				parameters.add(reactivoDTO.getId());
				parameters.add(biopsiaInfoDTO.getId());
				parameters.add(biopsiaMicroLaminasDTO.getCassete());
				parameters.add(biopsiaMicroLaminasDTO.getBloque());
				parameters.add(biopsiaMicroLaminasDTO.getLamina());
				
				if(! DBUtil.executeNonSelectQuery(queryUpdateLaminasReactivos, parameters)){
					result = false;
					break;
				} else {
					log.info("Almacenada micro_lamina: " + biopsiaMicroLaminasDTO + " procedemos a almacenar sus files");
					List<BiopsiaMicroLaminasFileDTO> listaFiles = biopsiaMicroLaminasDTO.getMicroLaminasFilesDTO();
							
					if(listaFiles != null && listaFiles.size() > 0) {
						parameters.clear();
						parameters.add(biopsiaInfoDTO.getId());
						parameters.add(biopsiaMicroLaminasDTO.getCassete());
						parameters.add(biopsiaMicroLaminasDTO.getBloque());
						parameters.add(biopsiaMicroLaminasDTO.getLamina());
						parameters.add(reactivoDTO.getId());
						
						if(! DBUtil.executeNonSelectQuery(queryDeleteLaminasFiles, parameters)){
							result = false;
						} else {
							//se eliminaron los files anteriores, se almacenaran los nuevos
							for (BiopsiaMicroLaminasFileDTO biopsiaMicroLaminasFileDTO : listaFiles) {
								parameters.clear();
								parameters.add(biopsiaInfoDTO.getId());
								parameters.add(biopsiaMicroLaminasDTO.getCassete());
								parameters.add(biopsiaMicroLaminasDTO.getBloque());
								parameters.add(biopsiaMicroLaminasDTO.getLamina());
								parameters.add(biopsiaMicroLaminasFileDTO.getMediaFile().getName());
								parameters.add(biopsiaMicroLaminasFileDTO.getFileStream());
								parameters.add(reactivoDTO.getId());
								
								if(!DBUtil.executeInsertQueryAsBoolean(queryLaminasFiles, parameters)){
									result = false;
									break;
								}
							}
						}
					}
				}
			}
		}
		
		//ya se procesaron los cassetes
		if(! result){
			log.error("Los cassetes de la biopsia '" + biopsiaInfoDTO.getCodigo() 
					+ "' no pudieron almacenarse correctamente");
		}	
		
		// TODO Auto-generated method stub
		log.info("Resultado de almacenar informacion de histologia de la biopsia '" + biopsiaInfoDTO.getCodigo() 
				+ "' fue: " + result);
		return result ;
	}
	
	/**
	 * 
	 * @param biopsia
	 */
	public static void storeDiagnosticoBLob(BiopsiaInfoDTO biopsia){
		final String query = "UPDATE biopsias SET ultimo_informe_impreso=? WHERE id=?";
		List<Object> parameters = new LinkedList<Object>();
		FileInputStream fis = null;
		
		try {
			File diagnostico = new File(Constants.TMP_PATH + File.separator + "diagnostico_" + biopsia.getId() + ".pdf");
			byte[] bytesFile = new byte[(int) diagnostico.length()];
			fis = new FileInputStream(diagnostico); 
			try {
				fis.read(bytesFile);
			} catch (Exception e) {
				// TODO: handle exception
				log.error(e.getLocalizedMessage(), e);
			}
			
			parameters.add(bytesFile);
			parameters.add(biopsia.getId());
			
			boolean result = DBUtil.executeNonSelectQuery(query, parameters);
			log.info("Almacenado binario del diagnostico " + biopsia.getCodigo() + " = " + result);
		} catch (Exception e2) {
			// TODO: handle exception
		} finally {
			try {
				fis.close();
			} catch (Exception e) {
				// TODO: handle exception
			}
		}
	}
	
	/**
	 * 
	 * @param valores
	 * @return 
	 */
	public static List<BiopsiaInfoDTO> searchAllByCriteria(
			Map<CriterioBusquedaBiopsia, String> valores) {
		// TODO Auto-generated method stub
		BiopsiaInfoDAOListBuilder builder = new BiopsiaInfoDAOListBuilder();
		
		for (CriterioBusquedaBiopsia criterio : valores.keySet()) {
			if(CriterioBusquedaBiopsia.CEDULA.equals(criterio)){
				builder.searchByLikeCedulaCliente(valores.get(criterio));
			} else if(CriterioBusquedaBiopsia.DIAGNOSTICO.equals(criterio)){
				builder.searchByLikeDiagnostico(valores.get(criterio));
			} else if(CriterioBusquedaBiopsia.ESPECIALIDAD.equals(criterio)){
				builder.searchByLikeEspecialidad(valores.get(criterio));
			} else if(CriterioBusquedaBiopsia.EXAMEN.equals(criterio)){
				builder.searchByLikeExamen(valores.get(criterio));
			} else if(CriterioBusquedaBiopsia.FASE.equals(criterio)){
				builder.searchByLikeFase(valores.get(criterio));
			} else if(CriterioBusquedaBiopsia.MEDICO_QUE_REFIERE.equals(criterio)){
				builder.searchByLikeMedicoQueRefiere(valores.get(criterio));
			} else if(CriterioBusquedaBiopsia.NUMERO_BIOPSIA.equals(criterio)){
				builder.searchByLikeNumeroBiopsia(valores.get(criterio));
			} else if(CriterioBusquedaBiopsia.PACIENTE.equals(criterio)){
				builder.searchByLikePaciente(valores.get(criterio));
			} else if(CriterioBusquedaBiopsia.PATOLOGO.equals(criterio)){
				builder.searchByLikePatologo(valores.get(criterio));
			} else if(CriterioBusquedaBiopsia.PROCEDENCIA_DEL_MATERIAL.equals(criterio)){
				builder.searchByLikeProcedenciaMaterial(valores.get(criterio));
			} else if(CriterioBusquedaBiopsia.TIPO_DE_ESTUDIO.equals(criterio)){
				builder.searchByLikeTipoEstudio(valores.get(criterio));
			} else if(CriterioBusquedaBiopsia.FECHA_DESDE.equals(criterio)){
				builder.searchByFechaDesde(valores.get(criterio));
			} else if(CriterioBusquedaBiopsia.FECHA_HASTA.equals(criterio)){
				builder.searchByFechaHasta(valores.get(criterio));
			} else if(CriterioBusquedaBiopsia.FASES_DE_ENTREGA.equals(criterio)){
				builder.searchByFasesDeEntrega();
			}
		}
		
		//verificamos las fechas desde y hasta
		builder.setOrberByRegistro();
		return builder.getResults();
	}
	
	/**
	 * 
	 * @param idBiopsia
	 * @return
	 */
	public static int getNumBloques(int idBiopsia){
		int numBloques = 0;
		final String query = "SELECT MAX(bloque)"
				+ " FROM micro_laminas"
				+ " WHERE id = ?"
				+ " GROUP BY id, cassete";
		
		try {
			List<Object> queryParameters = new LinkedList<Object>();
			queryParameters.add(idBiopsia);
			
			CachedRowSet rows = DBUtil.executeSelectQuery(query, queryParameters);
			while (rows.next()) {
				numBloques += rows.getInt(1);
			}
		} catch (Exception e) {
			// TODO: handle exception
			log.error("Error: " + e.getLocalizedMessage(), e);
		}
		
		log.info("Se tienen " + numBloques + " bloques para la biopsia " + idBiopsia);
		return numBloques;
	}
	
	/**
	 * 
	 * @param idBiopsia
	 * @return
	 */
	public static int getNumLaminas(int idBiopsia){
		int numLaminas = 0;
		final String query = "SELECT COUNT(lamina)"
				+ " FROM micro_laminas"
				+ " WHERE id = ?"
				+ " GROUP BY id";
		
		try {
			List<Object> queryParameters = new LinkedList<Object>();
			queryParameters.add(idBiopsia);
			
			CachedRowSet rows = DBUtil.executeSelectQuery(query, queryParameters);
			while (rows.next()) {
				numLaminas += rows.getInt(1);
			}
		} catch (Exception e) {
			// TODO: handle exception
			log.error("Error: " + e.getLocalizedMessage(), e);
		}
		
		log.info("Se tienen " + numLaminas + " laminas para la biopsia " + idBiopsia);
		return numLaminas;
	}
}
