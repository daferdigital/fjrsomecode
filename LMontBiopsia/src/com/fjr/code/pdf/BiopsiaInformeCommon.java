package com.fjr.code.pdf;

import java.text.NumberFormat;
import java.util.Calendar;

import org.apache.log4j.Logger;

import com.fjr.code.dto.BiopsiaInfoDTO;
import com.fjr.code.util.Constants;
import com.itextpdf.text.Chunk;
import com.itextpdf.text.Document;
import com.itextpdf.text.DocumentException;
import com.itextpdf.text.Element;
import com.itextpdf.text.Font;
import com.itextpdf.text.Paragraph;
import com.itextpdf.text.Phrase;
import com.itextpdf.text.pdf.ColumnText;
import com.itextpdf.text.pdf.PdfPCell;
import com.itextpdf.text.pdf.PdfPTable;
import com.itextpdf.text.pdf.PdfWriter;

/**
 * 
 * Class: BiopsiaDiagnosticoCommon <br />
 * DateCreated: 09/01/2014 <br />
 * @author T&T <br />
 *
 */
abstract class BiopsiaInformeCommon {
	private static final Logger log = Logger.getLogger(BiopsiaInformeCommon.class);
	private static final NumberFormat nf = NumberFormat.getNumberInstance();
	
	protected static final Chunk chunkEnter = Chunk.NEWLINE;
	protected static final Chunk tab1 = Chunk.SPACETABBING;
	protected Font informeFontNormal = FuenteInformeUtil.getInformeFontNormal();
	protected Font informeFontBold = FuenteInformeUtil.getInformeFontBold();
	
	public BiopsiaInformeCommon() {
		// TODO Auto-generated constructor stub
		nf.setMaximumFractionDigits(0);
		nf.setMinimumFractionDigits(0);
	}
	
	/**
	 * 
	 * @param cedula
	 * @return
	 */
	private String formatCedula(String cedula){
		String formattedCedula = cedula;
		String number = "";
		
		try {
			//separamos el tipo de cedula del numero
			String[] pieces = cedula.split("-");
			String type = pieces[0].concat("-");
			
			for (int i = 0; i < cedula.toCharArray().length; i++) {
				try {
					Integer.parseInt("" + cedula.toCharArray()[i]);
					number += cedula.toCharArray()[i];
				} catch (Exception e) {
					// TODO: handle exception
				}
			}
			
			formattedCedula = type + nf.format(Integer.parseInt(number));
		} catch (Exception e) {
			// TODO: handle exception
			log.error("Error formateando la cedula '" + cedula + "'. Error: " + e.getLocalizedMessage(), e);
			if("".equals(number)){
				//la cedula es vacia, debemos colocar el N/I respectivo
				log.info("Como la cedula es vacia, colocamos el texto N/I");
				formattedCedula = " N/I";
			}
		}
		
		log.info("Cedula '" + cedula + "' formateada a '" + formattedCedula + "'");
		return formattedCedula;
	}
	
	/**
	 * 
	 * @return
	 */
	protected PdfPTable addDetailBiopsiaTable(BiopsiaInfoDTO biopsia){
		return addDetailBiopsiaTable(biopsia, false);
	}
	
	/**
	 * 
	 * @return
	 */
	protected PdfPTable addDetailBiopsiaTable(BiopsiaInfoDTO biopsia, boolean esComplementario){
		PdfPTable table = new PdfPTable(new float[]{18, 45, 10, 35});
		table.setWidthPercentage(100);
		
		PdfPCell cell = new PdfPCell(new Phrase("\nDr: ", new Font(informeFontNormal.getBaseFont(), 10)));
		cell.setBorder(0);
		
		PdfPCell cell1 = new PdfPCell(new Phrase("\n" + biopsia.getIngresoDTO().getReferidoMedico(), informeFontNormal));
		cell1.setColspan(3);
		cell1.setBorder(0);
		
		PdfPCell cell2 = new PdfPCell(new Phrase("Paciente: ", new Font(informeFontNormal.getBaseFont(), 10)));
		cell2.setBorder(0);
		
		PdfPCell cell3 = new PdfPCell(new Phrase(biopsia.getCliente().getNombres()
				+ " " + biopsia.getCliente().getApellidos(), informeFontNormal));
		cell3.setColspan(3);
		cell3.setBorder(0);
		
		PdfPCell cell4 = new PdfPCell(new Phrase("Procedencia:", new Font(informeFontNormal.getBaseFont(), 10)));
		cell4.setBorder(0);
		
		PdfPCell cell5 = new PdfPCell(new Phrase(biopsia.getIngresoDTO().getProcedencia(), informeFontNormal));
		cell5.setBorder(0);
		
		PdfPCell cell6 = new PdfPCell(new Phrase("Edad:", new Font(informeFontNormal.getBaseFont(), 10)));
		cell6.setBorder(0);
		cell6.setHorizontalAlignment(PdfPCell.ALIGN_LEFT);
		
		String edad = "";
		if(biopsia.getCliente().getEdad() < 1){
			edad = " N/I ";
		}else {
			edad = " " + biopsia.getCliente().getEdad() + " " 
					+ biopsia.getCliente().getTipoEdad().getNombre().toLowerCase();
		}
		PdfPCell cell7 = new PdfPCell(new Phrase(edad + " C.I. "
				+ formatCedula(biopsia.getCliente().getCedula()), informeFontNormal));
		cell7.setBorder(0);
		
		PdfPCell cell8 = new PdfPCell(new Phrase("Referencia:", new Font(informeFontNormal.getBaseFont(), 10)));
		cell8.setBorder(0);
		
		PdfPCell cell9 = new PdfPCell(new Phrase(biopsia.getCodigo(), informeFontNormal));
		cell9.setBorder(0);
		
		PdfPCell cell10 = new PdfPCell(new Phrase("Fecha:", new Font(informeFontNormal.getBaseFont(), 10)));
		cell10.setBorder(0);
		cell10.setHorizontalAlignment(PdfPCell.ALIGN_LEFT);
		
		Calendar date = Calendar.getInstance();
		if(esComplementario){
			if(biopsia.getFechaImpresionComplementario() != null){
				date = biopsia.getFechaImpresionComplementario();
			}
		} else {
			if(biopsia.getFechaImpresionInforme() != null){
				date = biopsia.getFechaImpresionInforme();
			}
		}
		
		PdfPCell cell11 = new PdfPCell(new Phrase(Constants.sdfDDMMYYYY.format(date.getTime()), informeFontNormal));
		cell11.setBorder(0);
		
		table.addCell(cell);
		table.addCell(cell1);
		table.addCell(cell2);
		table.addCell(cell3);
		table.addCell(cell4);
		table.addCell(cell5);
		table.addCell(cell6);
		table.addCell(cell7);
		table.addCell(cell8);
		table.addCell(cell9);
		table.addCell(cell10);
		table.addCell(cell11);
		
		return table;
	}
	
	/**
	 * 
	 * @param writer
	 * @param document
	 * @param biopsia
	 * @throws DocumentException
	 */
	protected void addDiagnostico(PdfWriter writer, Document document, 
			BiopsiaInfoDTO biopsia) throws DocumentException{
		addDiagnostico(writer, document, biopsia, false);
	}
	
	/**
	 * 
	 * @param writer
	 * @param document
	 * @param biopsia
	 * @param isIHQ
	 * @throws DocumentException
	 */
	protected void addDiagnostico(PdfWriter writer, Document document, 
			BiopsiaInfoDTO biopsia, boolean isIHQ) throws DocumentException{
		
		boolean printDiagnostico = (isIHQ && !"".equals(biopsia.getMicroscopicaDTO().getDiagnosticoIHQ().trim())
				|| (!isIHQ && !"".equals(biopsia.getMicroscopicaDTO().getDiagnostico().trim())));
		
		if(printDiagnostico){
			//dandole al diagnostico al menos 3 lineas, verificamos si debe pasar a la siguiente hoja o no
			log.info("writer.getVerticalPosition(true)/document.bottom() " + writer.getVerticalPosition(true) 
					+ "/" + document.bottom());
			//espacio faltante para el margen inferior del documento
			int espacioFaltante = (int) (writer.getVerticalPosition(true) - document.bottom());
			if(espacioFaltante < 50){
				log.info("El diagnostico no va a caber al final de la hoja actual, se pasa de primero a la siguiente");
				document.newPage();
			}
			
			Chunk title1 = new Chunk("DIAGNOSTICO:", 
					new Font(informeFontBold.getBaseFont(), 12F, Font.UNDERLINE));
			Phrase value1 = null;
			if(isIHQ){
				value1 = new Phrase(biopsia.getMicroscopicaDTO().getDiagnosticoIHQ(), 
						new Font(informeFontNormal.getBaseFont(), 12F));
			} else {
				value1 = new Phrase(biopsia.getMicroscopicaDTO().getDiagnostico(), 
						new Font(informeFontNormal.getBaseFont(), 12F));
			}
			
			Paragraph p1 = new Paragraph();
			p1.setIndentationLeft(50);
			p1.add(chunkEnter);
			p1.add(title1);
			
			Paragraph p2 = new Paragraph();
			p2.setIndentationLeft(100);
			p2.setAlignment(Element.ALIGN_JUSTIFIED);
			p2.add(value1);
			
			document.add(p1);
			document.add(p2);
		}
	}
	
	/**
	 * 
	 * @param writer
	 * @param document
	 * @param firmante1
	 * @param firmante2
	 * @throws DocumentException
	 */
	protected void addFirmantes(PdfWriter writer, Document document,
			String firmante1, String firmante2) throws DocumentException{
		log.info("writer.getVerticalPosition(true)/document.bottom() " + writer.getVerticalPosition(true) 
				+ "/" + document.bottom());
		//espacio faltante para el margen inferior del documento
		int espacioFaltante = (int) (writer.getVerticalPosition(true) - document.bottom());
		int maxSignYPosition = 60;
		
		if(espacioFaltante > 90){
			maxSignYPosition = (int) (writer.getVerticalPosition(true) - 90);
		}
		
		log.info("Colocando firmas del informe en la posicion " + maxSignYPosition);
		int cantidadFirmates = 1;
		if(firmante2 != null 
				&& ! "".equals(firmante2.trim())
				&& ! "seleccione".equals(firmante2.trim().toLowerCase())){
			cantidadFirmates++;
		}
		
		int factor = (int) (document.getPageSize().getWidth() / 2) / cantidadFirmates;
		
		ColumnText.showTextAligned(writer.getDirectContent(),
                Element.ALIGN_CENTER, 
                new Phrase(firmante1, new Font(FuenteInformeUtil.getInformeFontNormal().getBaseFont(), 12)),
                factor, 
                maxSignYPosition,
                0);
		
		if(cantidadFirmates == 2){
			ColumnText.showTextAligned(writer.getDirectContent(),
	                Element.ALIGN_CENTER, 
	                new Phrase(firmante2, new Font(FuenteInformeUtil.getInformeFontNormal().getBaseFont(), 12)),
	                factor * 3, 
	                maxSignYPosition,
	                0);
		}
	}
}
