package com.yss.controller;

import javax.servlet.ServletContext;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.sql.DataSource;

import org.apache.log4j.Logger;

import com.yss.dto.ErrorMessageDTO;
import com.yss.util.DBUtil;

/**
 * 
 * Class: AppControllerImpl
 * Creation Date: 01/07/2012
 * (c) 2012
 *
 * @author T&T
 *
 */
public class AppControllerImpl implements AppController{
	private static final Logger appLogger = Logger.getLogger(AppController.class);
	
	private static AppController impl;
	private ServletContext servletContext;
	
	/**
	 * private constructor
	 * 
	 * @param servletContext
	 * @param dataSource
	 */
	private AppControllerImpl(ServletContext servletContext) {
		this.servletContext = servletContext;
	}
	
	/**
	 * 
	 * @param servletContext
	 * @param dataSource
	 * @return
	 */
	public static AppController getInstance(ServletContext servletContext){
		if(impl == null){
			impl = new AppControllerImpl(servletContext);
		}
		
		return impl;
	}
	
	public String getSitePath() {
		// TODO Auto-generated method stub
		return servletContext.getRealPath("/");
	}
	
	public void forward(ErrorMessageDTO erroresDTO, HttpServletRequest request,
			HttpServletResponse response, String jspHandler) {
		try {
			Long t0Request = (Long) request.getAttribute(AppConstant.T0_REQUEST);
			if(erroresDTO != null && erroresDTO.getErrorMessages().size() > 0){
				//tengo errores que mostrar
				request.setAttribute(AppConstant.ATT_ERRORES_MSGS, erroresDTO);
			}
			
			servletContext.getRequestDispatcher(jspHandler).forward(request, response);
			appLogger.info("forwarded to: " + jspHandler 
					+ " (" + (System.currentTimeMillis() - t0Request) + " ms.)");
		} catch (Exception e) {
			// TODO Auto-generated catch block
			appLogger.error("Error trying to reach " + jspHandler
					+ " Error was: " + e.getMessage(), e);
		}
	}
	
	@Override
	public DataSource getDataSource() {
		// TODO Auto-generated method stub
		return DBUtil.getAppDataSource();
	}
}
