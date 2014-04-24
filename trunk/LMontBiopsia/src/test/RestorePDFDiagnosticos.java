package test;

import java.io.File;
import java.util.LinkedList;
import java.util.List;

import javax.sql.rowset.CachedRowSet;

import org.apache.log4j.Logger;

import com.fjr.code.util.BLOBUtil;
import com.fjr.code.util.Constants;
import com.fjr.code.util.DBUtil;
import com.fjr.code.util.SystemLogger;
import com.itextpdf.text.pdf.PdfReader;

/**
 * 
 * Class: SetPDFDates <br />
 * DateCreated: 24/03/2014 <br />
 * @author T&T <br />
 *
 */
public class RestorePDFDiagnosticos {
	private static final Logger log = Logger.getLogger(RestorePDFDiagnosticos.class);
	
	public static void main(String[] args) {
		int totalDiagnosticos = 0, diagnosticosFaltantes = 0;
		
		try {
			SystemLogger.init(Constants.LOGS_PATH);
			
			final String query = "SELECT id FROM biopsias WHERE ultimo_informe_impreso IS NULL AND id_fase_actual = 10 ORDER BY id";
			
			CachedRowSet rows = DBUtil.executeSelectQuery(query);
			List<Object> parametros = new LinkedList<Object>();
			
			while (rows.next()) {
				totalDiagnosticos++;
				
				File diagnostico = new File("diagnosticos" + File.separator + "diagnostico_" + rows.getInt(1) +".pdf");
				if(! diagnostico.exists()){
					diagnosticosFaltantes++;
					log.warn("Diagnostico " + diagnostico.getAbsolutePath() + " no existe.");
				} else {
					//tenemos el diagnostico, lo metemos en la base de datos
				}
			}
		} catch (Exception e) {
			// TODO: handle exception
			log.error("Error: " + e.getLocalizedMessage(), e);
		}
		
		log.info("DiagnosticosTotales: " + totalDiagnosticos);
		log.info("DiagnosticosFaltantes: " + diagnosticosFaltantes);
		log.info("Finish...");
	}
}
