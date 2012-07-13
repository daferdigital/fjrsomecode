package com.yss.controller;

import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.sql.DataSource;

import com.yss.dto.ErrorMessageDTO;

/**
 * 
 * Class: AppController
 * Creation Date: 01/07/2012
 * (c) 2012
 *
 * @author T&T
 *
 */
public interface AppController {
	
	/**
	 * Return the root directory of this WAP application.
	 * Must have the same value of "docBase" property inside
	 * the XML context definition.
	 * 
	 * @return
	 */
	public String getSitePath();
	
	/**
	 * 
	 * @param erroresDTO null or empty if errors doesnt mind
	 * @param request
	 * @param response
	 * @param jspHandler
	 */
	public void forward(ErrorMessageDTO erroresDTO, HttpServletRequest request,
			HttpServletResponse response, String jspHandler);	
	
	/**
	 * Return the <code>javax.sql.DataSource</code> previously builded
	 * to this Wap Application.
	 * 
	 * @return
	 * @see WapServlet#init()
	 */
	public DataSource getDataSource();
}
