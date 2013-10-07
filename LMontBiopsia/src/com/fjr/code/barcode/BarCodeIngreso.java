package com.fjr.code.barcode;

import java.awt.print.PageFormat;
import java.awt.print.Paper;
import java.io.File;
import java.io.FileOutputStream;
import java.io.IOException;

import org.apache.log4j.Logger;

import com.fjr.code.util.Constants;
import com.itextpdf.text.Chunk;
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
 * Clase para generar la etiqueta en la etapa de ingreso.
 * 
 * Class: BarCodeIngreso <br />
 * DateCreated: 22/08/2013 <br />
 * @author T&T <br />
 *
 */
public final class BarCodeIngreso extends BarCodePrint {
	private static final PageFormat PAGE_FORMAT = new PageFormat();
	
	private static final Logger log = Logger.getLogger(BarCodeIngreso.class);
	
	/**
	 * Largo de la etiqueta a generar en la etapa de ingreso.
	 * Valor es aproximado a mm_reales * 2.8 (57 * 2,8)
	 */
	private static final int largoMMTransformados = 159;
	
	/**
	 * Ancho de la etiqueta a generar en la etapa de ingreso.
	 * Valor es aproximado a mm_reales * 2.8 (44 * 2,8)
	 */
	private static final int anchoMMTransformados = 123;
	
	private String nroBiopsia;
	private String nombrePaciente;
	private String cedula;
	private String labelFileName;
	private String labelFilePath;
	
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
	 * @param nombrePaciente
	 * @param cedula
	 */
	public BarCodeIngreso(String nroBiopsia, String nombrePaciente,
			String cedula) {
		// TODO Auto-generated constructor stub
		super(log, PAGE_FORMAT);
		this.nroBiopsia = nroBiopsia;
		this.nombrePaciente = nombrePaciente;
		this.cedula = cedula;
		this.labelFileName = "ingreso_" + nroBiopsia + ".pdf";
		this.labelFilePath = Constants.LABELS_PATH + File.separator + labelFileName;
	}
	
	/**
     * Creates a PDF document.
     * 
     * @throws    DocumentException 
     * @throws    IOException
     */
    public void crearEtiquetaIngreso() throws IOException, DocumentException {
    	log.info("Iniciando creacion de etiqueta para la peticion de ingreso: "
    			+ this);
    	new File(Constants.LABELS_PATH).mkdirs();
    	
    	// step 1
        Document document = new Document(
    			new Rectangle(largoMMTransformados, anchoMMTransformados), 
    			10, 
    			10, 
    			10, 
    			10);
    	
        // step 2
        PdfWriter writer = PdfWriter.getInstance(document, 
        		new FileOutputStream(labelFilePath));
        
        // step 3
        document.open();
        
        // step 4
        PdfContentByte cb = writer.getDirectContent();
        
        Barcode128 barCode = new Barcode128();
        barCode.setCode(nroBiopsia);
        
        Image imgFJR = barCode.createImageWithBarcode(cb, null, null);
        imgFJR.setRotationDegrees(90F);
        
        log.info("Creado codigo de barras con el valor " + nroBiopsia);
        
        Paragraph p = new Paragraph();
        String chunkText = "Nro: " + nroBiopsia;
        String chunkText1 = "\nPaciente: \n" + nombrePaciente;
        chunkText1 += "\nC.I: " + cedula;
        
        p.add(new Chunk(chunkText, new Font(FontFamily.COURIER, 10F, Font.BOLD)));
        p.add(new Chunk(chunkText1, new Font(FontFamily.COURIER, 8F, Font.BOLD)));
        p.add(new Chunk(imgFJR, 35F, -15F));
        document.add(p);
        
        //step 5
        document.close();
        
        log.info("Finalizada creacion de etiqueta para la peticion de ingreso: "
    			+ this);
    }

    public void printLabelFile() {
    	// TODO Auto-generated method stub
    	super.printLabelFile(new File(this.labelFilePath));
    }
    
	@Override
	public String toString() {
		return "BarCodeIngreso [nroBiopsia=" + nroBiopsia + ", nombrePaciente="
				+ nombrePaciente + ", cedula=" + cedula + ", labelFileName="
				+ labelFileName + "]";
	}
	
	public static void main(String[] args) throws IOException, DocumentException {
		BarCodeIngreso ingreso = new BarCodeIngreso("13-3467", 
				"Josefina Carolina\nGonzalez Aristigueta", 
				"7.958.543");
		
		ingreso.crearEtiquetaIngreso();
		//ingreso.printLabelFile();
	}
}
