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
public class ComprobanteEntregaMaterial implements PDFPageChecker {
	private static final Logger log = Logger.getLogger(ComprobanteEntregaMaterial.class);
	private static final Chunk chunkEnter = new Chunk("\n");
	private static final Chunk tab1 = new Chunk("        ");
	
	private BiopsiaInfoDTO biopsia;
	private int idBiopsia;
	private boolean fixNumberPage = false;
	private String fileName;
	private String filePath;
	private int bloques;
	private int laminas;
	
	Font informeFontNormal = FuenteInformeUtil.getInformeFontNormal();
	Font informeFontBold = FuenteInformeUtil.getInformeFontBold();
	
	/**
	 * 
	 * @param biopsia
	 * @param bloques
	 * @param laminas
	 */
	public ComprobanteEntregaMaterial(BiopsiaInfoDTO biopsia,
			int bloques, int laminas) {
		// TODO Auto-generated constructor stub
		this.biopsia = biopsia;
		this.idBiopsia = biopsia.getId();
		this.fileName = "Comprobante_" + idBiopsia + ".pdf";
		this.filePath = Constants.TMP_PATH + File.separator + fileName; 
		this.bloques = bloques;
		this.laminas = laminas;
	}
	
	/**
	 * 
	 */
	public void buildDiagnostico(){
		long t0 = System.currentTimeMillis();
		log.info("+ Iniciando creacion de comprobante de entrega de material para la biopsia de id=" + idBiopsia);
		
		try {
			Document document = new Document(PageSize.LETTER);
			document.setMargins(document.leftMargin(), 
					114, 
					120, 
					document.bottomMargin() + 70);
			
			//step 2
			PdfWriter writer = PdfWriter.getInstance(document, 
	        		new FileOutputStream(filePath));
			
			HeaderFooter event = new HeaderFooter(biopsia.getCodigo(), this, 420);
            writer.setPageEvent(event);
            
			//step 3
			document.open();
	        document.newPage();
			//step 4
	        //PdfContentByte cb = writer.getDirectContent();
	        
	        //agregamos la tabla de detalle de la biopsia
	        document.add(addDetailBiopsiaTable());
	        
	        //agregamos el texto centrado del titulo del informe
	        addTitle(document);
	        
	        //agregamos la información de los reactivos (cepas)
	        addMaterialInfo(document);
	        
	        //se agrega el cuadro fijo de informacion complementaria
		    //addInformacionComplementaria(document);
		    
		    //agregamos los firmantes
		    addFirmantes(writer, document);
		    
	        //step 5
	        document.close();
		} catch (Throwable e) {
			// TODO: handle exception
			log.error(e.getLocalizedMessage(), e);
		}
		
		log.info("+ Finalizada creacion de comprobante de entrega de material para la biopsia de id=" + idBiopsia
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
	 * @throws DocumentException 
	 */
	private void addTitle(Document document) throws DocumentException{
		Paragraph p = new Paragraph();
        p.setAlignment(Paragraph.ALIGN_CENTER);
        p.add(chunkEnter);
        p.add(tab1);
        p.add(tab1);
        p.add(new Phrase("COMPROBANTE DE ENTREGA DE MATERIAL", 
        		new Font(FuenteInformeUtil.getInformeFontBold().getFamily(), 14, Font.BOLD)));
        document.add(p);
	}
	
	/**
	 * 
	 * @param document
	 * @throws DocumentException
	 */
	private void addMaterialInfo(Document document) throws DocumentException{
		//obtenemos las laminas de IHQ para mostrar los resultados de los reactivos
		PdfPTable table = new PdfPTable(new float[]{160, 80, 100});
		table.setHorizontalAlignment(Element.ALIGN_JUSTIFIED);
		
		PdfPCell cell = new PdfPCell(new Phrase("MATERIAL", 
				new Font(informeFontBold.getBaseFont(), 10F)));
		PdfPCell cell1 = new PdfPCell(new Phrase("CANTIDAD", 
				new Font(informeFontBold.getBaseFont(), 10F)));
		PdfPCell cell2 = new PdfPCell(new Phrase("", 
				new Font(informeFontBold.getBaseFont(), 10F)));
		cell2.setRowspan(3);
		
		table.addCell(cell);
		table.addCell(cell1);
		table.addCell(cell2);
		
		table.addCell(new PdfPCell(new Phrase(" Bloques", 
				new Font(informeFontNormal.getBaseFont(), 10F))));
		table.addCell(new PdfPCell(new Phrase(" " + bloques, 
				new Font(informeFontNormal.getBaseFont(), 10F))));
		table.addCell(new PdfPCell(new Phrase(" Laminas", 
				new Font(informeFontNormal.getBaseFont(), 10F))));
		table.addCell(new PdfPCell(new Phrase(" " + laminas, 
				new Font(informeFontNormal.getBaseFont(), 10F))));
		
		Paragraph p = new Paragraph();
		p.setIndentationLeft(40F);
		p.add(chunkEnter);
		p.add(table);
		document.add(p);
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
		int cantidadFirmates = 1;
		
		int factor = (int) (document.getPageSize().getWidth() / 2) / cantidadFirmates;
		
		ColumnText.showTextAligned(writer.getDirectContent(),
                Element.ALIGN_CENTER, 
                new Phrase("Recibi conforme", 
                		new Font(FuenteInformeUtil.getInformeFontNormal().getBaseFont(), 10)),
                factor, 
                480,
                0);
		ColumnText.showTextAligned(writer.getDirectContent(),
                Element.ALIGN_CENTER, 
                new Phrase(biopsia.getCliente().getNombres() + " " + biopsia.getCliente().getApellidos(), 
                		new Font(FuenteInformeUtil.getInformeFontNormal().getBaseFont(), 10)),
                factor, 
                440,
                0);
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
