package com.fjr.code.barcode;

import java.awt.print.PageFormat;
import java.awt.print.Paper;
import java.io.File;
import java.io.FileOutputStream;
import java.io.IOException;
import java.util.List;

import org.apache.log4j.Logger;

import com.fjr.code.dto.BiopsiaCasseteDTO;
import com.fjr.code.util.Constants;
import com.itextpdf.text.Document;
import com.itextpdf.text.DocumentException;
import com.itextpdf.text.Font;
import com.itextpdf.text.Font.FontFamily;
import com.itextpdf.text.Image;
import com.itextpdf.text.Paragraph;
import com.itextpdf.text.Rectangle;
import com.itextpdf.text.pdf.Barcode128;
import com.itextpdf.text.pdf.PdfContentByte;
import com.itextpdf.text.pdf.PdfWriter;

/**
 * Clase para generar la etiqueta en la etapa de histologia.
 * 
 * Class: BarCodeHistologia <br />
 * DateCreated: 22/08/2013 <br />
 * @author T&T <br />
 *
 */
public final class BarCodeHistologia extends BarCodePrint{
	private static final PageFormat PAGE_FORMAT = new PageFormat();
	private static final Logger log = Logger.getLogger(BarCodeHistologia.class);
	
	/**
	 * Largo de la etiqueta a generar en la etapa de histologia.
	 * Valor es aproximado a mm_reales * 2.8 (28 * 2,8)
	 */
	private static final int largoMMTransformados = 78;
	
	/**
	 * Ancho de la etiqueta a generar en la etapa de histologia.
	 * Valor es aproximado a mm_reales * 2.8 (20 * 2,8)
	 */
	private static final int anchoMMTransformados = 56;
	
	private String nroBiopsia;
	private List<BiopsiaCasseteDTO> cassetes;
	private String labelFileName;
	private boolean specificPrint;
	
	static {
		Paper p = new Paper();
		p.setSize(((largoMMTransformados / 2.8) / 2.54 / 10)*72, ((anchoMMTransformados / 2.8) / 2.54 / 10)*72);
		p.setImageableArea(0, 
				0, 
				p.getWidth(), 
				p.getHeight());
		
		PAGE_FORMAT.setPaper(p);
		PAGE_FORMAT.setOrientation(PageFormat.PORTRAIT);
	}
	
	/**
	 * 
	 * @param nroBiopsia
	 * @param abreviaturaTipoEstudio
	 * @param cassetes
	 */
	public BarCodeHistologia(String nroBiopsia, List<BiopsiaCasseteDTO> cassetes,
			boolean specificPrint) {
		// TODO Auto-generated constructor stub
		super(log, PAGE_FORMAT);
		this.nroBiopsia = nroBiopsia;
		this.cassetes = cassetes;
		this.labelFileName = "histologia_" + nroBiopsia + ".pdf";
		this.specificPrint = specificPrint;
	}

	public void crearEtiquetaHistologia() throws IOException, DocumentException {
		if(specificPrint){
			crearEtiquetaHistologiaEspecificas();
		} else{
			crearEtiquetaHistologiaCompleta();
		}
	}
	
	/**
	 * Etiquetas especificas de los nuevos cortes.
	 * 
	 * @throws IOException
	 * @throws DocumentException
	 */
	private void crearEtiquetaHistologiaEspecificas() throws IOException, DocumentException {
		log.info("Iniciando creacion de etiqueta para la peticion de histologia: "
    			+ this);
    	String fileOut = Constants.LABELS_PATH + File.separator + labelFileName;
		
		// step 1
        Document document = new Document(
    			new Rectangle(largoMMTransformados, anchoMMTransformados), 
    			5, 
    			1, 
    			1, 
    			1);
    	
        // step 2
        PdfWriter writer = PdfWriter.getInstance(document, 
        		new FileOutputStream(fileOut));
        
        // step 3
        document.open();
        
        // step 4
        PdfContentByte cb = writer.getDirectContent();
        
        Barcode128 barCode = new Barcode128();
        barCode.setCode(nroBiopsia);
        barCode.setBarHeight(40);
        barCode.setAltText("");
        barCode.setBaseline(0.8F);
        //barCode.setSize(20);
        //barCode.setAltText(nroBiopsia + " " + (i+1) + "/" + nroCassetes);
        
        Image imgFJR = barCode.createImageWithBarcode(cb, null, null);
        imgFJR.scaleToFit(new Rectangle(60, 35));
        log.info("Creado codigo de barras con el valor " + nroBiopsia);
        
        for (int cassete = 0; cassete < cassetes.size(); cassete++) {
        	BiopsiaCasseteDTO casseteDTO = cassetes.get(cassete);
        	
        	String chunkText = nroBiopsia;
        	chunkText += "\n\nC" + casseteDTO.getNumero() + " B" + (casseteDTO.getBloques()) 
        			+ " L" + (casseteDTO.getLaminaEspecifica()) + "/" + casseteDTO.getLaminas();
        	Paragraph p = new Paragraph(Paragraph.ALIGN_TOP, 
        			chunkText,
        			new Font(FontFamily.COURIER, 8F, Font.BOLD));
        	p.setSpacingAfter(0F);
        	document.add(imgFJR);
        	document.add(p);
        	document.newPage();
        }
	    
    	//step 5
        document.close();
        
    	log.info("Finalizada creacion de etiqueta para la peticion de ingreso: "
    			+ this);
	}
	
	/**
     * Creates a PDF document.
     * 
     * @throws    DocumentException 
     * @throws    IOException
     */
    private void crearEtiquetaHistologiaCompleta() throws IOException, DocumentException {
    	log.info("Iniciando creacion de etiqueta para la peticion de histologia: "
    			+ this);
    	String fileOut = Constants.LABELS_PATH + File.separator + labelFileName;
		
		// step 1
        Document document = new Document(
    			new Rectangle(largoMMTransformados, anchoMMTransformados), 
    			5, 
    			1, 
    			1, 
    			1);
    	
        // step 2
        PdfWriter writer = PdfWriter.getInstance(document, 
        		new FileOutputStream(fileOut));
        
        // step 3
        document.open();
        
        // step 4
        PdfContentByte cb = writer.getDirectContent();
        
        Barcode128 barCode = new Barcode128();
        barCode.setCode(nroBiopsia);
        barCode.setBarHeight(40);
        barCode.setAltText("");
        barCode.setBaseline(0.8F);
        //barCode.setSize(20);
        //barCode.setAltText(nroBiopsia + " " + (i+1) + "/" + nroCassetes);
        
        Image imgFJR = barCode.createImageWithBarcode(cb, null, null);
        imgFJR.scaleToFit(new Rectangle(60, 35));
        log.info("Creado codigo de barras con el valor " + nroBiopsia);
        
        for (int cassete = 0; cassete < cassetes.size(); cassete++) {
        	BiopsiaCasseteDTO casseteDTO = cassetes.get(cassete);
        	
        	for (int bloque = 0; bloque < casseteDTO.getBloques(); bloque++) {
        		for (int lamina = 0; lamina < casseteDTO.getLaminas(); lamina++) {
        	        String chunkText = nroBiopsia;
                    chunkText += "\n\nC" + casseteDTO.getNumero() + " B" + (bloque+1) 
                    		+ " L" + (lamina+1) + "/" + casseteDTO.getLaminas();
                    Paragraph p = new Paragraph(Paragraph.ALIGN_TOP, 
                    		chunkText,
                    		new Font(FontFamily.COURIER, 8F, Font.BOLD));
                    p.setSpacingAfter(0F);
                    document.add(imgFJR);
                    document.add(p);
                    document.newPage();
        		}
        	}	
		}
        
    	//step 5
        document.close();
        
    	
    	log.info("Finalizada creacion de etiqueta para la peticion de ingreso: "
    			+ this);
    }
    
    /**
     * 
     */
    public void printLabelFile() {
    	// TODO Auto-generated method stub
    	super.printLabelFile(new File(Constants.LABELS_PATH + File.separator + this.labelFileName));
    }
    
	@Override
	public String toString() {
		return "BarCodeMacroscopica [nroBiopsia=" + nroBiopsia
				+ ", labelFileName=" + labelFileName + "]";
	}

	public static void main(String[] args) throws IOException, DocumentException {
		//new BarCodeHistologia("13-63892", 1, 3, 5).crearEtiquetaHistologia();
		System.out.println("Finish...");
	}
}
