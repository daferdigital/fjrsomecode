package com.yss.servlets;

import java.io.IOException;
import java.util.HashMap;
import java.util.Map;
import java.util.Set;

import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import org.apache.log4j.Logger;

import com.yss.controller.AppConstant;
import com.yss.controller.AppController;
import com.yss.controller.AppControllerImpl;
import com.yss.javabeans.view.SiteBean;
import com.yss.properties.MessagesProperties;
import com.yss.util.DBUtil;
import com.yss.util.ServletUtil;

public class AppServlet extends HttpServlet{
	private static Logger logger = null;
	private static SiteBean siteBean = null;
	
	private static Map<String, String> actionsAllowedWhitOutSession = new HashMap<String, String>();
	
	
	static {
		actionsAllowedWhitOutSession.put("showHome", "showHome");
	}
	
	/**
	 * 
	 */
	private static final long serialVersionUID = -3558612897314088918L;
	
	/**
	 * This attribute contains all the handlers to use in this application.
	 * see the web.xml configuration file.
	 * 
	 */
	private Set<String> actionHandlers;
	
	/**
	 * Controller of the application.
	 */
	private static AppController controller;
	
	@Override
	public void init() throws ServletException {
		// TODO Auto-generated method stub
		final String method = "init(): ";
		long t0 = System.currentTimeMillis();
		
		try {
			//en este punto, debemos tener inicializado el log4j
			super.init();
			
			if(Log4jInitServlet.wasStartedAppLog()){
				logger = Logger.getLogger(AppServlet.class);
			}else{
				throw new Exception("No se iniciara el servlet principal, debido a que el log de la aplicacion no fue iniciado.");
			}
			
			//configuramos el DataSource
			DBUtil.getDataSourceFromMetaInfDBCPInfo(getServletContext().getRealPath("/"));
			logger.info(method + "Iniciado el DataSource");
			
			//configuramos los action handlers
			actionHandlers = ServletUtil.lookUpActionHandlers(this);
			logger.info(method + "Cargado(s)   " + actionHandlers.size() + " action-handlers");
			
			//set up "controller" implementation
			controller = AppControllerImpl.getInstance(getServletContext());
			logger.info("Controller implementation was started");
			
			MessagesProperties.setPropsDirPath(getServletContext().getRealPath("/properties"));
			logger.info(method + "Completada la carga del servlet en "
					+ (System.currentTimeMillis() - t0) + " ms.");
		} catch (Throwable e) {
			// TODO: handle exception
			e.printStackTrace();
			throw new ServletException(e.getMessage(), e.getCause());
		}
	}
	
	/**
	 * This method return the interface class name, which represents the
	 * "controller" object, if any subclass need a more custom controller implementation
	 * then must override this object returning the correct value.
	 * 
	 */
	public String getControllerInterfaceClassName(){
		return AppController.class.getCanonicalName();
	}
	
	/**
	 * 
	 * @param request
	 */
	private static void createSiteBean(HttpServletRequest request){
		if(siteBean == null){
			//obtenemos el url base
			String baseUrl = request.getRequestURL().substring(0, request.getRequestURL().indexOf(request.getServletPath()));

			siteBean = new SiteBean();
			siteBean.setRootSiteURL(baseUrl);
		}
		
		request.setAttribute(AppConstant.ATT_BEAN_SITE, siteBean);
	}
	
	/**
	 * 
	 * @param request
	 */
	private static void createUserSiteBean(HttpServletRequest request){
		if(request.getSession().getAttribute(AppConstant.ATT_BEAN_USER_VIEW) == null){
			//obtenemos el url base
			String baseUrl = request.getRequestURL().substring(0, request.getRequestURL().indexOf(request.getServletPath()));

			siteBean = new SiteBean();
			siteBean.setRootSiteURL(baseUrl);
		}
		
		request.setAttribute(AppConstant.ATT_BEAN_SITE, siteBean);
	}
	
	@Override
	protected void doPost(HttpServletRequest req, HttpServletResponse resp)
			throws ServletException, IOException {
		// TODO Auto-generated method stub
		doGet(req, resp);
	}
	
	protected void doGet(HttpServletRequest request, HttpServletResponse response)
			throws ServletException, IOException {
		final String action = request.getParameter(ServletUtil.ACTION);
		
		//verificamos si hay sesion de usuario
		//para saber si es permitido ejecutar la solicitud del usuario conectado
		createSiteBean(request);
		createUserSiteBean(request);
		
		try {
			ServletUtil.useActionHandlers(actionHandlers,
					action, request, response, logger,
					getControllerInterfaceClassName(),
					controller);
		} catch (Exception e) {
			// TODO Auto-generated catch block
			logger.error("Error in doGet. Error was: " + e.getMessage(), e);
		}
	}

}
