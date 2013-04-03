package com.carrito.actions;

import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import org.apache.struts.action.Action;
import org.apache.struts.action.ActionForm;
import org.apache.struts.action.ActionForward;
import org.apache.struts.action.ActionMapping;
import org.apache.struts.action.ActionMessage;
import org.apache.struts.action.ActionMessages;

import com.carrito.dao.UsuarioDAO;
import com.carrito.forms.UsuarioForm;
import com.carrito.util.Constants;

/**
 * 
 * Class: AddAccountAction <br />
 * DateCreated: 01/04/2013 <br />
 * @author T&T <br />
 *
 */
public class AddAccountAction extends Action{
	@Override
	public ActionForward execute(ActionMapping mapping, ActionForm form,
			HttpServletRequest request, HttpServletResponse response)
			throws Exception {
		// TODO Auto-generated method stub
		UsuarioForm usuarioForm = (UsuarioForm) form;
		
		ActionMessages messages = new ActionMessages();
		ActionMessages errors = new ActionMessages();
		
		if(UsuarioDAO.addUserToDataBase(usuarioForm)){
			//usuario agregado con exito
			messages.add("usuario.creado", new ActionMessage("usuario.creado", new Object[]{usuarioForm.getLogin()}));
			saveMessages(request, messages);
		}else{
			//error agregando usuario
			errors.add("usuario.nocreado", new ActionMessage("usuario.nocreado", new Object[]{usuarioForm.getLogin()}));
			saveErrors(request, errors);
		}
		
		return mapping.findForward(Constants.MAPPING_SUCCESS);
	}
}
