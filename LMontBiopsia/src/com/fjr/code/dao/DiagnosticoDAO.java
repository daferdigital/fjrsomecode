package com.fjr.code.dao;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.Types;
import java.util.List;
import java.util.SortedMap;

import org.apache.log4j.Logger;

import com.fjr.code.gui.tables.JTableDiagnosticoWizard;
import com.fjr.code.util.DBUtil;

/**
 * 
 * Class: DiagnosticoDAO <br />
 * DateCreated: 22/04/2014 <br />
 * @author T&T <br />
 *
 */
public class DiagnosticoDAO {
	private static final Logger log = Logger.getLogger(DiagnosticoDAO.class);
	
	private DiagnosticoDAO() {
		// TODO Auto-generated constructor stub
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
		final String queryMaestro = "INSERT INTO diagnostico_maestro(?,?,?,NOW())";
		
		Connection con = null;
		PreparedStatement ps = null;
		
		try {
			con = DBUtil.getConnection();
			ps = con.prepareStatement(queryMaestro);
			ps.setInt(1, idBiopsia);
			ps.setInt(2, idFirmante1);
			if(idFirmante2 > 0){
				ps.setInt(3, idFirmante2);
			} else {
				ps.setNull(3, Types.INTEGER);
			}
			
			if(ps.execute()){
				log.info("Fue creado el registro maestro, vamos con el detalle ahora");
				storeDetalleDiagnostico(idBiopsia, JTableDiagnosticoWizard.SECCION_MACRO, mapMacro);
				storeDetalleDiagnostico(idBiopsia, JTableDiagnosticoWizard.SECCION_DIAGNOSTICO, mapDiagnostico);
				storeDetalleDiagnostico(idBiopsia, JTableDiagnosticoWizard.SECCION_IHQ, mapIHQ);
			} else {
				log.info("Por algun motivo no pudo crearse el registro maestro");
				result = false;
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
		
		return result;
	}
	
	/**
	 * 
	 * @param idBiopsia
	 * @param seccion
	 * @param mapToProcess
	 * @return
	 */
	private static boolean storeDetalleDiagnostico(int idBiopsia, String seccion,
			SortedMap<Integer, List<String>> mapToProcess){
		final String queryDetalle = "INSERT INTO diagnostico_detalle(id_maestro, linea, seccion, texto_seccion, imagen1_name, "
				+ "imagen1_data, imagen2_name, imagen2_data, imagen3_name, imagen3_data) "
				+ "VALUES(?,?,?,?,?,?,?,?,?,?)";
		
		boolean result = true;
		int linea = 1;
		Connection con = null;
		PreparedStatement ps = null;
		String tmpSeccion = seccion;
		
		try {
			con = DBUtil.getConnection();
			ps = con.prepareStatement(queryDetalle);
			
			ps.setInt(1, idBiopsia);
			
			for (List<String> listaLinea : mapToProcess.values()) {
				ps.setInt(2, linea);
				
				for (String valor : listaLinea) {
					if(JTableDiagnosticoWizard.SECCION_MACRO.equals(seccion)){
						//verifico si es macro o per-operatoria
						if(valor.startsWith(JTableDiagnosticoWizard.SECCION_PER_OPERATORIA)){
							//es per operatoria
							tmpSeccion = JTableDiagnosticoWizard.SECCION_PER_OPERATORIA;
						} else {
							tmpSeccion = JTableDiagnosticoWizard.SECCION_MACRO;
						}
					}
					
					ps.setString(3, tmpSeccion);
					
				}
				
				linea++;
			}
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
