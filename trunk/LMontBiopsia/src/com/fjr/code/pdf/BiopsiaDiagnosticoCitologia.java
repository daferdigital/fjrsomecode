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
import com.itextpdf.text.Element;
import com.itextpdf.text.Font;
import com.itextpdf.text.PageSize;
import com.itextpdf.text.Paragraph;
import com.itextpdf.text.Phrase;
import com.itextpdf.text.pdf.ColumnText;
import com.itextpdf.text.pdf.PdfPCell;
import com.itextpdf.text.pdf.PdfPTable;
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
public class BiopsiaDiagnosticoCitologia implements PDFPageChecker {
	private static final Logger log = Logger.getLogger(BiopsiaDiagnosticoCitologia.class);
	private static final Chunk chunkEnter = new Chunk("\n");
	
	private BiopsiaInfoDTO biopsia;
	private int idBiopsia;
	private boolean fixNumberPage = false;
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
	        document.add(addDetailBiopsiaTable());
	        
	        //agregamos el texto inicial
	        addDetail(document);
	        
	        //agregamos el diagnostico de la fase micro
		    addDiagnostico(document);
		    
		    //agregamos los firmantes
		    addFirmantes(writer, document);
		    
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
		
		PdfPCell cell7 = new PdfPCell(new Phrase(biopsia.getCliente().getEdad() + " a�os C.I. "
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
		
		Chunk title2 = new Chunk("DESCRIPCION MICROSCOPICA:", 
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
	 * @throws DocumentException
	 */
	private void addDiagnostico(Document document) throws DocumentException{
		Chunk title1 = new Chunk("DIAGNOSTICO:", 
				new Font(informeFontBold.getBaseFont(), 12F, Font.UNDERLINE));
		Phrase value1 = new Phrase(" " + biopsia.getMicroscopicaDTO().getDiagnostico(), 
				new Font(informeFontNormal.getBaseFont(), 10F));
		
		Paragraph p1 = new Paragraph();
		p1.setIndentationLeft(50);
		p1.add(chunkEnter);
		p1.add(chunkEnter);
		p1.add(title1);
		
		Paragraph p2 = new Paragraph();
		p2.setIndentationLeft(100);
		p2.setAlignment(Element.ALIGN_JUSTIFIED);
		p2.add(value1);
		p2.add(chunkEnter);
		p2.add(chunkEnter);
		
		document.add(p1);
		document.add(p2);
	}
	
	/**
	 * 
	 * @param writer
	 * @param document
	 * @throws DocumentException
	 */
	private void addFirmantes(PdfWriter writer, Document document) throws DocumentException{
		log.info("writer.getVerticalPosition(true)/document.bottom() " + writer.getVerticalPosition(true) 
				+ "/" + document.bottom());
		int espacioFaltante = (int) (writer.getVerticalPosition(true) - document.bottom());
		int maxSignYPosition = 120;
		
		if(espacioFaltante - 50 > maxSignYPosition){
			maxSignYPosition = espacioFaltante - 50;
		}
		
		int cantidadFirmates = 1;
		if(firmante2 != null 
				&& ! "".equals(firmante2.trim())
				&& ! "seleccione".equals(firmante2.trim().toLowerCase())){
			cantidadFirmates++;
		}
		
		int factor = (int) (document.getPageSize().getWidth() / 2) / cantidadFirmates;
		
		ColumnText.showTextAligned(writer.getDirectContent(),
                Element.ALIGN_CENTER, 
                new Phrase(firmante1, new Font(FuenteInformeUtil.getInformeFontNormal().getBaseFont(), 10)),
                factor, 
                maxSignYPosition,
                0);
		
		if(cantidadFirmates == 2){
			ColumnText.showTextAligned(writer.getDirectContent(),
	                Element.ALIGN_CENTER, 
	                new Phrase(firmante2, new Font(FuenteInformeUtil.getInformeFontNormal().getBaseFont(), 10)),
	                factor * 3, 
	                maxSignYPosition,
	                0);
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
		return fixNumberPage;
	}
}
