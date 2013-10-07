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

/** Inner class to add a header and a footer. */
class HeaderFooter extends PdfPageEventHelper {
	private String nroBiopsia;
	
	public HeaderFooter(String nroBiopsia) {
		// TODO Auto-generated constructor stub
		this.nroBiopsia = nroBiopsia;
	}
	
	@Override
	public void onStartPage(PdfWriter writer, Document document) {
		// TODO Auto-generated method stub
		if(document.getPageNumber() > 1){
			Paragraph p = new Paragraph();
			p.setIndentationLeft(50);
			p.add(new Chunk("(continuación " + nroBiopsia + ") " + document.getPageNumber() + ".- ", FuenteInformeUtil.getInformeFontNormal()));
			try {
				document.add(p);
			} catch (DocumentException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
		}
	}
	
    public void onEndPage (PdfWriter writer, Document document) {
        try {
			Image imgFJR = Image.getInstance(Constants.IMAGES_PATH + "pdfHeader1.jpg");
			imgFJR.setAbsolutePosition(20f, 775f);
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
        
        Phrase p1 = new Phrase("PATOLOGIA SAN ROMAN C.A.", 
        		new Font(FuenteInformeUtil.getInformeFontNormal().getBaseFont(), 16));
        Phrase p2 = new Phrase("ANATOMIA PATOLOGICA Y CITOLOGIA", new Font(FuenteInformeUtil.getInformeFontNormal().getBaseFont(), 10));
        Phrase p3 = new Phrase("Dr. Jesús Enrique González Alfonzo", new Font(FuenteInformeUtil.getInformeFontNormal().getBaseFont(), 10));
        Phrase p4 = new Phrase("Dr. José David Mota Gamboa", new Font(FuenteInformeUtil.getInformeFontNormal().getBaseFont(), 10));
        Phrase p5 = new Phrase("Dr. Enrique López Loyo", new Font(FuenteInformeUtil.getInformeFontNormal().getBaseFont(), 10));
        
        ColumnText.showTextAligned(writer.getDirectContent(),
        		Element.ALIGN_CENTER, 
        		p1,
        		(document.getPageSize().getWidth() - document.leftMargin() + document.rightMargin()) / 2, 
        		document.getPageSize().getHeight() - 20, 
        		0);
        
        ColumnText.showTextAligned(writer.getDirectContent(),
        		Element.ALIGN_CENTER, 
        		p2,
        		(document.getPageSize().getWidth() - document.leftMargin() + document.rightMargin()) / 2, 
        		document.getPageSize().getHeight() - 30, 
        		0);
        
        ColumnText.showTextAligned(writer.getDirectContent(),
        		Element.ALIGN_CENTER, 
        		p3,
        		(document.getPageSize().getWidth() - document.leftMargin() + document.rightMargin()) / 2, 
        		document.getPageSize().getHeight() - 40, 
        		0);
        
        ColumnText.showTextAligned(writer.getDirectContent(),
        		Element.ALIGN_CENTER, 
        		p4,
        		(document.getPageSize().getWidth() - document.leftMargin() + document.rightMargin()) / 2, 
        		document.getPageSize().getHeight() - 50, 
        		0);
        
        ColumnText.showTextAligned(writer.getDirectContent(),
        		Element.ALIGN_CENTER, 
        		p5,
        		(document.getPageSize().getWidth() - document.leftMargin() + document.rightMargin()) / 2, 
        		document.getPageSize().getHeight() - 60, 
        		0);
        
        //footer
        ColumnText.showTextAligned(writer.getDirectContent(),
                Element.ALIGN_CENTER, 
                new Phrase("INSTITUTO DE CLINICAS Y UROLOGIA TAMANACO", 
                		new Font(FuenteInformeUtil.getInformeFontNormal().getBaseFont(), 8)),
                document.getPageSize().getWidth() / 2, 
                40,
                0);
        ColumnText.showTextAligned(writer.getDirectContent(),
                Element.ALIGN_CENTER, 
                new Phrase("Calle Chivacoa. Sector San romás. Las Mercedes. Telfs. 999 0542 - 991 8923"
                		+ "Caracas. Rif: J-31245344-3", 
                		new Font(FuenteInformeUtil.getInformeFontNormal().getBaseFont(), 8)),
                document.getPageSize().getWidth() / 2, 
                30,
                0);
        ColumnText.showTextAligned(writer.getDirectContent(),
                Element.ALIGN_CENTER, 
                new Phrase("Caracas. Rif: J-31245344-3", 
                		new Font(FuenteInformeUtil.getInformeFontNormal().getBaseFont(), 8)),
                document.getPageSize().getWidth() / 2, 
                20,
                0);
    }
}
