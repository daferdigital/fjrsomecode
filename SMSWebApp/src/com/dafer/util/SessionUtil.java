package com.dafer.util;

import javax.servlet.http.HttpServletRequest;

import org.apache.log4j.Logger;

import com.dafer.dto.UsuarioDTO;

/**
 * 
 * Class: SessionUtil
 * Creation Date: 30/03/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public final class SessionUtil {
	private static final Logger log = Logger.getLogger(SessionUtil.class);
	
	private SessionUtil() {
		// TODO Auto-generated constructor stub
	}
	
	/**
	 * Metodo para obtener el id del usuario que esta en sesion, si es que existe uno.
	 * 
	 * @param request
	 */
	public static int getUserIdInSession(HttpServletRequest request){
		int userId = -1;
		
		if(request.getSession().getAttribute(Constants.SESSION_USER_LOGGED) != null){
			userId = ((UsuarioDTO) request.getSession().getAttribute(Constants.SESSION_USER_LOGGED)).getId();
			log.info("Obtenido id " + userId + " para el usuario en sesion");
		} else {
			log.info("Usuario aun no registrado en sesion");
		}
		
		return userId;
	}
	
	/**
	 * Metodo para obtener el objeto asociado al bean del usuario en session.
	 * 
	 * @param request
	 */
	public static UsuarioDTO getUserBeanInSession(HttpServletRequest request){
		UsuarioDTO beanDTO = null;
		
		if(request.getSession().getAttribute(Constants.SESSION_USER_LOGGED) != null){
			beanDTO = ((UsuarioDTO) request.getSession().getAttribute(Constants.SESSION_USER_LOGGED));
			log.info("Obtenido bean " + beanDTO + " para el usuario en sesion");
		} else {
			log.info("Usuario aun no registrado en sesion");
		}
		
		return beanDTO;
	}
}
