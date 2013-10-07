package com.fjr.code.barcode;

import java.awt.print.PageFormat;
import java.awt.print.Paper;
import java.io.File;
import java.io.FileOutputStream;
import java.io.IOException;

import org.apache.log4j.Logger;

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
 * Clase para generar la etiqueta en la etapa de la fase macroscopica.
 * 
 * Class: BarCodeIngreso <br />
 * DateCreated: 22/08/2013 <br />
 * @author T&T <br />
 *
 */
public final class BarCodeMacroscopica extends BarCodePrint{
	private static final PageFormat PAGE_FORMAT = new PageFormat();
	private static final Logger log = Logger.getLogger(BarCodeMacroscopica.class);
	
	/**
	 * Largo de la etiqueta a generar en la etapa de macro.
	 * Valor es aproximado a mm_reales * 2.8 (28 * 2,8)
	 */
	private static final int largoMMTransformados = 78;
	
	/**
	 * Ancho de la etiqueta a generar en la etapa de macro.
	 * Valor es aproximado a mm_reales * 2.8 (20 * 2,8)
	 */
	private static final int anchoMMTransformados = 56;
	
	private String nroBiopsia;
	private int nroCassetes;
	private String labelFileName;
	
	static {
		Paper p = new Paper();
		p.setSize(((largoMMTransformados / 2.8) / 25.4)*72, ((anchoMMTransformados / 2.8) / 25.4) *72);
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
	 * @param nroCassetes
	 */
	public BarCodeMacroscopica(String nroBiopsia, int nroCassetes) {
		// TODO Auto-generated constructor stub
		super(log, PAGE_FORMAT);
		this.nroBiopsia = nroBiopsia;
		this.nroCassetes = nroCassetes;
		this.labelFileName = "macroscopica_" + nroBiopsia + ".pdf";
	}
	
	/**
     * Creates a PDF document.
     * 
     * @throws    DocumentException 
     * @throws    IOException
     */
    public void crearEtiquetaMacroscopica() throws IOException, DocumentException {
    	log.info("Iniciando creacion de etiqueta para la peticion de macroscopica: "
    			+ this);
    	
    	final String fileOut = Constants.LABELS_PATH + File.separator + labelFileName;
    	
    	// step 1
        Document document = new Document(
    			new Rectangle(largoMMTransformados, anchoMMTransformados), 
    			1, 
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
        
    	for (int i = 0; i < nroCassetes; i++) {
    		document.newPage();
    		
    	    Barcode128 barCode = new Barcode128();
            barCode.setCode(nroBiopsia);
            barCode.setBarHeight(40);
            barCode.setAltText("");
            barCode.setBaseline(0.8F);
            //barCode.setSize(0.1F);
            //barCode.setAltText(nroBiopsia + " " + (i+1) + "/" + nroCassetes);
            
            Image imgFJR = barCode.createImageWithBarcode(cb, null, null);
            imgFJR.scaleToFit(new Rectangle(60, 35));
            log.info("Creado codigo de barras con el valor " + nroBiopsia);
            
            String chunkText = nroBiopsia + " \n\nC" + (i+1) + "/" + nroCassetes;
            Paragraph p = new Paragraph(Paragraph.ALIGN_TOP, 
            		chunkText,
            		new Font(FontFamily.COURIER, 8F, Font.BOLD));
            
            document.add(imgFJR);
            document.add(p);
            
            log.info("Creada etiqueta macro " + (i+1) + " de " + nroBiopsia);
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
				+ ", nroCassetes=" + nroCassetes + ", labelFileName="
				+ labelFileName + "]";
	}

	public static void main(String[] args) throws IOException, DocumentException {
		new BarCodeMacroscopica("13-63892", 10).crearEtiquetaMacroscopica();
		System.out.println("Finish...");
	}
}
