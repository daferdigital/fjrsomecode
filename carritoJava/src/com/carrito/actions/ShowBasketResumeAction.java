package com.carrito.actions;

import java.util.LinkedList;
import java.util.List;

import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import org.apache.log4j.Logger;
import org.apache.struts.action.Action;
import org.apache.struts.action.ActionForm;
import org.apache.struts.action.ActionForward;
import org.apache.struts.action.ActionMapping;

import com.carrito.dao.BancoDAO;
import com.carrito.dao.ProductoDAO;
import com.carrito.dao.TipoDePagoDAO;
import com.carrito.dto.CarritoItemDTO;
import com.carrito.dto.ProductDTO;
import com.carrito.forms.BasketForm;
import com.carrito.util.Constants;
import com.carrito.util.SessionUtil;

/**
 * Clase para manejar la logica de mostrar la orden definitiva de compra
 * justo antes de comprar como tal.
 * 
 * Class: ShowBasketResumeAction
 * Creation Date: 07/04/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class ShowBasketResumeAction extends Action{
	private static final Logger log = Logger.getLogger(ShowBasketResumeAction.class);
	
	@Override
	public ActionForward execute(ActionMapping mapping, ActionForm form,
			HttpServletRequest request, HttpServletResponse response)
			throws Exception {
		// TODO Auto-generated method stub
		BasketForm basketForm = (BasketForm) form;
		
		//verificamos que el usuario esta en sesion
		if(SessionUtil.getUserBeanInSession(request) == null){
			log.info("Se desea ingresar al resumen de compra pero sin un usuario en session, devolvemos este flujo al index");
			return mapping.findForward(Constants.GLOBAL_FORWARD_INDEX);
		}
		
		List<CarritoItemDTO> itemsToBuy = new LinkedList<CarritoItemDTO>();
		for (int i = 0; i < basketForm.getProductosSeleccionados().length; i++) {
			if(basketForm.getCantidadesSeleccionadas()[i] > 0){
				//este producto fue marcado para ser comprado
				//lo agregamos al resumen
				
				//obtenemos los datos del producto
				ProductDTO productoDTO =  ProductoDAO.getProductInfo(basketForm.getProductosSeleccionados()[i]);
				
				CarritoItemDTO itemDTO = new CarritoItemDTO();
				itemDTO.setCantidad(basketForm.getCantidadesSeleccionadas()[i]);
				itemDTO.setProductId(basketForm.getProductosSeleccionados()[i]);
				itemDTO.setProductName(productoDTO.getNombre());
				itemDTO.setProductPrice(productoDTO.getPrecioNetoActual());
				itemDTO.setUserId(SessionUtil.getUserIdInSession(request));
				
				itemsToBuy.add(itemDTO);
				
				log.info("Agregado al resumen de compra el siguiente item: " + itemDTO);
			}
		}
		
		request.setAttribute(Constants.PARAMETER_ITEMS_TO_BUY, itemsToBuy);
		request.setAttribute(Constants.PARAMETER_LIST_BANCOS, BancoDAO.getAll());
		request.setAttribute(Constants.PARAMETER_LIST_TIPOS_DE_PAGO, TipoDePagoDAO.getAll());
		
		//verificamos que productos fueron los seleccionados para enviarlos
		return mapping.findForward(Constants.MAPPING_SUCCESS);
	}
}
