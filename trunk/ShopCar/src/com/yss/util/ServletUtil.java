package com.yss.util;

import java.lang.reflect.Method;
import java.util.Iterator;
import java.util.Set;
import java.util.TreeSet;

import javax.servlet.GenericServlet;
import javax.servlet.ServletContext;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import org.apache.log4j.Logger;

/**
 * 
 * Class: ServletUtil
 * Creation Date: 01/07/2012
 * (c) 2012
 *
 * @author T&T
 *
 */
public class ServletUtil {
	
	public static final String ACTION = "action";
	
	/**
	 * 
	 * @param actionHandlers
	 * @param action
	 * @param request
	 * @param response
	 * @param appLogger
	 * @param controllerInterfaceName
	 * @param controllerImpl
	 * @throws Exception
	 */
	public static void useActionHandlers(Set<String> actionHandlers, String action, HttpServletRequest request, 
			HttpServletResponse response, Logger appLogger, String controllerInterfaceName, Object controllerImpl)
					throws Exception {
		Class<?> paramTypes[] = {
				Class.forName("javax.servlet.http.HttpServletRequest"), 
				Class.forName("javax.servlet.http.HttpServletResponse"), 
				Class.forName(controllerInterfaceName)
		};

		for(Iterator<String> itHnd = actionHandlers.iterator(); itHnd.hasNext();) {
			String className = (String)itHnd.next();
			
			try {
				Class<?> cl = Class.forName(className);
				Method method = cl.getMethod(action, paramTypes);
				method.invoke(null, new Object[] {
						request, response, controllerImpl
				});
				
				appLogger.info((new StringBuilder("called ")).append(className).append(".").append(action).toString());
				return;
			} catch(ClassNotFoundException classnotfoundexception) { }
			catch(NoSuchMethodException nosuchmethodexception) { }
			catch(IllegalAccessException illegalaccessexception) { }
			catch(NullPointerException nullpointerexception) { }
		}
		
		throw new Exception((new StringBuilder("action '")).append(action).append("' not found in actionHandlers").toString());
	}

	/**
	 * 
	 * @param servletInfo
	 * @return
	 * @throws ServletException
	 */
	public static Set<String> lookUpActionHandlers(Object servletInfo)
			throws ServletException {
		
		Set<String> actionHandlers = new TreeSet<String>();
		ServletContext context = null;
		GenericServlet webXML = null;
		boolean useGenericServlet = false;
		
		if(servletInfo instanceof ServletContext) {
			context = (ServletContext)servletInfo;
			useGenericServlet = false;
		} else if(servletInfo instanceof GenericServlet) {
			webXML = (GenericServlet)servletInfo;
			useGenericServlet = true;
		} else {
			throw new ServletException((new StringBuilder(
					"Parameter 'servletInfo' must be a instance of 'ServletContext' or 'GenericServlet' but is an '")).append(
							servletInfo.getClass().getName()).append("'").toString());
		}
	        
		int i = 1;
		for(boolean stop = false; !stop;) {
			String paramValue = null;
			if(useGenericServlet) {
				paramValue = webXML.getInitParameter((new StringBuilder("actionHandler.")).append(i).toString());
			} else {
				paramValue = context.getInitParameter((new StringBuilder("actionHandler.")).append(i).toString());
			}
			
			if(paramValue == null) {
				stop = true;
			} else {
				actionHandlers.add((String) paramValue);
			}
			
			i++;
		}

		return actionHandlers;
	}
}
