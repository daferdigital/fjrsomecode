package com.carrito.actions;

import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import org.apache.log4j.Logger;
import org.apache.struts.action.Action;
import org.apache.struts.action.ActionForm;
import org.apache.struts.action.ActionForward;
import org.apache.struts.action.ActionMapping;

import com.carrito.dao.CarritoItemDAO;
import com.carrito.dto.CarritoItemDTO;
import com.carrito.dto.UsuarioDTO;
import com.carrito.forms.AddProductToBasketForm;
import com.carrito.util.Constants;
import com.carrito.util.SessionUtil;

/**
 * 
 * Class: AddProductToBasketAction
 * Creation Date: 31/03/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class AddProductToBasketAction extends Action{
	private static final Logger log = Logger.getLogger(AddProductToBasketAction.class);
	
	@Override
	public ActionForward execute(ActionMapping mapping, ActionForm form,
			HttpServletRequest request, HttpServletResponse response)
			throws Exception {
		// TODO Auto-generated method stub
		AddProductToBasketForm customForm = (AddProductToBasketForm) form;
		
		CarritoItemDTO itemDTO = new CarritoItemDTO();
		itemDTO.setProductId(customForm.getProductId());
		itemDTO.setSessionId(request.getSession().getId());
		itemDTO.setUserId(SessionUtil.getUserIdInSession(request));
		
		CarritoItemDAO.addProductToBasket(itemDTO);
		
		UsuarioDTO user = SessionUtil.getUserBeanInSession(request);
		if(user != null){
			user.setItemsCarrito(CarritoItemDAO.getCarritoItems(request.getSession().getId(), 
					SessionUtil.getUserIdInSession(request)));
			log.info("Actualizados items del carrito en sesion");
		}
		
		return mapping.findForward(Constants.MAPPING_SUCCESS);
	}
}
