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
import com.itextpdf.text.Image;
import com.itextpdf.text.PageSize;
import com.itextpdf.text.Paragraph;
import com.itextpdf.text.Phrase;
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
	private String firmante1;
	private String firmante2;
	
	Font informeFontNormal = FuenteInformeUtil.getInformeFontNormal();
	Font informeFontBold = FuenteInformeUtil.getInformeFontBold();
	
	/**
	 * 
	 * @param biopsia
	 * @param firmante1
	 * @param firmante2
	 */
	public BiopsiaDiagnostico(BiopsiaInfoDTO biopsia,
			String firmante1, String firmante2) {
		// TODO Auto-generated constructor stub
		this.biopsia = biopsia;
		this.idBiopsia = biopsia.getId();
		this.firmante1 = firmante1;
		this.firmante2 = firmante2;
		this.fileName = "diagnostico_" + idBiopsia + ".pdf";
		this.filePath = Constants.TMP_PATH + File.separator + fileName; 
	}
	
	public void buildDiagnostico(){
		long t0 = System.currentTimeMillis();
		log.info("+ Iniciando creacion de diagnostico para la biopsia de id=" + idBiopsia);
		
		try {
			Document document = new Document(PageSize.A4);
			document.setMargins(document.leftMargin(), 
					114, 
					120, 
					document.bottomMargin() + 20);
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

	        if("".equals(biopsia.getMicroscopicaDTO().getDiagnostico())){
	        	
	        } 
	        
	        //agregamos el diagnostico de la fase micro
		    addDiagnostico(document);
		    
		    addFirmantes(document);
		    
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
		PdfPTable table = new PdfPTable(new float[]{18, 45, 10, 35});
		table.setWidthPercentage(100);
		
		PdfPCell cell = new PdfPCell(new Phrase("\nDr: ", informeFontNormal));
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
		
		PdfPCell cell7 = new PdfPCell(new Phrase(biopsia.getCliente().getEdad() + " años C.I. "
				+ biopsia.getCliente().getCedula(), informeFontNormal));
		cell7.setBorder(0);
		
		PdfPCell cell8 = new PdfPCell(new Phrase("Referencia:", new Font(informeFontNormal.getBaseFont(), 10)));
		cell8.setBorder(0);
		
		PdfPCell cell9 = new PdfPCell(new Phrase(biopsia.getCodigo(), informeFontNormal));
		cell9.setBorder(0);
		
		PdfPCell cell10 = new PdfPCell(new Phrase("Fecha:", new Font(informeFontNormal.getBaseFont(), 10)));
		cell10.setBorder(0);
		cell10.setHorizontalAlignment(PdfPCell.ALIGN_LEFT);
		
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
		Chunk chunkEnter = new Chunk("\n");
		
		Chunk title1 = new Chunk("PROCEDENCIA DEL MATERIAL:", 
				new Font(informeFontBold.getBaseFont(), 12F, Font.UNDERLINE));
		Phrase value1 = new Phrase(" " + biopsia.getIngresoDTO().getPiezaRecibida(), 
				new Font(informeFontNormal.getBaseFont(), 12F));
		
		Paragraph p1 = new Paragraph();
		p1.setIndentationLeft(50);
		p1.add(chunkEnter);
		p1.add(chunkEnter);
		p1.add(title1);
		p1.add(value1);
		
		Chunk title2 = new Chunk("DESCRIPCION MACROSCOPICA:", 
				new Font(informeFontBold.getBaseFont(), 12F, Font.UNDERLINE));
		Phrase value2 = new Phrase(biopsia.getMacroscopicaDTO().getDescMacroscopica(), new Font(informeFontNormal.getBaseFont(), 12F));
		Paragraph p2 = new Paragraph();
		p2.setAlignment(Paragraph.ALIGN_JUSTIFIED);
		p2.setIndentationLeft(50);
		p2.add(chunkEnter);
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
						Chunk titlePerOperatorio = new Chunk("BIOPSIA PER-OPERATORIA: ", 
								new Font(informeFontBold.getBaseFont(), 12F, Font.UNDERLINE));
						Phrase valuePerOperatorio = new Phrase(biopsia.getMacroscopicaDTO().getDescPerOperatoria(), 
								new Font(informeFontNormal.getBaseFont(), 12F));
						Paragraph p3 = new Paragraph();
						p3.setAlignment(Paragraph.ALIGN_JUSTIFIED);
						p3.setIndentationLeft(50);
						p3.add(chunkEnter);
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
	
	
	private void addFirmantes(Document document) throws DocumentException{
		int cantidadFirmates = 1;
		if(firmante2 != null 
				&& ! "".equals(firmante2.trim())
				&& ! "seleccione".equals(firmante2.trim().toLowerCase())){
			cantidadFirmates++;
		}
		
		PdfPTable table = null;
		if(cantidadFirmates == 1){
			table = new PdfPTable(new float[]{100});
		} else {
			table = new PdfPTable(new float[]{50, 50});
		}
		table.setWidthPercentage(100);
		
		PdfPCell cellSpace = new PdfPCell(new Phrase("\n\n\n_______________________", 
				informeFontNormal));
		cellSpace.setBorder(0);
		cellSpace.setHorizontalAlignment(PdfPCell.ALIGN_CENTER);
		
		PdfPCell cell = new PdfPCell(new Phrase("\n" + firmante1, informeFontNormal));
		cell.setBorder(0);
		cell.setHorizontalAlignment(PdfPCell.ALIGN_CENTER);
		
		PdfPCell cell1 = new PdfPCell(new Phrase("\n" + firmante2, informeFontNormal));
		cell1.setBorder(0);
		cell1.setHorizontalAlignment(PdfPCell.ALIGN_CENTER);
		
		table.addCell(cellSpace);
		if(cantidadFirmates == 2){
			table.addCell(cellSpace);
		}
		
		table.addCell(cell);
		if(cantidadFirmates == 2){
			table.addCell(cell1);
		}
		
		document.add(table);
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
		BiopsiaInfoDTO biopsia = BiopsiaInfoDAO.getBiopsiaByNumero("13-009002");
		if(biopsia == null){
			biopsia = new BiopsiaInfoDTO();
			biopsia.setId(1);
		}
		
		new BiopsiaDiagnostico(biopsia, "Felipe Rojas", null).buildDiagnostico();
		System.out.println("Finish...");
	}
}
