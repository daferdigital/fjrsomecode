package com.fjr.code.barcode;

import java.awt.print.PageFormat;
import java.awt.print.Paper;
import java.awt.print.PrinterJob;
import java.io.File;
import java.io.FileInputStream;
import java.net.URL;

import javax.print.attribute.HashPrintRequestAttributeSet;
import javax.print.attribute.PrintRequestAttributeSet;
import javax.print.attribute.standard.MediaPrintableArea;

import org.apache.log4j.Logger;

import com.qoppa.pdf.PrintSettings;
import com.qoppa.pdfPrint.PDFPrint;

public abstract class BarCodePrint {
	private Logger log;
	private PageFormat pageFormat;
	/**
	 * 
	 * @param log
	 * @param pageFormat 
	 * @param fileToPrint
	 */
	public BarCodePrint(Logger log, PageFormat pageFormat) {
		// TODO Auto-generated constructor stub
		this.log = log;
		this.pageFormat = pageFormat;
	}
	
	/**
	 * 
	 * @param pageFormat
	 */
	private void describePageFormat(PageFormat pageFormat) {
        log.info(String.format("printing on %fx%f paper, imageable area=%fx%f",
                pageFormat.getWidth(),
                pageFormat.getHeight(),
                pageFormat.getImageableWidth(),
                pageFormat.getImageableHeight()
                ));
    }
	
	/**
	 * 
	 * @param printJob
	 * @return
	 */
	private PageFormat getMinimumMarginPageFormat(PrinterJob printJob) {
	    PageFormat pf0 = printJob.defaultPage();
	    PageFormat pf1 = (PageFormat) pf0.clone();
	    Paper p = pf0.getPaper();
	    p.setImageableArea(0, 0,pf0.getWidth(), pf0.getHeight());
	    pf1.setPaper(p);
	    PageFormat pf2 = printJob.validatePage(pf1);
	    return pf2;     
	}
	
	/**
	 * 
	 */
	protected void printLabelFile(File fileToPrint){
		try {
			PrinterJob printJob = PrinterJob.getPrinterJob();
			URL url = new URL("file:///".concat(fileToPrint.getAbsolutePath()));

			// PDFPrint pdfPrint = new PDFPrint (url, this);
			//PDFPrint pdfPrint = new PDFPrint(url, null);
			PDFPrint pdfPrint = new PDFPrint(new FileInputStream(fileToPrint), null);
			PrintSettings ps = pdfPrint.getPrintSettings();
			ps.setForceUserPageFormat(true);
			
			pdfPrint.setPrintSettings(ps);
			
			PrintRequestAttributeSet attSet = new HashPrintRequestAttributeSet();
			MediaPrintableArea m = new MediaPrintableArea(0, 0, 57, 44, MediaPrintableArea.MM);
			log.info(m.getWidth(MediaPrintableArea.MM));
			log.info(m.getHeight(MediaPrintableArea.MM));
			
			attSet.add(m);
			//attSet.add(new Copies(2));
			printJob.setPrintable(pdfPrint, pageFormat);
			
			describePageFormat(pageFormat);
			getMinimumMarginPageFormat(printJob);
			printJob.validatePage(pageFormat);
			describePageFormat(pageFormat);
			
			if (printJob.printDialog()) {
				log.info("Solicitud para imprimir archivo " + fileToPrint.getAbsolutePath()
						+ " sera procesada.");
				log.info(m.getWidth(MediaPrintableArea.MM));
				log.info(m.getHeight(MediaPrintableArea.MM));
				
				getMinimumMarginPageFormat(printJob);
				printJob.validatePage(pageFormat);
				describePageFormat(pageFormat);
				
				log.info(attSet);
				
				//class javax.print.attribute.standard.MediaPrintableArea
				//(25.1,25.4)->(165.6,228.6)mm /MediaPrintableArea
				attSet.add(m);
				
				printJob.setPrintable(pdfPrint, pageFormat);
				printJob.print();
			}
		} catch (Exception e) {
			// TODO: handle exception
			log.error(e.getMessage(), e);
		}
	}
}
