package com.carrito.actions;

import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import org.apache.struts.action.Action;
import org.apache.struts.action.ActionErrors;
import org.apache.struts.action.ActionForm;
import org.apache.struts.action.ActionForward;
import org.apache.struts.action.ActionMapping;
import org.apache.struts.action.ActionMessage;

import com.carrito.dao.CarritoItemDAO;
import com.carrito.dao.UsuarioDAO;
import com.carrito.dto.UsuarioDTO;
import com.carrito.forms.LoginForm;
import com.carrito.util.Constants;
import com.carrito.util.SessionUtil;

public class LoginAction extends Action{
	
	@Override
	public ActionForward execute(ActionMapping mapping, ActionForm form,
			HttpServletRequest request, HttpServletResponse response)
			throws Exception {
		// TODO Auto-generated method stub
		LoginForm loginForm = (LoginForm) form;
		boolean continueProcess = true;
		
		ActionErrors errors = new ActionErrors();
		
		if(loginForm == null){
			continueProcess = false;
			errors.add("error.nologin", new ActionMessage("error.nologin"));
		} else {
			if(loginForm.getLogin() == null || "".equals(loginForm.getLogin().trim())){
				//login es vacio
				continueProcess = false;
				errors.add("error.camponovacio", new ActionMessage("error.camponovacio", new Object[]{"login"}));
			}
			if(loginForm.getPassword() == null || "".equals(loginForm.getPassword().trim())){
				//password es vacio
				continueProcess = false;
				errors.add("error.camponovacio", new ActionMessage("error.camponovacio", new Object[]{"password"}));
			}
		}
		
		
		if(continueProcess){
			UsuarioDTO user = UsuarioDAO.getUserByLoginData(loginForm.getLogin(),
					loginForm.getPassword());
			
			if(user == null){
				//debemos indicar que el intento de login fue fallido
				errors.add("error.nologin", new ActionMessage("error.nologin"));
			} else {
				//cargamos el posible carro que tengamos en sesion para presentarlo
				user.setItemsCarrito(CarritoItemDAO.getCarritoItems(
						SessionUtil.getUserIdInSession(request)));
				
				request.getSession().setAttribute(Constants.SESSION_USER_LOGGED, user);
			}
		}
		
		if(! errors.isEmpty() ){
			addErrors(request, errors);
		}
		
		return mapping.findForward(Constants.MAPPING_SUCCESS);
	}
}
