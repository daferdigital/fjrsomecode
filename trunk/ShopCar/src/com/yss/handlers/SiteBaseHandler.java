package com.yss.handlers;

import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import com.yss.controller.AppConstant;
import com.yss.controller.AppController;
import com.yss.dao.LoginDAO;
import com.yss.dto.ErrorMessageDTO;
import com.yss.dto.LoginDTO;
import com.yss.properties.MessagesProperties;

/**
 * En esta clase debemos almacenar los actions que vamos a permitir ejecutar
 * tenga o no sesion de login el usuario que este realizando los request respectivos.
 * 
 * Class: SiteBaseHandler
 * Creation Date: 01/07/2012
 * (c) 2012
 *
 * @author T&T
 *
 */
public final class SiteBaseHandler {
	
	/**
	 * When a user go in the site, this method is executed
	 * or any customized by one specific client
	 * 
	 * @param request
	 * @param response
	 * @param controller
	 * @throws Exception
	 */
	public static void showHome(HttpServletRequest request,
			HttpServletResponse response, AppController controller)
	throws Exception{
		controller.forward(null, request, response, "/webpages/home.jsp");
	}
	
	/**
	 * Mostramos el formulario de login
	 * 
	 * @param request
	 * @param response
	 * @param controller
	 * @throws Exception
	 */
	public static void showLoginForm(HttpServletRequest request,
			HttpServletResponse response, AppController controller)
	throws Exception{
		controller.forward(null, request, response, "/webpages/loginForm.jsp");
	}
	
	/**
	 * Ejecutamos la accion de login
	 * 
	 * @param request
	 * @param response
	 * @param controller
	 * @throws Exception
	 */
	public static void doLogin(HttpServletRequest request,
			HttpServletResponse response, AppController controller)
	throws Exception{
		final String login = request.getParameter(AppConstant.PARAM_LOGIN);
		final String password = request.getParameter(AppConstant.PARAM_PASSWORD);
		
		ErrorMessageDTO erroresDTO = new ErrorMessageDTO();
		
		if(login == null || "".equals(login)){
			erroresDTO.addErrorMessage(MessagesProperties.getPropertyValue("login.isEmpty"));
			if(password == null || "".equals(password)){
				erroresDTO.addErrorMessage(MessagesProperties.getPropertyValue("password.isEmpty"));
			}
			
			controller.forward(erroresDTO, request, response, "/webpages/loginForm.jsp");
			return;
		}
		
		LoginDTO loginDTO = LoginDAO.checkIfCredentialsAreValid(erroresDTO, login, password);
		
		if(loginDTO == null){
			erroresDTO.addErrorMessage(MessagesProperties.getPropertyValue("credentials.notCorrect"));
			controller.forward(erroresDTO, request, response, "/webpages/loginForm.jsp");
			return;
		}else{
			//tenemos un login valido
			//lo registramos en sesion
			request.getSession().setAttribute(AppConstant.ATT_BEAN_USER_VIEW, loginDTO);
			controller.forward(null, request, response, "/webpages/welcome.jsp");
		}
	}
	
	/**
	 * Ejecutamos la accion de logout.
	 * 
	 * @param request
	 * @param response
	 * @param controller
	 * @throws Exception
	 */
	public static void doLogout(HttpServletRequest request,
			HttpServletResponse response, AppController controller)
	throws Exception{
		request.getSession().removeAttribute(AppConstant.ATT_BEAN_USER_VIEW);
		request.getSession().invalidate();
		
		controller.forward(null, request, response, "/webpages/home.jsp");
	}
}
