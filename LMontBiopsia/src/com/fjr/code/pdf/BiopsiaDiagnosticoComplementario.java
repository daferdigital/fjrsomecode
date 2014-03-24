package com.fjr.code.pdf;

import java.awt.Desktop;
import java.io.File;
import java.io.FileOutputStream;
import java.io.IOException;

import org.apache.log4j.Logger;

import com.fjr.code.dao.BiopsiaInfoDAO;
import com.fjr.code.dto.BiopsiaInfoDTO;
import com.fjr.code.util.Constants;
import com.itextpdf.text.Chunk;
import com.itextpdf.text.Document;
import com.itextpdf.text.DocumentException;
import com.itextpdf.text.Element;
import com.itextpdf.text.Font;
import com.itextpdf.text.PageSize;
import com.itextpdf.text.Paragraph;
import com.itextpdf.text.Phrase;
import com.itextpdf.text.pdf.PdfWriter;

/**
 * 
 * Class: BiopsiaDiagnosticoComplementario
 * Creation Date: 22/03/2014
 * (c) 2014
 *
 * @author T&T
 *
 */
public class BiopsiaDiagnosticoComplementario extends BiopsiaInformeCommon implements PDFPageChecker {
	private static final Logger log = Logger.getLogger(BiopsiaDiagnosticoComplementario.class);
	
	private BiopsiaInfoDTO biopsia;
	private int idBiopsia;
	private String fileName;
	private String filePath;
	private String firmante1;
	private String firmante2;
	private String textoDiagnosticoComplementario;
	private String textoComentarioComplementario;
	/**
	 * 
	 * @param biopsia
	 * @param firmante1
	 * @param firmante2
	 * @param textoDiagnosticoComplementario
	 * @param textoComentarioComplementario
	 */
	public BiopsiaDiagnosticoComplementario(BiopsiaInfoDTO biopsia,
			String firmante1, String firmante2, String textoDiagnosticoComplementario,
			String textoComentarioComplementario) {
		// TODO Auto-generated constructor stub
		this.biopsia = biopsia;
		this.idBiopsia = biopsia.getId();
		this.firmante1 = firmante1;
		this.firmante2 = firmante2;
		this.textoComentarioComplementario = textoComentarioComplementario;
		this.textoDiagnosticoComplementario = textoDiagnosticoComplementario;
		this.fileName = Constants.PREFIJO_PDF_INFORME_COMPLEMENTARIO + idBiopsia + ".pdf";
		this.filePath = Constants.TMP_PATH + File.separator + fileName; 
	}
	
	/**
	 * 
	 */
	public void buildDiagnostico(){
		long t0 = System.currentTimeMillis();
		log.info("+ Iniciando creacion de diagnostico complementario para la biopsia de id=" + idBiopsia);
		
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
	        document.add(addDetailBiopsiaTable(biopsia, true));
	        document.add(chunkEnter);
	        
	        //agregamos el titulo del informe
	        addTitle(document, writer);
	        
	        //agregamos la info de Macro
	        addDetailMacro(document, writer);

	        //agregamos el comentario del informe
		    addComentarios(document, writer, this.textoComentarioComplementario);
		    
		    //agregamos el diagnostico del informe
	        biopsia.getMicroscopicaDTO().setDiagnostico(this.textoDiagnosticoComplementario);
		    addDiagnostico(writer, document, biopsia);
		    
		    //agregamos los firmantes
		    addFirmantes(writer, document, firmante1, firmante2);
		    
	        //step 5
	        document.close();
		} catch (Throwable e) {
			// TODO: handle exception
			log.error(e.getLocalizedMessage(), e);
		}
		
		log.info("+ Finalizada creacion de diagnostico complementario para la biopsia de id=" + idBiopsia
				+ ". Duracion=" + (System.currentTimeMillis() - t0) + " ms.");
	}
	
	/**
	 * 
	 * @param document
	 * @param writer
	 * @throws DocumentException
	 */
	private void addTitle(Document document, PdfWriter writer) throws DocumentException{
		Chunk title1 = new Chunk("INFORME COMPLEMENTARIO:", 
				new Font(informeFontBold.getBaseFont(), 12F, Font.UNDERLINE));
		
		Paragraph p1 = new Paragraph();
		p1.setAlignment(Element.ALIGN_CENTER);
		p1.add(chunkEnter);
		p1.add(title1);
		
		document.add(p1);
	}
	
	/**
	 * 
	 * @param document
	 * @param writer
	 * @throws DocumentException
	 */
	private void addDetailMacro(Document document, PdfWriter writer) throws DocumentException{
		Chunk title1 = new Chunk("PROCEDENCIA DEL MATERIAL:", 
				new Font(informeFontBold.getBaseFont(), 12F, Font.UNDERLINE));
		Phrase value1 = new Phrase(" " + biopsia.getIngresoDTO().getPiezaRecibida(), 
				new Font(informeFontNormal.getBaseFont(), 12F));
		
		Paragraph p1 = new Paragraph();
		p1.setIndentationLeft(50);
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
		
		document.add(p1);
		document.add(p2);		
	}
	
	/**
	 * 
	 * @param document
	 * @param writer
	 * @param textoComentarioComplementario
	 * @throws DocumentException
	 */
	private void addComentarios(Document document, PdfWriter writer, String textoComentarioComplementario) 
			throws DocumentException{
		boolean putComentario = true;
		try {
			putComentario = ! "".equals(textoComentarioComplementario.trim());
		} catch (Exception e) {
			// TODO: handle exception
			putComentario = false;
		}
		
		if(putComentario){
			Chunk title1 = new Chunk("COMENTARIOS:", 
					new Font(informeFontBold.getBaseFont(), 12F, Font.UNDERLINE));
			Phrase value1 = new Phrase(textoComentarioComplementario, 
					new Font(informeFontNormal.getBaseFont(), 12F));
			
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
		} else {
			log.info("Como el comentario vino vacio no se coloca");
		}
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
		return false;
	}
}
