package com.fjr.code.pdf;

import java.awt.Desktop;
import java.io.File;
import java.io.FileOutputStream;
import java.io.IOException;
import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.List;
import java.util.Map;
import java.util.SortedMap;

import org.apache.log4j.Logger;

import com.fjr.code.dao.BiopsiaInfoDAO;
import com.fjr.code.dao.BiopsiaMicroLaminasDAO;
import com.fjr.code.dto.BiopsiaInfoDTO;
import com.fjr.code.dto.BiopsiaMicroLaminasDTO;
import com.fjr.code.dto.ReactivoDTO;
import com.fjr.code.gui.tables.JTableDiagnosticoWizard;
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
import com.itextpdf.text.pdf.ColumnText;
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
public class BiopsiaDiagnostico implements PDFPageChecker {
	private static final Logger log = Logger.getLogger(BiopsiaDiagnostico.class);
	private static final Chunk chunkEnter = new Chunk("\n");
	private static final Chunk tab1 = new Chunk("        ");
	
	private BiopsiaInfoDTO biopsia;
	private int idBiopsia;
	private boolean fixNumberPage = false;
	private String fileName;
	private String filePath;
	private String firmante1;
	private String firmante2;
	private SortedMap<Integer, List<String>> mapMacro;
	private SortedMap<Integer, List<String>> mapIHQ;
	private SortedMap<Integer, List<String>> mapDiagnostico;
	
	Font informeFontNormal = FuenteInformeUtil.getInformeFontNormal();
	Font informeFontBold = FuenteInformeUtil.getInformeFontBold();
	
	/**
	 * 
	 * @param biopsia
	 * @param firmante1
	 * @param firmante2
	 * @param mapPerOperatoria
	 * @param mapMacro
	 * @param mapIHQ
	 * @param mapDiagnostico
	 */
	public BiopsiaDiagnostico(BiopsiaInfoDTO biopsia,
			String firmante1, String firmante2, SortedMap<Integer, List<String>> mapMacro, 
			SortedMap<Integer, List<String>> mapIHQ, SortedMap<Integer, List<String>> mapDiagnostico) {
		// TODO Auto-generated constructor stub
		this.biopsia = biopsia;
		this.idBiopsia = biopsia.getId();
		this.firmante1 = firmante1;
		this.firmante2 = firmante2;
		this.fileName = "diagnostico_" + idBiopsia + ".pdf";
		this.filePath = Constants.TMP_PATH + File.separator + fileName; 
		this.mapMacro = mapMacro;
		this.mapIHQ = mapIHQ;
		this.mapDiagnostico = mapDiagnostico;
	}
	
	/**
	 * 
	 */
	public void buildDiagnostico(){
		long t0 = System.currentTimeMillis();
		log.info("+ Iniciando creacion de diagnostico para la biopsia de id=" + idBiopsia);
		
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
	        //agregamos la info de Macro
	        addDetailMacro(document, writer);

	        //verificamos info de IHQ
	        if(biopsia.getMicroscopicaDTO().getEstudioIHQ() != null
					&& ! "".equals(biopsia.getMicroscopicaDTO().getEstudioIHQ().trim())){
	        	addFirmantes(writer, document);
	        	addInfoIHQ(document, writer);
	        }
	        
	        addFotosMicro(document, writer);
	        
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
		
		document.add(p1);
		document.add(p2);
		
		addMapMacro(document, writer);
	}
	
	/**
	 * 
	 * @param document
	 * @param writer
	 * @throws DocumentException
	 */
	private void addInfoIHQ(Document document, PdfWriter writer) throws DocumentException{
		//verificamos si se debe agregar informacion de IHQ
		if(biopsia.getMicroscopicaDTO().getEstudioIHQ() != null
				&& ! "".equals(biopsia.getMicroscopicaDTO().getEstudioIHQ().trim())){
			fixNumberPage = true;
			document.newPage();
			fixNumberPage = false;
			
			document.add(addDetailBiopsiaTable());
			
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
			
			document.add(p1);
			
			//podemos registrar info IHQ
			title1 = new Chunk("ESTUDIO INMUNOHISTOQUIMICO:", 
					new Font(informeFontBold.getBaseFont(), 12F, Font.UNDERLINE));
			
			value1 = new Phrase(" " + biopsia.getMicroscopicaDTO().getEstudioIHQ(), 
					new Font(informeFontNormal.getBaseFont(), 12F));
			
			p1 = new Paragraph();
			p1.setAlignment(Element.ALIGN_JUSTIFIED);
			p1.setIndentationLeft(50);
			p1.add(chunkEnter);
			p1.add(chunkEnter);
			p1.add(title1);
			p1.add(value1);
			
			document.add(p1);
			
			//obtenemos las laminas de IHQ para mostrar los resultados de los reactivos
			biopsia = BiopsiaMicroLaminasDAO.setMicroLaminas(biopsia, true);
			if(biopsia.getMicroscopicaDTO().getLaminasDTO() != null){
				Chunk title2 = new Chunk("RESULTADO:", 
						new Font(informeFontBold.getBaseFont(), 12F, Font.UNDERLINE));
				
				Paragraph p2 = new Paragraph();
				p2.setIndentationLeft(50);
				p2.add(chunkEnter);
				p2.add(chunkEnter);
				p2.add(title2);
				document.add(p2);
				
				for (BiopsiaMicroLaminasDTO lamina : biopsia.getMicroscopicaDTO().getLaminasDTO()) {
					if(lamina.getReactivosDTO() != null
							&& lamina.getReactivosDTO().size() > 0){
						for (ReactivoDTO reactivo : lamina.getReactivosDTO()) {
							Paragraph p = new Paragraph();
							p.setIndentationLeft(100);
							p.setAlignment(Element.ALIGN_JUSTIFIED);
							p.setSpacingBefore(0);
							//p.add(chunkEnter);
							p.add(new Chunk(reactivo.getNombre() + " (" + reactivo.getAbreviatura() + "): ", 
									new Font(informeFontBold.getBaseFont(), 12F)));
							p.add(new Chunk(reactivo.getDescripcionIHQ(), 
									new Font(informeFontNormal.getBaseFont(), 12F)));
							
							document.add(p);
						}
					}
				}
			}
			
			addMapToDocument(mapIHQ, document, writer);
		}
	}
	
	/**
	 * 
	 * @param document
	 * @param writer
	 * @throws DocumentException
	 */
	private void addFotosMicro(Document document, PdfWriter writer) throws DocumentException{
		if(mapDiagnostico != null
				&& mapDiagnostico.size() > 0){
			addMapToDocument(mapDiagnostico, document, writer);
		}
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
				new Font(informeFontNormal.getBaseFont(), 12F));
		
		Paragraph p1 = new Paragraph();
		p1.setIndentationLeft(50);
		p1.add(chunkEnter);
		p1.add(chunkEnter);
		p1.add(title1);
		p1.add(chunkEnter);
		
		Paragraph p2 = new Paragraph();
		p2.setIndentationLeft(100);
		p2.setAlignment(Element.ALIGN_JUSTIFIED);
		p2.add(chunkEnter);
		p2.add(value1);
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
		int espacioFaltante = (int) (writer.getVerticalPosition(true) - document.bottom());
		
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
                120,
                0);
		if(cantidadFirmates == 2){
			ColumnText.showTextAligned(writer.getDirectContent(),
	                Element.ALIGN_CENTER, 
	                new Phrase(firmante2, new Font(FuenteInformeUtil.getInformeFontNormal().getBaseFont(), 12)),
	                factor * 3, 
	                120,
	                0);
		}
		/*
		PdfPTable table = null;
		if(cantidadFirmates == 1){
			table = new PdfPTable(new float[]{100});
		} else {
			table = new PdfPTable(new float[]{50, 50});
		}
		table.setWidthPercentage(100);
		
		//PdfPCell cellSpace = new PdfPCell(new Phrase("\n\n\n_______________________", 
			//	informeFontNormal));
		
		PdfPCell cellSpace = new PdfPCell(new Phrase("\n\n\n\n\n\n\n\n"));
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
		*/
	}
	
	/**
	 * 
	 * @param document
	 * @throws DocumentException
	 */
	private void addMapMacro(Document document, PdfWriter writer) throws DocumentException{
		//procesamos las posibles fotos del mapa indicado
		int numeroFoto = 1;
				
		for (Integer linea : mapMacro.keySet()) {
			List<String> mapLinea = mapMacro.get(linea);
			
			boolean esPerOperatoria = mapLinea.get(0).startsWith(JTableDiagnosticoWizard.SECCION_PER_OPERATORIA);
			String element0 = mapLinea.get(0);
			if(esPerOperatoria){
				element0 = mapLinea.get(0).substring(JTableDiagnosticoWizard.SECCION_PER_OPERATORIA.length());
			}
			
			if(mapLinea.size() == 1 && (! new File(element0).exists())){
				//es solo la descripcion
				if(esPerOperatoria){
					Chunk titlePerOperatorio = new Chunk("BIOPSIA PER-OPERATORIA: ", 
							new Font(informeFontBold.getBaseFont(), 12F, Font.UNDERLINE));
					Phrase valuePerOperatorio = new Phrase(element0, 
							new Font(informeFontNormal.getBaseFont(), 12F));
					Paragraph p3 = new Paragraph();
					p3.setAlignment(Paragraph.ALIGN_JUSTIFIED);
					p3.setIndentationLeft(50);
					p3.add(chunkEnter);
					p3.add(titlePerOperatorio);
					p3.add(valuePerOperatorio);
					p3.add(chunkEnter);
					document.add(p3);	
				} else {
					Phrase phraseFoto = new Phrase(numeroFoto + ".- " + element0,
							new Font(informeFontNormal.getBaseFont(), 12F));
					
					Paragraph parrafoFoto = new Paragraph();
					parrafoFoto.setAlignment(Paragraph.ALIGN_JUSTIFIED);
					parrafoFoto.setIndentationLeft(50);
					parrafoFoto.add(chunkEnter);
					parrafoFoto.add(tab1);
					parrafoFoto.add(phraseFoto);
					parrafoFoto.add(chunkEnter);
					
					document.add(parrafoFoto);
					numeroFoto++;
				}
			} else {
				//es una seccion con fotos
				//vemos si tiene descripcion y cuantas fotos
				boolean haveDesc = false;
				int numFotos = 0;
						
				for (String stringValue : mapLinea) {
					if(esPerOperatoria || stringValue.startsWith(JTableDiagnosticoWizard.SECCION_PER_OPERATORIA)){
						stringValue = stringValue.substring(JTableDiagnosticoWizard.SECCION_PER_OPERATORIA.length());
					}
					
					if(new File(stringValue).exists()){
						numFotos++;
					} else {
						haveDesc = true;
					}
				}
						
				if(haveDesc){
					if(esPerOperatoria){
						Chunk titlePerOperatorio = new Chunk("BIOPSIA PER-OPERATORIA: ", 
								new Font(informeFontBold.getBaseFont(), 12F, Font.UNDERLINE));
						Phrase valuePerOperatorio = new Phrase(element0, 
								new Font(informeFontNormal.getBaseFont(), 12F));
						Paragraph p3 = new Paragraph();
						p3.setAlignment(Paragraph.ALIGN_JUSTIFIED);
						p3.setIndentationLeft(50);
						p3.add(chunkEnter);
						p3.add(chunkEnter);
						p3.add(titlePerOperatorio);
						p3.add(valuePerOperatorio);
						p3.add(chunkEnter);
						p3.add(chunkEnter);
						
						document.add(p3);	
					} else {
						Phrase phraseFoto = new Phrase(numeroFoto + ".- " + element0,
								new Font(informeFontNormal.getBaseFont(), 12F));
						
						Paragraph parrafoFoto = new Paragraph();
						parrafoFoto.setAlignment(Paragraph.ALIGN_JUSTIFIED);
						parrafoFoto.setIndentationLeft(50);
						
						parrafoFoto.add(chunkEnter);
						parrafoFoto.add(chunkEnter);
						parrafoFoto.add(tab1);
						parrafoFoto.add(phraseFoto);
						parrafoFoto.add(chunkEnter);
						parrafoFoto.add(chunkEnter);
						
						document.add(parrafoFoto);
						numeroFoto++;
					}
				}
						
				float[] measures = null;
				float value = 60;
				if(numFotos == 1){
					measures = new float[]{value * 3};
				} else if(numFotos == 2){
					measures = new float[]{value, value};
				} else if(numFotos == 3){
					measures = new float[]{value, value, value};
				}
				
				if(measures != null){
					PdfPTable table = new PdfPTable(measures);
					table.setWidthPercentage(100);
					table.setHorizontalAlignment(Element.ALIGN_CENTER);
					
					for (String stringValue : mapLinea) {
						if(esPerOperatoria || stringValue.startsWith(JTableDiagnosticoWizard.SECCION_PER_OPERATORIA)){
							stringValue = stringValue.substring(JTableDiagnosticoWizard.SECCION_PER_OPERATORIA.length());
						}
						
						if(new File(stringValue).exists()){
							try {
								Image imgFJR = Image.getInstance(stringValue);
								imgFJR.scaleAbsolute(110 + (90 / numFotos), 70 + (90 / numFotos));
								imgFJR.setScaleToFitLineWhenOverflow(false);
								//imgFJR.setIndentationLeft(50);
								
								PdfPCell cell = new PdfPCell(imgFJR);
								if(numFotos == 1){
									cell.setHorizontalAlignment(Element.ALIGN_CENTER);
								} else {
									cell.setHorizontalAlignment(Element.ALIGN_LEFT);
								}
								cell.setBorder(0);
								cell.setNoWrap(true);
								cell.setFixedHeight(70 + (90 / numFotos));
								cell.setIndent(50);
								table.addCell(cell);
								
								//verificamos si agregar esta celda, genera un overflow de contenido
								if (writer.getVerticalPosition(true) - cell.getFixedHeight() < document.bottom()) {
									document.newPage();
					            }
							} catch (Throwable e) {
								// TODO Auto-generated catch block
								log.error(e.getMessage(), e);
							} 
						}
					}
					
					document.add(table);
				}
			}
		}
	}
	
	/**
	 * 
	 * @param mapToProcess
	 * @param document
	 * @throws DocumentException 
	 */
	private void addMapToDocument(Map<Integer, List<String>> mapToProcess,
			Document document, PdfWriter writer) throws DocumentException{
		//procesamos las posibles fotos del mapa indicado
		int numeroFoto = 1;
		Chunk tab1 = new Chunk("        ");
		Chunk enter = new Chunk("\n");
		
		for (Integer linea : mapToProcess.keySet()) {
			List<String> mapLinea = mapToProcess.get(linea);
			
			if(mapLinea.size() == 1 && (! new File(mapLinea.get(0)).exists())){
				//es solo la descripcion
				Phrase phraseFoto = new Phrase(numeroFoto + ".- " + mapLinea.get(0),
						new Font(informeFontNormal.getBaseFont(), 12F));
				
				Paragraph parrafoFoto = new Paragraph();
				parrafoFoto.setAlignment(Paragraph.ALIGN_JUSTIFIED);
				parrafoFoto.setIndentationLeft(50);
				parrafoFoto.add(enter);
				parrafoFoto.add(tab1);
				parrafoFoto.add(phraseFoto);
				parrafoFoto.add(enter);
				
				document.add(parrafoFoto);
				numeroFoto++;
			} else {
				//es una seccion con fotos
				//vemos si tiene descripcion y cuantas fotos
				boolean haveDesc = false;
				int numFotos = 0;
				
				for (String stringValue : mapLinea) {
					if(new File(stringValue).exists()){
						numFotos++;
					} else {
						haveDesc = true;
					}
				}
				
				if(haveDesc){
					Paragraph parrafoFoto = new Paragraph();
					parrafoFoto.setAlignment(Paragraph.ALIGN_JUSTIFIED);
					parrafoFoto.setIndentationLeft(50);
					//parrafoFoto.setFirstLineIndent(150);
					
					Phrase phraseFoto = new Phrase(numeroFoto + ".- " + mapLinea.get(0),
							new Font(informeFontNormal.getBaseFont(), 12F));
					parrafoFoto.add(enter);
					parrafoFoto.add(enter);
					parrafoFoto.add(tab1);
					parrafoFoto.add(phraseFoto);
					parrafoFoto.add(enter);
					parrafoFoto.add(enter);
					
					document.add(parrafoFoto);
					numeroFoto++;
				}
				
				float[] measures = null;
				float value = 60;
				if(numFotos == 1){
					measures = new float[]{value * 3};
				} else if(numFotos == 2){
					measures = new float[]{value, value};
				} else if(numFotos == 3){
					measures = new float[]{value, value, value};
				}
				
				PdfPTable table = new PdfPTable(measures);
				table.setWidthPercentage(100);
				table.setHorizontalAlignment(Element.ALIGN_CENTER);
				
				for (String stringValue : mapLinea) {
					if(new File(stringValue).exists()){
						try {
							Image imgFJR = Image.getInstance(stringValue);
							imgFJR.scaleAbsolute(110 + (90 / numFotos), 70 + (90 / numFotos));
							//imgFJR.setIndentationLeft(50);
							
							PdfPCell cell = new PdfPCell(imgFJR);
							if(numFotos == 1){
								cell.setHorizontalAlignment(Element.ALIGN_CENTER);
							} else {
								cell.setHorizontalAlignment(Element.ALIGN_LEFT);
							}
							cell.setNoWrap(true);
							cell.setBorder(0);
							cell.setFixedHeight(70 + (90 / numFotos));
							cell.setIndent(50);
							table.addCell(cell);
							
							if (writer.getVerticalPosition(true) - cell.getFixedHeight() < document.bottom()) {
								document.newPage();
				            }
						} catch (Throwable e) {
							// TODO Auto-generated catch block
							log.error(e.getMessage(), e);
						} 
					}
				}
				
				document.add(table);
			}
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
