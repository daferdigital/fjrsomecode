package com.fjr.code.pdf;

import java.awt.Desktop;
import java.io.File;
import java.io.FileOutputStream;
import java.io.IOException;
import java.text.DateFormat;
import java.text.SimpleDateFormat;

import org.apache.log4j.Logger;

import com.fjr.code.dao.BiopsiaInfoDAO;
import com.fjr.code.dto.BiopsiaInfoDTO;
import com.fjr.code.util.Constants;
import com.itextpdf.text.Chunk;
import com.itextpdf.text.Document;
import com.itextpdf.text.DocumentException;
import com.itextpdf.text.Font.FontFamily;
import com.itextpdf.text.Font;
import com.itextpdf.text.PageSize;
import com.itextpdf.text.Paragraph;
import com.itextpdf.text.Phrase;
import com.itextpdf.text.pdf.PdfContentByte;
import com.itextpdf.text.pdf.PdfPCell;
import com.itextpdf.text.pdf.PdfPTable;
import com.itextpdf.text.pdf.PdfWriter;
import com.sun.org.apache.bcel.internal.generic.BIPUSH;

/**
 * 
 * Class: BiopsiaDiagnostico
 * Creation Date: 29/09/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class BiopsiaDiagnostico {
	private static final Logger log = Logger.getLogger(BiopsiaDiagnostico.class);
	
	private BiopsiaInfoDTO biopsia;
	private int idBiopsia;
	private String fileName;
	private String filePath;
	
	/**
	 * 
	 * @param biopsia
	 */
	public BiopsiaDiagnostico(BiopsiaInfoDTO biopsia) {
		// TODO Auto-generated constructor stub
		this.biopsia = biopsia;
		this.idBiopsia = biopsia.getId();
		this.fileName = "diagnostico_" + idBiopsia + ".pdf";
		this.filePath = Constants.TMP_PATH + File.separator + fileName;
	}
	
	public void buildDiagnostico(){
		long t0 = System.currentTimeMillis();
		log.info("+ Iniciando creacion de diagnostico para la biopsia de id=" + idBiopsia);
		
		try {
			Document document = new Document(PageSize.A4);
			document.setMargins(document.leftMargin(), 
					document.rightMargin(), 
					90, 
					document.bottomMargin());
			/*
			System.out.println(document.leftMargin());
			System.out.println(document.rightMargin());
			System.out.println(document.topMargin());
			System.out.println(document.bottomMargin());
			System.out.println(document.getPageSize());
			*/
			//step 2
			PdfWriter writer = PdfWriter.getInstance(document, 
	        		new FileOutputStream(filePath));
			
			HeaderFooter event = new HeaderFooter();
            writer.setPageEvent(event);
        
			//step 3
			document.open();
	        document.newPage();
			//step 4
	        PdfContentByte cb = writer.getDirectContent();
	        
	        //agregamos la tabla de detalle de la biopsia
	        document.add(addDetailBiopsiaTable());
	        //agregamos la info de Macro
	        addDetailMacro(document);
	        
	        //step 5
	        document.close();
		} catch (Throwable e) {
			// TODO: handle exception
			log.error(e.getLocalizedMessage(), e);
		}
		
		log.info("+ Finalizada creacion de diagnostico para la biopsia de id=" + idBiopsia
				+ ". Duracion=" + (System.currentTimeMillis() - t0) + " ms.");
	}

	/**
	 * 
	 * @param biopsia
	 * @return
	 */
	private PdfPTable addDetailBiopsiaTable(){
		PdfPTable table = new PdfPTable(new float[]{20, 30, 10, 40});
		table.setWidthPercentage(100);
		
		PdfPCell cell = new PdfPCell(new Phrase("Dr: "));
		cell.setBorder(0);
		
		PdfPCell cell1 = new PdfPCell(new Phrase(biopsia.getIngresoDTO().getPatologoTurno().getNombre()));
		cell1.setColspan(3);
		cell1.setBorder(0);
		
		PdfPCell cell2 = new PdfPCell(new Phrase("Paciente: "));
		cell2.setBorder(0);
		
		PdfPCell cell3 = new PdfPCell(new Phrase(biopsia.getCliente().getNombres()
				+ " " + biopsia.getCliente().getApellidos()));
		cell3.setColspan(3);
		cell3.setBorder(0);
		
		PdfPCell cell4 = new PdfPCell(new Phrase("Procedencia:"));
		cell4.setBorder(0);
		
		PdfPCell cell5 = new PdfPCell(new Phrase(biopsia.getIngresoDTO().getProcedencia()));
		cell5.setBorder(0);
		
		PdfPCell cell6 = new PdfPCell(new Phrase("Edad:"));
		cell6.setBorder(0);
		cell6.setHorizontalAlignment(PdfPCell.ALIGN_RIGHT);
		
		PdfPCell cell7 = new PdfPCell(new Phrase(biopsia.getCliente().getEdad() + " años C.I. "
				+ biopsia.getCliente().getCedula()));
		cell7.setBorder(0);
		
		PdfPCell cell8 = new PdfPCell(new Phrase("Referencia:"));
		cell8.setBorder(0);
		
		PdfPCell cell9 = new PdfPCell(new Phrase(biopsia.getCodigo()));
		cell9.setBorder(0);
		
		PdfPCell cell10 = new PdfPCell(new Phrase("Fecha:"));
		cell10.setBorder(0);
		cell10.setHorizontalAlignment(PdfPCell.ALIGN_RIGHT);
		
		DateFormat df = new SimpleDateFormat("dd-MM-yyyy");
		PdfPCell cell11 = new PdfPCell(new Phrase(df.format(biopsia.getFechaRegistro().getTime())));
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
	 * @param document 
	 * @param biopsia
	 * @return
	 * @throws DocumentException 
	 */
	private void addDetailMacro(Document document) throws DocumentException{
		Chunk title1 = new Chunk("\n\nPROCEDENCIA DEL MATERIAL: ", new Font(FontFamily.TIMES_ROMAN, 14F, Font.BOLD));
		Phrase value1 = new Phrase(biopsia.getIngresoDTO().getPiezaRecibida(), new Font(FontFamily.TIMES_ROMAN, 12F, Font.NORMAL));
		
		Paragraph p1 = new Paragraph();
		p1.setIndentationLeft(50);
		p1.add(title1);
		p1.add(value1);
		
		Chunk title2 = new Chunk("\nDESCRIPCION MACROSCOPICA: ", new Font(FontFamily.TIMES_ROMAN, 14F, Font.BOLD));
		Phrase value2 = new Phrase(biopsia.getMacroscopicaDTO().getDescMacroscopica(), new Font(FontFamily.TIMES_ROMAN, 12F));
		Paragraph p2 = new Paragraph();
		p2.setIndentationLeft(50);
		p2.add(title2);
		p2.add(value2);
		
		document.add(p1);
		document.add(p2);
	}

	/**
	 * 
	 */
	public void open(){
		try {
			Desktop.getDesktop().open(new File(this.filePath));
		} catch (IOException e) {
			// TODO Auto-generated catch block
			log.error(e.getLocalizedMessage(), e);
		}
	}
	
	public static void main(String[] args) {
		BiopsiaInfoDTO biopsia = BiopsiaInfoDAO.getBiopsiaByNumero("11-005000");
		if(biopsia == null){
			biopsia = new BiopsiaInfoDTO();
			biopsia.setId(1);
		}
		
		new BiopsiaDiagnostico(biopsia).buildDiagnostico();
		System.out.println("Finish...");
	}
}
