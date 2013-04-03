package com.carrito.actions;

import java.util.Enumeration;

import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import org.apache.log4j.Logger;
import org.apache.struts.action.Action;
import org.apache.struts.action.ActionForm;
import org.apache.struts.action.ActionForward;
import org.apache.struts.action.ActionMapping;

import com.carrito.util.Constants;
import com.carrito.util.SessionUtil;

/**
 * 
 * Class: LogOutAction
 * Creation Date: 30/03/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class LogOutAction extends Action{
	private static final Logger log = Logger.getLogger(LogOutAction.class);
	
	@Override
	public ActionForward execute(ActionMapping mapping, ActionForm form,
			HttpServletRequest request, HttpServletResponse response)
			throws Exception {
		// TODO Auto-generated method stub
		
		//eliminamos el bean de usuario de la sesion
		Enumeration<String> attributeNames = request.getSession().getAttributeNames();
		while(attributeNames.hasMoreElements()){
			String key = attributeNames.nextElement();
			request.getSession().removeAttribute(attributeNames.nextElement());
			log.info("Eliminado de sesion atributo " + key);
		}
		
		log.info("Proceso de logout realizado para el usuario " + SessionUtil.getUserIdInSession(request));
		
		return mapping.findForward(Constants.MAPPING_SUCCESS);
	}
}
