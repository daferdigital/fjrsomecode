package com.carrito.util;

import javax.servlet.http.HttpServletRequest;

/**
 * 
 * Class: PagingUtil
 * Creation Date: 07/07/2012
 * (c) 2012
 *
 * @author T&T
 *
 */
public final class PagingUtil {
	private static final int pageRange = 8;
	private HttpServletRequest request;
	private int totalRecords;
	private String customAjaxPagingFunctionName;
	
	/**
	 * 
	 * @param request
	 * @param totalRecords
	 * @param customAjaxPagingFunctionName
	 */
	public PagingUtil(HttpServletRequest request, int totalRecords, String customAjaxPagingFunctionName) {
		// TODO Auto-generated constructor stub
		this.request = request;
		this.totalRecords = totalRecords;
		this.customAjaxPagingFunctionName = customAjaxPagingFunctionName;
	}
	
	/**
	 * 
	 * @return
	 */
	public int getPageNumberRequested(){
		int pageNumber = 1;
		
		if(request.getParameter(Constants.PARAMETER_PAGE_NUMBER) != null){
			try {
				pageNumber = Integer.parseInt(request.getParameter(Constants.PARAMETER_PAGE_NUMBER));
			} catch (Exception e) {
				// TODO: handle exception
			}
		}
		
		return pageNumber;
	}
	
	/**
	 * 
	 */
	public String injectPageNumberAsHidden(){
		int pageNumber = getPageNumberRequested();
		
		final String hiddenField = "<input type=\"hidden\" name=\""
				+ Constants.PARAMETER_PAGE_NUMBER + "\" value=\""
				+ pageNumber + "\"/>";
		
		return hiddenField; 
	}
	
	/**
	 * 
	 * @return
	 */
	public String getTRFooterPaging(){
		StringBuilder footerTR = new StringBuilder();
		
		//vemos la cantidad de elementos a dibujar por pagina
		int maxRecordsPerPage = Constants.MAX_RECORDS_PER_PAGE;
		
		//calculamos el total de paginas involucradas
		int pagesInvolved = (totalRecords / maxRecordsPerPage) 
				+ (totalRecords % maxRecordsPerPage == 0 ? 0 : 1);
		
		//vemos la pagina que estamos dibujando
		int pageNumber = getPageNumberRequested();
		
		//si estamos en la primera pagina no dibujamos las opciones de ir a primera pagina
		//ni pagina previa
		if(pageNumber > 1){
			footerTR.append("<a href=\"#footerPage\" id=\"footerPage\" onclick=\"" + customAjaxPagingFunctionName + "(1)\">");
			footerTR.append("<img src=\"images/icons/firstPage.png\" border=\"0\" title=\"Primera Pagina\" />");
			footerTR.append("</a>");
			
			footerTR.append("<a href=\"#footerPage\" id=\"footerPage\" onclick=\"" + customAjaxPagingFunctionName + "(" + (pageNumber - 1) + ")\">");
			footerTR.append("<img src=\"images/icons/prevPage.png\" border=\"0\" title=\"Pagina Anterior\" />");
			footerTR.append("</a>");
		}
		
		//dibujamos los indices anteriores
		for (int i = (pageRange / 2); i > 0; i--) {
			if(pageNumber - i > 0){
				//dibujamos este indice
				footerTR.append("<a href=\"#footerPage\" id=\"footerPage\" onclick=\"" + customAjaxPagingFunctionName + "(" + (pageNumber - i) + ")\">");
				footerTR.append(pageNumber - i);
				footerTR.append("</a>");
			} else {
				continue;
			}
		}
		
		//dibujamos la propia pagina
		footerTR.append(pageNumber);
		
		//dibujamos los indices posteriores
		for (int i = 1; i < (pageRange / 2) + 1; i++) {
			if(pageNumber + i <= pagesInvolved){
				//dibujamos este indice
				footerTR.append("<a href=\"#footerPage\" id=\"footerPage\" onclick=\"" + customAjaxPagingFunctionName + "(" + (pageNumber + i) + ")\">");
				footerTR.append(pageNumber + i);
				footerTR.append("</a>");
			} else {
				continue;
			}
		}
		
		//si no estamos en la ultima pagina, dibujamos las opciones de ir a siguiente o ultima pagina
		if(pageNumber < pagesInvolved){
			footerTR.append("<a href=\"#footerPage\" id=\"footerPage\" onclick=\"" + customAjaxPagingFunctionName + "(" + (pageNumber + 1) + ")\">");
			footerTR.append("<img src=\"images/icons/nextPage.png\" border=\"0\" title=\"Proxima Pagina\" />");
			footerTR.append("</a>");
			
			footerTR.append("<a href=\"#footerPage\" id=\"footerPage\" onclick=\"" + customAjaxPagingFunctionName + "(" + pagesInvolved + ")\">");
			footerTR.append("<img src=\"images/icons/lastPage.png\" border=\"0\" title=\"Ultima Pagina\" />");
			footerTR.append("</a>");
		}
		
		return footerTR.toString();
	}
}
