package com.fjr.code.pdf;

public interface PDFPageChecker {
	
	/**
	 * Metodo para indicar que debe ajustarse de manera dinamica
	 * el contador de paginas en un mismo documento.
	 * 
	 * En los casos de Biopsia e IHQ, dicho numero
	 * debe ser reseteado mas de una vez en la generacion del documento.
	 * 
	 * @return
	 */
	public boolean mustFixNumberPage();
}
