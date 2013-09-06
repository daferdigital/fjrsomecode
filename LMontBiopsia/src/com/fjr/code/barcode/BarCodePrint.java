package com.fjr.code.barcode;

import java.awt.print.PrinterJob;
import java.io.File;
import java.net.URL;

import org.apache.log4j.Logger;

import com.qoppa.pdfPrint.PDFPrint;

public abstract class BarCodePrint {
	private Logger log;
	
	/**
	 * 
	 * @param log
	 * @param fileToPrint
	 */
	public BarCodePrint(Logger log) {
		// TODO Auto-generated constructor stub
		this.log = log;
	}
	
	/**
	 * 
	 */
	protected void printLabelFile(File fileToPrint){
		try {
			PrinterJob printJob = PrinterJob.getPrinterJob();
			URL url = new URL("file:///".concat(fileToPrint.getAbsolutePath()));

			// PDFPrint pdfPrint = new PDFPrint (url, this);
			PDFPrint pdfPrint = new PDFPrint(url, null);
			
			if (printJob.printDialog()) {
				printJob.setPrintable(pdfPrint);
				printJob.print();
			}
		} catch (Exception e) {
			// TODO: handle exception
			log.error(e.getMessage(), e);
		}
	}
}
