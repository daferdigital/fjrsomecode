package test;

import java.io.File;
import java.io.FileOutputStream;
import java.util.Iterator;
import java.util.LinkedList;
import java.util.List;
import java.util.Map;

import javax.sql.rowset.CachedRowSet;

import com.fjr.code.util.BLOBUtil;
import com.fjr.code.util.Constants;
import com.fjr.code.util.DBUtil;
import com.fjr.code.util.SystemLogger;
import com.itextpdf.text.Document;
import com.itextpdf.text.PageSize;
import com.itextpdf.text.pdf.PdfDictionary;
import com.itextpdf.text.pdf.PdfName;
import com.itextpdf.text.pdf.PdfReader;
import com.itextpdf.text.pdf.PdfWriter;

/**
 * 
 * Class: SetPDFDates <br />
 * DateCreated: 24/03/2014 <br />
 * @author T&T <br />
 *
 */
public class SetPDFDates {
	public static void main(String[] args) {
		try {
			SystemLogger.init(Constants.LOGS_PATH);
			
			final String query = "SELECT id, ultimo_informe_impreso FROM biopsias WHERE ultimo_informe_impreso IS NOT NULL ORDER BY id";
			final String queryUpdate = "UPDATE biopsias SET fecha_impresion_informe=? WHERE id=?";
			
			CachedRowSet rows = DBUtil.executeSelectQuery(query);
			List<Object> parametros = new LinkedList<Object>();
			
			while (rows.next()) {
				parametros.clear();
				if(rows.getBytes(2) != null){
					File dest = new File(Constants.TMP_PATH + File.separator + "diagnostico_" + rows.getInt(1) +".pdf");
					
					BLOBUtil.writeBLOBToDisk(dest,
							rows.getBytes(2));
					
					//escrito el archivo, se le obtiene la fecha de creacion
					PdfReader reader = new PdfReader(dest.getAbsolutePath());
					String date = reader.getInfo().get("CreationDate");
					String value = date.substring(2,6) + "-" + date.substring(6,8) + "-" + date.substring(8,10);
					/*
					1 2 3 4 5 6 7 8 9 0
					D : 2 0 1 4 0 3 2 4
					0 1 2 3 4 5 6 7 8 9
					*/
					parametros.add(value);
					parametros.add(rows.getInt(1));
					DBUtil.executeNonSelectQuery(queryUpdate, parametros);
					
					System.out.println("Biopsia " + rows.getInt(1) + ": " + value);
				}
			}
		} catch (Exception e) {
			// TODO: handle exception
			e.printStackTrace();
		}
		
		System.out.println("Finish...");
	}
}
