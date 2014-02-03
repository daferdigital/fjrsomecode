package com.fjr.code.pdf;

import java.awt.Desktop;
import java.io.File;
import java.io.FileOutputStream;
import java.io.IOException;

import org.apache.log4j.Logger;

import com.fjr.code.dao.BiopsiaInfoDAO;
import com.fjr.code.dao.BiopsiaMicroLaminasDAO;
import com.fjr.code.dto.BiopsiaInfoDTO;
import com.fjr.code.dto.BiopsiaMicroLaminasDTO;
import com.fjr.code.util.Constants;
import com.itextpdf.text.Chunk;
import com.itextpdf.text.Document;
import com.itextpdf.text.DocumentException;
import com.itextpdf.text.Font;
import com.itextpdf.text.PageSize;
import com.itextpdf.text.Paragraph;
import com.itextpdf.text.Phrase;
import com.itextpdf.text.pdf.PdfWriter;

/**
 * 
 * Class: BiopsiaDiagnosticoCISH
 * Creation Date: 04/01/2014
 * (c) 2014
 *
 * @author T&T
 *
 */
public class BiopsiaDiagnosticoCitologia extends BiopsiaInformeCommon implements PDFPageChecker {
	private static final Logger log = Logger.getLogger(BiopsiaDiagnosticoCitologia.class);
	private static final Chunk chunkEnter = new Chunk("\n");
	
	private BiopsiaInfoDTO biopsia;
	private int idBiopsia;
	private boolean fixNumberPage = false;
	private String fileName;
	private String filePath;
	private String firmante1;
	private String firmante2;
	
	/**
	 * 
	 * @param biopsia
	 * @param firmante1
	 * @param firmante2
	 */
	public BiopsiaDiagnosticoCitologia(BiopsiaInfoDTO biopsia,
			String firmante1, String firmante2) {
		// TODO Auto-generated constructor stub
		this.biopsia = biopsia;
		this.idBiopsia = biopsia.getId();
		this.firmante1 = firmante1;
		this.firmante2 = firmante2;
		this.fileName = "diagnostico_" + idBiopsia + ".pdf";
		this.filePath = Constants.TMP_PATH + File.separator + fileName; 
	}
	
	/**
	 * 
	 */
	public void buildDiagnostico(){
		long t0 = System.currentTimeMillis();
		log.info("+ Iniciando creacion de diagnostico Citologia para la biopsia de id=" + idBiopsia);
		
		try {
			Document document = new Document(PageSize.LETTER);
			document.setMargins(document.leftMargin(), 
					114, 
					120, 
					document.bottomMargin() + 70);
			
			//step 2
			PdfWriter writer = PdfWriter.getInstance(document, 
	        		new FileOutputStream(filePath));
			
			HeaderFooter event = new HeaderFooter(biopsia.getCodigo(), this);
            writer.setPageEvent(event);
            
			//step 3
			document.open();
	        document.newPage();
			//step 4
	        //PdfContentByte cb = writer.getDirectContent();
	        
	        //agregamos la tabla de detalle de la biopsia
	        document.add(addDetailBiopsiaTable(biopsia));
	        document.add(chunkEnter);
	        
	        //agregamos el texto inicial
	        addDetail(document);
	        
	        //agregamos el diagnostico de la fase micro
		    addDiagnostico(writer, document, biopsia);
		    
		    //agregamos los firmantes
		    addFirmantes(writer, document, firmante1, firmante2);
		    
	        //step 5
	        document.close();
		} catch (Throwable e) {
			// TODO: handle exception
			log.error(e.getLocalizedMessage(), e);
		}
		
		log.info("+ Finalizada creacion de diagnostico Citologia para la biopsia de id=" + idBiopsia
				+ ". Duracion=" + (System.currentTimeMillis() - t0) + " ms.");
	}

	/**
	 * 
	 * @param document
	 * @throws DocumentException 
	 */
	private void addDetail(Document document) throws DocumentException{
		Chunk title1 = new Chunk("PROCEDENCIA DEL MATERIAL:", 
				new Font(informeFontBold.getBaseFont(), 12F, Font.UNDERLINE));
		Phrase value1 = new Phrase(" " + biopsia.getIngresoDTO().getPiezaRecibida(), 
				new Font(informeFontNormal.getBaseFont(), 12F));
		
		Paragraph p1 = new Paragraph();
		p1.setIndentationLeft(50);
		p1.add(chunkEnter);
		p1.add(chunkEnter);
		p1.add(chunkEnter);
		p1.add(title1);
		p1.add(value1);
		
		Paragraph p2 = new Paragraph();
		Chunk title2 = new Chunk("DESCRIPCION MICROSCOPICA:", 
				new Font(informeFontBold.getBaseFont(), 12F, Font.UNDERLINE));
		p2.setAlignment(Paragraph.ALIGN_JUSTIFIED);
		p2.setIndentationLeft(50);
		p2.add(chunkEnter);
		p2.add(title2);
		
		Paragraph p3 = new Paragraph();
		p3.setAlignment(Paragraph.ALIGN_JUSTIFIED);
		p3.setIndentationLeft(100);
		
		biopsia = BiopsiaMicroLaminasDAO.setMicroLaminas(biopsia, false);
		if(biopsia.getMicroscopicaDTO().getLaminasDTO() != null){
			for (BiopsiaMicroLaminasDTO lamina : biopsia.getMicroscopicaDTO().getLaminasDTO()) {
				p3.add(new Phrase(lamina.getDescripcion(), 
						new Font(informeFontNormal.getBaseFont(), 12F)));
				p3.add(chunkEnter);
			}
		}
		
		document.add(p1);
		document.add(p2);
		document.add(p3);
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
		
		//new BiopsiaDiagnostico(biopsia, "Felipe Rojas", null).buildDiagnostico();
		System.out.println("Finish...");
	}

	@Override
	public boolean mustFixNumberPage() {
		// TODO Auto-generated method stub
		return fixNumberPage;
	}
}
