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
import com.carrito.forms.ProductForm;
import com.carrito.util.Constants;
import com.carrito.util.SessionUtil;

/**
 * 
 * Class: DeleteProductFromBasketAction
 * Creation Date: 31/03/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class DeleteProductFromBasketAction extends Action{
	private static final Logger log = Logger.getLogger(DeleteProductFromBasketAction.class);
	
	@Override
	public ActionForward execute(ActionMapping mapping, ActionForm form,
			HttpServletRequest request, HttpServletResponse response)
			throws Exception {
		// TODO Auto-generated method stub
		ProductForm customForm = (ProductForm) form;
		
		CarritoItemDTO itemDTO = new CarritoItemDTO();
		itemDTO.setProductId(customForm.getProductId());
		itemDTO.setUserId(SessionUtil.getUserIdInSession(request));
		
		CarritoItemDAO.deleteProductFromBasket(itemDTO);
		
		UsuarioDTO user = SessionUtil.getUserBeanInSession(request);
		if(user != null){
			user.setItemsCarrito(CarritoItemDAO.getCarritoItems( 
					SessionUtil.getUserIdInSession(request)));
			log.info("Actualizados items del carrito en sesion para el usuario " + user.getLogin());
		}
		
		if(Constants.COME_FROM_MENU_RIGTH.equals(customForm.getPageComeFrom())){
			log.info("Retornando con mappping " + Constants.MAPPING_SUCCESS);
			return mapping.findForward(Constants.MAPPING_SUCCESS);
		} else if (Constants.COME_FROM_PREV_CHECKOUT.equals(customForm.getPageComeFrom())){
			log.info("Retornando con mappping " + Constants.MAPPING_SUCCESS_PREV_CHECKOUT);
			return mapping.findForward(Constants.MAPPING_SUCCESS_PREV_CHECKOUT);
		} else {
			log.info("Retornando con mappping generico, esto es un error, falta el mapeo");
			return super.execute(mapping, customForm, request, response);
		}
	}
}
