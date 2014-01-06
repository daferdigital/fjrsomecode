package com.fjr.code.pdf;

import java.io.IOException;
import java.net.MalformedURLException;

import com.fjr.code.util.Constants;
import com.itextpdf.text.BadElementException;
import com.itextpdf.text.Chunk;
import com.itextpdf.text.Document;
import com.itextpdf.text.DocumentException;
import com.itextpdf.text.Element;
import com.itextpdf.text.Font;
import com.itextpdf.text.Image;
import com.itextpdf.text.Paragraph;
import com.itextpdf.text.Phrase;
import com.itextpdf.text.pdf.ColumnText;
import com.itextpdf.text.pdf.PdfPageEventHelper;
import com.itextpdf.text.pdf.PdfWriter;

/**
 * Inner class to add a header and a footer.
 *  
 * Class: HeaderFooter
 * Creation Date: 03/11/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
class HeaderFooter extends PdfPageEventHelper {
	private static final Chunk chunkEnter = new Chunk("\n");
	private PDFPageChecker pageChecker;
	private String nroBiopsia;
	private int fixedNum = 0;
	private int startYFooter = 40;
	
	/**
	 * 
	 * @param nroBiopsia
	 * @param pageChecker
	 */
	public HeaderFooter(String nroBiopsia, PDFPageChecker pageChecker) {
		// TODO Auto-generated constructor stub
		this.nroBiopsia = nroBiopsia;
		this.pageChecker = pageChecker;
		this.startYFooter = 40;
	}
	
	/**
	 * 
	 * @param nroBiopsia
	 * @param pageChecker
	 * @param startYFooter
	 */
	public HeaderFooter(String nroBiopsia, PDFPageChecker pageChecker, int startYFooter) {
		// TODO Auto-generated constructor stub
		this.nroBiopsia = nroBiopsia;
		this.pageChecker = pageChecker;
		this.startYFooter = startYFooter;
	}
	
	@Override
	public void onStartPage(PdfWriter writer, Document document) {
		// TODO Auto-generated method stub
		System.out.println("document.getPageNumber()/fixedNum = " + document.getPageNumber() + "/" + fixedNum);
		
		if(pageChecker.mustFixNumberPage() ){
			fixedNum = document.getPageNumber() -1;
		}
		
		if(document.getPageNumber() - fixedNum > 1){
			Paragraph p1 = new Paragraph();
			p1.setIndentationLeft(50);
			p1.add(chunkEnter);
			p1.add(chunkEnter);
			
			try {
				document.add(p1);
			} catch (DocumentException e) {
				// TODO Auto-generated catch block
				//e.printStackTrace();
			}
		}
	}
	
	
    public void onEndPage (PdfWriter writer, Document document) {
        try {
			Image imgFJR = Image.getInstance(Constants.IMAGES_PATH + "LogoHeader.jpg");
			imgFJR.disableBorderSide(Image.LEFT);
			imgFJR.setAbsolutePosition(20f, 670f);
			document.add(imgFJR);
		} catch (BadElementException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		} catch (MalformedURLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		} catch (IOException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		} catch (DocumentException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
        
        Phrase p1 = new Phrase("PATOLOGIA  SAN ROMAN  C.A.", 
        		new Font(FuenteInformeUtil.getInformeFontNormal().getBaseFont(), 18));
        Phrase p2 = new Phrase("ANATOMIA PATOLOGICA Y CITOLOGIA", new Font(FuenteInformeUtil.getInformeFontNormal().getBaseFont(), 11));
        Phrase p3 = new Phrase("Dr. Jesús Enrique González Alfonzo", new Font(FuenteInformeUtil.getInformeFontNormal().getBaseFont(), 11));
        Phrase p4 = new Phrase("Dr. José David Mota Gamboa", new Font(FuenteInformeUtil.getInformeFontNormal().getBaseFont(), 11));
        Phrase p5 = new Phrase("Dr. Enrique López Loyo", new Font(FuenteInformeUtil.getInformeFontNormal().getBaseFont(), 11));
        
        ColumnText.showTextAligned(writer.getDirectContent(),
        		Element.ALIGN_CENTER, 
        		p1,
        		document.getPageSize().getWidth() / 2, 
        		document.getPageSize().getHeight() - 50, 
        		0);
        
        ColumnText.showTextAligned(writer.getDirectContent(),
        		Element.ALIGN_CENTER, 
        		p2,
        		document.getPageSize().getWidth() / 2, 
        		document.getPageSize().getHeight() - 63, 
        		0);
        
        ColumnText.showTextAligned(writer.getDirectContent(),
        		Element.ALIGN_CENTER, 
        		p3,
        		document.getPageSize().getWidth() / 2, 
        		document.getPageSize().getHeight() - 74, 
        		0);
        
        ColumnText.showTextAligned(writer.getDirectContent(),
        		Element.ALIGN_CENTER, 
        		p4,
        		document.getPageSize().getWidth() / 2, 
        		document.getPageSize().getHeight() - 85, 
        		0);
        
        ColumnText.showTextAligned(writer.getDirectContent(),
        		Element.ALIGN_CENTER, 
        		p5,
        		document.getPageSize().getWidth() / 2,
        		document.getPageSize().getHeight() - 96, 
        		0);
        
        if(document.getPageNumber() - fixedNum > 1){
			Phrase p = new Phrase("(continuación " + nroBiopsia + ") " + (document.getPageNumber() - fixedNum) + ".- ", 
					new Font(FuenteInformeUtil.getInformeFontNormal().getBaseFont(), 11));
	        
			ColumnText.showTextAligned(writer.getDirectContent(),
	        		Element.ALIGN_LEFT, 
	        		p,
	        		50,
	        		document.getPageSize().getHeight() - 130, 
	        		0);
		}
        
        //footer
        /*
        if(document.getPageNumber() > 1){
        	ColumnText.showTextAligned(writer.getDirectContent(),
                    Element.ALIGN_LEFT, 
                    new Phrase("(continuación " + nroBiopsia + ") " + document.getPageNumber() + ".-", 
                    		new Font(FuenteInformeUtil.getInformeFontNormal().getBaseFont(), 8)),
                    40, 
                    50,
                    0);
        }
        */
        ColumnText.showTextAligned(writer.getDirectContent(),
                Element.ALIGN_CENTER, 
                new Phrase("INSTITUTO DE CLINICAS Y UROLOGIA TAMANACO", 
                		new Font(FuenteInformeUtil.getInformeFontNormal().getBaseFont(), 8)),
                document.getPageSize().getWidth() / 2, 
                startYFooter,
                0);
        ColumnText.showTextAligned(writer.getDirectContent(),
                Element.ALIGN_CENTER, 
                new Phrase("Calle Chivacoa. Sector San Román. Las Mercedes. Telfs. 999 0542 - 999 0543 - 991 8923", 
                		new Font(FuenteInformeUtil.getInformeFontNormal().getBaseFont(), 8)),
                document.getPageSize().getWidth() / 2, 
                startYFooter - 10,
                0);
        ColumnText.showTextAligned(writer.getDirectContent(),
                Element.ALIGN_CENTER, 
                new Phrase("Caracas. RIF: J-31245344-3", 
                		new Font(FuenteInformeUtil.getInformeFontNormal().getBaseFont(), 8)),
                document.getPageSize().getWidth() / 2, 
                startYFooter - 20,
                0);
    }
}
