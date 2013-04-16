package com.carrito.util;

import java.io.File;
import java.io.IOException;
import java.util.Map;

import org.apache.log4j.Logger;

import net.sf.jasperreports.engine.JRException;
import net.sf.jasperreports.engine.JRExporterParameter;
import net.sf.jasperreports.engine.JasperFillManager;
import net.sf.jasperreports.engine.JasperPrint;
import net.sf.jasperreports.engine.export.JRXlsExporter;
import net.sf.jasperreports.engine.export.JRXlsExporterParameter;

/**
 * 
 * Class: JasperReportsUtil
 * Creation Date: 15/04/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public final class JasperReportsUtil {
	private static final Logger log = Logger.getLogger(JasperReportsUtil.class);
	
	private JasperReportsUtil() {
		// TODO Auto-generated constructor stub
	}
	
	/**
	 * 
	 * @param parameters
	 * @param pathReport
	 * @throws JRException
	 */
	public static File fillReport(Map<String,Object> parameters, String pathReport, String pathDest) throws JRException {
		long start = System.currentTimeMillis();
		
		try {
			log.info("Fill de reporte " + pathReport);
			JasperPrint print = JasperFillManager.fillReport(pathReport, parameters, DBUtil.getConnection());
			return exportToXLS(print, pathDest);
		} catch (Throwable e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		
		log.info("Filling time : " + (System.currentTimeMillis() - start));
		return null;
	}
	
	
	/**
	 * @throws IOException 
	 *
	 */
	public static File exportToXLS(JasperPrint jasperPrint, String pathDest) throws JRException, IOException {
		long start = System.currentTimeMillis();
		
		File destFile = new File(pathDest + File.separator + jasperPrint.getName() + System.currentTimeMillis() + ".xls");
		
		JRXlsExporter exporter = new JRXlsExporter();
		
		exporter.setParameter(JRExporterParameter.JASPER_PRINT, jasperPrint);
		exporter.setParameter(JRExporterParameter.OUTPUT_FILE_NAME, destFile.getAbsolutePath());
		exporter.setParameter(JRXlsExporterParameter.IS_ONE_PAGE_PER_SHEET, Boolean.FALSE);
		exporter.setParameter(JRXlsExporterParameter.IS_DETECT_CELL_TYPE, Boolean.TRUE);
		exporter.setParameter(JRXlsExporterParameter.IS_WHITE_PAGE_BACKGROUND, Boolean.FALSE);
		exporter.setParameter(JRXlsExporterParameter.IS_REMOVE_EMPTY_SPACE_BETWEEN_ROWS, Boolean.TRUE);
		
		exporter.exportReport();
		
		log.info("Report: " + destFile.getAbsolutePath() + ". XLS creation time: " + (System.currentTimeMillis() - start));
		
		return destFile;
	}
}
