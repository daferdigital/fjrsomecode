package com.fjr.code.pdf;

import java.awt.Desktop;
import java.io.File;
import java.io.FileOutputStream;
import java.io.IOException;
import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.LinkedList;
import java.util.List;

import org.apache.log4j.Logger;

import com.fjr.code.dao.BiopsiaFotosMacroDAO;
import com.fjr.code.dao.BiopsiaInfoDAO;
import com.fjr.code.dto.BiopsiaInfoDTO;
import com.fjr.code.dto.BiopsiaMacroFotoDTO;
import com.fjr.code.util.Constants;
import com.itextpdf.text.Chunk;
import com.itextpdf.text.Document;
import com.itextpdf.text.DocumentException;
import com.itextpdf.text.Element;
import com.itextpdf.text.Font;
import com.itextpdf.text.Font.FontStyle;
import com.itextpdf.text.Image;
import com.itextpdf.text.PageSize;
import com.itextpdf.text.Paragraph;
import com.itextpdf.text.Phrase;
import com.itextpdf.text.TabStop.Alignment;
import com.itextpdf.text.pdf.PdfPCell;
import com.itextpdf.text.pdf.PdfPTable;
import com.itextpdf.text.pdf.PdfWriter;

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
	
	Font informeFontNormal = FuenteInformeUtil.getInformeFontNormal();
	Font informeFontBold = FuenteInformeUtil.getInformeFontBold();
	
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
			
			HeaderFooter event = new HeaderFooter(biopsia.getCodigo());
            writer.setPageEvent(event);
        
			//step 3
			document.open();
	        document.newPage();
			//step 4
	        //PdfContentByte cb = writer.getDirectContent();
	        
	        //agregamos la tabla de detalle de la biopsia
	        document.add(addDetailBiopsiaTable());
	        //agregamos la info de Macro
	        addDetailMacro(document);
	        //agregamos el diagnostico de la fase micro
	        addDiagnostico(document);
	        
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
		
		PdfPCell cell = new PdfPCell(new Phrase("Dr: ", informeFontNormal));
		cell.setBorder(0);
		
		PdfPCell cell1 = new PdfPCell(new Phrase(biopsia.getIngresoDTO().getReferidoMedico(), informeFontNormal));
		cell1.setColspan(3);
		cell1.setBorder(0);
		
		PdfPCell cell2 = new PdfPCell(new Phrase("Paciente: ", informeFontNormal));
		cell2.setBorder(0);
		
		PdfPCell cell3 = new PdfPCell(new Phrase(biopsia.getCliente().getNombres()
				+ " " + biopsia.getCliente().getApellidos(), informeFontNormal));
		cell3.setColspan(3);
		cell3.setBorder(0);
		
		PdfPCell cell4 = new PdfPCell(new Phrase("Procedencia:", informeFontNormal));
		cell4.setBorder(0);
		
		PdfPCell cell5 = new PdfPCell(new Phrase(biopsia.getIngresoDTO().getProcedencia(), informeFontNormal));
		cell5.setBorder(0);
		
		PdfPCell cell6 = new PdfPCell(new Phrase("Edad:", informeFontNormal));
		cell6.setBorder(0);
		cell6.setHorizontalAlignment(PdfPCell.ALIGN_RIGHT);
		
		PdfPCell cell7 = new PdfPCell(new Phrase(biopsia.getCliente().getEdad() + " a�os C.I. "
				+ biopsia.getCliente().getCedula(), informeFontNormal));
		cell7.setBorder(0);
		
		PdfPCell cell8 = new PdfPCell(new Phrase("Referencia:", informeFontNormal));
		cell8.setBorder(0);
		
		PdfPCell cell9 = new PdfPCell(new Phrase(biopsia.getCodigo(), informeFontNormal));
		cell9.setBorder(0);
		
		PdfPCell cell10 = new PdfPCell(new Phrase("Fecha:", informeFontNormal));
		cell10.setBorder(0);
		cell10.setHorizontalAlignment(PdfPCell.ALIGN_RIGHT);
		
		DateFormat df = new SimpleDateFormat("dd-MM-yyyy");
		PdfPCell cell11 = new PdfPCell(new Phrase(df.format(biopsia.getFechaRegistro().getTime()), informeFontNormal));
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
		Chunk title1 = new Chunk("\n\nPROCEDENCIA DEL MATERIAL: ", new Font(informeFontBold.getBaseFont(), 14F));
		Phrase value1 = new Phrase(biopsia.getIngresoDTO().getPiezaRecibida(), new Font(informeFontNormal.getBaseFont(), 12F));
		
		Paragraph p1 = new Paragraph();
		p1.setIndentationLeft(50);
		p1.add(title1);
		p1.add(value1);
		
		Chunk title2 = new Chunk("\nDESCRIPCION MACROSCOPICA: ", new Font(informeFontBold.getBaseFont(), 14F));
		Phrase value2 = new Phrase(biopsia.getMacroscopicaDTO().getDescMacroscopica(), new Font(informeFontNormal.getBaseFont(), 12F));
		Paragraph p2 = new Paragraph();
		p2.setAlignment(Paragraph.ALIGN_JUSTIFIED);
		p2.setIndentationLeft(50);
		p2.add(title2);
		p2.add(value2);
		
		
		//procesamos las posibles fotos de macro
		List<Element> parrafosFotos = new LinkedList<Element>();
		BiopsiaFotosMacroDAO.setMacroFotos(biopsia);
		if(biopsia.getMacroscopicaDTO().getMacroFotosDTO() != null){
			boolean revisarPerOperatoria = true;
			int numeroFoto = 1;
			
			for (BiopsiaMacroFotoDTO macroFoto : biopsia.getMacroscopicaDTO().getMacroFotosDTO()) {
				//por cada foto colocaremos primero la observacion, la descripcion y luego las fotos
				Paragraph parrafoFoto = new Paragraph();
				parrafoFoto.setAlignment(Paragraph.ALIGN_JUSTIFIED);
				parrafoFoto.setIndentationLeft(50);
				parrafoFoto.setFirstLineIndent(100);
				
				Phrase phraseFoto = new Phrase("\n" + numeroFoto + ".- " + macroFoto.getNotacion() + ": "
						+ macroFoto.getDescripcion() + "\n",
						new Font(informeFontNormal.getBaseFont(), 12F));
				
				parrafoFoto.add(phraseFoto);
				parrafosFotos.add(parrafoFoto);
				
				try {
					Image imgFJR = Image.getInstance(macroFoto.getFotoFile().getAbsolutePath());
					imgFJR.scaleToFit(300, 200);
					imgFJR.setIndentationLeft(50);
					parrafosFotos.add(imgFJR);
				} catch (Throwable e) {
					// TODO Auto-generated catch block
					log.error(e.getMessage(), e);
				} 
				
				
				
				if(revisarPerOperatoria){
					if(! "".equals(biopsia.getMacroscopicaDTO().getDescPerOperatoria())){
						Chunk titlePerOperatorio = new Chunk("\nBIOPSIA PER-OPERATORIA: ", new Font(informeFontBold.getBaseFont(), 14F));
						Phrase valuePerOperatorio = new Phrase(biopsia.getMacroscopicaDTO().getDescPerOperatoria(), new Font(informeFontNormal.getBaseFont(), 12F));
						Paragraph p3 = new Paragraph();
						p3.setAlignment(Paragraph.ALIGN_JUSTIFIED);
						p3.setIndentationLeft(50);
						p3.add(titlePerOperatorio);
						p3.add(valuePerOperatorio);
						
						parrafosFotos.add(p3);	
					}
					
					revisarPerOperatoria = false;
				}
				
				numeroFoto++;
			}
		}
		
		document.add(p1);
		document.add(p2);
		
		for (Element element : parrafosFotos) {
			document.add(element);
		}
	}

	
	private void addDiagnostico(Document document) throws DocumentException{
		Chunk title1 = new Chunk("\n\nDIAGNOSTICO: ", new Font(informeFontBold.getBaseFont(), 14F));
		Phrase value1 = new Phrase(biopsia.getMicroscopicaDTO().getDiagnostico(), new Font(informeFontNormal.getBaseFont(), 12F));
		
		Paragraph p1 = new Paragraph();
		p1.setIndentationLeft(50);
		p1.add(title1);
		
		Paragraph p2 = new Paragraph();
		p2.setIndentationLeft(50);
		p2.setAlignment(Paragraph.ALIGN_JUSTIFIED);
		p2.add(value1);
		
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