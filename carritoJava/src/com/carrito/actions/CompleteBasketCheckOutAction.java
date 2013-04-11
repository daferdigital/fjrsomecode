package com.carrito.actions;

import java.text.DateFormat;
import java.text.MessageFormat;
import java.util.Calendar;
import java.util.Map;

import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import org.apache.log4j.Logger;
import org.apache.struts.action.Action;
import org.apache.struts.action.ActionErrors;
import org.apache.struts.action.ActionForm;
import org.apache.struts.action.ActionForward;
import org.apache.struts.action.ActionMapping;
import org.apache.struts.action.ActionMessage;
import org.apache.struts.action.ActionMessages;
import org.apache.struts.util.MessageResources;

import com.carrito.dao.CarritoItemDAO;
import com.carrito.dao.CategoriaDAO;
import com.carrito.dao.CompraDAO;
import com.carrito.dto.UsuarioDTO;
import com.carrito.forms.BasketForm;
import com.carrito.util.Constants;
import com.carrito.util.SendMail;
import com.carrito.util.SessionUtil;
import com.carrito.vo.IndexVO;

/**
 * 
 * Class: CompleteBasketCheckOutAction
 * Creation Date: 04/04/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class CompleteBasketCheckOutAction extends Action {
	private static final Logger log = Logger.getLogger(CompleteBasketCheckOutAction.class);
	
	@Override
	public ActionForward execute(ActionMapping mapping, ActionForm form,
			HttpServletRequest request, HttpServletResponse response)
			throws Exception {
		// TODO Auto-generated method stub
		BasketForm basketForm = (BasketForm) form;
		
		//verificamos que el usuario esta en sesion
		UsuarioDTO user = SessionUtil.getUserBeanInSession(request);
		if(user == null){
			log.info("Se desea hacer una pre orden pero sin un usuario en session, devolvemos este flujo al index");
			return mapping.findForward(Constants.GLOBAL_FORWARD_INDEX);
		}
		
		//tenemos el listado de la cesta
		//debemos ver que elementos quedan en la cesta temporal y cuales seran comprados realmente
		basketForm.setUserId(SessionUtil.getUserIdInSession(request));
		Map<String, Object> resultado = CompraDAO.registrarCompra(basketForm);
		ActionErrors errors = (ActionErrors) resultado.get(CompraDAO.KEY_COMPRA_ERRORES);
		
		if(errors.size() > 0){
			saveErrors(request, errors);
		} else{
			ActionMessages messages = new ActionMessages();
			messages.add("carrito.checkout.completed", new ActionMessage("carrito.checkout.completed"));
			saveMessages(request, messages);
			
			String template = SendMail.getMailCompraFinalizadaTemplate(
					request.getSession().getServletContext().getRealPath("/"));
			template = MessageFormat.format(template, new Object[]{user.getNombre() + " " + user.getApellido(),
					DateFormat.getDateInstance().format(Calendar.getInstance().getTime()),
					resultado.get(CompraDAO.KEY_COMPRA_DETALLE),
					resultado.get(CompraDAO.KEY_COMPRA_TOTAL)});
			
			MessageResources resources = getResources(request);
			SendMail.sendEmail(resources, 
					user.getEmail(), 
					resources.getMessage("mail.completecheckout.subject"), 
					template);
		}
		
		IndexVO indexForm = new IndexVO();
		//cargamos las categorias
		indexForm.setCategorias(CategoriaDAO.getAllCategories());
		
		//cargamos el posible carro que tengamos en base de datos para presentarlo
		user.setItemsCarrito(CarritoItemDAO.getCarritoItems(user.getId()));
		
		request.getSession().setAttribute(Constants.SESSION_USER_LOGGED, user);
		request.setAttribute("indexVOForm", indexForm);
		
		
		return mapping.findForward(Constants.MAPPING_SUCCESS);
	}
}
