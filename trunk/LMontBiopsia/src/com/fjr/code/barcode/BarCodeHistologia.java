package com.fjr.code.barcode;

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
 * Clase para generar la etiqueta en la etapa de histologia.
 * 
 * Class: BarCodeHistologia <br />
 * DateCreated: 22/08/2013 <br />
 * @author T&T <br />
 *
 */
public final class BarCodeHistologia {
	private static final Logger log = Logger.getLogger(BarCodeHistologia.class);
	
	/**
	 * Largo de la etiqueta a generar en la etapa de ingreso.
	 * Valor es aproximado a mm_reales * 2.8 (57 * 2,8)
	 */
	private static final int largoMMTransformados = 70;
	
	/**
	 * Ancho de la etiqueta a generar en la etapa de ingreso.
	 * Valor es aproximado a mm_reales * 2.8 (44 * 2,8)
	 */
	private static final int anchoMMTransformados = 50;
	
	private String nroBiopsia;
	private int nroCassete;
	private int nroBloques;
	private int nroLaminas;
	private String labelBaseFileName;
	
	/**
	 * 
	 * @param nroBiopsia
	 * @param nroCassete
	 * @param nroBloques
	 * @param nroLaminas
	 */
	public BarCodeHistologia(String nroBiopsia, int nroCassete,
			int nroBloques, int nroLaminas) {
		// TODO Auto-generated constructor stub
		this.nroBiopsia = nroBiopsia;
		this.nroCassete = nroCassete;
		this.nroBloques = nroBloques;
		this.nroLaminas = nroLaminas;
		this.labelBaseFileName = "histologia_" + nroBiopsia + "_";
	}
	
	/**
     * Creates a PDF document.
     * 
     * @throws    DocumentException 
     * @throws    IOException
     */
    public void crearEtiquetaHistologia() throws IOException, DocumentException {
    	log.info("Iniciando creacion de etiqueta para la peticion de macroscopica: "
    			+ this);
    	new File(Constants.LABELS_PATH).mkdirs();
    	
    	for (int i = 0; i < nroBloques; i++) {
    		for (int j = 0; j < nroLaminas; j++) {
    			String fileOut = Constants.LABELS_PATH + File.separator + labelBaseFileName 
    					+ nroCassete + "_B"+ (i + 1) + " L" + (j + 1) + ".pdf";
        		
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
                barCode.setBarHeight(45);
                barCode.setAltText("");
                barCode.setBaseline(0.8F);
                //barCode.setSize(20);
                //barCode.setAltText(nroBiopsia + " " + (i+1) + "/" + nroCassetes);
                
                Image imgFJR = barCode.createImageWithBarcode(cb, null, null);
                imgFJR.scaleToFit(new Rectangle(60, 35));
                log.info("Creado codigo de barras con el valor " + nroBiopsia);
                
                String chunkText = nroBiopsia;
                chunkText += "\n\nC" + nroCassete + " B" + (i+1) + " L" + (j+1) + "/" + nroLaminas;
                Paragraph p = new Paragraph(Paragraph.ALIGN_MIDDLE, 
                		chunkText,
                		new Font(FontFamily.COURIER, 8F));
                
                document.add(imgFJR);
                document.add(p);
                
                //step 5
                document.close();
                log.info("Creada etiqueta " + (i+1) + " de " + nroBiopsia);
    		}
    	}
    		
    	
    	log.info("Finalizada creacion de etiqueta para la peticion de ingreso: "
    			+ this);
    }

	@Override
	public String toString() {
		return "BarCodeMacroscopica [nroBiopsia=" + nroBiopsia
				+ ", nroCassete=" + nroCassete + ", labelBaseFileName="
				+ labelBaseFileName + "]";
	}

	public static void main(String[] args) throws IOException, DocumentException {
		new BarCodeHistologia("13-63892", 1, 3, 5).crearEtiquetaHistologia();
		System.out.println("Finish...");
	}
}
