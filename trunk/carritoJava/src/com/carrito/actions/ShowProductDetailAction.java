package com.carrito.actions;

import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import org.apache.struts.action.Action;
import org.apache.struts.action.ActionForm;
import org.apache.struts.action.ActionForward;
import org.apache.struts.action.ActionMapping;

import com.carrito.dao.ProductoDAO;
import com.carrito.dto.ProductDTO;
import com.carrito.forms.ProductForm;
import com.carrito.util.Constants;

/**
 * 
 * Class: ShowProductDetailAction <br />
 * DateCreated: 01/04/2013 <br />
 * @author T&T <br />
 *
 */
public class ShowProductDetailAction extends Action{
	
	@Override
	public ActionForward execute(ActionMapping mapping, ActionForm form,
			HttpServletRequest request, HttpServletResponse response)
			throws Exception {
		// TODO Auto-generated method stub
		ProductForm productForm = (ProductForm) form;
		
		ProductDTO product = ProductoDAO.getProductInfo(productForm.getProductId());
		
		request.setAttribute(Constants.REQUEST_PRODUCT_DTO, product);
		
		return mapping.findForward(Constants.MAPPING_SUCCESS);
	}
}
