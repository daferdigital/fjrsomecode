package com.fjr.code.dao;

import java.io.File;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.Types;
import java.util.LinkedList;
import java.util.List;
import java.util.SortedMap;

import org.apache.log4j.Logger;

import com.fjr.code.dao.definitions.TipoDiagnostico;
import com.fjr.code.dto.DiagnosticoWizardDTO;
import com.fjr.code.gui.tables.JTableDiagnosticoWizard;
import com.fjr.code.util.BLOBUtil;
import com.fjr.code.util.DBUtil;

/**
 * 
 * Class: DiagnosticoDAO <br />
 * DateCreated: 22/04/2014 <br />
 * @author T&T <br />
 *
 */
public class DiagnosticoWizardDAO {
	private static final Logger log = Logger.getLogger(DiagnosticoWizardDAO.class);
	
	private DiagnosticoWizardDAO() {
		// TODO Auto-generated constructor stub
	}
	
	/**
	 * 
	 * @param codigoBiopsia
	 * @param tipoDiagnostico
	 * @return
	 */
	public static List<DiagnosticoWizardDTO> getWizardPrevio(int idBiopsia,
			TipoDiagnostico tipoDiagnostico){
		DiagnosticoWizardDAOListBuilder builder = new DiagnosticoWizardDAOListBuilder(idBiopsia,
				tipoDiagnostico);
		
		return builder.getResults();
	}
	
	/**
	 * 
	 * @param codigoBiopsia
	 * @param tipoDiagnostico
	 * @return
	 */
	public static List<DiagnosticoWizardDTO> getWizardPrevio(String codigoBiopsia,
			TipoDiagnostico tipoDiagnostico){
		DiagnosticoWizardDAOListBuilder builder = new DiagnosticoWizardDAOListBuilder(codigoBiopsia,
				tipoDiagnostico);
		
		return builder.getResults();
	}
	
	/**
	 * 
	 * @param idBiopsia
	 * @return
	 */
	private static boolean deleteDiagnosticoInfo(int idBiopsia, TipoDiagnostico tipoDiagnostico){
		final String query = "DELETE FROM diagnostico_detalle where id_biopsia = ? AND tipo_diagnostico=?";
		final String query2 = "DELETE FROM diagnostico_maestro where id_biopsia = ? AND tipo_diagnostico=?";
		boolean result = true;
		
		try {
			List<Object> parameters = new LinkedList<Object>();
			parameters.add(idBiopsia);
			parameters.add(tipoDiagnostico.getKey());
			
			result = DBUtil.executeNonSelectQuery(query, parameters);
			log.info("Borrado detalle de diagnostico de la biopsia: " + idBiopsia
					+ ", tipoDiagnostico='" + tipoDiagnostico.getKey() + "'");
			
			if(result){
				result = DBUtil.executeNonSelectQuery(query2, parameters);
				if(result){
					log.info("Borrado maestro de diagnostico de la biopsia: " + idBiopsia
							+ ", tipoDiagnostico='" + tipoDiagnostico.getKey() + "'");
				} else {
					log.info("No pudo ser borrado maestro de diagnostico de la biopsia: " + idBiopsia
							+ ", tipoDiagnostico='" + tipoDiagnostico.getKey() + "'");
				}
			} else {
				log.info("No pudo ser borrado detalle de diagnostico de la biopsia: " + idBiopsia
						+ ", tipoDiagnostico='" + tipoDiagnostico.getKey() + "'");
			}
		} catch (Exception e) {
			// TODO: handle exception
			log.error("Error: " + e.getLocalizedMessage(), e);
			result = false;
		}
		
		return result;
	}
	
	/**
	 * 
	 * @param idBiopsia
	 * @param idFirmante1
	 * @param idFirmante2
	 * @param mapMacro
	 * @param mapIHQ
	 * @param mapDiagnostico
	 * @return
	 */
	public static final boolean storeDiagnostico(int idBiopsia, int idFirmante1,
			int idFirmante2, SortedMap<Integer, List<String>> mapMacro,
			SortedMap<Integer, List<String>> mapIHQ, SortedMap<Integer, List<String>> mapDiagnostico){
		
		boolean result = true;
		final String queryMaestro = "INSERT INTO diagnostico_maestro(id_biopsia, tipo_diagnostico, id_firmante_1, id_firmante_2, fecha)"
				+ " VALUES(?, ?, ?, ?, NOW())";
		
		Connection con = null;
		PreparedStatement ps = null;
		
		try {
			deleteDiagnosticoInfo(idBiopsia, TipoDiagnostico.DE_BIOPSIA);
			
			con = DBUtil.getConnection();
			ps = con.prepareStatement(queryMaestro);
			ps.setInt(1, idBiopsia);
			ps.setString(2, TipoDiagnostico.DE_BIOPSIA.getKey());
			ps.setInt(3, idFirmante1);
			if(idFirmante2 > 0){
				ps.setInt(4, idFirmante2);
			} else {
				ps.setNull(4, Types.INTEGER);
			}
			
			ps.execute();
			log.info("Fue creado el registro maestro, vamos con el detalle ahora");
			
			int linea = storeDetalleDiagnostico(idBiopsia, 1, JTableDiagnosticoWizard.SECCION_MACRO, mapMacro);
			linea = storeDetalleDiagnostico(idBiopsia, linea, JTableDiagnosticoWizard.SECCION_DIAGNOSTICO, mapDiagnostico);
			linea = storeDetalleDiagnostico(idBiopsia, linea, JTableDiagnosticoWizard.SECCION_IHQ, mapIHQ);
		} catch (Exception e) {
			// TODO: handle exception
			log.error("Error: " + e.getLocalizedMessage(), e);
		} finally {
			try {
				ps.close();
			} catch (Exception e2) {
				// TODO: handle exception
			}
			
			try {
				con.close();
			} catch (Exception e2) {
				// TODO: handle exception
			}
		}
		
		return result;
	}
	
	/**
	 * 
	 * @param idBiopsia
	 * @param seccion
	 * @param mapToProcess
	 * @return
	 */
	private static int storeDetalleDiagnostico(int idBiopsia, int linea, String seccion,
			SortedMap<Integer, List<String>> mapToProcess){
		final String queryDetalle = "INSERT INTO diagnostico_detalle(id_biopsia, tipo_diagnostico, linea, seccion, texto_seccion, imagen1_name, "
				+ "imagen1_data, imagen2_name, imagen2_data, imagen3_name, imagen3_data) "
				+ "VALUES(?,?,?,?,?,?,?,?,?,?,?)";
		
		Connection con = null;
		PreparedStatement ps = null;
		String tmpSeccion = seccion;
		
		try {
			con = DBUtil.getConnection();
			ps = con.prepareStatement(queryDetalle);
			
			ps.setInt(1, idBiopsia);
			ps.setString(2, TipoDiagnostico.DE_BIOPSIA.getKey());
			
			for (List<String> listaLinea : mapToProcess.values()) {
				ps.setInt(3, linea);
				
				String element0 = listaLinea.get(0);

				if(JTableDiagnosticoWizard.SECCION_MACRO.equals(seccion)){
					//verifico si es macro o per-operatoria
					if(element0.startsWith(JTableDiagnosticoWizard.SECCION_PER_OPERATORIA)){
						//es per operatoria
						tmpSeccion = JTableDiagnosticoWizard.SECCION_PER_OPERATORIA;
						element0 = element0.substring(JTableDiagnosticoWizard.SECCION_PER_OPERATORIA.length());
					} else {
						tmpSeccion = JTableDiagnosticoWizard.SECCION_MACRO;
					}
				}
				
				ps.setString(4, tmpSeccion);
				
				//veo si el primer elemento es una foto o es una descripcion
				int fotoIndex = 0;
				File tmp = new File(element0);
				if(!tmp.exists()){
					//es una descripcion
					ps.setString(5, element0);
					fotoIndex++;
				} else {
					//no se tienen descripcion, sino posiblemente 3 fotos
					ps.setString(5, "");
				}
				
				try {
					element0 = listaLinea.get(fotoIndex);
					if(JTableDiagnosticoWizard.SECCION_MACRO.equals(seccion)){
						//verifico si es macro o per-operatoria
						if(element0.startsWith(JTableDiagnosticoWizard.SECCION_PER_OPERATORIA)){
							//es per operatoria
							element0 = element0.substring(JTableDiagnosticoWizard.SECCION_PER_OPERATORIA.length());
						}
					}
					
					tmp = new File(element0);
					ps.setString(6, tmp.getName());
					ps.setBytes(7, BLOBUtil.buildBLOBFromFile(tmp));
				} catch (Exception e) {
					// TODO: handle exception
					ps.setNull(6, Types.VARCHAR);
					ps.setNull(7, Types.BLOB);
				}
				
				fotoIndex++;
				try {
					element0 = listaLinea.get(fotoIndex);
					if(JTableDiagnosticoWizard.SECCION_MACRO.equals(seccion)){
						//verifico si es macro o per-operatoria
						if(element0.startsWith(JTableDiagnosticoWizard.SECCION_PER_OPERATORIA)){
							//es per operatoria
							element0 = element0.substring(JTableDiagnosticoWizard.SECCION_PER_OPERATORIA.length());
						}
					}
					
					tmp = new File(element0);
					ps.setString(8, tmp.getName());
					ps.setBytes(9, BLOBUtil.buildBLOBFromFile(tmp));
				} catch (Exception e) {
					// TODO: handle exception
					ps.setNull(8, Types.VARCHAR);
					ps.setNull(9, Types.BLOB);
				}
				
				fotoIndex++;
				try {
					element0 = listaLinea.get(fotoIndex);
					if(JTableDiagnosticoWizard.SECCION_MACRO.equals(seccion)){
						//verifico si es macro o per-operatoria
						if(element0.startsWith(JTableDiagnosticoWizard.SECCION_PER_OPERATORIA)){
							//es per operatoria
							element0 = element0.substring(JTableDiagnosticoWizard.SECCION_PER_OPERATORIA.length());
						}
					}
					
					tmp = new File(element0);
					ps.setString(10, tmp.getName());
					ps.setBytes(11, BLOBUtil.buildBLOBFromFile(tmp));
				} catch (Exception e) {
					// TODO: handle exception
					ps.setNull(10, Types.VARCHAR);
					ps.setNull(11, Types.BLOB);
				}
				
				ps.execute();
				linea++;
			}
		} catch (Exception e) {
			// TODO: handle exception
			log.error("Error: " + e.getLocalizedMessage(), e);
		} finally {
			try {
				ps.close();
			} catch (Exception e2) {
				// TODO: handle exception
			}
			
			try {
				con.close();
			} catch (Exception e2) {
				// TODO: handle exception
			}
		}
		
		return linea;
	}
	
	/**
	 * 
	 * @param idBiopsia
	 * @param idFirmante1
	 * @param idFirmante2
	 * @param diagnosticoComplementario
	 * @param comentarioComplementario
	 * @return
	 */
	public static final boolean storeDiagnosticoComplementario(int idBiopsia, int idFirmante1,
			int idFirmante2, String diagnosticoComplementario, String comentarioComplementario){
		boolean result = true;
		final String queryMaestro = "INSERT INTO diagnostico_maestro(id_biopsia, tipo_diagnostico, id_firmante_1, id_firmante_2, fecha)"
				+ " VALUES(?, ?, ?, ?, NOW())";
		
		Connection con = null;
		PreparedStatement ps = null;
		
		try {
			deleteDiagnosticoInfo(idBiopsia, TipoDiagnostico.COMPLEMENTARIO);
			
			con = DBUtil.getConnection();
			ps = con.prepareStatement(queryMaestro);
			ps.setInt(1, idBiopsia);
			ps.setString(2, TipoDiagnostico.COMPLEMENTARIO.getKey());
			ps.setInt(3, idFirmante1);
			if(idFirmante2 > 0){
				ps.setInt(4, idFirmante2);
			} else {
				ps.setNull(4, Types.INTEGER);
			}
			
			ps.execute();
			log.info("Fue creado el registro maestro, vamos con el detalle del diagnostico complementario");
			
			result = storeDetalleDiagnosticoComplementario(idBiopsia,
					diagnosticoComplementario,
					comentarioComplementario);
		} catch (Exception e) {
			// TODO: handle exception
			log.error("Error: " + e.getLocalizedMessage(), e);
		} finally {
			try {
				ps.close();
			} catch (Exception e2) {
				// TODO: handle exception
			}
			
			try {
				con.close();
			} catch (Exception e2) {
				// TODO: handle exception
			}
		}
		
		return result;
	}
	
	/**
	 * 
	 * @param idBiopsia
	 * @param diagnosticoComplementario
	 * @param comentarioComplementario
	 * @return
	 */
	private static final boolean storeDetalleDiagnosticoComplementario(int idBiopsia, 
			String diagnosticoComplementario, String comentarioComplementario){
		boolean result = true;
		final String queryMaestro = "INSERT INTO diagnostico_detalle(id_biopsia, tipo_diagnostico, linea, seccion, diagnostico_complementario, comentario_complementario)"
				+ " VALUES(?, ?, 1, '', ?, ?)";
		
		Connection con = null;
		PreparedStatement ps = null;
		
		try {
			con = DBUtil.getConnection();
			ps = con.prepareStatement(queryMaestro);
			ps.setInt(1, idBiopsia);
			ps.setString(2, TipoDiagnostico.COMPLEMENTARIO.getKey());
			ps.setString(3, diagnosticoComplementario);
			ps.setString(4, comentarioComplementario);
			
			ps.execute();
		} catch (Exception e) {
			// TODO: handle exception
			log.error("Error: " + e.getLocalizedMessage(), e);
			result = false;
		} finally {
			try {
				ps.close();
			} catch (Exception e2) {
				// TODO: handle exception
			}
			
			try {
				con.close();
			} catch (Exception e2) {
				// TODO: handle exception
			}
		}
		
		return result;
	}
}
