package com.fjr.code.dao;

import java.sql.Timestamp;
import java.util.LinkedList;
import java.util.List;

import org.apache.log4j.Logger;

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
		
		if(getBiopsiaByNumero(nroBiopsia) != null){
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
		BiopsiaInfoDTO biopsia = null;
		
		BiopsiaInfoDAOListBuilder builder = new BiopsiaInfoDAOListBuilder();
		builder.searchByNumeroBiopsia(numero);
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
	 * 
	 * @param numero
	 * @return
	 */
	public static List<BiopsiaInfoDTO> getBiopsiasEnFasesActivas(){
		BiopsiaInfoDAOListBuilder builder = new BiopsiaInfoDAOListBuilder();
		builder.searchByFasesActivas();
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
		
		final String queryBasico = "INSERT INTO biopsias (year_biopsia, numero_biopsia, fecha_registro, id_examen_biopsia, id_cliente, id_fase_actual)"
				+ " VALUES(?,?,?,?,?,?)";
		final String queryIngreso = "INSERT INTO biopsias_ingresos(id, procedencia, pieza_recibida, referido_medico, idx, id_patologo_turno)"
				+ " VALUES(?,?,?,?,?,?)";
		
		int[] result = null;
		if(biopsiaInfo.getNumeroBiopsia() < 0){
			result = BiopsiaCodigoDAO.getAutomaticYearAndNumber();
			if(result[0] < 0){
				//no se pudo obtener de manera automatica el valor del codigo de biopsia
				//debemos salir
				log.error("No se pudo obtener el codigo de la biopsia de manera automatica.");
				return -1;
			}else {
				biopsiaInfo.setYearBiopsia(result[0]);
				biopsiaInfo.setNumeroBiopsia(result[1]);
			}
		}
		
		try {
			//preparamos el query basico
			List<Object> parameters = new LinkedList<Object>();
			parameters.add(biopsiaInfo.getYearBiopsia());
			parameters.add(biopsiaInfo.getNumeroBiopsia());
			parameters.add(new Timestamp(System.currentTimeMillis()));
			parameters.add(biopsiaInfo.getExamenBiopsia().getId());
			parameters.add(biopsiaInfo.getCliente().getId());
			parameters.add(FasesBiopsia.INGRESO.getCodigoFase());
			
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
				+ " SET year_biopsia = ?, numero_biopsia = ?, id_examen_biopsia = ?,"
				+ " id_cliente = ? WHERE id = ?";
		final String updateIngreso = "UPDATE biopsias_ingresos "
				+ " SET procedencia = ?, pieza_recibida = ?, referido_medico = ?,"
				+ "idx = ?, id_patologo_turno = ? WHERE id = ?";
		
		List<Object> parameters = new LinkedList<Object>();
		
		try {
			parameters.add(ingreso.getYearBiopsia());
			parameters.add(ingreso.getNumeroBiopsia());
			parameters.add(ingreso.getExamenBiopsia().getId());
			parameters.add(ingreso.getCliente().getId());
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
		biopsia.setYearBiopsia(0);
		biopsia.setNumeroBiopsia(0);
		
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
		final String queryFotos = "INSERT INTO macro_fotos (id, notacion, descripcion, foto, file_name, fecha_registro) VALUES (?,?,?,?,?, NOW())";
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
				for (BiopsiaMacroFotoDTO foto : fotos) {
					parameters.clear();
					
					byte[] bytesFile = new byte[(int) foto.getFotoFile().length()];
					try {
						foto.getFotoBlob().read(bytesFile);
					} catch (Exception e) {
						// TODO: handle exception
						log.error(e.getLocalizedMessage(), e);
					}
					
					parameters.add(biopsiaInfoDTO.getId());
					parameters.add(foto.getNotacion());
					parameters.add(foto.getDescripcion());
					parameters.add(bytesFile);
					parameters.add(foto.getFotoFile().getName());
					
					if(! DBUtil.executeInsertQueryAsBoolean(queryFotos, parameters)){
						result = false;
						break;
					} else {
						log.info("Almacenada foto: " + foto);
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
		final String queryInsertMicro = "INSERT INTO biopsias_microscopicas (id, idx, diagnostico) VALUES (?,?,?)";
		final String queryUpdateMicro = "UPDATE biopsias_microscopicas SET idx=?, diagnostico=? WHERE id=? ";
		final String queryInsertLaminasReactivos = "INSERT INTO micro_laminas (descripcion, id_reactivo, id, cassete, bloque, lamina) VALUES(?,?,?,?,?,?)";
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
			parameters.add(biopsiaInfoDTO.getId());
			
			if(DBUtil.executeNonSelectQuery(queryUpdateMicro, parameters)){
				result = true;
			}
		} else {
			log.info("La biopsia histo '" + biopsiaInfoDTO.getCodigo() + "' no existia, ejecutamos el insert");
			
			parameters.add(biopsiaInfoDTO.getId());
			parameters.add(biopsiaInfoDTO.getMicroscopicaDTO().getIdx());
			parameters.add(biopsiaInfoDTO.getMicroscopicaDTO().getDiagnostico());
			
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
				if(! DBUtil.executeNonSelectQuery(queryInsertLaminasReactivos, parameters)){
					result = false;
				}
					
				if(result && reactivos != null && reactivos.size() > 0) {
					for (ReactivoDTO reactivo : reactivos) {
						parameters.clear();
						parameters.add(lamina.getDescripcion());
						parameters.add(reactivo.getId());
						parameters.add(biopsiaInfoDTO.getId());
						parameters.add(lamina.getCassete());
						parameters.add(lamina.getBloque());
						parameters.add(lamina.getLamina());
						
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
	 * @param goToMicro
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
}
